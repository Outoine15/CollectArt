<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../user/connUser.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <title>créer une toile</title>
</head>

<body>
    <?php
    include("../headerfooter/header.php");
    ?>

    <form action="toile.php" method="post">
        <table>
            <tr>
                <td>Nom</td>
                <td><input type="text" name="nom"></td>
            </tr>
            <tr>
                <td>hauteur</td>
                <td><input type="text" name="hauteur"></td>
            </tr>
            <tr>
                <td>largeur</td>
                <td><input type="text" name="largeur"></td>
            </tr>
            <tr>
                <td>description</td>
                <td><input type="text" name="description"></td>
            </tr>
        </table>
        <input type="submit" value="créer">
    </form>
    <?php
    include("../headerfooter/footer.php");
    ?>
</body>

</html>