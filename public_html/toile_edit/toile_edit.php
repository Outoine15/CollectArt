<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../dom/dom.js"></script>
    <link rel="stylesheet" href="../css/toile.css">
    <link rel="stylesheet" href="../css/default.css">
    <title>Document</title>
</head>
<body>
<?php
include("../headerfooter/header.php");
?>

<!-- <filesMatch ".php">
    Header set Cache-Control "max-age=84600, public"
</filesMatch> -->

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");

$html = "<div id='container'>";

// ça marche si ya beaucoup de data dans la db json on dirait donc poser pas trop de questions
if(isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["hauteur"]) && isset($_GET["largeur"])){
    $id=$_GET["id"];
    $nom=$_GET["name"];
    $hauteur=$_GET["hauteur"];
    $largeur=$_GET["largeur"];
    $toile_data=file_get_contents("../toilesJSON/$id.json");
    echo "<h1>$nom</h1>\n";
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
            echo "load_json_data();\n";
            echo "console.log(toile_status);\n";
    echo "</script>\n";
}

$html .= "</div>";
echo $html;

?>

</div>

<?php
include("../headerfooter/footer.php");
?>
</body>
</html>