<?php
//Démarrer le system de SESSION
session_start();

include "functions.php";
global $list_articles;
$basket_list = array();
$quantity_list = array();
$message_error_price = "";
$empty = false;
// Si le POST est vide message erreur
if (isset($_POST['basket'])){
    $basket_list = $_POST['basket'];
}else if(isset($_POST['basket_list'])){
    $basket_list = $_POST['basket_list'];
}else if(isset($_SESSION['basket'])){
    $basket_list = $_SESSION['basket'];
    if(empty($basket_list)){
        $message_error_price = "le panier est vide";
    }
}else{
    $message_error_price = "le panier est vide";
}

// Pour supprimer les articles
foreach ($basket_list as $index => $item){
    if (isset($_POST['delete'.$index])){
        unset($basket_list[$index]);
        unset($quantity_list[$index]);
        if (!$basket_list){
            $message_error_price = "le panier est vide";
        }
    }
}

// Garde les quantités en mémoire
if (isset($_POST['basket'])){
    foreach ($basket_list as $index => $item){
        $quantity_list[$index] = 1;
    }
}else {
    foreach ($basket_list as $index => $item) {
        if (isset($_POST["quantity"])) {
            $quantity_list[$index] = $_POST["quantity"][$index];
        } else if (isset($_SESSION['quantity'])) {
            if (isset($_SESSION["quantity"][$index])) {
                $quantity_list[$index] = $_SESSION["quantity"][$index];
            } else if (empty($quantity_list[$index])) {
                $quantity_list[$index] = 1;
            }
        } else {
            $quantity_list[$index] = 1;

        }
    }
}

// Calcule du prix
$total_price = 0;
function calculBasket($nbr, $price){
    return $nbr * $price;
}
function emptyBasket(){
    global $basket_list;
    global $quantity_list;
    $basket_list = array();
    $quantity_list = array();
}
if(isset($_GET["empty"]) && $_GET["empty"]){
    emptyBasket();
    $message_error_price = "le panier est vide";
}
$_SESSION['basket'] = $basket_list;
$_SESSION['quantity'] = $quantity_list;
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
<? include "header.php" ?>
<div class="container">
    <form action="basket.php" method="post">
        <? foreach ($basket_list as $index => $item){
            if ($quantity_list[$index] <= 0){
                $message_error_price = "Quantité inextact";
            }
            displayItemBasket($list_articles[$item]['name'], $list_articles[$item]['price'], $list_articles[$item]['picture'], $list_articles[$item]['desc'], $index, $quantity_list[$index], $message_error_price);
            $total_price = $total_price + calculBasket($quantity_list[$index], $list_articles[$item]['price']);
            echo '<input type="hidden" value="'.$item.'" name="basket_list[]">';
        }?>
        <div class="d-flex justify-content-end mt-5">
            <input type="submit" name="calcul" class="btn btn-success mr-5" value="Calculer le panier">
            <input type="text" class="mr-5 <? echo ($message_error_price ? "text-danger" : "text-success")?>" id="calcul" disabled value="<? echo ($message_error_price ? $message_error_price : $total_price) ?>">
            <a type="button" href="catalogue.php" class="btn btn-primary">Retour</a>
        </div>

    </form>
</div>
<? include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
