<?php
session_start();
include("../DBconnect/db_connect.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>parramètres de toile</title>
</head>

<body>
    <?php
    include("../headerfooter/header.php");
    ?>
    <div id="container">
        <?php
        if (isset($_GET["id"]))
            ;
        echo "<h1>paramètres de la toile $toile_name</h1>"

            ?>
    </div>
    <?php
    include("../headerfooter/footer.php");
    ?>
</body>

</html>
<?php
include("../DBconnect/db_disconnect.php");
?>