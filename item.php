<?php
include "functions.php";

//Variables
$item_name = htmlspecialchars($_GET['itemName']);
$item_price = htmlspecialchars($_GET['itemPrice']);
$item_picture = htmlspecialchars($_GET['itemPicture']);
$item_desc = htmlspecialchars($_GET['itemDesc']);


?>
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
    <? displayItemSelf($item_name, $item_price, $item_picture, $item_desc)?>
    <a type="button" href="catalogue.php" class="btn btn-primary mt-5 float-right">Retour</a>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
