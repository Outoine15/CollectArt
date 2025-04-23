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






<html>
	<head>
	<meta charset="UTF-8">
	</head>

	<body>
<form method="POST" action="connUser.php">
	Nom d'utilisateur :	<input type="text" name="login">
	Mot de passe :	<input type="text" name="passwd">
		<input type="submit">
	</form>
	<a href="CreerCompte_form.php">Créer un compte</a>
	</body>
</html>
</html>