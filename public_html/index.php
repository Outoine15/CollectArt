<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CollectArt</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
$connection=False

include("header_index.php");
?>
<div id="contenant">
    <?php
    if($connection){
    echo "
<div id='modifier_ses_toiles'><p>ici sera les toiles a modifier</p></div> ";
    }
?>

<div id="podium-des_toiles">
<p>ici sera le podium</p>
</div>
<div id="toutes_les_toiles">
<p>ici sera toutes les toiles</p>
</div>
</div>
<?php
include("footer.php");
?>    
</body>
</html>
