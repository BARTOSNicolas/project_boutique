<?php
require 'class/Article.php';

class Bottes extends Articles
{
    private $_size;

    public function __construct($id, $name, $description, $price, $quantity, $image, $weight, $available, $categorie, $size){
        parent::__construct($id, $name, $description, $price, $quantity, $image, $weight, $available, $categorie);

        $this->_size = $size;
    }

    public function getSize()
    {
        return $this->_size;
    }

}