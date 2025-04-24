<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


include("../crud/user.crud.php");
include("../DBconnect/db_connect.php");

$post_fait=0;
if(isset($_POST["login"])){
    $post_fait=1;
	$existe = pseudo_existe($conn, $_POST["login"] );
	if($existe=='1'){
		$result='ce pseudo existe déja';
	}
    else{
        $name=$_POST["login"];
        $pwd=$_POST["passwd"];
        insert_user($conn, $name, $pwd);
        $result='creation de compte fait.';
    }

    ;
}



include("../DBconnect/db_disconnect.php");
?>






<html>
	<head>
	<meta charset="UTF-8">
	</head>
	<link rel="stylesheet" href="creeUser.css">
	<body>
	<?php
	include("../header.php");?>
	
	<div id="formulaire">
<form method="POST" action="creeUser.php">
	<p>Nom d'utilisateur</p>
	<input type="text" name="login">
	<p>Mot de passe</p>
	
	<div><input type="text" name="passwd">
		<input type="submit"></div>
	</form>
    <?php
    if ($post_fait==1){
    echo "$result";
    }
    ?>
    <p>tu as déja un compte? </p>
	<a href="connUser.php">connecte toi.</a>
	</div>
	<?php
	include("../footer.php");?>
	</body>
</html>
</html>



