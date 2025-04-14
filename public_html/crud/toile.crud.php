<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile($conn, $name, $description, $id_creator){
	$sql="INSERT INTO `toile`(`name`, `description`, `id_creator`) value('$name', '$description', $id_creator)";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile($conn, $id, $name, $description, $id_creator){
	$sql="UPDATE `toile` set `name`='$name', `description`='$description', `id_creator`=$id_creator WHERE `id`=$id";
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

function select_toiles($conn){
	$sql="SELECT * FROM `toile`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile($res);
}

function select_toile($conn, $id){
	$sql="SELECT * FROM `toile` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_toile($res);
	return $tab[0];
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


