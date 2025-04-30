<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("../DBconnect/db_connect.php");
$json_file_name = "../toilesJSON/";
$json_file_name .= $_GET["id"];
$json_file_name .= ".json";
unlink($json_file_name);
include("../crud/toile.crud.php");
delete_toile($conn, $_GET["id"]);
include("../DBconnect/db_disconnect.php");
header("Location: ../admin/index.php");
?>