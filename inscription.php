<?php require_once('inc/header.inc.php') ?>

<?php 
//-------------------------
//Gestion de voir si un membre est connecter
if (userConnect()) {//Si l'internaute est connecté, je le redirige vers son profil
	header('location:profil.php');
	exit();
}
//------------------------------------------------

if ( $_POST ){// Si on clique sur le bouton submit
  debug( $_POST );

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
  if ( empty($error) ) {
    execute_requete("INSERT INTO membre(pseudo, mdp, nom, prenom,  email, telephone, 
      civilite ) 
      VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]', '$_POST[email]', '$_POST[telephone]',
      '$_POST[civilite]' )");

    echo '<div class="alert alert-success" role="alert">Inscription validée ! <a href="'. URL .'connexion.php"> Cliquez pour vous connecter </a></div>';
  }

  //affichage des erreurs : 
  $content .=$error;
}
 ?>

<h1>S'inscrire</h1>

<div class=" "  tabindex="-1" role="dialog"  aria-hidden="true">
  <div  role="document">
      <div>
        <h5>Inscris-toi !</h5>
        <button type="button" class="close"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div >

        <form method="post" action="?ajout"  enctype="multipart/form-data">

          <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Votre pseudo"><br>

          <input type="text" name="mdp" id="mdp" class="form-control" placeholder="Votre mot de passe"><br>

          <input type="text" name="nom" id="nom" class="form-control" placeholder="Votre nom"><br>

          <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Votre prenom"><br>

          <input type="text" name="email" id="email" class="form-control" placeholder="Votre email"><br>

          <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Votre téléphone"><br>

      <select name="civilite" id="civilite" style="width:100%; text-align: center;">
        <option value="m">homme</option>
        <option value="f">femme</option>
      </select><br><br>
            </div>
      <div  >
        <input type="submit" class="btn btn-success"  style="width: 100%; text-align: center;" value="Inscription">
      </div>
      </form>



  </div>
</div>

<?= $content; ?>

<?php require_once('inc/footer.inc.php') ?>