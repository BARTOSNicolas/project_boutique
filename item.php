<?php
include "functions.php";

//Variables
$item_name = $item_1["name"];
$item_price = $item_1["price"];
$item_picture = $item_1["picture"];

//Affichage des Variables
echo "<p>".$item_name."</p>";
echo "<p>".$item_price."</p>";
echo "<p>".$item_picture."</p>";

//Afficher avec une function
displayItem1();