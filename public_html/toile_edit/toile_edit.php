<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["admin_id"])){
    header("Location: ../main/index.php");
}

include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
include("../crud/toile_participants.crud.php");
include("../crud/user.crud.php");

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
    <link rel="stylesheet" href="../css/page_toile.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("../headerfooter/header.php");
    ?>

    <!-- <filesMatch ".php">
    Header set Cache-Control "max-age=84600, public"
</filesMatch> -->

<div id="container">

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// ça marche si ya beaucoup de data dans la db json on dirait donc poser pas trop de questions
if(isset($_GET["action"]) && isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["hauteur"]) && isset($_GET["largeur"])){
    $action = $_GET["action"];
    $id=$_GET["id"];
    $nom=$_GET["name"];
    $hauteur=$_GET["hauteur"];
    $largeur=$_GET["largeur"];
    $toile_data=file_get_contents("../toilesJSON/$id.json");
    $_SESSION["toile_id"]=$id;

    $url_toile = "toile_edit.php?action=toile&id=$id&name=$nom&hauteur=$hauteur&largeur=$largeur";
    $url_infos = "toile_edit.php?action=informations&id=$id&name=$nom&hauteur=$hauteur&largeur=$largeur";
    $url_param = "toile_edit.php?action=param&id=$id&name=$nom&hauteur=$hauteur&largeur=$largeur";

    if($action == "toile"){
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile active'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile'>Informations de la toile</a>\n
        <a href='$url_param' class='nav_toile'>Paramètres de la toile</a>\n
        </div>\n";

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
        echo "</script>\n";

    }else if($action == "informations"){
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile active'>Informations de la toile</a>\n
        <a href='$url_param' class='nav_toile'>Paramètres de la toile</a>\n
        </div>\n";

        $toile = select_toile($conn, $id);
        $creator_toile = $toile["creator_name"];
        $description = $toile["description"];
        $participants = select_user_participants_toile($conn, $id);

        echo "<script>\n";
        echo "
        var toile_informations = {
            'name' : '$nom',
            'creator' : '$creator_toile',
            'hauteur' : $hauteur,
            'largeur' : $largeur,
            'description' : '$description',
            'participants' : " . json_encode($participants) . "
        };
        createToileInformations();
        ";
        echo "</script>\n";

    }else if($action == "param"){
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile'>Informations de la toile</a>\n
        <a href='$url_param' class='nav_toile active'>Paramètres de la toile</a>\n
        </div>\n";

        if($admin == false && $creator == false) {
            echo "
            <div class='error-not-creator'>\n
                <p class='error-not-creator-text'><strong>Erreur : </strong> Seulement le créateur de la toile peut accéder aux paramètres</p>\n
            </div>\n 
            ";
        }else{
            echo "<h1>Bienvenue dans les paramètres</h1>";
        }

    }

}

    ?>

    </div>

    <?php
    include("../headerfooter/footer.php");
    ?>
</body>

</html>