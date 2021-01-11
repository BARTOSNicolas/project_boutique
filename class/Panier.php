<?php
//Inclusion Connection à la BDD
require_once "database/database.php";

class Panier
{
    private $_basket_list = array();
    private $_total_price;
    private $_total_weight;

    //Methode privée pour calculer le poids et prix
    private function calculTotal(){
        $price = 0;
        $weight = 0;
        foreach ($this->_basket_list as $index => $quantity){
            $bdd = connectBDD();
            $req = $bdd->prepare('SELECT * FROM products WHERE id=' . $index . ' ');
            $req->execute();
            $data = $req->fetch();
            $price =  $price + $data['price']*$quantity;
            $weight =  $weight + $data['weight']*$quantity;
            $req->closeCursor();
        }
        $this->_total_price = $price;
        $this->_total_weight = $weight;
    }

    public function getBasketList()
    {
        $this->calculTotal();
        return $this->_basket_list;
    }

    public function getTotalPrice()
    {
        $this->calculTotal();
        return $this->_total_price;
    }

    public function getTotalWeight()
    {
        return $this->_total_weight;
    }
    //Methode pour ajouter un produit ou la quantité
    public function addPanier($id){
        if(array_key_exists($id, $this->_basket_list)){
            $this->_basket_list[$id] = $this->_basket_list[$id] +1;
        }else{
            $this->_basket_list[$id] = 1;
        }
    }
    //Methode pour mettre à jour un produit
    public function updatePanier($id, $quantity){
        if(array_key_exists($id, $this->_basket_list)){
            $this->_basket_list[$id] = $quantity;
        }
    }
    //Methode pour supprimer un produit
    public function deletePanier($id){
        if(array_key_exists($id, $this->_basket_list)){
            unset($this->_basket_list[$id]);
        }
    }
    //Methode pour calculer le nombre de produits dans le panier
    public function getPanierNumber(){
        $total_article = 0;
        foreach($this->_basket_list as $index => $quantity){
            $total_article = $total_article + 1 * $quantity;
        }
        return $total_article;
    }


}