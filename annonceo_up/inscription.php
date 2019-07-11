<?php require_once('inc/header.inc.php') ?>


<?php 

if (userConnect()) {//Si l'internaute est connecté, je le redirige vers son profil

	header('location:profil.php');
	exit();

}
//------------------------------------------------
  


if ( $_POST ){// Si on clique sur le bouton submit
  //debug( $_POST );
  //Declaration d'une variable :
  $error = '';

  if (strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) >= 20) {
    //Si le pseudo est inferieur ou egale a 3 OU qu'il est sup a 20
    $error .= '<div class="alert alert-danger" role="alert">Erreur taille pseudo</div>';
  }

  $r = execute_requete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
  if ($r->rowCount() >= 1) {
    $error .= '<div class="alert alert-danger" role="alert">Pseudo indisponible</div>';
  }

  //Boucle sur les saisies afin de les passer dans la fonction addslashes :
  foreach ($_POST as $key => $value) {
    $_POST[$key] = addslashes($value);
  }

  //Cryptage du mot de passe : 
  $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
  if (empty($error)) {
    execute_requete("INSERT INTO membre(pseudo, mdp, nom, prenom,  email, sexe, ville, cp, adresse) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[sexe]','$_POST[ville]','$_POST[cp]','$_POST[adresse]')");

    echo '<div class="alert alert-success" role="alert">Inscription validée ! <a href="'. URL .'connexion.php"> Cliquez pour vous connecter </a></div>';
  }

  //affichage des erreurs : 
  $content .=$error;
}

 ?>

<?= $content; ?>
                                      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inscris-toi !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post">

  <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="pseudo"><br>

  <input type="text" name="mdp" id="mdp" class="form-control" placeholder="mot de passe"><br>

  <input type="text" name="nom" id="nom" class="form-control" placeholder="nom"><br>

  <input type="text" name="prenom" id="prenom" class="form-control" placeholder="prenom"><br>

  <input type="text" name="email" id="email" class="form-control" placeholder="email"><br>

  <input type="text" name="ville" id="ville" class="form-control" placeholder="telephone"><br>

      <select id="select" style="width:100%; text-align: center;">
        <option value="h">homme</option>
        <option value="f">femme</option>
      </select><br><br>

</form>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success"  style="width: 100%; text-align: center;" value="Inscription">
      </div>
    </div>
  </div>
</div>

       


<?php require_once('inc/footer.inc.php') ?>