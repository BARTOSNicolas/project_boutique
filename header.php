<?php
//Message en random dans une Array
$message = array("Ca sert à rien, alors vous en avez besoin !!",
                 "Les objets du quotidien qui ne vous serviront à rien !!",
                 "Vous êtes riche, alors achetez les quand même !!",
                 "Les meilleurs objets inutiles du monde !!");
//Chiffre aléatoire entre 0 et la longueur de l'Array -1
$rand = rand( 0, count($message)-1 );
//Affichage
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="catalogue.php">Useless Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" href="catalogue.php">Catalogue <span class="sr-only">(current)</span></a>
          <a class="nav-link" href="clients.php">Tous nos clients</a>
          <a class="nav-link" href="basket.php">Panier</a>
          <a class="nav-link" href="basket.php?empty=true">Vider le panier</a>
        </div>
      </div>
  </div>
</nav>
<div class="jumbotron jumbotron-fluid text-center" style="background-color: #4DA3FF;">
  <div class="container">
    <a href="catalogue.php" class="display-4 text-white text-decoration-none">Useless Shop</a>
    <p class="lead text-white">'.$message[$rand].'</p>
  </div>
</div>
';