<?php
include "functions.php";

$new_name = htmlspecialchars($_GET['itemName']);
$new_desc = htmlspecialchars($_GET['itemDesc']);
$new_price = htmlspecialchars($_GET['itemPrice']);
$new_picture = htmlspecialchars($_GET['itemPicture']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Nouvelle Article</title>
</head>
<body>
<? include "header.php" ?>
<div class="container">
    <? displayItem($new_name, $new_price, $new_picture, $new_desc) ?>
    <a type="button" href="addItem.php" class="btn btn-primary mt-5">Annuler le produit</a>
    <a type="button" href="catalogue.php" class="btn btn-primary mt-5 float-right">Valider le produit</a>
</div>

<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
