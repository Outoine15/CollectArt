<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile_tags
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile_tags($conn, $id_toile, $tag){
	$sql="INSERT INTO `toile_tags`(`id_toile`, `tag`) value($id_toile, '$tag')";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile_tags($conn, $id, $id_toile, $tag){
	$sql="UPDATE `toile_tags` set `id_toile`=$id_toile, `tag`='$tag' WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_toile_tags($conn, $id){
	$sql="DELETE FROM `toile_tags` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les toile_tagss
*/

function select_toile_tags($conn){
	$sql="SELECT * FROM `toile_tags`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_toile_tags($res);
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_toile_tags($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}


?>


