<?php
include("../crud/user.crud.php");
include("../DBconnect/db_connect.php");

session_start();

if(isset($_SESSION["user"])){
	header("Location: user.php");
}

$message_creation = "";
if(isset($_POST["user_name"]) && isset($_POST["user_pwd"]) && isset($_POST["user_pwd_confirmation"])){
	$name = $_POST["user_name"];
	$pwd = $_POST["user_pwd"];
	$pwd_confirmation = $_POST["user_pwd_confirmation"];

	if($name == "" || $pwd == "" || $pwd_confirmation == ""){
		$message_creation .= "<p class='error_message'>Erreur : Veuillez remplir tous les champs</p>";
	}else if(name_existe_user($conn, $name)){
		$message_creation .= "<p class='error_message'>Erreur : Identifiant déjà utilisé</p>";
	}else{
		include("../lib/fct_user.php");

		if(areLoginsValid($name, $pwd, $pwd_confirmation)){
			insert_user($conn, $name, $pwd);
			$message_creation .= "<p class='success_message'>Compte créée avec succès !</p>";
		}else{
			$message_creation .= "<p class='error_message'>Erreur : L'identifiant et/ou le mot de passe n'est pas valide</p>";
		}

    }
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/default.css">
	<link rel="stylesheet" href="../css/form.css">
	<title>Créer un compte</title>
	<script>
		function passwordSeeHide(checkboxId, pwdId){
			var checkbox = document.getElementById(checkboxId);
			var pwd = document.getElementById(pwdId);
			
			if(checkbox.checked){
				pwd.type = "text";
			}else{
				pwd.type = "password";
			}
		}
	</script>
</head>	
	
<body>
<?php

include("../headerfooter/header.php");?>
	
<div id="container">
	<div id="form_container">
		<h2 class="form_title">Créer un compte</h2>

		<?php
		echo $message_creation;
		?>
	
		<div id="formulaire">
			<form method="POST" action="creeUser.php">
				<div class="form_section">
					<p class="form_txt">Nom d'utilisateur</p>
					<input type="text" name="user_name">
					<p class="form_contrainte">2 à 16 caractères</p>
				</div>

				<div class="form_section">
					<p class="form_txt">Mot de passe</p>
					<input type="password" name="user_pwd" id="user_pwd">

					<div class="pwd_container">
						<input type="checkbox" id="checkbox_pwd" onclick="passwordSeeHide('checkbox_pwd', 'user_pwd')">
						<label for="checkbox_pwd">Afficher/Cacher le mot de passe</label>
					</div>

					<p class="form_contrainte">8 caractères ou plus dont au moins : 1 majuscule, 1 minuscule et 1 chiffre</p>
				</div>

				<div class="form_section">
					<p class="form_txt">Confirmez le mot de passe</p>
					<input type="password" name="user_pwd_confirmation" id="user_pwd_confirmation">

					<div class="pwd_container">
						<input type="checkbox" id="checkbox_pwd_confirmation" onclick="passwordSeeHide('checkbox_pwd_confirmation', 'user_pwd_confirmation')">
						<label for="checkbox_pwd_confirmation">Afficher/Cacher le mot de passe</label>
					</div>
				</div>

				<input type="submit" value="Créer un compte">
			</form>

			<a href="connUser.php">Déjà enregistré ? Connecte toi ici</a>
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



