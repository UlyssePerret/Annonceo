<?php require_once('../inc/header.inc.php'); ?>
<!-- Trie -->
<?php
$content .="Trier par catégorie :";
$content .='<form method="GET" action="gestion_annonce.php">  
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
if( isset($_GET['action']) && $_GET['action'] == 'supprimer' ){

	//Récupération des infos de l'annonce à supprimer
	$r = execute_requete("SELECT * FROM annonce WHERE id_annonce='$_GET[id_annonce]' ");

	//Application de la méthode 'fetch' pour pouvoir exploiter les données
	$article_a_supprimer = $r->fetch(PDO::FETCH_ASSOC);

	execute_requete("DELETE FROM annonce WHERE id_annonce= '$_GET[id_annonce]' ");

	//redirection avec l'affichage des annonces
	header('location:gestion_annonce.php?action=affichage');
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
								<a href='?action=afficher&id_annonce=$annonce[id_annonce]'>Afficher</a> <br>";
								$content .="<a href='?action=modifier&id_annonce=$annonce[id_annonce]'>Modifier</a> <br>";
							$content .= '<a href="?action=supprimer&id_annonce='. $annonce['id_annonce'] . '" onclick="return( confirm(\' En êtes vous sur ?\'))">Supprimer</a> ';
							$content .= "</td>";
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
//--------------------------------
	// echo "titre :  $_POST[titre]"; // pour tester
	if( isset($_GET['action']) &&  $_GET['action'] == 'modifier' ){
		
		$photo_bdd = $_POST['photo_actuelle'];

	}
	//-------------------------
		//debug($_FILES);
		//debug($_SERVER);
	    //debug($_POST);

	if (!empty($_FILES['photo']['name'])) { // Si vous avez uploadé un fichier
		
		// Ici, on renomme la photo : 
		$nom_photo = $_POST['id_annonce'] . '_' . $_FILES['photo']['name'];

		//Chemin pour accéder à la photo en BDD : 
		$photo_bdd = URL . "photo/$nom_photo";

		//Ou est ce que l'ion veut stocker notre photo :
		$photo_dossier = $_SERVER['DOCUMENT_ROOT'] . "up-php/annonceo/photo/$nom_photo";

		copy($_FILES['photo']['tmp_name'], $photo_dossier);
		// copy(arg1, arg2) => fonction prédéfine de php ou :
			// arg1 : chemin du fichier source
			// arg2 : chemin de destination 
	}
//------------------------------------------------

	elseif( $_GET['action'] == 'ajouter' )
	{
		if( !isset( $_SESSION['membre'] ) ) {
				
			echo " Merci de vous connecter avant d'ajouter un membre" ;
		}
		else{

			$membre = $_SESSION['membre'];
		
		execute_requete(" 
			INSERT INTO `annonce`( `titre`, description_courte, description_longue, prix, categorie_id, pays, ville, adresse, cp, membre_id , date_enregistrement ) VALUES ( '$_POST[titre]', '$_POST[description_courte]','$_POST[description_longue]','$_POST[prix]', '$_POST[categorie_id]',  '$_POST[pays]','$_POST[ville]','$_POST[adresse]','$_POST[cp]', '$membre', NOW()  )");
		}
	}
//----------------------------------
	if( isset($_GET['action']) &&  $_GET['action'] == 'modifier' ){
		//echo "modification actuel :  $_POST[ville]";
		execute_requete("UPDATE annonce SET  
			titre= '$_POST[titre]',
			description_courte= '$_POST[description_courte]',
			description_longue= '$_POST[description_longue]',
			prix= '$_POST[prix]',
			categorie_id= '$_POST[categorie_id]',
			pays= '$_POST[pays]',
			ville= '$_POST[ville]',
			adresse= '$_POST[adresse]',
			cp= '$_POST[cp]'
			WHERE id_annonce = $_GET[id_annonce];");

	}

}
?>

<h1>Affichage des annonces </h1> 

<a href="gestion_annonce.php?action=afficher">Afficher toutes les annonces</a> <br>
<a href="gestion_annonce.php?action=ajouter">Ajouter une annonce</a>
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
	$categorie_6 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '6') ? 'selected' : '';
	$categorie_7 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '7') ? 'selected' : '';
	$categorie_8 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '8') ? 'selected' : '';
	$categorie_9 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '9') ? 'selected' : '';
	$categorie_10 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '10') ? 'selected' : '';
	$categorie_11 =  ( isset($annonce_actuel['categorie_id']) && $annonce_actuel['categorie_id'] == '11') ? 'selected' : '';

	$adresse= ( isset($annonce_actuel['adresse']) ) ? $annonce_actuel['adresse'] : '';
	$ville= ( isset($annonce_actuel['ville']) ) ? $annonce_actuel['ville'] : '';
	$cp= ( isset($annonce_actuel['cp']) ) ? $annonce_actuel['cp'] : '';
//------------------------------------------------------------------------------------
 ?>

<form method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<div class="row">
			<div class="col-1"></div>
			<div class="col-4">

				<label for='titre'> Titre</label> <br>
				<input type="text" name="titre"  id="titre"  value="<?= $titre ?>"  placeholder="Titre de l'annonce" class="form-control" >  <br>

				<label for='description_courte'> Description Courte </label> <br>
				<textarea rows = '3'  type="text" name="description_courte"  id="description_courte"     placeholder="Description courte de votre annonce" class="form-control "  ><?= $description_courte ?></textarea>  <br>

				<label for='description_longue'> Description longue </label> <br>


				<textarea rows ='10'  type="text" name="description_longue"  id="description_longue"     placeholder="Description longue de votre annonce" class="form-control" ><?= $description_longue;?></textarea>  <br>

				<label for='prix'>Prix</label>
				<input type="text" name="prix"  id="prix"  value="<?= $prix?>"  placeholder="Prix figurant dans l'annonce" class="form-control" >  <br>

				<label for='categorie_id'>Catégorie</label>
			    <select name="categorie_id" id="categorie_id" class="form-control">
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

				<label for="photo">photo</label><br>
				<input type="file" name="photo" id="photo"><br>
				<?php
				if( isset($annonce_actuel)){
					echo '<i>Vous pouvez uploadez une nouvelle photo </i>';

					echo'<img src="'.$annonce_actuel['photo'].'"width="80">';
					echo '<input type="hidden" name="photo_actuelle" value="'. 
					$annonce_actuel['photo'].'">';
				}
				?>
			<br><br>

			<label for="pays">Pays</label>
				<select name="pays" id="pays" class="form-control">
					<option value="France" selected  > France </option>
					<option value="Royaume-uni"  >Royaume-uni</option>
				</select><br><br>

				<label for="adresse">Adresse</label>
				<textarea rows = '3' type="text" name="adresse"  id="adresse" placeholder="Adresse figurant dans l'annonce" class="form-control"><?= $adresse ?></textarea>  <br>

				<label for='ville'>Ville</label>
				<input type="text" name="ville"  id="ville"  value="<?= $ville?>"  placeholder="Ville" class="form-control" >  <br>	

				<label for='cp'>Code postal</label>
				<input type="text" name="cp"  id="cp"  value="<?= $cp?>"  placeholder="Code Postale figurant dans l'annonce" class="form-control" >  <br>

     	 </div>
     	 </div>
    		<div class="d-flex  justify-content-center">
				<input type="submit" class="btn btn-secondary  " value="<?php echo ucfirst( $_GET['action'] ); ?>">
			</div>
	 </div class="form-group">
</form>
<?php endif; ?>
<?php require_once('../inc/footer.inc.php'); ?>