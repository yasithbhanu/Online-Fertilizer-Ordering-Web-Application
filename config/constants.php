<?php

session_start();

define('SITEURL', 'http://localhost/Agro-Shop/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'agro');

// Database Connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

// Select the Database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>