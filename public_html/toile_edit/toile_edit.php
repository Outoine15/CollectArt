<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["admin_id"])){
    header("Location: ../main/index.php");
}

include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
include("../crud/toile_participants.crud.php");

$member=false;
$creator=false;
$admin=false;
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $participants=select_toile_participants_toile($conn,$id);
    for ($i=0; $i < count($participants); $i++) { 
        if($participants[$i]["id_user"]==$_SESSION["user"]){
            $member=true;
        }
    }
    $toile_metadata=select_toile($conn,$id);
    $toile_creator=$toile_metadata["id_creator"];
    if($toile_creator==$_SESSION["user"]){
        $creator=true;
    }

}
if(isset($_GET["admin_id"])){
    $admin=true;
}
if(!$member && !$creator && !$admin){
    header("Location: ../main/index.php");
}
?>

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

$html = "<div id='container'>";
$html .= "<a href='../pages/toile_setting.php'>settings</a>";
// ça marche si ya beaucoup de data dans la db json on dirait donc poser pas trop de questions
if(isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["hauteur"]) && isset($_GET["largeur"])){
    $id=$_GET["id"];
    $nom=$_GET["name"];
    $hauteur=$_GET["hauteur"];
    $largeur=$_GET["largeur"];
    $toile_data=file_get_contents("../toilesJSON/$id.json");
    $_SESSION["toile_id"]=$id;
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