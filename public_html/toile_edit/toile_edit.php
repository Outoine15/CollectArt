<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["admin_id"])){
    header("Location: ../main/index.php");
}

include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
include("../crud/toile_participants.crud.php");
include("../crud/toile_demandes.crud.php");
include("../crud/user.crud.php");

$member=false;
$creator=false;
$admin=false;

$message = "";

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


if(isset($_GET["remove"]) && isset($_GET["id"])){
    $user_id_remove = $_GET["remove"];
    $user_remove = select_user_by_id($conn, $user_id_remove);
    $user_remove_name = $user_remove["name"];
    $toile_id = $_GET["id"];

    $message = "<p class='success_message'><strong>L'utilisateur " . $user_remove_name . " a été supprimé avec succès !</p>";

    delete_toile_participants_user($conn, $toile_id, $user_id_remove);
}

if(isset($_POST["editParam"])){
    $editParam = $_POST["editParam"];

    $user_id = $_SESSION["user"];
    $user = select_user_by_id($conn, $user_id);
    $creator_name = $user["name"];

    if($editParam == "Ajouter"){
        if(isset($_POST["add-participant"])){
            $username = $_POST["add-participant"];

            if(name_existe_user($conn, $username)){
                
                if($username == $creator_name){
                    $message = "<p class='error_message'><strong>Erreur :</strong> Vous ne pouvez pas vous ajouter vous-même</p>";
                }else {
                    $user_add = select_user_by_name($conn, $username);
                    $user_add_id = $user_add["id"];

                    if(is_user_already_participant($conn, $_GET["id"], $user_add_id)){
                        $message = "<p class='error_message'><strong>Erreur :</strong> " . $username . " participe déjà à cette toile</p>";
                    }else {
                        delete_toile_demandes_user($conn, $_GET["id"], $user_add_id);
                        insert_toile_participants($conn, $_GET["id"], $user_add_id);
                        $message = "<p class='success_message'><strong>L'utilisateur " . $username . " a été ajouté avec succès !</p>";
                    }
                }

            }else {
                $message = "<p class='error_message'><strong>Erreur :</strong> Nom d'utilisateur inexistant</p>";
            }

        }
    }else if($editParam == "Enregistrer"){
        $name_edit = $_POST["nom"];
        $hauteur_edit = $_POST["hauteur"];
        $largeur_edit = $_POST["largeur"];
        $description_edit = $_POST["description"];

        if($name_edit == "" || $description_edit == "") {
            $message = "<p class='error_message'><strong>Erreur :</strong> Champ vide interdit</p>";
        }else {
            update_toile($conn, $_GET["id"], $name_edit, $description_edit, $user_id, $creator_name, $hauteur_edit, $largeur_edit, 0);
            $message = "<p class='success_message'><strong>Modification effectuée avec succès !</p>";
        }
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

<!-- <filesMatch ".php">
    Header set Cache-Control "max-age=84600, public"
</filesMatch> -->

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

    $creator_toile = $toile["creator_name"];
    $description = $toile["description"];
    $participants = select_user_participants_toile($conn, $id);

    $url_toile = "toile_edit.php?action=toile&id=$id";
    $url_infos = "toile_edit.php?action=informations&id=$id";
    $url_param = "toile_edit.php?action=param&id=$id";
    $url_demande = "toile_edit.php?action=demande&id=$id";

    if($action == "toile"){
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile active'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile'>Informations de la toile</a>\n
        <a href='$url_param' class='nav_toile'>Paramètres de la toile</a>\n
        <a href='$url_demande' class='nav_toile'>Demandes de participation</a>\n
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
        <a href='$url_demande' class='nav_toile'>Demandes de participation</a>\n
        </div>\n";

        echo "<script>\n";
        echo "
        var toile_informations = {
            'id' : '$id',
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
        <a href='$url_demande' class='nav_toile'>Demandes de participation</a>\n
        </div>\n";

        if($admin == false && $creator == false) {
            echo "
            <div class='error-not-creator'>\n
                <p class='error-not-creator-text'><strong>Erreur : </strong>Seulement le créateur de la toile peut accéder aux paramètres</p>\n
            </div>\n 
            ";
        }else{
            echo "<script>\n";
            echo "
            var toile_informations = {
                'id' : '$id',
                'name' : '$nom',
                'creator' : '$creator_toile',
                'hauteur' : $hauteur,
                'largeur' : $largeur,
                'description' : '$description',
                'participants' : " . json_encode($participants) . "
            };
            createToileParametres(`$message`);
            ";
            echo "</script>\n";
        }
    }else if($action == "demande"){
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toile' class='nav_toile'>Afficher la toile</a>\n
        <a href='$url_infos' class='nav_toile'>Informations de la toile</a>\n
        <a href='$url_param' class='nav_toile'>Paramètres de la toile</a>\n
        <a href='$url_demande' class='nav_toile active'>Demandes de participation</a>\n
        </div>\n";

        if($admin == false && $creator == false) {
            echo "
            <div class='error-not-creator'>\n
                <p class='error-not-creator-text'><strong>Erreur : </strong>Seulement le créateur de la toile peut accéder aux demandes de participation</p>\n
            </div>\n 
            ";
        }else{
            $demandes = select_user_demandes_toile($conn, $id);

            echo "
            <script>
            var demandes = " . json_encode($demandes) . ";
            </script>
            ";
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