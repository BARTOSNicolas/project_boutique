<?php
//Inclusion Connection à la BDD
require "database/database.php";

class Panier
{
    private $_list_panier = array();
    private $_quantity_list = array();
    private $_total_price = 0;
    private $_total_weight = 0;

    public function __construct(Array $array_id, Array $array_quantity){
        foreach($array_quantity as $quantity){
            array_push($this->_quantity_list, $quantity);
        }
        foreach($array_id as $index => $item){
            $bdd = connectBDD();
            $req = $bdd->prepare('SELECT * FROM products WHERE id='.$item);
            $req->execute();
            $data = $req->fetch();
            $article_panier = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
            array_push($this->_list_panier, $article_panier);
            $req->closeCursor();
            $this->_total_price = $this->_total_price + $article_panier->getPrice()*$array_quantity[$index];
            $this->_total_weight = $this->_total_weight + $article_panier->getWeight()*$array_quantity[$index];
        }
    }

    public function getListPanier()
    {
        return $this->_list_panier;
    }

    public function getQuantityList()
    {
        return $this->_quantity_list;
    }

    public function getTotalPrice()
    {
        return $this->_total_price;
    }

    public function getTotalWeight()
    {
        return $this->_total_weight;
    }

    public function displayPanier($error){
        foreach ($this->_list_panier as $index => $article){
            $article->displayArticlePanier($index, $this->_quantity_list[$index], $error);
        }
    }
}