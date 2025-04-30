<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: ../user/connUser.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/toile.css">
    <link rel="stylesheet" href="../css/default.css">
    <script src="../dom/dom.js"></script>
    <title>toile</title>
</head>

<?php
include("../headerfooter/header.php");
?>
<div id="container">
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
    if(isset($_SESSION["user"])){
        $id_creator=$_SESSION["user"];
    } else{
        $id_creator=1;
    }
    insert_toile($conn,$nom,$description,$id_creator,$hauteur,$largeur,0);
    $id=get_last_inserted_id($conn);
    file_put_contents("../toilesJSON/$id.json","[]");
    $toile_data=file_get_contents("../toilesJSON/$id.json");
    echo "<h1>$nom</h1>";
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
            echo "make_toile();\n";
            // echo "load_json_data();\n";
            echo "console.log(toile_status);\n";
        }
echo "</script>";
?>
</div>

<?php
include("../headerfooter/footer.php");
?>
</body>
</html>