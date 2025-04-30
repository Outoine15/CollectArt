<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: ../user/connUser.php");
}
?>
<script src="../dom/dom.js"></script>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
if(isset($_POST["nom"]) && isset($_POST["hauteur"]) && isset($_POST["largeur"]) && isset($_POST["description"])){
    $nom=$_POST["nom"];
    $description=$_POST["description"];
    $hauteur=$_POST["hauteur"];
    $largeur=$_POST["largeur"];
    $id_creator=2;
    if(isset($_SESSION["user"])){
        $id_creator=(int)$_SESSION["user"];
    }
    // print_r($id_creator);
    insert_toile($conn,$nom,$description,$id_creator,$hauteur,$largeur,0);
    $id=get_last_inserted_id($conn);
    file_put_contents("../toilesJSON/$id.json","[]");
    $toile_data=file_get_contents("../toilesJSON/$id.json");
    echo "<script>\n";
    echo "var toile_status = {
            'nom': '$nom',
            'toile_id': $id,
            'hauteur': $hauteur,
            'largeur': $largeur,
            'color' : '#000000',
            'pixelData' : $toile_data,
            'loadData' : $toile_data,
            isDrawing : false
            };\n";
            echo "make_toile('create');\n";
            echo "send_json_data_for_save();\n";
            // echo "load_json_data();\n";
            echo "console.log(toile_status);\n";
        }
echo "</script>";

// header("Location: ../pages/mes_toiles.php");
?>