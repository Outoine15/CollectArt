<?php
include("../DBconnect/db_connect.php");
include("../crud/user.crud.php");
include("../crud/toile.crud.php");

session_start();
$user_id = -1;
$user = [];

if(!isset($_SESSION["user"])){
	header("Location: ../user/connUser.php?erreur_page=mes_toiles");
}else{
    $user_id = $_SESSION["user"];
    $user = select_user_by_id($conn, $user_id);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="../dom/script.js"></script>
    <title>CollectArt - Mes toiles</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/mes_toiles.css">
</head>
<body>

<?php
include("../headerfooter/header.php");
?>

<div id="container">
    <div id="mes_toiles_header">
        <div id="header_part1">
            <h1>Mes Toiles</h1>
            <p>
            <?php
            $user_name = $user["name"];
            echo "Bienvenue dans votre galerie, <strong>$user_name</strong> ! 
            Vous y trouverez toutes les toiles que vous avez créées ainsi que celles auxquelles vous participez."
            ?>
            </p>
            <a href="../toile_cree/cree_toile.php" class="mes_toiles_create">Créer une toile</a>
        </div>
        
        <div id="header_part2">
            <?php
            $nb_toiles = count(select_toiles_by_user_id($conn, $user_id));
            $txt_toile = "Toile";
            if($nb_toiles > 1){
                $txt_toile .= "s";
            }
            $txt_toile .= " au total";            

            $html = "<p class='nb_toiles'>" . $nb_toiles . "</p>";
            $html .= "<p class='txt_nb_toiles'>" . $txt_toile . "</p>";

            echo $html;
            ?>
        </div>
    </div>

    <div id="toiles-container"></div>

</div>

<?php
$toiles=select_toiles_by_user_id($conn, $user_id);

for ($i=0; $i < count($toiles); $i++) { 
    $id=$toiles[$i]["id"];
    $toileJSONdata = file_get_contents("../toilesJSON/$id.json");
    $toileJSONdata=json_decode($toileJSONdata);
    array_push($toiles[$i],$toileJSONdata);
}

$toiles=json_encode($toiles);

echo "<script>";
echo "var listToiles = ${toiles};\n";
echo "var listMyToiles = [];\n";
echo "displayToiles('modifier')";
echo "</script>";
?>

<?php
include("../headerfooter/footer.php");
?>

</body>
</html>

<?php
include("../DBconnect/db_disconnect.php");
?>
