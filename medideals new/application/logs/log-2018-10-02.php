<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-02 02:44:51 --> Severity: error --> Exception: Session: Configured save path 'C:\Windows\TEMP' is not writable by the PHP process. C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\libraries\Session\drivers\Session_files_driver.php 143
ERROR - 2018-10-02 02:44:51 --> Severity: Warning --> fopen(a7s8a4bq9po7vnbjd9gjk1abdohbv0im): failed to open stream: Permission denied C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\libraries\Session\drivers\Session_files_driver.php 172
ERROR - 2018-10-02 02:44:51 --> Session: Unable to open file 'a7s8a4bq9po7vnbjd9gjk1abdohbv0im'.
ERROR - 2018-10-02 02:44:51 --> Severity: Warning --> Unknown: Failed to write session data (user). Please verify that the current setting of session.save_path is correct (C:\Windows\TEMP) Unknown 0
ERROR - 2018-10-02 02:44:52 --> Severity: error --> Exception: Session: Configured save path 'C:\Windows\TEMP' is not writable by the PHP process. C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\libraries\Session\drivers\Session_files_driver.php 143
ERROR - 2018-10-02 02:44:52 --> Severity: Warning --> fopen(a7s8a4bq9po7vnbjd9gjk1abdohbv0im): failed to open stream: Permission denied C:\Inetpub\vhosts\medideals.co.in\httpdocs\system\libraries\Session\drivers\Session_files_driver.php 172
ERROR - 2018-10-02 02:44:52 --> Session: Unable to open file 'a7s8a4bq9po7vnbjd9gjk1abdohbv0im'.
ERROR - 2018-10-02 02:44:52 --> Severity: Warning --> Unknown: Failed to write session data (user). Please verify that the current setting of session.save_path is correct (C:\Windows\TEMP) Unknown 0
ERROR - 2018-10-02 02:48:03 --> Query error: Table 'medi.ci_session' doesn't exist - Invalid query: SELECT `data`
FROM `ci_session`
WHERE `id` = 'j017b6lrbfanvi5imja01v1s2m9smqdo'
ERROR - 2018-10-02 02:48:04 --> Query error: Table 'medi.ci_session' doesn't exist - Invalid query: SELECT `data`
FROM `ci_session`
WHERE `id` = '8hfjvcsud1fhob1po7nqetakfi6ou10j'
ERROR - 2018-10-02 02:48:26 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'medi.vendors.name' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `vendors`.`name` as `vendor_name`, `products`.`id`, `products`.`quantity`, `products`.`image`, `products`.`url`, `products_translations`.`price`, `products_translations`.`title`, `products_translations`.`old_price`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
LEFT JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`abbr` = 'en'
AND `products`.`in_slider` =0
AND `visibility` = 1
AND `quantity` >0
GROUP BY `discount`
ORDER BY `discount` DESC
 LIMIT 8
ERROR - 2018-10-02 02:48:27 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:50:43 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:50:45 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:50:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:50:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:50:46 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:50:47 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:50:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:50:50 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:02 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:04 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:05 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:51:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:10 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:11 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:51:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:19 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:19 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:19 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:51:19 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:22 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:51:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:44 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:45 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 02:51:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 02:51:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:00:10 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:00:12 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 10:00:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:00:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:00:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:00:25 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:00:31 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:46 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 10:02:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:50 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:50 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:51 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 10:02:51 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:02:54 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:03:08 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:03:08 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 10:03:08 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:03:08 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:03:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:03:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:14 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:14 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:18 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:18 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:18 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:19 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:19 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:21:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:31 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:36 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 10:41:36 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:39 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:40 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 10:41:41 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:41:53 --> 404 Page Not Found: /index
ERROR - 2018-10-02 10:42:00 --> 404 Page Not Found: /index
ERROR - 2018-10-02 12:32:40 --> 404 Page Not Found: /index
ERROR - 2018-10-02 12:47:42 --> 404 Page Not Found: /index
ERROR - 2018-10-02 12:47:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 12:47:46 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 12:47:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 13:13:49 --> 404 Page Not Found: /index
ERROR - 2018-10-02 13:13:50 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 13:13:50 --> 404 Page Not Found: /index
ERROR - 2018-10-02 13:14:10 --> 404 Page Not Found: /index
ERROR - 2018-10-02 13:14:10 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 13:14:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 13:14:23 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:17 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:17 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:18 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:18 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:05:18 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:21 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:23 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:25 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:25 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:26 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:26 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:29 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:30 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:05:59 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:23 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:25 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:26 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:10:26 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:27 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:10:28 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:31 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:50 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:10:50 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:16:04 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:16:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:16:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:16:05 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:16:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:20:07 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:21 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:25:21 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:21 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:38 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:38 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:39 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:25:39 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:39 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:45 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:25:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:25:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:09 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:26:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:14 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:14 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:26:14 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:48 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:26:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:26:49 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:27:00 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:27:36 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:27:36 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:27:36 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:27:36 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:27:36 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:27:37 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:22 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:28:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:22 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:55 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:55 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:55 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:28:55 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:28:55 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:29:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:29:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:29:05 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:29:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:10 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:10 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:30:10 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:10 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:20 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:30:20 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:32:00 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:32:27 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:32:27 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:32:27 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:32:27 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:32:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:33:07 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:33:07 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:33:08 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:33:08 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:33:09 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:45 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:36:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:56 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:56 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:56 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:36:56 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:36:57 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:37:03 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:37:03 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:37:03 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:37:03 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:37:21 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:38:01 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:38:01 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:38:01 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:38:02 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:40:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:40:16 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:40:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:40:16 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:40:47 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:40:47 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:40:47 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:40:47 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:05 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:17 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:33 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:41:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:34 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:43 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:43 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:43 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:41:43 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:56 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:56 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:41:56 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:41:57 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:13 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:48 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 14:42:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 14:42:48 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:00:35 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:00:40 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:00:41 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:44 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:44 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:44 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:44 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:44 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:24:45 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:09 --> Query error: Unknown column 'email_verify' in 'where clause' - Invalid query: SELECT *
FROM `vendors`
WHERE `email` = ''
AND `status` = 1
AND `email_verify` = 1
ERROR - 2018-10-02 15:27:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:33 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:34 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:27:34 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:34 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:34 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:34 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:37 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:37 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:27:37 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:38 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:46 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:27:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:27:46 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:28:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:28:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:28:24 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:28:24 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:29:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:29:11 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:29:11 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:29:12 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:36:10 --> Query error: Unknown column 'email_verify' in 'where clause' - Invalid query: SELECT *
FROM `vendors`
WHERE `email` = 'ajayoberoi1117@gmail.com'
AND `status` = 1
AND `email_verify` = 1
ERROR - 2018-10-02 15:36:36 --> Query error: Unknown column 'email_verify' in 'where clause' - Invalid query: SELECT *
FROM `vendors`
WHERE `email` = 'ajayoberoi1117@gmail.com'
AND `status` = 1
AND `email_verify` = 1
ERROR - 2018-10-02 15:40:40 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:40:41 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:40:41 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:40:41 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:40:41 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:40:53 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:58:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:58:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:58:15 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:58:17 --> Severity: Warning --> file_get_contents(./application/views/templates\redlabel\\assets\js\mine.js): failed to open stream: No such file or directory C:\Inetpub\vhosts\medideals.co.in\httpdocs\application\controllers\Loader.php 76
ERROR - 2018-10-02 15:58:17 --> 404 Page Not Found: /index
ERROR - 2018-10-02 15:58:18 --> 404 Page Not Found: /index
ERROR - 2018-10-02 23:31:57 --> 404 Page Not Found: 
