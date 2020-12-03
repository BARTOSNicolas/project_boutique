<?php
$form_error = false;
$error_message_name = "";
$error_message_desc = "";
$error_message_picture = "";
$error_message_price = "";

//Verifie SI le $_POST est vide
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
        $get_name = htmlspecialchars($_POST['itemName']);
    }
    // Verifie et Implante le $_POST description
    if (empty($_POST['itemDesc'])){
        $form_error = true;
        $error_message_desc = "Il faut obligatoirement entrer une description.";
    }else{
        $get_desc = htmlspecialchars($_POST['itemDesc']);
    }
    // Verifie et Implante le $_POST price
    if (empty($_POST['itemPrice']) || $_POST['itemPrice'] <= 0){
        $form_error = true;
        $error_message_price = "Il faut obligatoirement entrer une valeur positive.";
    }else{
        $get_price = htmlspecialchars($_POST['itemPrice']);
    }
    // Test si le fichier IMAGE à bien été envoyer et si il n'y a pas d'erreur
    if(!empty($_FILES['itemFile']) AND $_FILES['itemFile']['error'] == 0){
        //Verifie que le fichier n'est pas trop gros
        if($_FILES['itemFile']['size'] <= 1000000){
            $infofichier = pathinfo($_FILES['itemFile']['name']);
            $extension_upload = $infofichier['extension'];
            $extension_autorisees = array("jpg", "jpeg", "gif", "png");
            //Verifie le format du fichier
            if (in_array($extension_upload, $extension_autorisees)){
                move_uploaded_file($_FILES['itemFile']['tmp_name'], "img/".basename($_FILES['itemFile']['name']));
                $get_picture = htmlspecialchars($_FILES['itemFile']['name']);
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
    // Si tout est OK Envoi en GET les info à displayItem
    if(!$form_error){
       header("Location: displayItem.php?itemName=".$get_name."&itemPrice=".$get_price."&itemPicture=".$get_picture."&itemDesc=".$get_desc."");
   }
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
    <title>Ajouter un objet</title>
</head>
<body>
<? include "header.php"; ?>
<div class="container">
    <form method="post" action="addItem.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="itemName">Nom du produit</label>
            <input type="text" class="form-control" id="itemName" name="itemName" value="<? echo $_POST['itemName'] ?>">
            <? echo '<p class="text-danger">'.$error_message_name.'</p>'?>
        </div>
        <div class="form-group">
            <label for="itemDesc">Description du produit</label>
            <input type="text" class="form-control" id="itemDesc" name="itemDesc" value="<? echo $_POST['itemDesc'] ?>">
            <? echo '<p class="text-danger">'.$error_message_desc.'</p>'?>
        </div>
        <div class="row">
            <div class="form-group col-5">
                <label for="itemPrice">Prix du produit</label>
                <div class="input-group">
                    <input type="number" step="1" class="form-control" id="itemPrice" name="itemPrice" value="<? echo $_POST['itemPrice'] ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <? echo '<p class="text-danger">'.$error_message_price.'</p>'?>
            </div>
            <div class="form-group col-7">
                <label for="itemFile">Image du produit (poid max : 1Mo)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="itemFile" name="itemFile" aria-describedby="itemFileAddon">
                        <label class="custom-file-label" for="itemFile">Importer une image</label>
                    </div>
                </div>
                <? echo '<p class="text-danger">'.$error_message_picture.'</p>'?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5 float-right">Créer le produit</button>
        <button type="reset" class="btn btn-primary mt-5 float-right mr-3">Reset</button>
    </form>
</div>
<? include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
    })
</script>
</body>
</html>
