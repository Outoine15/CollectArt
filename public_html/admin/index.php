<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: connAdmin.php");
}

include("../DBconnect/db_connect.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <script src="../dom/script.admin.js"></script>
    <link rel="stylesheet" href="../css/default.admin.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>page admin</title>
</head>

<body>

    <?php
    include("../DBconnect/db_connect.php");
    include("../headerfooter/header.php");
    include("../crud/toile.crud.php");
    ?>

    <div id="container">
        <a id="deconnection" href="deconnAdmin.php">déconnexion</a>
        <div id="toiles-container"></div>
    </div>

    <?php
    $toiles = select_toiles($conn);
    $toiles = json_encode($toiles);
    // print_r($toiles);
    echo "<script>";
    echo "var listToiles = ${toiles};\n";
    echo "displayToiles()";
    echo "</script>";

    include("../headerfooter/footer.php");

    include("../DBconnect/db_disconnect.php");
    ?>

</body>

</html>