<?php
header("Content-Type: application/json");
// $data = [];

// build a PHP variable from JSON sent using POST method
$data = file_get_contents("php://input");

// json_decode fait de la merde donc voila:
$full_length = strlen($data);
while ($data[-$i]!=",") { 
    $i=$i+1;
    // ne fait que 2/3 boucles (délimite l'ID)
}

$filename=substr($data,-$i+1,-1);
$pixelData=substr($data,-$full_length+1,$full_length-$i-1);
// $pixelData=$data[0];
// $filename=$data[1];
// $pixelData=$data;
// $filename="test2870";
// la c'est la merde:
// if(isset($_GET["data"]) && isset($_GET["path"])){
//     $data=$_GET["data"];
$path = "../toilesJSON/${filename}.json";
// $str_json = file_get_contents('php://input');
    save_json_toile($pixelData,$path);
// }

// ça ca marche:
function save_json_toile($toile_data,$filename){
    print_r($toile_data);
    file_put_contents($filename,$toile_data);
}
?>