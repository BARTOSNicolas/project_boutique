<?php
//Inclusion Classe Article et connection BDD
require "database/database.php";
//require "class/Article.php";
require "class/Legendary.php";

class Catalogue
{
    //----------ATTRIBUTS----------
    private $_list_article = array();

    //----------CONSTRUCTEUR----------
    public function __construct(){
        $bdd = connectBDD();
        $req = $bdd->prepare('SELECT p.id, p.name, p.description, p.price, p.quantity, p.picture, p.weight, p.available, p.categorie_id, q.quality 
                              FROM products p LEFT JOIN quality q ON p.id = q.article_id');
        $req->execute();
        while($data = $req->fetch()){
            if (!$data['quality']){
                $article = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
                $this->_list_article[$data['id']] = $article;
            }else if ($data['quality']) {
                $legend = new Legendary($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id'], $data['quality']);
                $this->_list_article[$data['id']] = $legend;
            }
        }
        $req->closeCursor();
        ksort($this->_list_article);
    }

    //----------GETTER----------
    public function getListArticle()
    {
        return $this->_list_article;
    }

}
// requete pour tous = ('SELECT * FROM products')
// requete pour les SIZE = ('SELECT * FROM products p INNER JOIN size s ON p.id = s.product_id ')
// requete pour afficher quality = ('SELECT * FROM products p INNER JOIN quality q ON p.id = q.article_id ')
// requete pour tous sauf article speciaux = ('SELECT * FROM products p LEFT JOIN size s ON p.id = s.product_id LEFT JOIN quality q ON p.id = q.article_id WHERE s.id IS NULL AND q.id IS NULL')