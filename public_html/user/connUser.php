<?php
include("../crud/user.crud.php");
include("../DBconnect/db_connect.php");

session_start();

if (isset($_SESSION["user"])) {
	header("Location: user.php");
}

$message_connexion = "";

if (isset($_POST["user_name"]) && isset($_POST["user_pwd"])) {
	$name = $_POST["user_name"];
	$pwd = $_POST["user_pwd"];

	$user = get_user_account($conn, $name, $pwd);

    if($user == []){
		$message_connexion .= "<p class='error_message'><strong>Erreur :</strong> Identifiant et/ou mot de passe invalide</p>";
	}else{
		/* session user */
		$_SESSION["user"] = $user["id"];

		/* redirection */
		header("Location: ../pages/mes_toiles.php");
	}
}else if(isset($_GET["erreur_page"])){
	if($_GET["erreur_page"] == "mes_toiles"){
		$message_connexion .= "<p class='error_message'><strong>Erreur :</strong> Vous devez être connecté pour visualiser vos toiles</p>";
	}
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/default.css">
	<link rel="stylesheet" href="../css/form.css">
	<title>Se connecter</title>
	<script>
		function passwordSeeHide(checkboxId, pwdId) {
			var checkbox = document.getElementById(checkboxId);
			var pwd = document.getElementById(pwdId);

			if (checkbox.checked) {
				pwd.type = "text";
			} else {
				pwd.type = "password";
			}
		}
	</script>
</head>

<body>
	<?php
	include("../headerfooter/header.php");
	?>

	<div id="container">
		<div id="form_container">
			<h2 class="form_title">Se connecter</h2>
			<?php
			echo $message_connexion;
			?>

			<div id="formulaire">
				<form method="POST" action="connUser.php">
					<div class="form_section">
						<p class="form_txt">Nom d'utilisateur</p>
						<input type="text" name="user_name">
					</div>

					<div class="form_section">
						<div class="form_header">
							<p class="form_txt">Mot de passe</p>

							<div class="pwd_container">
								<input type="checkbox" id="checkbox_pwd"
									onclick="passwordSeeHide('checkbox_pwd', 'user_pwd')">
								<label for="checkbox_pwd">Afficher</label>
							</div>
						</div>

						<input type="password" name="user_pwd" id="user_pwd">
					</div>

					<input type="submit" value="Se connecter">
				</form>

				<a href="creeUser.php">Créer un compte</a>
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