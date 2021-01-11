<?php
session_start(); //Démarrage des SESSIONS

//Inclusion de la Classe Catalogue
require "class/Catalogue.php";
require "class/Panier.php";
require "functions.php";

//Initialisation du Catalogue
$catalogue = new Catalogue();

$basket = new Panier();
// SI SESSION On charge la session
if (isset($_SESSION['basket'])){
    foreach ($_SESSION['basket'] as $index => $quantity){
        $basket->addPanier($index);
        $basket->updatePanier($index, $quantity);
    }
}

// Si on ajoute un produit de Catalogue
if(isset($_POST['add'])){
    $basket->addPanier($_POST['add']);
}
// Enregistrer les SESSIONS
$_SESSION['basket'] = $basket->getBasketList();
$_SESSION['in_basket'] = $basket->getPanierNumber();
//Affichage
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Page Catalogue</title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <div class="d-flex justify-content-end">
        <a type="button" href="addItem.php" class="btn btn-primary mb-5">Add New Item</a>
    </div>
    <form action="catalogue.php" method="post">
        <?php
        displayCat($catalogue);
        ?>
        <div class="d-flex justify-content-end align-items-start">
            <input type="submit" class="btn btn-primary" style="margin-bottom: 150px" value="Ajouter au panier">
        </div>
    </form>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>