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
        <h1>Mes Toiles</h1>
        <p>
        <?php
        $user_name = $user["name"];
        echo "Bienvenue dans votre galerie, <strong>$user_name</strong> ! 
        Vous y trouverez toutes les toiles que vous avez créées ainsi que celles auxquelles vous participez. "
        ?>
        </p>
        <a href="../toile_cree/cree_toile.php" class="mes_toiles_create">Créer une toile</a>
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
echo "displayToiles()";
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
