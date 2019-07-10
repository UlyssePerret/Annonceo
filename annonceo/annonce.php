<?php require_once('inc/header.inc.php'); ?>
<?php
//Affichage des produits sur la page d'accueil
$r = execute_requete(" SELECT  * FROM annonce ORDER BY  `id_annonce` DESC");

$content .= '<table border=1>';
	//Affichage des catégories :
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
	
	//Affichage des articles correspondant à la catégorie selectionnée 
$content .= '</table';

//-----------------------------------------------------------------------------
?>

<h1>Affichage des annonces </h1>

<?= $content ?>
 
<?php require_once('inc/footer.inc.php'); ?>