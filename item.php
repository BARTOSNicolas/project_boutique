<?php
include "functions.php";
include  "database.php";

//Variables
$id = $_GET['id'];

function show_single_product($product_id){
    $bdd = connectBDD();
    $req = $bdd->prepare('SELECT * FROM products WHERE id='.$product_id.' ');
    $req->execute(array());
    $article = $req->fetch();
    displayItemSelf($article['name'], $article['price'], $article['picture'], $article['description'], $article['id']);
    $req->closeCursor();
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
    <title>Article </title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <?php show_single_product($id); ?>
    <a type="button" href="catalogue.php" class="btn btn-primary mt-5 float-right">Retour</a>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
