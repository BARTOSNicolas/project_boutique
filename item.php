<?php
session_start(); //Démarrer le system de SESSION
//Inclusion des Classe
require "class/Article.php";
require "class/Panier.php";
require "functions.php";
require_once "database/database.php";

//Variables
$id = $_GET['id'];

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

//Fonction pour afficher un seul produit
function show_single_product($product_id){
    $bdd = connectBDD();
    $req = $bdd->prepare('SELECT * FROM products WHERE id='.$product_id.' ');
    $req->execute(array());
    $data = $req->fetch();
    $article = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
    displayArticleSelf($article);
    $req->closeCursor();
}
?>
<!-- Affichage -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Article </title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <form action="item.php?id=<?php echo $id ?>" method="post">
    <?php show_single_product($id); ?>
    </form>
    <a type="button" href="catalogue.php" class="btn btn-primary mt-5 float-right" style="margin-bottom: 100px">Retour</a>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
