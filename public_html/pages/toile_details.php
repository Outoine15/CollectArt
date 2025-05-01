<?php
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
include("../crud/toile_participants.crud.php");
include("../crud/user.crud.php");

$message = "";

session_start();
if(isset($_POST["demandeParticiper"])){
    if(isset($_SESSION["user"])){
        $message = "<p class='success_message'>Demande effectuée avec succès !</p>";
    }else {
        header("Location: ../user/connUser.php?erreur_page=toile_details");
    }
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

<div id="container">

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET["action"]) && isset($_GET["id"])){
    $action = $_GET["action"];
    $id = $_GET["id"];

    $toile = select_toile($conn, $id);

    $nom = $toile["name"];
    $hauteur = $toile["hauteur"];
    $largeur = $toile["largeur"];
    $toile_data = file_get_contents("../toilesJSON/$id.json");
    $_SESSION["toile_id"] = $id;

    $url_toile = "toile_details.php?action=toile&id=$id";
    $url_infos = "toile_details.php?action=informations&id=$id";

    if($action == "toile") {
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile active'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile'>Informations de la toile</a>\n
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
                echo "make_toile('Voir détails');\n";
                echo "load_json_data();\n";
        echo "</script>\n";

    }else if($action == "informations"){
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile active'>Informations de la toile</a>\n
        </div>\n";

        $creator = $toile["creator_name"];
        $description = $toile["description"];
        $participants = select_user_participants_toile($conn, $id);

        echo "<script>\n";
        echo "
        var toile_informations = {
            'name' : '$nom',
            'creator' : '$creator',
            'hauteur' : $hauteur,
            'largeur' : $largeur,
            'description' : '$description',
            'participants' : " . json_encode($participants) . "
        };
        createToileInformations();
        ";
        echo "</script>\n";

        echo "<div class='container-message'>";
        echo $message;
        echo "
        <form action='$url_infos' method='post' class='demande-participation'>\n
            <input type='submit' value='Demander à participer' class='submit1-form-param' name='demandeParticiper'>
        </form>
        ";
        echo "</div>";

    }

}


?>

</div>

<?php
include("../headerfooter/footer.php");
?>

</body>
</html>