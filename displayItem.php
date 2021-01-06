<?php
include "functions.php";
include "database.php";
$id = $_GET['id'];

function show_single_product($product_id){
   $bdd = connectBDD();
   $req = $bdd->prepare('SELECT * FROM products WHERE id='.$product_id.' ');
   $req->execute(array());
   while($article = $req->fetch()){
       displayItemSelf($article['name'], $article['price'], $article['picture'], $article['description'], $article['id']);
   }
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
    <title>Nouvelle Article</title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <p class="text_danger"><?php echo $message_delete?></p>
    <div class="d-flex justify-content-center">
        <!-- <a type="button" href="addItem.php" class="btn btn-danger mt-5 mr-3 ">Annuler le produit</a> -->
        <a type="button" href="catalogue.php" class="btn btn-success mt-5">Valider le produit</a>
    </div>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
