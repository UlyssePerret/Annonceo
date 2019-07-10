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

 if (isset($_GET['categorie']) ){ // Cas si il a un trie
		$value_categorie = $_GET['categorie']  ;
		//echo "$value_categorie ";
		$r = execute_requete("SELECT `id_annonce`, a.titre as annonce_titre, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, m.prenom ,`photo_id`, c.titre as categorie_titre, a.date_enregistrement as date
			FROM `annonce` as a 
				INNER JOIN membre AS m 
				ON a.membre_id = m.id_membre 
				INNER JOIN categorie  AS c
				ON a.categorie_id = c.id_categorie 
WHERE categorie_id='$value_categorie' 
ORDER BY `id_annonce` DESC
");
	}
	else{ //sinon affichage standard
		$r = execute_requete(" SELECT `id_annonce`, a.titre as annonce_titre, `description_courte`, `description_longue`, `prix`, `photo`, `pays`, `ville`, `adresse`, `cp`, m.prenom ,`photo_id`, c.titre as categorie_titre, a.date_enregistrement as date
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
									<a href='?action=afficher'>Afficher</a>
									<a href='?action=modifier'>Modifier</a>
									<a href='?action=supprimer'>Supprimer</a>
								</td>";
			$content .= '</tr>';		
		}

$content .= '</table';

//--------------------------------------------------------------- 
?>

<h1>Affichage des annonces </h1>

<?= $content ?>


<?php require_once('inc/footer.inc.php'); ?>
