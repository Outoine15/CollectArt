<?php
session_start();
if(!isset($_SESSION["admin_id"])) {
    header("Location: connAdmin.php");
}

include("../DBconnect/db_connect.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="../dom/script.js"></script>
    <script src="../dom/dom.js"></script>
    <link rel="stylesheet" href="../css/default.admin.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/page_toile.css">
    <link rel="stylesheet" href="../css/toile.css">
    <title>page admin</title>
</head>
<body>

<?php
include("../DBconnect/db_connect.php");
include("../headerfooter/header.php");
include("../crud/toile.crud.php");
include("../crud/user.crud.php");
?>

<div id="container">
<a id="deconnection" href="deconnAdmin.php">déconnexion</a>

<?php
if(isset($_GET["action"])){
    $action=$_GET["action"];

    $url_toiles="index.php?action=toiles";
    $url_users="index.php?action=users";


    if($action=="toiles"){

        echo "<div id='div_toile_nav'>\n
        <a href='$url_toiles' class='nav_toile active'>Toiles</a>\n
        <a href='$url_users' class='nav_toile'>Utilisateurs</a>\n
        </div>\n";

        echo "<div id='toiles-container'></div>";

        $toiles=select_toiles($conn);
        $toiles=json_encode($toiles);
        echo "<script>";
        echo "var listToiles = ${toiles};\n";
        echo "displayToiles('supprimer')";
        echo "</script>";
    }else if($action=="users"){

        echo "<div id='div_toile_nav'>\n
        <a href='$url_toiles' class='nav_toile'>Toiles</a>\n
        <a href='$url_users' class='nav_toile active'>Utilisateurs</a>\n
        </div>\n";

        echo "<div id='toiles-container'></div>";

        $users=select_user_no_pwd($conn);
        $users_cleaned=[];
        for ($i=0; $i < count($users); $i++) { 
            array_push($users_cleaned,);
        }
        $users=json_encode($users);
        echo "<script>";
        echo "var listUsers = ${users};\n";
        echo "displayUsers();\n";
        echo "</script>;\n";
    } else {
        echo "<div id='div_toile_nav'>\n
        <a href='$url_toiles' class='nav_toile'>Toiles</a>\n
        <a href='$url_users' class='nav_toile'>Utilisateurs</a>\n
        </div>\n";

        echo "<div id='toiles-container'></div>";

    }
}

include("../headerfooter/footer.php");

include("../DBconnect/db_disconnect.php");
?>
</div>

</body>
</html>