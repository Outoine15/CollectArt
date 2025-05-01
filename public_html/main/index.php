<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="../dom/script.js"></script>
    <title>CollectArt</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/default.css">
</head>
<body>
<?php
include("../DBconnect/db_connect.php");
include("../headerfooter/header.php");
include("../crud/toile.crud.php");
?>

<div id="container">
<div id="toiles-container"></div>
</div>

<?php
$toiles=select_toiles($conn);
$toiles=json_encode($toiles);
// print_r($toiles);
echo "<script>";
echo "var listToiles = ${toiles};\n";
echo "displayToiles('voir details')";
echo "</script>";

include("../headerfooter/footer.php");

include("../DBconnect/db_disconnect.php");
?>

</body>
</html>
