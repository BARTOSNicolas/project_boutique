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
    public function displayArticle(){
        echo'<div class="card mb-4 d-flex align-content-center shadow-sm border-0 position-relative">';
        // SI c'est n'est plus disponible
        if($this->_available == 0){
            echo'<div class="position-absolute bg-danger text-white text-center rounded shadow" style="top: 125px; left: -25px; z-index: 1; transform: rotate(-45deg); transform-origin: top left;">
                <p class="font-weight-bold m-0 pl-3 pr-3">Victime de son succès</p>
                </div>';
        }
        echo'<div class="row no-gutters">
                <a href="item.php?id='.$this->_id.'" class="col-sm-2" style="background-image: url(img/'.$this->_image.'); background-size : cover; background-position: center, center; height:180px"></a>              
                <div class="card-body col-lg-7 col-sm-6 p-2">
                    <h5 class="card-title">'.$this->_name.'</h5>
                    <p class="card-text">'.$this->_description.'</p>
                </div>
                <div class="col-lg-1 col-sm-2 w-50 d-flex align-items-center">
                    <a href="item.php?id='.$this->_id.'" class="btn btn-primary w-100">'.$this->_price.' €</a>
                </div>
                <div class="col-sm-2 w-50 d-flex align-items-center justify-content-center">';
        //Si disponible afficher checkbox ajouter
        if($this->_available == 1) {
            echo '<div class="form-check">
                      <input class="form-check-input" type="checkbox" value="' . $this->_id . '" id="check' . $this->_id . '" name="basket[]">
                      <label class="form-check-label" for="check' . $this->_id . '">
                        Ajouter
                      </label>
                   </div>';
        //SINON Afficher plus disponible
        }else{
            echo '<p class="text-italic text-warning">Plus Disponible</p>';
        }
        echo'   </div>              
            </div>
        </div>
    ';
    }

    function displayArticlePanier($index, $quantity, $error)
    {
        echo '<div class="card mb-3 d-flex align-content-center shadow-sm border-0">
            <div class="row no-gutters">
                <div class="col-sm-2" style="background-image: url(img/' . $this->_image . '); background-size : cover; background-position: center, center; height:180px">
                </div>              
                <div class="card-body col-lg-7 col-sm-6 p-2">
                    <h5 class="card-title">' . $this->_name . '</h5>
                    <p class="card-text">' . $this->_description . '</p>
                </div>
                <div class="col-lg-1 col-sm-2 w-50 d-flex align-items-center">
                    <a href="item.php?id=' . $this->_id .'" class="btn btn-primary w-100">' . $this->_price . ' €</a>
                </div>   
                <div class="col-sm-2 w-50 d-flex align-items-center justify-content-end flex-column p-4">
                    <div class="form-group">
                        <label for="quantity' . $index . '">Quantité :</label>
                        <input type="number" step="1" min="1" max="'. $this->_quantity .'" class="form-control" id="quantity' . $index . '" name="quantity[]" value="' . $quantity . '">
                        <span class="text-danger">' . $error . '</span>
                    </div>
                      <input type="submit" name="delete' . $index . '" class="btn btn-danger" value="Supprimer">
                </div> 
                <input type="hidden" value="'.$this->_id.'" name="basket_list[]">           
            </div>
        </div>
    ';
    }
    function displayArticleSelf(){
        echo'<div class="card mb-3 d-flex flex-column align-content-center border-0">         
                <div class="col-md-6 offset-md-3">
                    <img src="img/'.$this->_image.'" class="card-img-top" alt="Photo">
                </div>              
                <div class="card-body col-md-6 offset-md-3">
                    <h5 class="card-title">'.$this->_name.'</h5>
                    <p class="card-text">'.$this->_description.'</p>
                    <p>Quantité disponible : '.$this->_quantity.'</p>
                    <p>Poids : '.$this->_weight.' Gr</p>
                </div>

                    <div class="col-sm-4 offset-sm-4 w-sm-50 d-flex">
                        <button class="btn btn-primary w-100">Prix : '.$this->_price.' €</button>
                    </div>                                       
        </div>
    ';
    }
}