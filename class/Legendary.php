<?php
require 'class/Article.php';

class Legendary extends Article
{
    private $_legendary;

    public function __construct($id, $name, $description, $price, $quantity, $image, $weight, $available, $categorie, $legendary){
        parent::__construct($id, $name, $description, $price, $quantity, $image, $weight, $available, $categorie);

        $this->_legendary = $legendary;
    }

    public function getLegendary()
    {
        return $this->_legendary;
    }
}