<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="~/pulic_html/dom/dom_main.js"></script>
    <title>CollectArt</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
<?php
include("~/public_html/DBconnect/db_connect.php");
include("menu_header.php");
include("~/public_html/crud/toile.crud.php");
$toiles=select_toiles($conn);
// // print_r($toiles);
// $toiles=json_encode($toiles);
// // print_r($toiles);
// echo "<script>";
// echo "var list_toiles = ${toiles};\n";
// echo "affiche_list_toiles()";
// echo "</script>";
include("menu_footer.php");

include("~/public_html/DBconnect/db_disconnect.php");
?>    
</body>
</html>