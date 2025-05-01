<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../user/connUser.php");
}
include("../headerfooter/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../dom/dom.js"></script>
    <link rel="stylesheet" href="../css/default.css">
    <title>toile en cours de création</title>
</head>

<body>
<div id="container">
<h1>votre toile est en cours de création</h1>
<a href="../pages/mes_toiles.php">retour a mes toiles</a>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");
include("../crud/user.crud.php");
if(isset($_POST["nom"]) && isset($_POST["hauteur"]) && isset($_POST["largeur"]) && isset($_POST["description"])){
    $nom=$_POST["nom"];
    $description=$_POST["description"];
    $hauteur=$_POST["hauteur"];
    $largeur=$_POST["largeur"];
    $id_creator=0;
    if($hauteur > 100 || $largeur > 100){
        echo "<div>toile trop grand, vous voullez tous casser ou quoi? (max 100px hauteur/largeur)</div>";
    } else{
        if(isset($_SESSION["user"])){
            $id_creator=(int)$_SESSION["user"];
        }
        
        $user = select_user_by_id($conn, $id_creator);
        $user_name = $user["name"];

        // print_r($id_creator);
        insert_toile($conn,$nom,$description,$id_creator,$user_name,$hauteur,$largeur,0);
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
        }
        // header("Location: ../pages/mes_toiles.php");
        ?>
    </div>

    <?php
    include("../headerfooter/footer.php");
    ?>
</body>

</html>