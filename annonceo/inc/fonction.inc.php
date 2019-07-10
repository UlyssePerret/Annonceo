<?php  

//-------------------------------------------------------------

//Fonction execute_requete() : permet d'effectuer une requete :

function execute_requete($req){
	global $pdo;
	$pdostatement = $pdo->query($req);
	return $pdostatement;
}

//------------------------------------------------------------

function userConnect(){
	if (!isset($_SESSION['membre'])) {
		return false;
	}
	else{
		return true;
	}
}

//------------------------------------------------------------

function adminConnect(){
	if (userConnect() && $_SESSION['membre']['statut'] == 1) {
		return true;
	}
	else{
		return false;
	}
}

//------------------------------------------------------------
?>