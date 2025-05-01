<?php
include("../crud/user.crud.php");
include("../DBconnect/db_connect.php");

session_start();

if (!$_SESSION["user"]) {
    header("Location: connUser.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <title>Se connecter</title>
</head>

<body>
    <?php
    include("../headerfooter/header.php");
    ?>

    <div id="container">
        <h1>Bonjour
            <?php
            $user_id = $_SESSION["user"];
            $user = select_user_by_id($conn, $user_id);
            $user_name = $user["name"];

    echo $user_name;
    echo "<p>";
    echo "id: ";
    echo $user_id+"</p>";

    ?>
    </h1>
    <div class="page_user">
        <div class='user_section'>
            <h2>Fin de session</h2>
            <a href="../index.php?action=disconnect">
            <button class='bouton_deconnexion'>Déconnexion</button>
            </a>
            <h2>Suppression du compte</h2>
            <a
            <?php
            $id=$_SESSION["user"];
            echo " href='../user/deletUser.php?action=delete&id=$id'";
            ?>
            >
            <button class="bouton_delet_user">Suprimer</button>
            </a>
        </div>
    </div>
</div>

    <?php
    include("../headerfooter/footer.php");
    ?>

</body>

</html>

<?php
include("../DBconnect/db_disconnect.php");
?>