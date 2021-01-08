<?php
session_start();
//Inclusion du fichier article PHP
include "functions.php";
include "class/Catalogue.php";

//Initialisation du Catalogue
$catalogue = new Catalogue();


$error_basket_empty = "";
if (isset($_GET['error']) && $_GET['error']){
    $error_basket_empty = "Vous n'avez pas sélectionner de produits";
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
    <title>Page Catalogue</title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <div class="d-flex justify-content-end">
        <a type="button" href="addItem.php" class="btn btn-primary mb-5">Add New Item</a>
    </div>
    <form action="basket.php" method="post">
<?php
//displayCat($catalogue->getListArticle());
displayCat($catalogue->getListArticle());
?>
        <div class="d-flex justify-content-end align-items-start">
            <p class="text-danger mr-4 pt-1"><? echo $error_basket_empty ?></p>
            <input type="submit" class="btn btn-primary" style="margin-bottom: 150px" value="Ajouter au panier">
        </div>
    </form>
</div>


<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>