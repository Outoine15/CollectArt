<?php
session_start(); 
if(isset($_GET["action"])){
	$action = $_GET["action"];
    
	if($action=="disconnect"){
		unset($_SESSION["user"]);
		unset($_SESSION["admin"]);
	}
}

header("Location: main/index.php");
?>