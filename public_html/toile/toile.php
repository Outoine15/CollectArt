<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../dom/dom.js"></script>
    <title>toile</title>
</head>
<body onload="load_toile()">
<?php
echo "<script>";
if(isset($_POST["nom"]) && isset($_POST["hauteur"]) && isset($_POST["largeur"])){
    $nom=$_POST["nom"];
    $hauteur=$_POST["hauteur"];
    $largeur=$_POST["largeur"];
    echo "var toile_status = {
            'size': $hauteur,
            'color' : '#000000',
            'pixelData' : [],
            isDrawing : false
            };";
}
echo "</script>";
?>
</body>
</html>