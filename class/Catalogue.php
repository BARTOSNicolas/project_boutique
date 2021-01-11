<?php
//Inclusion Classe Article et connection BDD
require "database/database.php";
require "class/Article.php";

class Catalogue
{
    //----------ATTRIBUTS----------
    private $_list_article = array();


    //----------CONSTRUCTEUR----------
    public function __construct(){
        $bdd = connectBDD();
        $req = $bdd->prepare('SELECT * FROM products');
        $req->execute();
        while($data = $req->fetch()){
            $article = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
            array_push($this->_list_article, $article);
        }
        $req->closeCursor();
    }

    //----------GETTER----------
    public function getListArticle()
    {
        return $this->_list_article;
    }

}