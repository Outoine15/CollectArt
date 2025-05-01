<?php session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../user/connUser.php?erreur_page=cree_toile");
} ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>Créer une toile</title>
</head>

<body>
    <?php
    include("../headerfooter/header.php");
    ?>
    <div id="container">
        <div id="form_container">
            <h2 class="form_title">Créer une toile</h2>
            <div id="formulaire">
                <form action="toile.php" method="post">
                    <div class="form_section">
                        <p class="form_txt">Nom</p>
                        <input type="text" minlength="1" maxlength="16" name="nom">
                        <p class="form_contrainte">(max 16 caractères)</p>
                    </div>
                    <div class="form_section">
                        <p class="form_txt">Hauteur</p>
                        <input type="number" min="1" max="100" name="hauteur">
                    </div>
                    <div class="form_section">
                        <p class="form_txt">Largeur</p>
                        <input type="number" min="1" max="100" name="largeur">
                    </div>
                    <div class="form_section">
                        <p class="form_txt">Description</p>
                        <input type="text" minlength="1" maxlength="200" name="description">
                        <p class="form_contrainte">(1 à 200 caractères)</p>
                    </div>
                    <input type="submit" value="Créer">
                </form>
            </div>
        </div>
    </div>
    <?php
    include("../headerfooter/footer.php");
    ?>
</body>

</html>