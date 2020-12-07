<?php
//Message en random
$message = array("Ca sert à rien, alors on en a besoin !!", "Les objets du quotidien qui ne servent à rien !!", "Vous êtes riche, alors acheter les quand même !!");
$rand = rand( 0, 2 );
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
          <!--<a class="nav-link" href="addItem.php">Ajouter un produit</a>-->
          <a class="nav-link" href="basket.php">Panier</a>
          <a class="nav-link" href="basket.php?empty=true">Vider le panier</a>
        </div>
      </div>
  </div>
</nav>
<div class="jumbotron jumbotron-fluid text-center" style="background-color: #e3f2fd;">
  <div class="container">
    <a href="catalogue.php" class="display-4 text-primary text-decoration-none">Useless Shop</a>
    <p class="lead text-primary">'.$message[$rand].'</p>
  </div>
</div>
';