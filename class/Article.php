<?php

class Article
{
    //----------ATTRIBUTS----------
    private $_id;
    private $_name;
    private $_description;
    private $_price;
    private $_quantity;
    private $_image;
    private $_weight;
    private $_available;
    private $_categorie;

    //----------CONSTRUCTEUR----------
    public function __construct($id, $name, $description, $price, $quantity, $image, $weight, $available, $categorie){
        $this->_id = $id;
        $this->_name = $name;
        $this->_description = $description;
        $this->_price = $price;
        $this->_quantity = $quantity;
        $this->_image = $image;
        $this->_weight = $weight;
        $this->_available = $available;
        $this->_categorie = $categorie;
    }

    //----------GETTER----------
    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function getWeight()
    {
        return $this->_weight;
    }

    public function getAvailable()
    {
        return $this->_available;
    }

    public function getCategorie()
    {
        return $this->_categorie;
    }

    //----------SETTER----------

    //----------METHODES----------

}