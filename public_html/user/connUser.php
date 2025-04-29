
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>Se connecter</title>
    <script src="../script/page404.js"></script>
</head>
<body>
<?php
include("../headerfooter/header.php");
?>

<div id="container">
    	<div id="formulaire">
<form method="POST" action="connUser.php">
	<p>Nom d'utilisateur</p>
	<input type="text" name="login">
	<p>Mot de passe</p>
	
	<div><input type="text" name="passwd">
		<input type="submit"></div>
	</form>
	<a href="creeUser.php">Créer un compte</a>
	</div>
</div> 

<?php
include("../headerfooter/footer.php");
?>    
</body>
</html>
