<?php
include "database.php";
include "class/Article.php";

class Catalogue
{
    //----------ATTRIBUTS----------
    private $list_article = array();


    //----------CONSTRUCTEUR----------
    public function __construct(){
        $bdd = connectBDD();
        $req = $bdd->prepare('SELECT * FROM products');
        $req->execute();
        while($data = $req->fetch()){
            $article = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
            array_push($this->list_article, $article);
        }
        $req->closeCursor();
    }

    //----------METHODES----------
    //----------GETTER----------
    public function getListArticle()
    {
        return $this->list_article;
    }
}