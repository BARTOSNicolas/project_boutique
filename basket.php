<?php
//Démarrer le system de SESSION
session_start();

//Inclusion des Classes
require "class/Article.php";
require "class/Panier.php";

//Variables
$basket_list = array();
$quantity_list = array();
$message_error_price = "";
$empty = false;
$shipping_price = 0;

//SI C'est un nouveau POST
if(isset($_POST['basket'])) {
    $basket_list = $_POST['basket'];
    foreach ($basket_list as $index => $item) {
        $quantity_list[$index] = 1;
    }
//SI post avec calcul charge le calcul
}else if(isset($_POST['basket_list'])) {
    $basket_list = $_POST['basket_list'];
    foreach ($basket_list as $index => $item) {
        $quantity_list[$index] = $_POST['quantity'][$index];
    }
//SI SESSION charge les sessions
}else if(isset($_SESSION['basket'])){
$basket_list = $_SESSION['basket'];
$quantity_list = $_SESSION["quantity"];
//SI session vide erreur
    if(empty($basket_list)) {
        $message_error_price = "le panier est vide";
    }
}else{
    $message_error_price = "le panier est vide";
}

// Pour supprimer les articles
foreach ($basket_list as $index => $item){
    if (isset($_POST['delete'.$index])){ //Executer seulement sur les btn 'supprimer'
        unset($basket_list[$index]);
        unset($quantity_list[$index]);
        //SI la liste est vide ERREUR
        if (empty($basket_list)){
            $message_error_price = "le panier est vide";
        }
    }
}

//CREE l'objet Panier à partir de $basket_list et quantity_list
if(isset($basket_list)){
    $basket = new Panier($basket_list, $quantity_list);
}

//Fonction pour vider le panier
function emptyBasket(){
    global $basket_list, $quantity_list, $basket;
    $basket_list = array();
    $quantity_list = array();
    $basket = new Panier($basket_list, $quantity_list);
}

// SI clique sur vider le panier = vide le panier
if(isset($_GET["empty"]) && $_GET["empty"]){
    emptyBasket();
    $message_error_price = "le panier est vide";
}

// On enregistre les variables de SESSIONS
$_SESSION['basket'] = $basket_list;
$_SESSION['quantity'] = $quantity_list;

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
        $basket->displayPanier($message_error_price);

        //Condition des frais de port via le poids calculé
        if($basket->getTotalWeight() < 1000){
            $shipping_price = 5;
        }elseif ($basket->getTotalWeight() >= 1000 && $basket->getTotalWeight() < 5000 ){
            $shipping_price = $basket->getTotalPrice() / 100 * 10;
        }elseif ($basket->getTotalWeight() >= 5000){
            $shipping_price = 0;
        }
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
