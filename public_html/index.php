<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="dom/dom_main.js"></script>
    <title>CollectArt</title>
</head>
<body>
<?php
include("DBconnect/db_connect.php");
include("header_index.php");
include("crud/toile.crud.php");
$toiles=select_toiles($conn);
// print_r($toiles);
$toiles=json_encode($toiles);
// print_r($toiles);
echo "<script>";
echo "var list_toiles = ${toiles};\n";
echo "affiche_list_toiles()";
echo "</script>";
include("footer.php");

include("DBconnect/db_disconnect.php");
?>    
</body>
</html>
