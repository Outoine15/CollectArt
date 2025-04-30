<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../user/connUser.php");
}
include("../DBconnect/db_connect.php");
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/default.css">
    <title>parramètres de toile</title>
</head>

<body>
    <?php
    include("../headerfooter/header.php");
    ?>
    <div id="container">
        <?php

        echo "<h1>paramètres de la toile $toile_name</h1>"

            ?>
        <form action="toile_setting.add_user.php" method="post">
            <table>
                <tr>
                    <td>id de l'utilisateur à ajouter</td>
                    <td><input type="text" name="id"></td>
                </tr>
            </table>
            <input type="submit" value="créer">
        </form>
    </div>
    <?php
    include("../headerfooter/footer.php");
    ?>
</body>

</html>
<?php
include("../DBconnect/db_disconnect.php");
?>