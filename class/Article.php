<?php


class Article
{
    //----------ATTRIBUTS----------
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $image;
    private $weight;
    private $available;
    private $categorie;

    //----------CONSTRUCTEUR----------
    public function __construct($id, $name, $desciption, $price, $quantity, $image, $weight, $available, $categorie){
        $this->id = $id;
        $this->name = $name;
        $this->description = $desciption;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->weight = $weight;
        $this->available = $available;
        $this->categorie = $categorie;
    }

    //----------METHODES----------
    //----------GETTER----------
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    //----------SETTER----------
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    public function setAvailable($available): void
    {
        $this->available = $available;
    }

    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
    }

}