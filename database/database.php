<?php
//Fonction pour se connecter à la base
function connectBDD(){
    $host = 'localhost';
    $base = 'my_base';
    $user = 'root';
    $password = 'root';
    //Test la connection à la base de données
    try
    {
    //Connection à la base de données avec un objet PDO
        $bdd = new PDO('mysql:host='.$host.';dbname='.$base, $user, $password);
    } //Renvoi une Erreur si un problème survient
    catch(Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }
    //Renvoi la connection
    return $bdd;
}
