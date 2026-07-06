#!/usr/bin/env python3
"""
MediDeals Scout — vendor/product discovery helper
Version: 1.0.0

Purpose
-------
A safe, polite scouting utility for MediDeals. It reads seed URLs or a CSV file
of vendor/product/catalog pages, respects robots.txt by default, extracts basic
page metadata and product-like text snippets, and writes JSONL output for human
review before any ingestion into the MediDeals database.

This scout does not scrape private systems, bypass logins, or collect personal
sensitive data. Use it only for sources you own or are authorized to inspect.

Usage examples
--------------
python scouts/medideals_scout.py --seed-url https://example-pharma.com/products --max-pages 5
python scouts/medideals_scout.py --source-csv vendor_sources.csv --out data/scout/medideals_sources.jsonl
"""

from __future__ import annotations

import argparse
import csv
import html
import json
import random
import re
import time
from dataclasses import asdict, dataclass
from datetime import datetime, timezone
from html.parser import HTMLParser
from pathlib import Path
from typing import Dict, Iterable, List, Optional, Set, Tuple
from urllib.parse import urljoin, urlparse
from urllib.robotparser import RobotFileParser

import requests

DEFAULT_USER_AGENT = "MediDealsScout/1.0 (+https://github.com/AjayOberoi1117/MediDeals-Php)"
PRODUCT_HINTS = [
    "tablet", "capsule", "injection", "syrup", "ointment", "cream", "drops",
    "mrp", "composition", "strength", "strip", "bottle", "vial", "ampoule",
    "surgical", "ayurvedic", "otc", "generic", "ethical", "pharma",
]


@dataclass
class ScoutRecord:
    source_url: str
    domain: str
    title: str
    fetched_at: str
    status: str
    content_length: int
    candidate_products: List[str]
    links: List[str]


class SimpleHTMLParser(HTMLParser):
    def __init__(self) -> None:
        super().__init__()
        self.in_title = False
        self.title_parts: List[str] = []
        self.text_parts: List[str] = []
        self.links: List[str] = []
        self.skip_depth = 0

    def handle_starttag(self, tag: str, attrs) -> None:
        tag = tag.lower()
        attrs_dict = dict(attrs)
        if tag == "title":
            self.in_title = True
        if tag in {"script", "style", "noscript"}:
            self.skip_depth += 1
        if tag == "a":
            href = attrs_dict.get("href")
            if href:
                self.links.append(href)

    def handle_endtag(self, tag: str) -> None:
        tag = tag.lower()
        if tag == "title":
            self.in_title = False
        if tag in {"script", "style", "noscript"} and self.skip_depth:
            self.skip_depth -= 1

    def handle_data(self, data: str) -> None:
        if self.skip_depth:
            return
        cleaned = data.strip()
        if not cleaned:
            return
        if self.in_title:
            self.title_parts.append(cleaned)
        else:
            self.text_parts.append(cleaned)

    @property
    def title(self) -> str:
        return " ".join(self.title_parts).strip()

    @property
    def text(self) -> str:
        raw = "\n".join(self.text_parts)
        raw = html.unescape(raw)
        raw = re.sub(r"\n{3,}", "\n\n", raw)
        return raw.strip()


def now_iso() -> str:
    return datetime.now(timezone.utc).isoformat()


def domain_of(url: str) -> str:
    return urlparse(url).netloc.lower()


def normalize_url(base_url: str, href: str) -> Optional[str]:
    full = urljoin(base_url, href)
    parsed = urlparse(full)
    if parsed.scheme not in {"http", "https"}:
        return None
    return full.split("#", 1)[0]


def read_seed_urls(args: argparse.Namespace) -> List[str]:
    seeds: List[str] = []
    if args.seed_url:
        seeds.extend(args.seed_url)
    if args.source_csv:
        with open(args.source_csv, newline="", encoding="utf-8") as f:
            reader = csv.DictReader(f)
            for row in reader:
                url = row.get("url") or row.get("website") or row.get("source_url")
                if url:
                    seeds.append(url.strip())
    cleaned = []
    seen = set()
    for url in seeds:
        if not url:
            continue
        if not url.startswith(("http://", "https://")):
            url = "https://" + url
        if url not in seen:
            cleaned.append(url)
            seen.add(url)
    return cleaned


def robots_allowed(url: str, user_agent: str, cache: Dict[str, RobotFileParser]) -> bool:
    parsed = urlparse(url)
    robots_url = f"{parsed.scheme}://{parsed.netloc}/robots.txt"
    if robots_url not in cache:
        rp = RobotFileParser()
        rp.set_url(robots_url)
        try:
            rp.read()
        except Exception:
            # If robots cannot be fetched, be conservative but allow a single manual-review fetch.
            return True
        cache[robots_url] = rp
    return cache[robots_url].can_fetch(user_agent, url)


def request_get(session: requests.Session, url: str, timeout: int = 45) -> str:
    response = session.get(url, timeout=timeout)
    response.raise_for_status()
    ctype = response.headers.get("content-type", "")
    if "text/html" not in ctype and "application/xhtml" not in ctype and ctype:
        raise ValueError(f"Unsupported content-type: {ctype}")
    return response.text


def extract_candidate_products(text: str, max_items: int = 25) -> List[str]:
    candidates: List[str] = []
    seen = set()
    lines = [re.sub(r"\s+", " ", line).strip() for line in text.splitlines()]
    for line in lines:
        if len(line) < 8 or len(line) > 220:
            continue
        lower = line.lower()
        if any(hint in lower for hint in PRODUCT_HINTS):
            if line not in seen:
                candidates.append(line)
                seen.add(line)
        if len(candidates) >= max_items:
            break
    return candidates


def append_jsonl(path: Path, record: ScoutRecord) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    with path.open("a", encoding="utf-8") as f:
        f.write(json.dumps(asdict(record), ensure_ascii=False) + "\n")


def crawl(args: argparse.Namespace) -> int:
    seeds = read_seed_urls(args)
    if not seeds:
        print("No seed URLs supplied. Use --seed-url or --source-csv.")
        return 2

    out_path = Path(args.out)
    session = requests.Session()
    session.headers.update({"User-Agent": args.user_agent})
    robots_cache: Dict[str, RobotFileParser] = {}

    queue: List[Tuple[str, int]] = [(url, 0) for url in seeds]
    seen: Set[str] = set()
    saved = skipped = failed = 0

    print("=" * 72)
    print("MediDeals Scout — Vendor/Product Discovery")
    print("=" * 72)
    print(f"Seeds       : {len(seeds)}")
    print(f"Max pages   : {args.max_pages}")
    print(f"Max depth   : {args.max_depth}")
    print(f"Output      : {out_path}")
    print("=" * 72)

    while queue and saved < args.max_pages:
        url, depth = queue.pop(0)
        if url in seen:
            continue
        seen.add(url)

        if args.respect_robots and not robots_allowed(url, args.user_agent, robots_cache):
            skipped += 1
            print(f"robots skip: {url}")
            continue

        try:
            html_text = request_get(session, url)
            parser = SimpleHTMLParser()
            parser.feed(html_text)
            text = parser.text
            links = []
            for href in parser.links:
                full = normalize_url(url, href)
                if not full:
                    continue
                if domain_of(full) == domain_of(url) and full not in seen:
                    links.append(full)

            candidates = extract_candidate_products(text)
            record = ScoutRecord(
                source_url=url,
                domain=domain_of(url),
                title=parser.title,
                fetched_at=now_iso(),
                status="scouted",
                content_length=len(text),
                candidate_products=candidates,
                links=links[:50],
            )
            append_jsonl(out_path, record)
            saved += 1
            print(f"saved {saved}: {url} | candidates={len(candidates)} | title={parser.title[:60]}")

            if depth < args.max_depth:
                for link in links[: args.max_links_per_page]:
                    if link not in seen:
                        queue.append((link, depth + 1))
        except Exception as exc:
            failed += 1
            print(f"failed: {url} | {exc}")

        time.sleep(args.delay + random.uniform(0, args.jitter))

    print("=" * 72)
    print(f"Saved   : {saved}")
    print(f"Skipped : {skipped}")
    print(f"Failed  : {failed}")
    print("=" * 72)
    return 0


def build_parser() -> argparse.ArgumentParser:
    parser = argparse.ArgumentParser(description="MediDeals vendor/product scout")
    parser.add_argument("--seed-url", action="append", help="Seed website/catalog/product URL. Can be repeated.")
    parser.add_argument("--source-csv", help="CSV with url, website, or source_url column.")
    parser.add_argument("--out", default="data/scout/medideals_scout.jsonl")
    parser.add_argument("--max-pages", type=int, default=10)
    parser.add_argument("--max-depth", type=int, default=1)
    parser.add_argument("--max-links-per-page", type=int, default=10)
    parser.add_argument("--delay", type=float, default=2.0)
    parser.add_argument("--jitter", type=float, default=1.0)
    parser.add_argument("--user-agent", default=DEFAULT_USER_AGENT)
    parser.add_argument("--no-robots", dest="respect_robots", action="store_false", help="Disable robots.txt checking only for sources you own/control.")
    parser.set_defaults(respect_robots=True)
    return parser


if __name__ == "__main__":
    raise SystemExit(crawl(build_parser().parse_args()))
