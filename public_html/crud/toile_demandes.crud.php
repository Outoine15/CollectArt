<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile_demandes
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile_demandes($conn, $id_toile, $id_user){
	$sql="INSERT INTO `toile_demandes`(`id_toile`, `id_user`) value($id_toile, $id_user)";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile_demandes($conn, $id, $id_toile, $id_user){
	$sql="UPDATE `toile_demandes` set `id_toile`=$id_toile, `id_user`=$id_user WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_toile_demandes($conn, $id){
	$sql="DELETE FROM `toile_demandes` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

function delete_toile_demandes_user($conn, $id_toile, $id_user){
	$sql="DELETE FROM `toile_demandes` WHERE `id_toile`=$id_toile and `id_user`=$id_user";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

function delete_toile_demandes_user_all($conn, $id_user){
	$sql="DELETE FROM `toile_demandes` WHERE `id_user`=$id_user";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les toile_demandess
*/

function select_toile_demandes($conn){
	$sql="SELECT * FROM `toile_demandes`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile_demandes($res);
}

function select_toile_demandes_toile($conn,$toile_id){
	$sql="SELECT * FROM `toile_demandes` WHERE `id_toile`=$toile_id";
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile_demandes($res);
}

function is_user_already_demande($conn, $id_toile, $id_user){
	$sql="SELECT * FROM `toile_demandes` WHERE `id_toile`=$id_toile AND `id_user`=$id_user";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_toile_demandes($res);

	$existe = false;
	if($tab != []){
		$existe = true;
	}
	
	return $existe;
}


/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_toile_demandes($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}


?>


