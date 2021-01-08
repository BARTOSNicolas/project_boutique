<?php
include 'class/Article.php';

class Legendaire extends Article
{
    private $legendary;

    public function __construct($id, $name, $desciption, $price, $quantity, $image, $weight, $available, $categorie, $legendary){
        parent::__construct($id, $name, $desciption, $price, $quantity, $image, $weight, $available, $categorie);
        $this->legendary = $legendary;
    }

    public function getLegendary()
    {
        return $this->legendary;
    }
}