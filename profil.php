<?php require_once('inc/header.inc.php'); ?>
<?php 
 if (!userConnect()){
	header('location:connexion.php');
	exit(); 
}
$content .= '<h2>Bienvenue '. $_SESSION['membre']['pseudo'] .'</h2>';
$content .= '<p>Voici vos informations :</p>';
$content .= '<p>prenom : '. $_SESSION['membre']['prenom'] .'</p>';
$content .= '<p>nom : '. $_SESSION['membre']['nom'] .'</p>';
$content .= '<p>email : '. $_SESSION['membre']['email'] .'</p>';
$content .= '<p>numéro de telephone : '. $_SESSION['membre']['telephone'] .'</p>';



 ?>


<h1>Profil</h1>

<?= $content ?>

<?php require_once('inc/footer.inc.php') ?>