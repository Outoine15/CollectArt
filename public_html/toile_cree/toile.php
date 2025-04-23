<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../dom/dom.js"></script>
    <title>toile</title>
</head>
<body>
<button type="button" name="save">sauvegarder</button>

<?php

?>

</body>

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
    insert_toile($conn,$nom,$description,1);
    $id=get_last_inserted_id($conn);
    echo "<h1>$nom</h1>";
    echo "<script>";
    echo "var toile_status = {
            'nom': '$nom',
            'toile_id': $id,
            'hauteur': $hauteur,
            'largeur': $largeur,
            'color' : '#000000',
            'pixelData' : [],
            isDrawing : false
            };";
            echo "make_toile();\n";
                echo "load_json_data($id);";
            // TODO: add save dans json.crud.php
        }
echo "</script>";
?>

</html>