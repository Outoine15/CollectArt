<?php
/*---------------------------------------
CRUD: Gestion de l'entité toile_notes
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_toile_notes($conn, $id_toile, $id_user, $note)
{
	$sql = "INSERT INTO `toile_notes`(`id_toile`, `id_user`, `note`) value($id_toile, $id_user, $note)";
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
function update_toile_notes($conn, $id, $id_toile, $id_user, $note)
{
	$sql = "UPDATE `toile_notes` set `id_toile`=$id_toile, `id_user`=$id_user, `note`=$note WHERE `id`=$id";
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
function delete_toile_notes($conn, $id)
{
	$sql = "DELETE FROM `toile_notes` WHERE `id`=$id";
	global $debug;
	if ($debug) {
		echo $sql;
	}
	$ret = mysqli_query($conn, $sql);
	return $ret;
}

/*
	S: selectionne tous les toile_notess
*/

function select_toile_notes($conn)
{
	$sql = "SELECT * FROM `toile_notes`";
	global $debeug;
	if ($debeug)
		echo $sql;
	$res = mysqli_query($conn, $sql);
	return rs_to_tab_toile_notes($res);
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_toile_notes($rs)
{
	$tab = [];
	while ($row = mysqli_fetch_assoc($rs)) {
		$tab[] = $row;
	}
	return $tab;
}


?>