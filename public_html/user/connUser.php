<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


include("../crud/user.crud.php");
include("../DBconnect/db_connect.php");


if(isset($_POST["login"])){
	$estdansBDD = is_in_DB($_POST["login"] , $_POST["passwd"] , $conn);
	if($estdansBDD=='1'){
		header("Location: rien.php");
	}
}



include("../DBconnect/db_disconnect.php");
?>


<!DOCTYPE html>
<html lang="fr">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


include("../crud/user.crud.php");
include("../DBconnect/db_connect.php");


if(isset($_POST["login"])){
	$estdansBDD = is_in_DB($_POST["login"] , $_POST["passwd"] , $conn);
	if($estdansBDD=='1'){
		header("Location: rien.php");
	}
}



include("../DBconnect/db_disconnect.php");
?>
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
