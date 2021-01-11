<?php
session_start(); //Démarrer le system de SESSION
//Inclusion de la connection à la database
require "database/database.php";

//Variables d'erreur
$form_error = false;
$error_message_name = "";
$error_message_desc = "";
$error_message_picture = "";
$error_message_price = "";
$error_message_weight = "";
$error_message_quantity = "";

//SI le $_POST est vide rempli avec du vide
if (empty($_POST)){
    $_POST['itemName'] ='';
    $_POST['itemDesc'] = '';
    $_POST['itemPrice'] = '';
    $_FILES['itemFile']= '';
//SINON
}else{
    // Verifie et Implante le $_POST name
    if (empty($_POST['itemName'])){
        $form_error = true;
        $error_message_name = "Il faut obligatoirement entrer un nom.";
    }else{
        $add_name = htmlspecialchars($_POST['itemName']);
    }
    // Verifie et Implante le $_POST description
    if (empty($_POST['itemDesc'])){
        $form_error = true;
        $error_message_desc = "Il faut obligatoirement entrer une description.";
    }else{
        $add_desc = htmlspecialchars($_POST['itemDesc']);
    }
    // Verifie et Implante le $_POST price
    if (empty($_POST['itemPrice']) || $_POST['itemPrice'] <= 0){
        $form_error = true;
        $error_message_price = "Il faut obligatoirement entrer une valeur positive.";
    }else{
        $add_price = htmlspecialchars($_POST['itemPrice']);
    }
    // Verifie et Implante le $_POST weight
    if (empty($_POST['itemWeight']) || $_POST['itemWeight'] <= 0){
        $form_error = true;
        $error_message_weight = "Il faut obligatoirement entrer une valeur positive.";
    }else{
        $add_weight = htmlspecialchars($_POST['itemWeight']);
    }
    // Verifie et Implante le $_POST quantity
    if (empty($_POST['itemQuantity']) || $_POST['itemQuantity'] <= 0){
        $form_error = true;
        $error_message_quantity = "Il faut obligatoirement entrer une valeur positive.";
    }else{
        $add_quantity = htmlspecialchars($_POST['itemQuantity']);
    }
    // Test si le fichier IMAGE à bien été envoyé et si il n'y a pas d'erreur
    if(!empty($_FILES['itemFile']) AND $_FILES['itemFile']['error'] == 0){
        //Verifie que le fichier n'est pas trop gros
        if($_FILES['itemFile']['size'] <= 1000000){
            $infofichier = pathinfo($_FILES['itemFile']['name']);
            $extension_upload = $infofichier['extension'];
            $extension_autorisees = array("jpg", "jpeg", "gif", "png");
            //Verifie le format du fichier
            if (in_array($extension_upload, $extension_autorisees)){
                move_uploaded_file($_FILES['itemFile']['tmp_name'], "img/".basename($_FILES['itemFile']['name']));
                $add_picture = htmlspecialchars($_FILES['itemFile']['name']);
            }else{
                $form_error = true;
                $error_message_picture = "Cette extension n'est pas autorisée.";
            }
        }else{
            $form_error = true;
            $error_message_picture = "La taille de l'image est trop grande.";
        }
    }else{
        $form_error = true;
        $error_message_picture = "L'image est obligatoire pour valider le formulaire.";
    }
    // Si tout est OK Envoi à la base de donnée et envoi l'id à displayItem
    if(!$form_error){
        $add_available = $_POST['available'];
        $add_categorie = $_POST['categorie'];
        $bdd = connectBDD();
        $req = $bdd->prepare("INSERT INTO products (name, description, price, weight, quantity, available, picture, categorie_id)
                                    VALUES('".$add_name."', '".$add_desc."', '".$add_price."', '".$add_weight."', '".$add_quantity."', '".$add_available."', '".$add_picture."', '".$add_categorie."')");
        $req->execute();
        $req->closeCursor();
        $id_product = $bdd->lastInsertId();

        header("Location: displayItem.php?id=$id_product");
   }
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
    <title>Ajouter un objet</title>
</head>
<body>
<?php include "header.php"; ?>
<div class="container mb-5">
    <form method="post" action="addItem.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="itemName">Nom du produit</label>
            <input type="text" class="form-control" id="itemName" name="itemName" value="<?php echo $_POST['itemName'] ?>">
            <?php echo '<p class="text-danger">'.$error_message_name.'</p>'?>
        </div>
        <div class="form-group">
            <label for="itemDesc">Description du produit</label>
            <input type="text" class="form-control" id="itemDesc" name="itemDesc" value="<?php echo $_POST['itemDesc'] ?>">
            <?php echo '<p class="text-danger">'.$error_message_desc.'</p>'?>
        </div>
        <div class="row">
            <div class="form-group col-sm-5">
                <label for="itemPrice">Prix du produit</label>
                <div class="input-group">
                    <input type="number" step="1" class="form-control" id="itemPrice" name="itemPrice" value="<?php echo $_POST['itemPrice'] ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <?php echo '<p class="text-danger">'.$error_message_price.'</p>'?>
            </div>
            <div class="form-group col-sm-7">
                <label for="itemFile">Image du produit (poid max : 1Mo)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="itemFile" name="itemFile" aria-describedby="itemFileAddon">
                        <label class="custom-file-label" for="itemFile">Importer une image</label>
                    </div>
                </div>
                <?php echo '<p class="text-danger">'.$error_message_picture.'</p>'?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="itemWeight">poids du produit</label>
                <div class="input-group">
                    <input type="number" step="1" class="form-control" id="itemWeight" name="itemWeight" value="<?php echo $_POST['itemWeight'] ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">Gr</span>
                    </div>
                </div>
                <?php echo '<p class="text-danger">'.$error_message_weight.'</p>'?>
            </div>
            <div class="form-group col-sm-6">
                <label for="itemQuantity">Quantité du produit</label>
                <div class="input-group">
                    <input type="number" step="1" class="form-control" id="itemQuantity" name="itemQuantity" value="<?php echo $_POST['itemQuantity'] ?>">
                </div>
                <?php echo '<p class="text-danger">'.$error_message_quantity.'</p>'?>
            </div>
            <div class="form-group col-sm-6">
                <label for="itemCategorie">Catégorie du produit</label>
                <div class="input-group">
                    <select class="custom-select" name="itemCategorie" id="categorie">
                        <option value="1">Inutile</option>
                        <option value="2">Très inutile</option>
                        <option value="3">Absolument inutile</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="itemDispo">Disponibilité du produit</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" id="dispo" name="itemDispo" checked>
                    <label class="form-check-label" for="dispo">Disponible</label><br>
                    <input class="form-check-input" type="radio" value="0" id="dispo" name="itemDispo">
                    <label class="form-check-label" for="dispo">Pas Disponible</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5 float-right">Créer le produit</button>
        <button type="reset" class="btn btn-primary mt-5 float-right mr-3" style="margin-bottom: 100px">Reset</button>
    </form>
</div>
<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bs-custom-file-input.min.js"></script>
<script>
    // Du JS pour afficher le nom du fichier dans la zone de chargement
    $(document).ready(function () {
        bsCustomFileInput.init()
    })
</script>
</body>
</html>
