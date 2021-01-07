<?php
include "products.php";

//Fonction pour afficher les articles du catalogue
function displayItem($name, $price, $picture, $desc, $index){
    echo'<div class="card mb-3 d-flex align-content-center">
            <div class="row no-gutters">
                <a href="item.php?id='.$index.'" class="col-2" style="background-image: url(img/'.$picture.'); background-size : cover; background-position: center, center; height:180px">
                    <!--<img src="img/'.$picture.'" class="card-img-top" alt="Photo">-->
                </a>              
                <div class="card-body col-7 p-2">
                    <h5 class="card-title">'.$name.'</h5>
                    <p class="card-text">'.$desc.'</p>
                </div>
                <div class="col-1 w-50 d-flex align-items-center">
                    <a href="item.php?id='.$index.'" class="btn btn-primary w-100">'.$price.' €</a>
                </div>
                <div class="col-2 w-50 d-flex align-items-center justify-content-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="'.$index.'" id="check'.$index.'" name="basket[]">
                      <label class="form-check-label" for="check'.$index.'">
                        Ajouter
                      </label>
                    </div>
                </div>              
            </div>
        </div>
    ';
}
//Fonction pôur afficher 1 article
function displayItemSelf($name, $price, $picture, $desc, $id, $quantity, $weight){
    echo'<div class="card mb-3 d-flex flex-column align-content-center border-white">         
                <div class="col-6 offset-3">
                    <img src="img/'.$picture.'" class="card-img-top" alt="Photo">
                </div>              
                <div class="card-body col-6 offset-3">
                    <h5 class="card-title">'.$name.'</h5>
                    <p class="card-text">'.$desc.'</p>
                    <p>Quantité disponible : '.$quantity.'</p>
                    <p>Poids : '.$weight.' Gr</p>
                </div>

                    <div class="col-4 offset-4 w-50 d-flex">
                        <button class="btn btn-primary w-100">Prix : '.$price.' €</button>
                    </div>                                       
        </div>
    ';
}
//Fonction pour afficher les articles du panier
function displayItemBasket($name, $price, $picture, $desc, $index, $quantity, $error, $weight){
    echo '<div class="card mb-3 d-flex align-content-center">
            <div class="row no-gutters">
                <div class="col-2" style="background-image: url(img/'.$picture.'); background-size : cover; background-position: center, center; height:180px">
                    <!--<img src="img/' . $picture . '" class="card-img-top" alt="Photo">-->
                </div>              
                <div class="card-body col-7 p-2">
                    <h5 class="card-title">' . $name . '</h5>
                    <p class="card-text">' . $desc . '</p>
                </div>
                <div class="col-1 w-50 d-flex align-items-center">
                    <a href="item.php?itemName=' . $name . '&amp;itemPrice=' . $price . '&amp;itemPicture=' . $picture . '&amp;itemDesc=' . $desc . '" class="btn btn-primary w-100">' . $price . ' €</a>
                </div>   
                <div class="col-2 w-50 d-flex align-items-center justify-content-end flex-column p-4">
                    <div class="form-group">
                        <label for="quantity'.$index.'">Quantité :</label>
                        <input type="number" step="1" min="1" class="form-control" id="quantity'.$index.'" name="quantity[]" value="'.$quantity.'">
                        <span class="text-danger">'. $error .'</span>
                    </div>
                      <input type="submit" name="delete'.$index.'" class="btn btn-danger" value="Supprimer">
                </div>            
            </div>
        </div>
    ';
}
