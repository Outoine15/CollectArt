<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile_defis
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile_defis($conn, $id_toile, $img_file)
{
	$sql = "INSERT INTO `toile_defis`(`id_toile`, `img_file`) value($id_toile, '$img_file')";
	global $debug;
	if ($debug) {
		echo $sql;
	}
	$ret = mysqli_query($conn, $sql);
	return $ret;
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_toile_defis($conn, $id_toile, $img_file)
{
	$sql = "UPDATE `toile_defis` set `img_file`='$img_file' WHERE `id_toile`=$id_toile";
	global $debug;
	if ($debug) {
		echo $sql;
	}
	$ret = mysqli_query($conn, $sql);
	return $ret;
}

/*
	D: supprime l'enregistrement 
*/
function delete_toile_defis($conn, $id_toile)
{
	$sql = "DELETE FROM `toile_defis` WHERE `id_toile`=$id_toile";
	global $debug;
	if ($debug) {
		echo $sql;
	}
	$ret = mysqli_query($conn, $sql);
	return $ret;
}

/*
	S: selectionne tous les toile_defiss
*/

function select_toile_defis($conn)
{
	$sql = "SELECT * FROM `toile_defis`";
	global $debeug;
	if ($debeug)
		echo $sql;
	$res = mysqli_query($conn, $sql);
	return rs_to_tab_toile_defis($res);
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_toile_defis($rs)
{
	$tab = [];
	while ($row = mysqli_fetch_assoc($rs)) {
		$tab[] = $row;
	}
	return $tab;
}


?>