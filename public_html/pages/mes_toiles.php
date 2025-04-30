<?php
include("../DBconnect/db_connect.php");
include("../crud/toile.crud.php");

session_start();

if(!isset($_SESSION["user"])){
	header("Location: ../user/connUser.php?erreur_page=mes_toiles");
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
</head>
<body>

<?php
include("../headerfooter/header.php");
?>

<div id="container">
<div id="toiles-container"></div>
</div>

<?php
include("../headerfooter/footer.php");
?>

</body>
</html>

<?php
include("../DBconnect/db_disconnect.php");
?>
