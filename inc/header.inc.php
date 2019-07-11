<?php require_once('init.inc.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Annonceo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	                     <!-- css boostrap -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <a class="navbar-brand" href="<?= URL ?>accueil.php">Annonceo</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Qui sommes nous? <span class="sr-only">(current)</span></a>
      </li>

       </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contacts</a>
      </li>

                        <!-- Partie recherche -->

      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Recherche..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

                      <!-- Partie Espace membre -->

  <li class="dropdown">
  <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flex; justify-content: flex-end;">
    Espace membre
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    


      <a class="dropdown-item" href="<?= URL ?>inscription.php" data-toggle="modal" data-target="#exampleModal">Inscription 

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="text-align:center">Inscris-toi !</h5>
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

  <input type="text" name="tel" id="tel" class="form-control" placeholder="telephone"><br>

      <select id="sexe" style="width:100%; text-align: center;">
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
</a>

    <a class="dropdown-item" href="#">Connexion</a>
    <a class="dropdown-item" href="#">Profil</a>
  </div>
</li>

                       <!-- Partie inscription -->

 
                    <!-- Fin inscription -->

     

                    <!-- partie BackOffice -->
                      <!-- Fin BackOffice -->

    </ul>
  </div>
</nav>

<div class="container">

