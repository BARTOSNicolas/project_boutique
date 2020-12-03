<?php
//Inclusion du fichier article PHP
include "functions.php";
global $item_1;
global $item_2;
global $item_3;

//Array commune pour les 3 articles
global $list_articles;

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
<? include "header.php" ?>
<div class="container">
<?
foreach ($list_articles as $article){
    displayItem($article["name"], $article["price"], $article["picture"], $article["desc"]);
}
?>
    <a type="button" href="addItem.php" class="btn btn-primary float-right mt-5">Add New Item</a>
</div>



<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
