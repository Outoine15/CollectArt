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
	<link rel="stylesheet" href="../css/*.css">
	<link rek="stylesheet" href="..
	</head>
		
		
		
	<body>
	<?php

	include("../headerfooter/header.php");?>
		

	
	
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
	<a href="connUser.php">Déja enregistré ? Connecte toi.</a>
	</div>
	<footer>
      
	  <div id="div_droits">  
	  <p>@ Tout droit r&#233;serv&#233; &#224; Bob_et_Alice</p>
	  <p>Les cookies c'est pas mauvais</p>
	  </div>

      <a href="https://www.univ-smb.fr/" id="div-image-univsmb"><image id="image-univsmb" src="../images/Logo_USMB_web_vertical_grand_RVB.png"></image></a>


</footer>
	</body>

</html>
</html>



