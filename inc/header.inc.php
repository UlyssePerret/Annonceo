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
    <?php if( userConnect() ) : ?>    
        <a class="dropdown-item" href="<?= URL ?>profil.php">Profil</a>
         <a class="dropdown-item " href="<?= URL ?>connexion.php?action=deconnexion">Deconnexion</a>
      </li>
     
    <?php  else : ?>
     <!-- Partie inscription -->   
      <a class="dropdown-item" href="<?= URL ?>inscription.php" >Inscription </a>
                    <!-- Fin inscription -->
    <a class="dropdown-item" href="connexion.php">Connexion</a>

      <?php endif; ?>
  </div>
</li>

    </ul>
  </div>
</nav>

<div class="container">

