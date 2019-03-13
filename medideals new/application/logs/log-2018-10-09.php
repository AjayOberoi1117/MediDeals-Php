<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-09 03:42:07 --> 404 Page Not Found: /index
ERROR - 2018-10-09 09:24:44 --> 404 Page Not Found: /index
ERROR - 2018-10-09 09:47:38 --> 404 Page Not Found: /index
ERROR - 2018-10-09 09:47:41 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 09:47:41 --> 404 Page Not Found: /index
ERROR - 2018-10-09 09:47:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 10:05:43 --> 404 Page Not Found: /index
ERROR - 2018-10-09 10:47:58 --> 404 Page Not Found: /index
ERROR - 2018-10-09 10:48:03 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 10:48:03 --> 404 Page Not Found: /index
ERROR - 2018-10-09 10:48:12 --> 404 Page Not Found: /index
ERROR - 2018-10-09 10:48:20 --> 404 Page Not Found: /index
ERROR - 2018-10-09 11:01:44 --> 404 Page Not Found: /index
ERROR - 2018-10-09 11:01:45 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 11:01:45 --> 404 Page Not Found: /index
ERROR - 2018-10-09 11:01:45 --> 404 Page Not Found: /index
ERROR - 2018-10-09 11:01:45 --> 404 Page Not Found: /index
ERROR - 2018-10-09 11:01:48 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:09 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:09 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:10 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:12 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:12 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 19:15:13 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:16 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:19 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:15:27 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:17:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 19:37:54 --> Severity: Notice --> Undefined variable: status C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules\vendor\models\Auth_model.php 86
ERROR - 2018-10-09 19:39:04 --> Severity: Warning --> include_once(C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules\vendor\models\Auth_model.php): failed to open stream: Permission denied C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\third_party\MX\Modules.php 157
ERROR - 2018-10-09 19:39:04 --> Severity: Warning --> include_once(): Failed opening 'C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules/vendor/models/Auth_model.php' for inclusion (include_path='.;.\includes;.\pear') C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\third_party\MX\Modules.php 157
ERROR - 2018-10-09 19:39:04 --> Severity: Error --> Class 'Auth_model' not found C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\third_party\MX\Loader.php 225
ERROR - 2018-10-09 19:39:21 --> Severity: Notice --> Undefined variable: status C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules\vendor\models\Auth_model.php 86
ERROR - 2018-10-09 19:42:03 --> Could not find the language line "vendor_home_page"
ERROR - 2018-10-09 20:21:15 --> 404 Page Not Found: /index
ERROR - 2018-10-09 20:21:15 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 20:21:16 --> 404 Page Not Found: /index
ERROR - 2018-10-09 20:39:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 20:39:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 20:39:43 --> 404 Page Not Found: /index
ERROR - 2018-10-09 20:51:42 --> Query error: Table 'medi.affiliate_code' doesn't exist - Invalid query: SELECT `aff_code`
FROM `affiliate_code`
WHERE `vendor_id` = '26'
ERROR - 2018-10-09 21:00:06 --> Query error: Table 'medi.affiliate_code_map' doesn't exist - Invalid query: SELECT `affiliated_id`
FROM `affiliate_code_map`
WHERE `affiliated_id` = '26'
ERROR - 2018-10-09 21:03:15 --> Query error: Unknown column 'affiliate_code_map.date' in 'field list' - Invalid query: SELECT `vendors`.`firm_name`, `vendors`.`email`, `affiliate_code_map`.`date`
FROM `affiliate_code_map`
INNER JOIN `vendors` ON `affiliate_code_map`.`affiliated_id` = `vendors`.`id`
WHERE `affiliate_code_map`.`affiliate_id` = '26'
 LIMIT 2
ERROR - 2018-10-09 21:05:57 --> Query error: Column 'affiliate_id' cannot be null - Invalid query: INSERT INTO `affiliate_code_map` (`affiliate_id`, `affiliated_id`) VALUES (NULL, '26')
ERROR - 2018-10-09 21:06:27 --> Query error: Column 'affiliate_id' cannot be null - Invalid query: INSERT INTO `affiliate_code_map` (`affiliate_id`, `affiliated_id`) VALUES (NULL, '26')
ERROR - 2018-10-09 21:13:33 --> Severity: Notice --> Undefined index: aff_code C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\modules\vendor\controllers\VendorProfile.php 241
ERROR - 2018-10-09 21:13:33 --> Query error: Column 'affiliate_id' cannot be null - Invalid query: INSERT INTO `affiliate_code_map` (`affiliate_id`, `affiliated_id`) VALUES (NULL, '26')
ERROR - 2018-10-09 21:13:46 --> Query error: Column 'affiliate_id' cannot be null - Invalid query: INSERT INTO `affiliate_code_map` (`affiliate_id`, `affiliated_id`) VALUES (NULL, '26')
ERROR - 2018-10-09 21:20:11 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:11 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:11 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:20:11 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:11 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:21 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:21 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:21 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:20:21 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:25 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:25 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:25 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:20:25 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:25 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:58 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:20:59 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:20:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:00 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:05 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:05 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:21:05 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:06 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:09 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:09 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:10 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:21:10 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:12 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:12 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:13 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:13 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:13 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:21:13 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:35 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:35 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:21:35 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:36 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:38 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:39 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:39 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:21:39 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:42 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:21:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:21:42 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:44:55 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:44:55 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:44:56 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:44:58 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:44:58 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:44:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:45:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:45:59 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:45:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:00 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:04 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:05 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:05 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:46:05 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:07 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:07 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:08 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:46:08 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:46:08 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:06 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:07 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:08 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:09 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:09 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:47:09 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:31 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:32 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:47:32 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:33 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:38 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:38 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:38 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:47:38 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:41 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:41 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:41 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:47:41 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:47:41 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:48:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:48:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:48:22 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:48:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:48:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:48:23 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:48:43 --> Query error: Column 'discount_code' cannot be null - Invalid query: INSERT INTO `orders` (`order_id`, `final_amount`, `products`, `date`, `referrer`, `clean_referrer`, `payment_type`, `paypal_status`, `discount_code`) VALUES (1021, 21877, 'a:5:{i:5;s:2:\"30\";i:7;s:2:\"40\";i:20;s:2:\"35\";i:59;s:2:\"50\";i:70;s:2:\"40\";}', 1539121723, 'Direct', 'Direct', 'cashOnDelivery', NULL, NULL)
ERROR - 2018-10-09 21:49:01 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:01 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:01 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:49:01 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:01 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:02 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:38 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:39 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:49:39 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:39 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:44 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:44 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:45 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:49:45 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:47 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:47 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:48 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:48 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:49:48 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:49:48 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:50:21 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:50:25 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:50:26 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:50:28 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:50:28 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:50:29 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:50:31 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:04 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:04 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:05 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:06 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:52:06 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:06 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:21 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:21 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:22 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:52:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:52:22 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:23 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:23 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:23 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:54:23 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:23 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:24 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:30 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:30 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:31 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:32 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:32 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:54:33 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:34 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:35 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:54 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:54 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:56 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:56 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:54:56 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:58 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:54:59 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:28 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:29 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:29 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:55:29 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:29 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:55 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:55 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:56 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 21:55:56 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:56 --> 404 Page Not Found: /index
ERROR - 2018-10-09 21:55:56 --> 404 Page Not Found: /index
ERROR - 2018-10-09 23:11:30 --> 404 Page Not Found: /index
ERROR - 2018-10-09 23:31:14 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-09 23:31:14 --> 404 Page Not Found: /index
ERROR - 2018-10-09 23:31:15 --> 404 Page Not Found: /index
