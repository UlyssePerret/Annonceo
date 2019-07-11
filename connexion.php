<?php require_once ('inc/header.inc.php');?>

<?php

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    session_destroy();
}

if (userConnect()) {
    header('location:profil.php');
    exit();
}
//-------------------------------------------
if ($_POST){
    $r = execute_requete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

    if ( $r->rowCount() >= 1){
        $membre = $r->fetch(PDO::FETCH_ASSOC);

       if (password_verify($_POST['mdp'], $membre['mdp'])){

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

       }

    }

}

?>































<?= $content ?>



<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
   Connexion
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="connexion" >Se connecter</h5>
                <button type="button" class="close" id="connexion" name="connexion" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <label for="pseudo"></label>
                    <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo"><br>


                    <label for="mdp"></label>
                    <input type="text" name="mdp" id="mdp" placeholder="Votre mot de passe"><br>
                </form>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary">Connexion</button>
            </div>
        </div>
    </div>
</div>




















<?php require_once ('inc/footer.inc.php') ?>
