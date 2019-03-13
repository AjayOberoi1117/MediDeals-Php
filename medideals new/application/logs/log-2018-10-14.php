<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-14 01:42:25 --> Severity: Notice --> Undefined index: name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 431
ERROR - 2018-10-14 01:42:25 --> Severity: Notice --> Undefined index: email C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 432
ERROR - 2018-10-14 01:42:25 --> Severity: Notice --> Undefined index: contact C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 433
ERROR - 2018-10-14 01:42:25 --> Severity: Notice --> Undefined index: message C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 434
ERROR - 2018-10-14 01:42:25 --> Query error: Column 'name' cannot be null - Invalid query: INSERT INTO `enquiry_form` (`name`, `email`, `contact`, `message`) VALUES (NULL, NULL, NULL, NULL)
ERROR - 2018-10-14 02:24:21 --> 404 Page Not Found: /index
ERROR - 2018-10-14 02:24:21 --> 404 Page Not Found: /index
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined variable: category C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 221
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined index: sel_price C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\models\Public_model.php 632
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined index: sel_discount C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\models\Public_model.php 640
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined index: sel_brand C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\models\Public_model.php 643
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined index: sel_city C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\models\Public_model.php 646
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined index: sel_cat C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\models\Public_model.php 650
ERROR - 2018-10-14 08:49:33 --> Severity: Notice --> Undefined index: search_prod C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\models\Public_model.php 653
ERROR - 2018-10-14 08:49:33 --> Query error: Unknown column 'R' in 'where clause' - Invalid query: SELECT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`quantity`, `products`.`brand`, `products`.`image`, `products`.`url`, `products_translations`.`price`, `products_translations`.`title`, `products_translations`.`old_price`, `shop_categories_translations`.`name`, `products`.`shop_categorie`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
LEFT JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
LEFT JOIN `shop_categories_translations` ON `shop_categories_translations`.`id` = `products`.`shop_categorie`
WHERE `products`.`shop_categorie` IS NULL
AND `products_translations`.`abbr` = 'en'
AND `visibility` = 1
AND `products_translations`.`price` >= `R`
AND `products_translations`.`price` <= `s`
AND `quantity` >0
ORDER BY `products`.`id`
ERROR - 2018-10-14 08:49:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\core\Exceptions.php:271) C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\core\Common.php 564
ERROR - 2018-10-14 10:05:13 --> Query error: Expression #1 of ORDER BY clause is not in SELECT list, references column 'medi.products.position' which is not in SELECT list; this is incompatible with DISTINCT - Invalid query: SELECT DISTINCT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`image`, `products`.`quantity`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`, `products`.`url`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
INNER JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`title` LIKE '%%' ESCAPE '!'
ORDER BY `position` ASC
ERROR - 2018-10-14 12:36:48 --> 404 Page Not Found: ../modules/Vendor/controllers//index
ERROR - 2018-10-14 13:51:29 --> 404 Page Not Found: /index
ERROR - 2018-10-14 13:52:35 --> Severity: Notice --> Undefined index: product_id C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\ShoppingCartPage.php 48
ERROR - 2018-10-14 13:52:35 --> Severity: Notice --> Undefined index: new_quantity C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\ShoppingCartPage.php 49
ERROR - 2018-10-14 13:52:35 --> Severity: Notice --> Undefined index: min_quantity C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\ShoppingCartPage.php 50
ERROR - 2018-10-14 13:52:35 --> Severity: Notice --> Undefined index: max_quantity C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\ShoppingCartPage.php 51
ERROR - 2018-10-14 13:52:35 --> Severity: Notice --> Undefined index: action C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\ShoppingCartPage.php 53
ERROR - 2018-10-14 13:52:35 --> Severity: Notice --> Undefined index: action C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\ShoppingCartPage.php 79
ERROR - 2018-10-14 15:08:23 --> 404 Page Not Found: /index
ERROR - 2018-10-14 15:08:23 --> Severity: Warning --> Missing argument 1 for Home::vendor() C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 72
ERROR - 2018-10-14 15:08:23 --> Severity: Notice --> Undefined variable: vendor_name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 77
ERROR - 2018-10-14 15:08:23 --> Severity: Notice --> Undefined variable: vendor_name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 82
ERROR - 2018-10-14 15:08:23 --> Severity: Notice --> Undefined variable: vendor_name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 95
ERROR - 2018-10-14 15:08:23 --> Severity: Notice --> Undefined variable: vendor_name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 99
ERROR - 2018-10-14 15:08:23 --> Severity: Notice --> Undefined variable: vendor_name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 100
ERROR - 2018-10-14 15:08:23 --> Severity: Notice --> Undefined variable: vendor_name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 103
ERROR - 2018-10-14 16:40:21 --> Query error: Expression #1 of ORDER BY clause is not in SELECT list, references column 'medi.products.position' which is not in SELECT list; this is incompatible with DISTINCT - Invalid query: SELECT DISTINCT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`image`, `products`.`quantity`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`, `products`.`url`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
INNER JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`title` LIKE '%%' ESCAPE '!'
ORDER BY `position` ASC
ERROR - 2018-10-14 20:32:58 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-14 20:32:58 --> 404 Page Not Found: /index
ERROR - 2018-10-14 21:12:39 --> 404 Page Not Found: /index
ERROR - 2018-10-14 21:12:40 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-14 21:12:40 --> 404 Page Not Found: /index
ERROR - 2018-10-14 21:22:34 --> 404 Page Not Found: /index
ERROR - 2018-10-14 21:22:35 --> 404 Page Not Found: /index
ERROR - 2018-10-14 22:33:37 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-14 22:36:29 --> Query error: Expression #1 of ORDER BY clause is not in SELECT list, references column 'medi.products.position' which is not in SELECT list; this is incompatible with DISTINCT - Invalid query: SELECT DISTINCT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`image`, `products`.`quantity`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`, `products`.`url`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
INNER JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`title` LIKE '%%' ESCAPE '!'
ORDER BY `position` ASC
