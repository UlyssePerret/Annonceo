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
?>
<!-- Affichage du tableau-->
<?php
$content .='<h1>Affichage des annonces </h1>';
 	if (isset($_GET['categorie']) ){ // Cas si il a un trie
		$value_categorie = $_GET['categorie']  ;
		//echo "$value_categorie ";
		$r = execute_requete("SELECT * FROM `annonce` WHERE `categorie_id`='$value_categorie' ");
	}
	else{ //sinon affichage standard
		$r = execute_requete(" SELECT  * FROM annonce ORDER BY  `id_annonce` DESC");
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
		$content .= "<th> membre id </th>";
		$content .= "<th> categorie </th>";
		$content .= "<th> date d'enregistrement</th>";
		$content .= "<th> actions</th>";
	$content .= '</thead>';
	//boucle pour les lignee :
		while( $annonce = $r->fetch(PDO::FETCH_ASSOC) ){
			//debug($annonce);	
			$content .= '<tr>';
				$content .= "<td>$annonce[id_annonce]</td>";
				$content .= "<td>$annonce[titre]</td>";
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

				$content .= "<td>$annonce[membre_id]</td>";
				$content .= "<td>$annonce[categorie_id]</td>";

				$content .= "<td>$annonce[date_enregistrement]</td>";
				$content .= "<td>
									<a href='?action=afficher'>Afficher</a>
									<a href='?action=modifier'>Modifier</a>
									<a href='?action=supprimer'>Supprimer</a>
								</td>";
			$content .= '</tr>';		
		}

$content .= '</table';

//--------------------------------------------------------------- 
?>

<?= $content ?>
 
<?php require_once('inc/footer.inc.php'); ?>
