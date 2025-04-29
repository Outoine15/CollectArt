<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// include("db_params.php") ; 

$env = parse_ini_file("/home/grp5/public_html/.env");
$USER = $env["ID"];
$PASS = $env["MDP"];
$HOST = $env["HOST"];
$DB = $env["DB"];

$conn = mysqli_connect($HOST, $USER,$PASS, $DB);
mysqli_set_charset($conn, "utf8");

?>