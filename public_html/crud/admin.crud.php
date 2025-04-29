<?php
/*---------------------------------------
CRUD: Gestion de l'entité admin
---------------------------------------*/
$debug = true;
error_reporting(E_ALL);
ini_set('display_errors', '1');

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

/*
is in DB all:
*/
function is_in_DB_get_id($Nom , $Password , $conn){
	$is_in=0;
	$id=0;
	$result = mysqli_query($conn,"SELECT * FROM `admin`");
	while ($row = mysqli_fetch_assoc($result)){
		$NomBDD=$row['name'];
		$PasswordBDD=$row['pwd'];
		
		if ($Nom == $NomBDD && $Password==$PasswordBDD){
		$is_in=1;
		$id=$row["id"];
		}
	}
	return [$is_in,$id] ;
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


