<?php
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");

if(isset($_GET["id"])){
    $id=$_GET["id"];
}
$toile_data = select_toile($conn,$id);
print_r($toile_data);
$toile_name = $toile_data["name"];
$toiles = select_toiles($conn);
print_r($toiles);
$toile_name_str = json_encode($toile_name);
echo "${toile_name_str}";
?>