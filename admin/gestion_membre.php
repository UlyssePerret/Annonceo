
<!--CREATE DATABASE annonceo;-->
<!---->
<!--USE database annonceo;-->
<!---->
<!--CREATE TABLE membre:-->
<!--(-->
<!-- id_membre int (3) AUTO_INCREMENTI-->
<!-- pseudo varchar 20)-->
<!-- mdp varchar (60)-->
<!-- nom varchar (20)-->
<!-- prenom varchar( 20)-->
<!-- telephone varchar (20)-->
<!-- email varchar (50)-->
<!-- civilite enum  ('m','f')-->
<!-- statut int (1)-->
<!-- date_enregistrement datetime-->
<!--)-->
<?php require_once ('../inc/header.inc.php') ?>

<?php

//if( !adminConnect()){
//
//    header('location:../connexion.php');
//    exit();
//}


//Suppression des membres:

if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){

    execute_requete("DELETE FROM membre WHERE id_membre= '$_GET[id_membre]' ");

    header('location:gestion_membre.php');
}


//-----------------------------------------------------------------------------------------------










        $r = execute_requete("SELECT * FROM membre");


    $content .= '<table border="1" cellpadding="5" style="width: 100%;" >';
    $content .= '<tr>';
    for ($i = 0; $i < $r->columnCount(); $i++){

        $colonne = $r ->getColumnMeta($i);
        $content .= "<th>$colonne[name]</th>";
    }

    $content .= "<th>Actions</th>";
    while ($membre = $r->fetch(PDO::FETCH_ASSOC)){

        $content .= '<tr>';
         foreach ($membre as $key => $value){

             $content .= "<td>$value</td>";
         }
        $content .= '<td>
                        <a href="?action=modification&id_membre='.$membre['id_membre'].'">Modif</a>
                        <a href="?action=suppression&id_membre='.$membre['id_membre'].'" onclick="return(confirm(\'En etes vous sur ?\')">Suppr</a>
                    </td>';


        $content .= '</tr>';
    }

    $content .= '</table>';





//Modification :
if( isset($_GET['action']) && $_GET['action'] == 'modification' ) {

    $r = execute_requete(" SELECT * FROM membre WHERE id_membre='$_GET[id_membre]' ");

    $membre = $r->fetch(PDO::FETCH_ASSOC);
//debug($membre);

    $pseudo = (isset($membre['pseudo'])) ? $membre['pseudo'] : '';
    $mdp = (isset($membre['mdp'])) ? $membre['mdp'] : '';
    $nom = (isset($membre['nom'])) ? $membre['nom'] : '';
    $prenom = (isset($membre['prenom'])) ? $membre['prenom'] : '';
    $telephone = (isset($membre['telephone'])) ? $membre['telephone'] : '';
    $email = (isset($membre['email'])) ? $membre['email'] : '';
    $civilite = (isset($membre['civilite'])) ? $membre['civilite'] : '';
    $statut = (isset($membre['statut'])) ? $membre['statut'] : '';
    $date_enregistrement = (isset($membre['date_enregistrment'])) ? $membre['date_enregistrment'] : '';



}


if( isset($_POST['update']) ){

    execute_requete(" UPDATE membre SET pseudo='$_POST[pseudo]', nom='$_POST[nom]', prenom='$_POST[prenom]', telephone='$_POST[telephone]', email='$_POST[email]', civilite='$_POST[civilite]', statut='$_POST[statut]', date_enregistrment='$_POST[date_enregistrement]' WHERE id_membre='$_GET[membre]' ");

    header('location:gestion_membre.php');
}

?>



<h2>GESTION DES MEMBRES</h2>


<?= $content ?>


<form>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control"  id="pseudo" placeholder="pseudo">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Votre email">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control"  id="mdp" placeholder="mot de passe">
        </div>
        <div class="form-group col-md-6">
            <label for="telephone">telephone</label>
            <input type="text" class="form-control"  id="telephone" placeholder="votre telephone">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nom">Nom</label>
            <input type="text" class="form-control"  id="nom" placeholder="votre nom">

        </div>
        <div class="form-group col-md-2">
            <label for="civilite">Civilite</label>
            <select id="civilite" class="form-control">
                <option value="m" >Homme</option>
                <option value="f" >Femme</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control"  id="prenom" placeholder="votre prenom">
        </div>
        <div class="form-group col-md-2">
            <label for="statut">Statut</label>
            <select id="statut" class="form-control">
                <option value="1"  >Admin</option>
                <option value="0"  >Membre</option>
        </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Enregistrer">


</form>











<!--<div class="row" >-->
<!--<form method="post" style="display: flex; margin: 0 auto; border: 2px red solid; width: 100%" >-->
<!--<div style="border: 2px green solid;  width: 100%"  >-->
<!--    <div class="card" style="padding: 10px;" >-->
<!---->
<!--    <label for="pseudo">Pseudo</label><br>-->
<!--    <input type="text" class="form-control" name="pseudo" id="pseudo"><br><br>-->
<!---->
<!--    <label for="mdp">Mot de passe</label><br>-->
<!--    <input type="text" class="form-control" name="mdp" id="mdp"><br><br>-->
<!---->
<!--    <label for="nom">Nom</label><br>-->
<!--    <input type="text" class="form-control" name="nom" id="nom"><br><br>-->
<!---->
<!--    <label for="prenom">Prenom</label><br>-->
<!--    <input type="text" class="form-control" name="prenom" id="prenom"><br><br>-->
<!---->
<!--    </div>-->
<!--</div>-->
<!--    <div style="width: 100%">-->
<!--        <div class="card">-->
<!---->
<!--    <label for="email">Email</label><br>-->
<!--    <input type="text" class="form-control"  name="email" id="email"><br><br>-->
<!---->
<!--    <label for="telephone">Telephone</label><br>-->
<!--    <input type="text" class="form-control"  name="telephone" id="telephone"><br><br>-->
<!---->
<!--    <label for="civilite">Civilite</label><br>-->
<!--    <select name="civilite" id="civilite">-->
<!--        <option value="m">Homme</option>-->
<!--        <option value="f">Femme</option>-->
<!--    </select>-->
<!--    <br>-->
<!---->
<!--    <label for="statut">Statut</label><br>-->
<!--    <select name="statut" id="statut">-->
<!--        <option value="0">Admin</option>-->
<!--        <option value="1">Membre</option>-->
<!--    </select><br><br>-->
<!---->
<!---->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</form>-->
<!---->
<!--    <input type="submit" class="btn btn-primary" value="Enregistrer">-->
<!--</div>-->



<?php require_once ('../inc/footer.inc.php') ?>
