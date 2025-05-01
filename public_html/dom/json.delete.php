<?php
session_start();

include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

if((isset($_SESSION["user"]) || isset($_SESSION["admin_id"])) && isset($_GET["id"]) && isset($_GET["action"])){
    $id=$_GET["id"];
    if(isset($_SESSION["admin_id"])){
        delete_toile_total($id,$conn);
    }
    $toile=select_toile($conn,$id);
    $id_creator=$toile["id_creator"];
    if($_SESSION["user"]==$id_creator){
        delete_toile_total($id,$conn);
    }
}

function delete_toile_total($id,$conn){
    $json_file_name="../toilesJSON/";
    $json_file_name.=$id;
    $json_file_name.=".json";
    unlink($json_file_name);
    delete_toile($conn,$id);

    include("../DBconnect/db_disconnect.php");

    if($_GET["action"]=="from_user"){
        header("Location: ../pages/mes_toiles.php");    
    } else if($_GET["action"]=="from_admin"){
        header("Location: ../admin/index.php");
    }
}

?>