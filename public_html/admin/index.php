<?php
session_start();
print_r($_SESSION);
if (isset($_SESSION["id"])) {
    echo "bienvenue";
} else{
    echo "thats not good";
    header("Location: connAdmin.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page admin</title>
</head>
<body>
    <a href="deconnAdmin.php">déconnexion</a>
    <!-- TODO:finis this -->
</body>
</html>