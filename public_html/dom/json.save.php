<?php
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
$data = [];

// la c'est la merde:
if(isset($_GET["data"]) && isset($_GET["path"])){
    $data=$_GET["data"];
$path = "../toilesJSON/${$_GET["path"]}";
$str_json = file_get_contents('php://input');
    save_json_toile($str_json,$path);
}

// ça ca marche:
function save_json_toile($toile_data,$filename){
    print_r($toile_data);
    file_put_contents($filename,$toile_data);
}
?>