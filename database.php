<?php

//Test la connection à la base de données
function connectBDD(){
    $host = 'localhost';
    $base = 'bdd_composer';
    $user = 'nicolas';
    $password = 'motdepass';
    try
    {
    //Connection à la base de données avec un objet PDO
        $bdd = new PDO('mysql:host='.$host.'; dbname='.$base.';charset=utf8', $user, $password);
    } //Renvoi une Erreur si un problème survient
    catch(Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }
    return $bdd;
}

function all_product(){
    $bdd = connectBDD();
    //Préparation de la requête de TEST
    $req = $bdd->prepare('SELECT * FROM products');

    //Exécution de la requête
    $req->execute(array());

    //Affichage des données
    echo '<h5>Tous les produits</H5>';
    while($data = $req->fetch()){
        echo $data['name'];
        echo '<br>';
    }
    //Clôture de la requête
    $req->closeCursor();
}
function product_out_of_stock(){
    $bdd = connectBDD();
    $req = $bdd->prepare('SELECT * FROM products WHERE available=0');
    $req->execute(array());
    echo '<h5>Produits en rupture de stock </H5>';
    while($data = $req->fetch()){
        echo $data['name'];
        echo '<br>';
    }
    $req->closeCursor();
}
function product_order_id($id){
    $bdd = connectBDD();
    $req = $bdd->prepare('
        SELECT p.name, o.quantity, p.price
        FROM products p
        INNER JOIN order_product o
        ON p.id = o.product_id
        WHERE o.order_id = '.$id.';
    ');
    $req->execute(array());
    echo '<h5>Produits de la commande '.$id.' </H5>';
    while($data = $req->fetch()){
        echo $data['name'].' | '.$data['quantity'].' | '.$data['price'];
        echo '<br>';
    }
    $req->closeCursor();
}
function number_order_by_client(){
    $bdd = connectBDD();
    $req = $bdd->prepare('
        SELECT c.first_name, c.last_name, COUNT(customer_id) AS total_commande
        FROM orders o
        RIGHT JOIN customers c
        ON o.customer_id = c.id
        GROUP BY c.first_name, c.last_name
    ');
    $req->execute(array());
    echo '<h5>Nombre de commandes par Client </H5>';
    while($data = $req->fetch()){
        echo $data['first_name'].' | '.$data['last_name'].' | '.$data['total_commande'];
        echo '<br>';
    }
    $req->closeCursor();
}

function add_stock_to_product($product_id, $add_stock){
    $bdd = connectBDD();
    $req = $bdd->prepare("UPDATE products SET quantity=quantity+".$add_stock." WHERE id=".$product_id." ");
    $req->execute(array())  or die(print_r($bdd->errorInfo()));
    $req->closeCursor();
    $req2 = $bdd->prepare("SELECT * FROM products WHERE id=".$product_id." ");
    $req2->execute(array()) or die(print_r($bdd->errorInfo()));

    while($data = $req2->fetch()){
        echo '<h5>Ajout de '.$add_stock.' unité(s) au produit '.$data['name'].' </H5>';
    }
    $req2->closeCursor();
}
function delete_product($product_id){
    $bdd = connectBDD();
    $req = $bdd->prepare("SELECT * FROM products WHERE id=".$product_id." ");
    $req->execute(array()) or die(print_r($bdd->errorInfo()));

    while($data = $req->fetch()){
        echo '<h5>Suppression du produit '.$data['name'].' </H5>';
    }
    $req->closeCursor();
    $req2 = $bdd->prepare('DELETE FROM products WHERE id='.$product_id.' ');
    $req2->execute(array());
    $req2->closeCursor();
}

//all_product();
//product_out_of_stock();
//product_order_id(1);
//number_order_by_client();
//add_stock_to_product(12, 100);
//delete_product(5);
?>