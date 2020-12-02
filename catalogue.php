<?php
//Inclusion du fichier article PHP
include "functions.php";


//Array commune pour les 3 articles
$list_articles = array($item_1, $item_2, $item_3);
//Boucle forEach pour parcourir les 3 articles
foreach ($list_articles as $article){
    //print_r($article);
    echo $article["name"];
    echo $article["price"];
    echo $article["picture"];
    echo "<br>";
}
//Affichage des 3 items avec une fonction avec paramètre
foreach ($list_articles as $article){
    displayItem($article["name"], $article["price"], $article["picture"]);
    echo "<br>";
}

