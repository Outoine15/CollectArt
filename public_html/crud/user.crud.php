<?php
/*---------------------------------------
CRUD: Gestion de l'entité user
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_user($conn, $name, $pwd){
	$sql="INSERT INTO `user`(`name`, `pwd`) value('$name', '$pwd')";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_user($conn, $id, $name, $pwd){
	$sql="UPDATE `user` set `name`='$name', `pwd`='$pwd' WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_user($conn, $id){
	$sql="DELETE FROM `user` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les users
*/

function select_user($conn){
	$sql="SELECT * FROM `user`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_user($res);
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_user($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}

/**
	* Fonction de vérification si user et pwd sont dans bdd
*/

function is_in_DB($Nom , $Password , $conn){
	$is_in=0;
	$result = mysqli_query($conn,"SELECT * FROM user");
	while ($row = mysqli_fetch_assoc($result)){
		$NomBDD=$row['name'];
		$PasswordBDD=$row['pwd'];
		
		if ($Nom == $NomBDD && $Password==$PasswordBDD){
		$is_in=1;}
	}
	return $is_in ;
}

/**
 	* Fonction de vérification si un user est déja utilisé 
 */
function pseudo_existe($conn, $Nom){
	$existe=0;
	$result = mysqli_query($conn,"SELECT * FROM user WHERE name = '$Nom'");
	while ($row = mysqli_fetch_assoc($result)){
		$NomBD=$row['name'];
		
		if ($Nom == $NomBD ){
		$existe=1;}
	}
	return $existe ;
}


?>


