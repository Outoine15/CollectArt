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
<?php
?>
</body>
<?php
if(isset($_POST["nom"]) && isset($_POST["hauteur"]) && isset($_POST["largeur"])){
    $nom=$_POST["nom"];
    $hauteur=$_POST["hauteur"];
    $largeur=$_POST["largeur"];
    echo "<h1>$nom</h1>";
    echo "<script>";
    echo "var toile_status = {
            'nom': '$nom',
            'hauteur': $hauteur,
            'largeur':$largeur,
            'color' : '#000000',
            'pixelData' : [],
            isDrawing : false
            };";
            echo "make_toile();\n";
            if($nom=="test"){
                echo "load_json_data();";
            }
        }
echo "</script>";
?>
</html>