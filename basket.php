<?php
session_start(); //Démarrer le system de SESSION

//Inclusion des Classes
require "functions.php";
require "class/Article.php";
require "class/Panier.php";

//Variables
$message_error_price = "";
$shipping_price = 0;
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

//SI on fait un calcul du panier
if(isset($_POST['basket_calcul'])){
    foreach ($_POST['basket_calcul'] as $index => $quantity){
        $basket->addPanier($index);
        $basket->updatePanier($index, $quantity);
    }
}

// SI C'est vide Message d'erreur
if(empty($basket->getBasketList())){
    $message_error_price = "le panier est vide";
}

// Pour supprimer les articles
foreach ($basket->getBasketList() as $index => $item){
    if (isset($_POST['delete'.$index])){ //Executer seulement sur les btn 'supprimer'
        $basket->deletePanier($index);
        //SI la liste est vide ERREUR
        if (empty($basket->getBasketList())){
            $message_error_price = "le panier est vide";
        }
    }
}

//SI on vide le panier
if(isset($_GET["empty"]) && $_GET["empty"]){
    global $basket;
    $basket = new Panier();
    $message_error_price = "le panier est vide";
}

//Condition des frais de port via le poids calculé
if(1 < $basket->getTotalWeight() AND $basket->getTotalWeight() < 1000){
    $shipping_price = 5;
}elseif ($basket->getTotalWeight() >= 1000 && $basket->getTotalWeight() < 5000 ){
    $shipping_price = $basket->getTotalPrice() / 100 * 10;
}elseif ($basket->getTotalWeight() >= 5000){
    $shipping_price = 0;
}

// On enregistre les variables de SESSIONS
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
    <title>Votre commande</title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <form action="basket.php" method="post">
    <?php
       displayPanier($basket, $message_error_price);
    ?>
        <div class="d-flex justify-content-end mt-5">
            <label for="calcul" class="mr-2 mr-sm-5">Poid total : <?php echo ($message_error_price ? "0" : $basket->getTotalWeight()) ?> gr</label>
            <input type="text" class="text-primary" id="calcul" disabled value="<?php echo ($message_error_price ? "Envoi impossible" : $shipping_price."€") ?>">
        </div>
        <div class="d-flex justify-content-end mt-1">
            <input type="submit" name="calcul" class="btn btn-success mr-2 mr-sm-5" value="Calculer le panier">
            <input type="text" class="<?php echo ($message_error_price ? "text-danger" : "text-success")?>" id="calcul" disabled value="<?php echo ($message_error_price ? $message_error_price : ($basket->getTotalPrice() + $shipping_price)."€") ?>">
        </div>
        <a type="button" href="catalogue.php" class="btn btn-primary float-right " style="margin: 50px 0 100px 0">Retour</a>
    </form>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
