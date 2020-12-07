<?php
include "functions.php";
global $list_articles;
$basket_list = array();
$message_error_price = "";
// Si le POST est vide message erreur
if (isset($_POST['basket'])){
    $basket_list =$_POST['basket'];
}else if(isset($_POST['basket_list'])){
    $basket_list =$_POST['basket_list'];
}else{
    $message_error_price = "le panier est vide";
}

// Pour supprimer les articles
foreach ($basket_list as $index => $item){
    if (isset($_POST['delete'.$index])){
        unset($basket_list[$index]);
        if (!$basket_list){
            $message_error_price = "le panier est vide";
        }
    }
}

// Garde les quantités en mémoire
foreach ($basket_list as $index => $item){
    if (!isset($_POST["quantity"])){
        $quantity[$index] = 1;
    }else{
        $quantity[$index] = $_POST["quantity"][$index];
    }
}

// Calcule du prix
$total_price = 0;
function calculBasket($nbr, $price){
    return $nbr * $price;
}

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
            if ($quantity[$index] <= 0){
                $message_error_price = "Quantité inextact";
            }
            displayItemBasket($list_articles[$item]['name'], $list_articles[$item]['price'], $list_articles[$item]['picture'], $list_articles[$item]['desc'], $index, $quantity[$index], $message_error_price);
            $total_price = $total_price + calculBasket($quantity[$index], $list_articles[$item]['price']);
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
