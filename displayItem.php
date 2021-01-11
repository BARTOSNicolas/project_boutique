<?php
session_start(); //Démarrer le system de SESSION
//Inclusion des Classes
require "class/Article.php";
require "functions.php";
require "database/database.php";

//Variables
$id = $_GET['id'];
$message_delete = '';

//Fonction pour afficher un seul produit
function show_single_product($product_id){
   $bdd = connectBDD();
   $req = $bdd->prepare('SELECT * FROM products WHERE id='.$product_id.' ');
   $req->execute();
   $data = $req->fetch();
   $article = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
   displayArticle($article);
   $req->closeCursor();
}

//Fonction pour supprimer le produit de la base
function delete_product($product_id){
    global $message_delete;
    if(isset($_GET['id']) AND $_GET['id'] != 'NULL') {
        $bdd = connectBDD();
        $req = $bdd->prepare('DELETE FROM products WHERE id=' . $product_id . ' ');
        $req->execute();
        $message_delete = 'Le produit a été supprimer !!!';
    }else{
        $message_delete = 'Aucun produit à supprimer !!!';
    }
}
//Si Delete =  on appelle la function delete-product() et on passe l'id à Null
if (isset($_GET['delete'])){
    delete_product($id);
    $id = 'NULL';
}
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
    <title>Valider Article</title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <?php
    // SI $id n'est pas NULL afficher le produit
    if($id != 'NULL'){
        show_single_product($id);
    }
    ?>
    <form action="displayItem.php" method="get">
        <p class="text-danger text-center"><?php echo $message_delete ?></p>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="d-flex justify-content-center">
            <?php
            //SI $id n'est pas NULL on affiche le button Annuler
            if($id != 'NULL'){
                echo '<input type="submit" name="delete" class="btn btn-danger mt-5 mr-3 " value="Annuler le produit">';
            }
            ?>
            <!-- Ternaire si $id n'est pas NULL afficher Valider SINON Retour -->
            <a type="button" href="catalogue.php" class="btn btn-success mt-5"><?php echo ($id != 'NULL' ? 'Valider le produit' : 'Retour au catalogue') ?></a>
        </div>
    </form>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
