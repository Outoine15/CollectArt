<?php
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");


$id = 0;
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$toile_data = select_toile($conn, $id);
$toile_str = json_encode($toile_data);

header("Content-Type: application/json; charset=utf-8");

echo($toile_str);
?>