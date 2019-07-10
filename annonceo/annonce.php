<?php require_once('inc/header.inc.php'); ?>
<!-- Trie -->
<?php
$content .="Trier par catégorie :";
$content .='<form method="GET" action="annonce.php">  
		<div class="form-group">
			<select class="form-control" name="categorie" id="categorie">';
  				$r = execute_requete(" SELECT * FROM `categorie` ");
				while( $categorie = $r->fetch(PDO::FETCH_ASSOC) ){
					$content .= '<option value="'.$categorie['id_categorie'].'">';
					$content .=	"$categorie[titre]" ;
					$content .=	'</option>';
				}
			$content .='</select> ';
		$content .='<input type="submit" value="Trier">
 		</div>
	</form>';
	$content .="<hr> <br>";
?>
<!-- Suppression annonce-->
<?php 
if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){

	//Récupération des infos de l'annonce à supprimer
	$r = execute_requete("SELECT * FROM annonce WHERE id_article='$_GET[id_article]' ");

	//Application de la méthode 'fetch' pour pouvoir exploiter les données
	$article_a_supprimer = $r->fetch(PDO::FETCH_ASSOC);

	execute_requete("DELETE FROM article WHERE id_article= '$_GET[id_article]' ");

	//redirection avec l'affichage des annonces
	header('location:annonce.php?action=affichage');
}
?>
<!-- Affichage du tableau-->
<?php
 if (isset($_GET['categorie']) ){ // Cas si il a un trie
 			$value_categorie = $_GET['categorie']  ;
		//echo "$value_categorie ";
		$r = execute_requete("SELECT `id_annonce`, a.titre as annonce_titre, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, m.prenom ,`photo_id`, c.titre as categorie_titre, 
			DATE_FORMAT(a.date_enregistrement,'%d/%m/%Y a %H:%i') as date

			FROM `annonce` as a 
				INNER JOIN membre AS m 
				ON a.membre_id = m.id_membre 
				INNER JOIN categorie  AS c
				ON a.categorie_id = c.id_categorie 
			WHERE categorie_id='$value_categorie' 
			ORDER BY `id_annonce` DESC ");	
	}
	else{ //sinon affichage standard
		$r = execute_requete(" SELECT `id_annonce`, a.titre as annonce_titre, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, m.prenom ,`photo_id`, c.titre as categorie_titre, 
			DATE_FORMAT(a.date_enregistrement,'%d/%m/%Y a %H:%i') as date
			FROM `annonce` as a 
				INNER JOIN membre AS m 
				ON a.membre_id = m.id_membre 
				INNER JOIN categorie  AS c
				ON a.categorie_id = c.id_categorie 
			ORDER BY `id_annonce` DESC ; ");
	}
$content .= '<table border=1>';
	//Affichage de l'entete :
	$content .= '<thead>';
		$content .= "<th> id annonce</th>";
		$content .= "<th> Titre </th>";
		$content .= "<th> description courte </th>";
		$content .= "<th> description_longue </th>";
		$content .= "<th> prix </th>";
		$content .= "<th> photo </th>";
		$content .= "<th> pays </th>";
		$content .= "<th> ville </th>";
		$content .= "<th> adresse </th>";
		$content .= "<th> cp </th>";
		$content .= "<th> membre</th>";
		$content .= "<th> categorie </th>";
		$content .= "<th> date d'enregistrement</th>";
		$content .= "<th> actions</th>";
	$content .= '</thead>';
	//boucle pour les lignee :
		while( $annonce = $r->fetch(PDO::FETCH_ASSOC) ){
			//debug($annonce);	
			$content .= '<tr>';
				$content .= "<td>$annonce[id_annonce]</td>";
				$content .= "<td>$annonce[annonce_titre]</td>";
				$content .= "<td>$annonce[description_courte]</td>";
				$content .= "<td>$annonce[description_longue]</td>";
				$content .= "<td>$annonce[prix] €</td>";
				$content .= "<td>
									$annonce[photo]
									<a href='?action=photo'>Voir les autres photos</a>
							</td>";
				$content .= "<td>$annonce[pays]</td>";
				$content .= "<td>$annonce[ville]</td>";
				$content .= "<td>$annonce[adresse]</td>";
				$content .= "<td>$annonce[cp]</td>";
 
				$content .= "<td><a href='#'>$annonce[prenom]</a></td>";
				
				 
				$content .= "<td> <a href='#'> $annonce[categorie_titre] </a></td>";

				$content .= "<td>$annonce[date]</td>";
				$content .= "<td>
									<a href='?action=afficher&id_annonce=$annonce[id_annonce]'>Afficher</a>
									<a href='?action=modifier&id_annonce=$annonce[id_annonce]'>Modifier</a>
									<a href='?action=supprimer&id_annonce=$annonce[id_annonce]'>Supprimer</a>
								</td>";
			$content .= '</tr>';		
		}

$content .= '</table';
$content .=" <br> <br>";
?>

<?php
//--------------------------------------------------------------- 
// AFFICHAGE du details 
if( isset($_GET['id_annonce']) && $_GET['action'] == 'afficher' ){
	$idannonce= $_GET['id_annonce'];
$content .= " 
	<div> 
	Referennce de l'annonce :	$idannonce <br>" ;
	$r = execute_requete(" SELECT titre,description_longue,description_courte,prix,adresse,ville,cp,pays, DATE_FORMAT(date_enregistrement,'%d/%m/%Y a %H:%i:%s') as date 
FROM `annonce` WHERE `id_annonce`= $idannonce  ");
		while ( $annonce_details = $r->fetch(PDO::FETCH_ASSOC) ) {
			 $content .= "Titre : $annonce_details[titre] <br>";
			 $content .= "Description:<br> $annonce_details[description_courte] <br> $annonce_details[description_longue] <br>";
			 $content .= "Prix : $annonce_details[prix] € <br> ";
			 $content .= "Adresse : <br>  $annonce_details[adresse] <br> $annonce_details[cp] $annonce_details[ville] <br> $annonce_details[pays] <br>";
			 $content .= " Enregistre :$annonce_details[date]";
		}

	$content .="</div>";
	$content .="<br>";
}
?>
<?php
//--------------------------------------------------------------- 
// ajouter un article

//------------------------------------------------------------------
if( !empty($_POST) ){ //Si le formulaire a été validé et qu'il y a des infos de dedans (le $_POST n'est pas vide)

	foreach ($_POST as $key => $value) {
		
		$_POST[$key] = htmlentities( addslashes($value) );
	}
echo "titre :  $_POST[titre]"; // pour tester
	if( isset($_GET['action']) && $_GET['action'] == 'ajouter_form' ){
		execute_requete(" 
			INSERT INTO `annonce`( `titre`, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, `membre_id`, `photo_id`, `categorie_id`, `date_enregistrement`) 
			VALUES ( $_POST[titre],
			");

			header('location:gestion_boutique.php?action=affichage');
	}

}
?>

<h1>Affichage des annonces </h1> 

<a href="annonce.php?action=afficher">Afficher les annonces</a> <br>
<a href="annonce.php?action=ajouter">Ajouter une annonce</a>
<br>
<?= $content ?>

<?php if( isset($_GET['action']) && ($_GET['action'] == 'ajouter' || $_GET['action'] == 'modification') ) :
//------------------------------------------------------------------------------------
 ?>

<form method="post" action="?ajouter_form">
	<label for='titre'> Titre</label> <br>
	<input type="text" name="titre" value="titre" placeholder="titre de l'annonce">

	<input type="submit" name="envoyer">
</form>
<?php endif; ?>
<?php require_once('inc/footer.inc.php'); ?>
