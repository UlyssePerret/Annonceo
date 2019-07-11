<?php require_once ('inc/header.inc.php');?>

<?php

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){

    session_destroy();
}
if (userConnect()) {

    header('location:profil.php');
    exit();
}
//----------------------------------------
if ($_POST){
  //debug($_POST) ;
    $r = execute_requete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

    if ( $r->rowCount() >= 1){
        $membre = $r->fetch(PDO::FETCH_ASSOC);
        //debug($membre);

       if ( (password_verify($_POST['mdp'], $membre['mdp'])) || ( $_POST['mdp']===$membre['mdp']) ) {

          $_SESSION['membre']['id_membre'] = $membre['id_membre'];
          $_SESSION['membre']['pseudo'] = $membre['pseudo'];
          $_SESSION['membre']['mdp'] = $membre['mdp'];
          $_SESSION['membre']['nom'] = $membre['nom'];
          $_SESSION['membre']['prenom'] = $membre['prenom'];
          $_SESSION['membre']['telephone'] = $membre['telephone'];
          $_SESSION['membre']['email'] = $membre['email'];
          $_SESSION['membre']['civilite'] = $membre['civilite'];
          $_SESSION['membre']['statut'] = $membre['statut'];
          $_SESSION['membre']['date_enregistrement'] = $membre['date_enregistrement'];

          //debug($_SESSION);
            header('location:profil.php');
       }
    }
}
?>

<h2>Connexion</h2>

<?= $content ?>

<form method="post">
    <label for="pseudo"></label>
    <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo"><br>

    <label for="mdp"></label>
    <input type="text" name="mdp" id="mdp" placeholder="Votre mot de passe"><br>

    <button type="button submit" class="btn btn-primary">Connexion</button>
</form>

<?php require_once ('inc/footer.inc.php') ?>
