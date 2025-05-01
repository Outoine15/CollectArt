<?php
/*---------------------------------------
CRUD: Gestion de l'entité user
---------------------------------------*/
$debug = false;

/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
function insert_user($conn, $name, $pwd){
	$sql="INSERT INTO `user`(`name`, `pwd`) value('$name', '$pwd')";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 	
}

/*
	U: met à jour les valeurs de l'enregistrement 
*/
function update_user($conn, $id, $name, $pwd){
	$sql="UPDATE `user` set `name`='$name', `pwd`='$pwd' WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
    return $ret; 
}

/*
	D: supprime l'enregistrement 
*/
function delete_user($conn, $id){
	$sql="DELETE FROM `user` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;} 
	$ret=mysqli_query($conn, $sql);
	return $ret; 
}

/*
	S: selectionne tous les users
*/

function select_user($conn){
	$sql="SELECT * FROM `user`"; 
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_user($res);
}

function select_user_by_id($conn, $id){
	$sql="SELECT * FROM `user` WHERE `id`=$id";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_user($res);
	return $tab[0];
}

function select_user_participants_toile($conn, $id_toile){
	$sql = "SELECT DISTINCT user.id, user.name FROM `user`
			JOIN `toile_participants` ON user.id = toile_participants.id_user
			WHERE toile_participants.id_toile = $id_toile";
	global $debeug;
	if($debeug) echo $sql; 
	$res=mysqli_query($conn, $sql); 
	return rs_to_tab_user($res);
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab_user($rs){
	$tab=[]; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row;	
	}
	return $tab;
}

/**
	* Fonction de vérification si user et pwd sont dans bdd
*/

function get_user_account($conn, $name, $pwd){
	$sql="SELECT * FROM `user` WHERE `name`='$name' AND `pwd`='$pwd'";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_user($res);

	$user = [];
	if($tab != []){
		$user = $tab[0];
	}
	
	return $user;
}

/**
 	* Fonction de vérification si un user est déja utilisé 
 */
function name_existe_user($conn, $name){
	$sql="SELECT * FROM `user` WHERE `name`='$name'";
	global $debug;
	if($debug){echo $sql;}
	$res = mysqli_query($conn, $sql);
	$tab = rs_to_tab_user($res);

	$existe = false;
	if($tab != []){
		$existe = true;
	}
	
	return $existe;
}


?>


