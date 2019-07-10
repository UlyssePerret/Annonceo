<?php require_once('inc/header.inc.php'); ?>
<!-- Trie -->
<?php
$content .="Trier par catégorie :";
$content .='<form method="GET" action="annonce.php">  
		<div class="form-group col-3">
			<select class="form-control" name="categorie" id="categorie">';
			$content .="<option value='' selected hidden> Trier par categorie</option>"	;
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
	if( isset($_GET['action']) &&  $_GET['action'] == 'modifier_form' ){
		execute_requete("UPDATE article SET  
			titre= '$_POST[titre]',

			WHERE id_annonce = '$_GET[id_anonce]' ");

			header('location:gestion_boutique.php?action=affichage');
	}
	elseif( $_GET['action'] == 'ajouter_form' )
	{
		execute_requete(" 
			INSERT INTO `annonce`( `titre`, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, `membre_id`, `photo_id`, `categorie_id`, `date_enregistrement`) 
			VALUES ( $_POST[titre], $_POST[description_courte],$_POST[description_longue],$_POST[prix],$_POST[categorie_id]
			");

			header('location:gestion_boutique.php?action=affichage');
	}
	

}
?>

<h1>Affichage des annonces </h1> 

<a href="annonce.php?action=afficher">Afficher toutes les annonces</a> <br>
<a href="annonce.php?action=ajouter">Ajouter une annonce</a>
<br>
<?= $content ?>

<?php if( isset($_GET['action']) && ($_GET['action'] == 'ajouter' || $_GET['action'] == 'modifier') ) :


	if( isset($_GET['id_annonce']) ){ 

		$r = execute_requete("SELECT * FROM annonce WHERE id_annonce = '$_GET[id_annonce]' ");

		$annonce_actuel = $r->fetch(PDO::FETCH_ASSOC);
		//debug($article_actuel);
	}

	$titre = ( isset($annonce_actuel['titre']) ) ? $annonce_actuel['titre'] : '';
	$description_courte= ( isset($annonce_actuel['description_courte']) ) ? $annonce_actuel['description_courte'] : '';
	$description_longue= ( isset($annonce_actuel['description_longue']) ) ? $annonce_actuel['description_longue'] : '';
	$prix= ( isset($annonce_actuel['prix']) ) ? $annonce_actuel['prix'] : '';

	$categorie_1 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '1') ? 'selected' : '';
	$categorie_2 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '2') ? 'selected' : '';	
	$categorie_3 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '3') ? 'selected' : '';	
	$categorie_4 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '4') ? 'selected' : '';
	$categorie_5 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
	$categorie_6 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
	$categorie_7 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
	$categorie_8 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
	$categorie_9 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
	$categorie_10 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
	$categorie_11 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '5') ? 'selected' : '';
//------------------------------------------------------------------------------------
 ?>

<form method="post" action="?ajouter_form">
	<div class="form-group">
		<div class="row">
			<div class="col-1"></div>
			<div class="col-4">

				<label for='titre'> Titre</label> <br>
				<input type="text" name="titre"  id="titre"  value="<?= $titre ?>"  placeholder="Titre de l'annonce" class="form-control" >  <br>

				<label for='description_courte'> Description Courte </label> <br>
				<textarea rows = '3'  type="text" name="description_courte"  id="description_courte"     placeholder="Description courte de votre annonce" class="form-control "  ><?= $description_courte ?> </textarea>  <br>

				<label for='description_longue'> Description longue </label> <br>
				<textarea rows ='10'  type="text" name="description_longue"  id="description_longue"     placeholder="Description longue de votre annonce" class="form-control  " >
					<?= $description_longue ?> 
				</textarea>  <br>

				<label for='prix'>Prix</label>
				<input type="text" name="prix"  id="prix"  value="<?= $prix?>"  placeholder="Prix figurant dans l'annonce" class="form-control" >  <br>

				<label for='categorie_id'>Catégorie</label>
			    <select name="categorie_id" id="categorie_id class="form-control  ">
					<option value="" selected>Toutes les catégories</option>
					<option value="1" <?= $categorie_1 ?> >Emploi </option>
					<option value="2" <?= $categorie_2 ?> > Vehicule </option>
					<option value="3" <?= $categorie_3 ?> > Immobilier </option>
					<option value="4" <?= $categorie_4 ?> > Vacances </option>
					<option value="5" <?= $categorie_5 ?> > Multimedia </option>
					<option value="6" <?= $categorie_6 ?> > Loisirs </option>
					<option value="7" <?= $categorie_7 ?> > Materiel </option>
					<option value="8" <?= $categorie_8 ?> > Services </option>
					<option value="9" <?= $categorie_9 ?> > Maison </option>
					<option value="10" <?= $categorie_10 ?> > Vetements </option>
					<option value="11" <?= $categorie_11 ?> > Autres </option>
				</select><br><br>
			</div>
			<div class="col-4">

			</div>
		</div>
		<div>
			<input type="submit" class="btn btn-secondary  " value="<?php echo ucfirst( $_GET['action'] ); ?>">
		</div>
	
	 </div class="form-group">
</form>
<?php endif; ?>
<?php require_once('inc/footer.inc.php'); ?>
