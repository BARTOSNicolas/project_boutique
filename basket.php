<?php
//Démarrer le system de SESSION
session_start();

include "functions.php";
include "database.php";

//Variables
$basket_list = array();
$quantity_list = array();
$message_error_price = "";
$empty = false;
$shipping_weight = 0;
$shipping_price = 0;

// SI le POST est vide message erreur
if (isset($_POST['basket'])){
    $basket_list = $_POST['basket'];
//SI method POST charge POST
}else if(isset($_POST['basket_list'])){
    $basket_list = $_POST['basket_list'];
//SI SESSION charge la SESSION
}else if(isset($_SESSION['basket'])){
    $basket_list = $_SESSION['basket'];
    //SI session vide erreur
    if(empty($basket_list)){
        $message_error_price = "le panier est vide";
    }
// SINON ERREUR liste vide
}else{
    $message_error_price = "le panier est vide";
}

// Pour supprimer les articles
foreach ($basket_list as $index => $item){
    if (isset($_POST['delete'.$item])){ //Executer seulement sur les btn 'supprimer'
        unset($basket_list[$index]);
        unset($quantity_list[$index]);
        //SI la liste est vide ERREUR
        if (!$basket_list){
            $message_error_price = "le panier est vide";
        }
    }
}

// Garde les quantités en mémoire
// SI c'est un nouveau POST quantité = 1
if (isset($_POST['basket'])){
    foreach ($basket_list as $index => $item){
        $quantity_list[$index] = 1;
    }
// SINON
}else {
    foreach ($basket_list as $index => $item) {
        //Rechargement page method POST
        if (isset($_POST["quantity"])) {
            $quantity_list[$index] = $_POST["quantity"][$index];
        //Changement de page Session
        } else if (isset($_SESSION['quantity'])) {
            if (isset($_SESSION["quantity"][$index])) {
                $quantity_list[$index] = $_SESSION["quantity"][$index];
            // SI pas en SESSION quantité = 1
            } else if (empty($quantity_list[$index])) {
                $quantity_list[$index] = 1;
            }
        // SI pas de POST ni SESSION quantité = 1
        } else {
            $quantity_list[$index] = 1;

        }
    }
}

// Fonction pour le calcule du prix
$total_price = 0;
function calculBasket($nbr, $price){
    return $nbr * $price;
}
//Fonction pour vider le panier
function emptyBasket(){
    global $basket_list;
    global $quantity_list;
    $basket_list = array();
    $quantity_list = array();
}
//Fonction pour le calcule des frais de port
function calculShipping($nbr, $weight){
    return $nbr * $weight;
}
// On Verifie si le panier doit être vider
if(isset($_GET["empty"]) && $_GET["empty"]){
    emptyBasket();
    $message_error_price = "le panier est vide";
}
//BDD
function show_basket($list){
    global $total_price, $shipping_weight, $quantity_list, $message_error_price;
    $bdd = connectBDD();
    foreach ($list as $index => $item){
        if ($quantity_list[$index] <= 0){
            $message_error_price = "Quantité inextact";
        }
        $req = $bdd->prepare('SELECT * FROM products WHERE id = '.$item.' ');
        $req->execute();
        $data = $req->fetch();
        displayItemBasket($data['name'], $data['price'], $data['picture'], $data['description'], $data['id'], $quantity_list[$index], $message_error_price, $data['weight']);
        $req->closeCursor();
        $total_price = $total_price + calculBasket($quantity_list[$index], $data['price']); //Calcul prix total
        $shipping_weight = $shipping_weight + calculShipping($quantity_list[$index], $data['weight']); //Calcul poids total
        echo '<input type="hidden" value="'.$item.'" name="basket_list[]">';
    }

}
// On charge les variables de SESSION
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
<?php include "header.php" ?>
<div class="container">
    <form action="basket.php" method="post">
    <?php
        show_basket($basket_list, $quantity_list, $message_error_price);
        //Condition des frais de port via le poids calculé
        if($shipping_weight < 1000){
            $shipping_price = 5;
        }elseif ($shipping_weight >= 1000 && $shipping_weight < 5000 ){
            $shipping_price = $total_price / 100 * 10;
        }elseif ($shipping_weight >= 5000){
            $shipping_price = 0;
        }
    ?>
        <div class="d-flex justify-content-end mt-5">
            <label for="calcul" class="mr-5">Poid total : <?php echo ($message_error_price ? "0" : $shipping_weight) ?> gr</label>
            <input type="text" class="text-primary" id="calcul" disabled value="<?php echo ($message_error_price ? "Envoi impossible" : $shipping_price."€") ?>">
        </div>
        <div class="d-flex justify-content-end mt-1">
            <input type="submit" name="calcul" class="btn btn-success mr-5" value="Calculer le panier">
            <input type="text" class="<?php echo ($message_error_price ? "text-danger" : "text-success")?>" id="calcul" disabled value="<?php echo ($message_error_price ? $message_error_price : ($total_price + $shipping_price)."€") ?>">

        </div>
        <a type="button" href="catalogue.php" class="btn btn-primary float-right " style="margin: 50px 0 100px 0">Retour</a>

    </form>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
