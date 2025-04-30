<?php
/*---------------------------------------
CRUD: Gestion de l'entité admin
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_admin($conn, $name, $pwd){
	$sql="INSERT INTO `admin`(`name`, `pwd`) value('$name', '$pwd')";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_admin($conn, $id, $name, $pwd){
	$sql="UPDATE `admin` set `name`='$name', `pwd`='$pwd' WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_admin($conn, $id){
	$sql="DELETE FROM `admin` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les admins
*/

function select_admin($conn){
	$sql="SELECT * FROM `admin`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_admin($res);
}

function select_admin_by_id($conn, $id){
	$sql="SELECT * FROM `admin` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_admin($res);
	return $tab[0];
}

/*
is in DB all:
*/
function get_admin_account($conn, $name, $pwd){
	$sql="SELECT * FROM `admin` WHERE `name`='$name' AND `pwd`='$pwd'";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_admin($res);

	$user = [];
	if($tab != []){
		$user = $tab[0];
	}
	
	return $user;
}

function name_existe_admin($conn, $name){
	$sql="SELECT * FROM `admin` WHERE `name`='$name'";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_admin($res);

	$existe = false;
	if($tab != []){
		$existe = true;
	}
	
	return $existe;
}


/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_admin($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}


?>


