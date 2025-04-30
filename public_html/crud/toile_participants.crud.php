<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile_participants
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile_participants($conn, $id_toile, $id_user){
	$sql="INSERT INTO `toile_participants`(`id_toile`, `id_user`) value($id_toile, $id_user)";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile_participants($conn, $id, $id_toile, $id_user){
	$sql="UPDATE `toile_participants` set `id_toile`=$id_toile, `id_user`=$id_user WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_toile_participants($conn, $id){
	$sql="DELETE FROM `toile_participants` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les toile_participantss
*/

function select_toile_participants($conn){
	$sql="SELECT * FROM `toile_participants`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile_participants($res);
}

function select_toile_participants_toile($conn,$toile_id){
	$sql="SELECT * FROM `toile_participants` WHERE `id_toile`=$toile_id";
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile_participants($res);
}


/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_toile_participants($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}


?>


