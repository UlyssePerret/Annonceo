<?php require_once('../inc/header.inc.php')

//-----------------------------------------------
 ?>

 <?php  /*if (!adminConnect()) {
		header('location:../connexion.php');
		exit();*/

//----------------------------------------------

						//Affichage commentaires :

		$r = execute_requete("SELECT * FROM commentaire");

		$content .= '<h2>Total commentaire(s) : ' . $r->rowCount() . ' </h2>';
		$content .= '<br>';

		$content .= '<table border="2" cellpadding="5">';

			$content .= '<tr>';

				for ($i=0; $i < $r->columnCount() ; $i++) { 
		
					$colonne = $r->getColumnMeta($i);

					$content .= "<th>$colonne[name]</th>";


		}
					$content .="<th>action</th>";
			$content .= '</tr>';

				while ($commentaire = $r->fetch(PDO::FETCH_ASSOC)) {

					$content .= '<tr>';

						foreach ($commentaire as $key => $value) {

							$content .= "<td>$value</td>";
				}
				$content .= '<td><a href="?action=details&id_commentaire='.  $commentaire['id_commentaire'] .'">détails</a>
							 <br><a href="?action=modification&id_commentaire='.  $commentaire['id_commentaire'] .'">modif</a>
							 <br><a href="?action=suppression&id_commentaire='.  $commentaire['id_commentaire'] .'">suppr</a></td>';

					$content .= '</tr>';
		}

		$content .= '</table>';


?>

<h1>Gestion des commentaires</h1>

 <a href="?action=affichage">Affichage des commentaires</a><br>

 <?= $content ?>

 <?php require_once('../inc/footer.inc.php') ?>