<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-15 04:36:41 --> 404 Page Not Found: /index
ERROR - 2018-10-15 04:36:41 --> Query error: Expression #1 of ORDER BY clause is not in SELECT list, references column 'medi.products.position' which is not in SELECT list; this is incompatible with DISTINCT - Invalid query: SELECT DISTINCT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`image`, `products`.`quantity`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`, `products`.`url`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
INNER JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`title` LIKE '%%' ESCAPE '!'
ORDER BY `position` ASC
ERROR - 2018-10-15 07:33:04 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:06 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 07:33:06 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:27 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:28 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:31 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:31 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:31 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:32 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:32 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:48 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 07:33:48 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:48 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:49 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:49 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:52 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:52 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:52 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 07:33:52 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:53 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:33:53 --> 404 Page Not Found: /index
ERROR - 2018-10-15 07:34:05 --> 404 Page Not Found: /index
ERROR - 2018-10-15 08:24:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 08:29:00 --> 404 Page Not Found: /index
ERROR - 2018-10-15 09:29:54 --> Severity: Notice --> Undefined index: name C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 431
ERROR - 2018-10-15 09:29:54 --> Severity: Notice --> Undefined index: email C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 432
ERROR - 2018-10-15 09:29:54 --> Severity: Notice --> Undefined index: contact C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 433
ERROR - 2018-10-15 09:29:54 --> Severity: Notice --> Undefined index: message C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Home.php 434
ERROR - 2018-10-15 09:29:54 --> Query error: Column 'name' cannot be null - Invalid query: INSERT INTO `enquiry_form` (`name`, `email`, `contact`, `message`) VALUES (NULL, NULL, NULL, NULL)
ERROR - 2018-10-15 10:38:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:53 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:54 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:54 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:54 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:54 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 10:39:55 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 10:39:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:39:58 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:40:08 --> 404 Page Not Found: /index
ERROR - 2018-10-15 10:40:50 --> Query error: Expression #1 of ORDER BY clause is not in SELECT list, references column 'medi.products.position' which is not in SELECT list; this is incompatible with DISTINCT - Invalid query: SELECT DISTINCT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`image`, `products`.`quantity`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`, `products`.`url`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
INNER JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`title` LIKE '%%' ESCAPE '!'
ORDER BY `position` ASC
ERROR - 2018-10-15 11:19:38 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:40 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:40 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 11:19:41 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:43 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 11:19:44 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:44 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:50 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:19:59 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:35:32 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:55:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:55:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:55:10 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 11:55:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:55:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:42 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:43 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:44 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:46 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:46 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 11:57:46 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:49 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:57:52 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:58:01 --> 404 Page Not Found: /index
ERROR - 2018-10-15 11:58:16 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:02 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:03 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:03 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 12:03:03 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:03 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:17 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:29 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:29 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 12:03:29 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:03:30 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:15 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:15 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 12:04:15 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:16 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 12:04:16 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:17 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:21 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:21 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 12:04:21 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:21 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 12:04:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 12:04:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 13:11:03 --> 404 Page Not Found: /index
ERROR - 2018-10-15 13:30:46 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:18 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:18 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:46:18 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:19 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:19 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:25 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:25 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:25 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:46:26 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:31 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:31 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:46:31 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:31 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:32 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:34 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:34 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:34 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:34 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:46:34 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:46:34 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:09 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:47:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:12 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:12 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:12 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:12 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:47:13 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:14 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:14 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:47:14 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:14 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:14 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:33 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:33 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:47:33 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:33 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:36 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:36 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:36 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:47:36 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:37 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:38 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:38 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:39 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:47:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:47:54 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:48:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:48:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:48:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:48:09 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:48:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:48:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:48:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:07 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:08 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:08 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:08 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 14:49:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:23 --> Could not find the language line "vendor_home_page"
ERROR - 2018-10-15 14:49:24 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:36 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:49:44 --> Severity: Notice --> Undefined index: the_id C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules\vendor\controllers\Orders.php 165
ERROR - 2018-10-15 14:49:44 --> Query error: Unknown column 'processed' in 'field list' - Invalid query: SELECT `processed`
FROM `vendors_orders`
WHERE `id` IS NULL
ERROR - 2018-10-15 14:49:56 --> Severity: Notice --> Undefined index: the_id C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules\vendor\controllers\Orders.php 165
ERROR - 2018-10-15 14:49:56 --> Query error: Unknown column 'processed' in 'field list' - Invalid query: SELECT `processed`
FROM `vendors_orders`
WHERE `id` IS NULL
ERROR - 2018-10-15 14:50:52 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:51:00 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:51:50 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:51:59 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:52:08 --> Could not find the language line "vendor_home_page"
ERROR - 2018-10-15 14:52:20 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:52:40 --> 404 Page Not Found: /index
ERROR - 2018-10-15 14:54:05 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:06:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\libraries\PHPMailer\class.smtp.php:234) C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\helpers\url_helper.php 561
ERROR - 2018-10-15 15:08:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:08:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:08:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:08:22 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:08:23 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:08:28 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:08:33 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:08:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:10:06 --> Could not find the language line "vendor_home_page"
ERROR - 2018-10-15 15:10:56 --> Could not find the language line "vendor_home_page"
ERROR - 2018-10-15 15:13:19 --> Could not find the language line "vendor_home_page"
ERROR - 2018-10-15 15:13:56 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:13:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:13:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:13:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:13:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:13:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:13:56 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:14:08 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:16:20 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:16:20 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:16:20 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:16:21 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:08 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:09 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:10 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:12 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:24:12 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:15 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:27 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:33 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:24:34 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:23 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:23 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:25 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:29:25 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:28 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:29:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:19 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:20 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:20 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:20 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:21 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:32:21 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:22 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-15 15:32:22 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:23 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:25 --> 404 Page Not Found: /index
ERROR - 2018-10-15 15:32:39 --> 404 Page Not Found: /index
ERROR - 2018-10-15 16:59:48 --> 404 Page Not Found: /index
