<?php
//start session
session_start();

//create constant to store database
define('SITEURL', 'http://localhost/food_order/');
define('LOCALHOST','localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food_order');
// Execute query and save data in database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);//database connection
$db_select = mysqli_select_db($conn, DB_NAME);//selecting database
?>