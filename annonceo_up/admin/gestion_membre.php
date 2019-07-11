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
//Suppression des membres:
if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){
    execute_requete("DELETE FROM membre WHERE id_membre= '$_GET[id_membre]' ");
    header('location:gestion_membre.php');
}
//-----------------------------------------------------------------------------------------------
        $r = execute_requete("SELECT * FROM membre");
    $content .= '<table border="1" cellpadding="5" >';
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
                        <a href="?action=suppression&id_membre='.$membre['id_membre'].'">Suppr</a>
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
    $nom = (isset($membre['nom'])) ? $membre['nom'] : '';
    $prenom = (isset($membre['prenom'])) ? $membre['prenom'] : '';
    $sexe = (isset($membre['telephone'])) ? $membre['telephone'] : '';
    $email = (isset($membre['email'])) ? $membre['email'] : '';
    $cp = (isset($membre['civilite'])) ? $membre['civilite'] : '';
    $statut = (isset($membre['statut'])) ? $membre['statut'] : '';
    $adresse = (isset($membre['date_enregistrment'])) ? $membre['date_enregistrment'] : '';
}
if( isset($_POST['update']) ){
    execute_requete(" UPDATE membre SET pseudo='$_POST[pseudo]', nom='$_POST[nom]', prenom='$_POST[prenom]', telephone='$_POST[telephone]', email='$_POST[email]', civilite='$_POST[civilite]', statut='$_POST[statut]', date_enregistrment='$_POST[date_enregistrment]' WHERE id_membre='$_GET[membre]' ");
    header('location:gestion_membre.php');
}
?>



<h2>GESTION DES MEMBRES</h2>


<?= $content ?>


<form method="post">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" name="pseudo" id="pseudo"><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="text" name="mdp" id="mdp"><br><br>

    <label for="nom">Nom</label><br>
    <input type="text" name="nom" id="nom"><br><br>

    <label for="prenom">Prenom</label><br>
    <input type="text" name="prenom" id="prenom"><br><br>

    <label for="email">Email</label><br>
    <input type="text" name="email" id="email"><br><br>

    <label for="telephone">Telephone</label><br>
    <input type="text" name="telephone" id="telephone"><br><br>

    <label for="civilite">Civilite</label><br>
    <select name="civilite" id="civilite">
        <option value="m">Homme</option>
        <option value="f">Femme</option>
    </select>
    <br>

    <label for="statut">Statut</label><br>
    <select name="statut" id="statut">
        <option value="0">Admin</option>
        <option value="1">Membre</option>
    </select><br><br>


    <input type="submit" value="Enregistrer">
</form>





<?php require_once ('../inc/footer.inc.php') ?>