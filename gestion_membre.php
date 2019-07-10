
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

        $r = execute_requete("SELECT * FROM membre");
;

    $content .= '<table border="1" cellpadding="5" >';
    $content .= '<tr>';
    for ($i = 0; $i < $r->columnCount(); $i++){

        $colonne = $r ->getColumnMeta($i);
        $content .= "<th>$colonne[name]</th>";
    }

    while ($membre = $r->fetch(PDO::FETCH_ASSOC)){

        $content .= '<tr>';
         foreach ($membre as $key => $value){

             $content .= "<td>$value</td>";
         }

        $content .= '</tr>';
    }

    $content .= '</table>'

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
    </select>
</form>





<?php require_once ('../inc/footer.inc.php') ?>
