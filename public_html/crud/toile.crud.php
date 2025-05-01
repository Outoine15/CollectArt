<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile($conn, $name, $description, $id_creator, $creator_name, $hauteur, $largeur, $finished){
	$sql="INSERT INTO `toile`(`name`, `description`, `id_creator`, `creator_name`, `hauteur`, `largeur`, `finished`) value('$name', '$description', $id_creator, '$creator_name', $hauteur, $largeur, $finished)";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}
function get_last_inserted_id($conn){
	$sql="SELECT `id` FROM `toile` WHERE ID=(SELECT MAX(ID) FROM `toile`)";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return rs_to_tab_toile($ret)[0]['id'];
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile($conn, $id, $name, $description, $id_creator, $creator_name, $hauteur, $largeur, $finished){
	$sql="UPDATE `toile` set `name`='$name', `description`='$description', `id_creator`=$id_creator, `creator_name`='$creator_name', `hauteur`=$hauteur, `largeur`=$largeur, `finished`=$finished WHERE `id`=$id";
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

function delete_toile_creator($conn, $id_creator){
	$sql="DELETE FROM `toile` WHERE `id_creator`=$id_creator";
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

function select_toile_name($conn, $id){
	$sql="SELECT `name` FROM `toile` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	return $res;
}

function select_toiles_by_user_id($conn, $user_id){
	$sql="SELECT DISTINCT toile.id, toile.name, toile.description, toile.id_creator, toile.creator_name, toile.hauteur, toile.largeur, toile.finished 
		FROM `toile`
		LEFT JOIN `toile_participants` ON toile.id = toile_participants.id_toile
		WHERE toile.id_creator = $user_id OR toile_participants.id_user = $user_id";

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


