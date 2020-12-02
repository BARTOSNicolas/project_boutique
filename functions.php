<?php
include "products.php";

//Fonction pour afficher item1
function displayItem1(){
    global $item_1;
    echo $item_1["name"];
    echo $item_1["price"];
    echo $item_1["picture"];
}
//Fonction pour afficher item1
function displayItem2(){
    global $item_2;
    echo $item_2["name"];
    echo $item_2["price"];
    echo $item_2["picture"];
}
//Fonction pour afficher item1
function displayItem3(){
    global $item_3;
    echo $item_3["name"];
    echo $item_3["price"];
    echo $item_3["picture"];
}
//Fonction pour afficher item
function displayItem($name, $price, $picture, $desc){
    echo'<div class="card mb-3 d-flex .flex-column align-content-center">
            <div class="row no-gutters">
                <div class="col-2">
                    <img src="img/'.$picture.'" class="card-img-top" alt="Photo">
                </div>              
                <div class="card-body col-8 p-2">
                    <h5 class="card-title">'.$name.'</h5>
                    <p class="card-text">'.$desc.'</p>
                </div>
                <div class="col-2 w-50 d-flex align-items-center">
                    <a href="item.php" class="btn btn-primary w-100">'.$price.' €</a>
                </div>              
            </div>
        </div>
    ';
}
