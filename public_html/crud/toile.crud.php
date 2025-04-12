<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile($conn, $name, $id_creator){
	$sql="INSERT INTO `toile`(`name`, `id_creator`) value('$name', $id_creator)";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile($conn, $id, $name, $id_creator){
	$sql="UPDATE `toile` set `name`='$name', `id_creator`=$id_creator WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_toile($conn, $id){
	$sql="DELETE FROM `toile` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les toiles
*/

function select_toile($conn){
	$sql="SELECT * FROM `toile`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile($res);
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_toile($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}


?>


