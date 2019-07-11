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
function debug( $arg ){

	echo '<div style="background:#fda500; padding:5px; z-index:1000;">';

		$trace = debug_backtrace(); //Fonction prédéfinie de php qui retourne un array contenant des infos

		echo 'Debug demandé dans le fichier : ' . $trace[0]['file'] . ' à la ligne '. $trace[0]['line'];

		print '<pre>';
			print_r( $arg );
		print '</pre>';
	echo '</div>';
}

?>