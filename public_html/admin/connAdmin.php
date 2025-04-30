<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


include("../crud/admin.crud.php");
include("../DBconnect/db_connect.php");


if (isset($_POST["login"]) && isset($_POST["passwd"])) {
	$session_data = get_admin_account($conn, $_POST["login"], $_POST["passwd"]);
	print_r($session_data);
	$id = $session_data["id"];
	if ($$session_data == []) {
		echo "hello there";
		$_SESSION["admin_id"] = $id;
		header("Location: index.php");
	}
}
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
			<form method="POST" action="connAdmin.php">
				<p>Identifiant admin</p>
				<input type="text" name="login">
				<p>Mot de passe</p>

				<div><input type="text" name="passwd">
					<input type="submit">
				</div>
			</form>
			<!-- <a href="creeUser.php">Créer un compte</a> -->
		</div>
	</div>

	<?php
	include("../headerfooter/footer.php");
	include("../DBconnect/db_disconnect.php");
	?>
</body>

</html>