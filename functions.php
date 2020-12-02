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
function displayItem($name, $price, $picture){
    echo $name;
    echo $price;
    echo $picture;
}