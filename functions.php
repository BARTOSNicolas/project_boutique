<?php
require_once "database/database.php";
//FONCTIONS POO ARTICLES
function displayArticle(Article $article){
    if(method_exists($article, 'getLegendary')){
        echo '<div class="card mb-4 d-flex align-content-center shadow-sm position-relative border-4 border-warning">';
    }else{
        echo '<div class="card mb-4 d-flex align-content-center shadow-sm position-relative border-0">';
    }
    // SI c'est n'est plus disponible
    if($article->getAvailable() == 0){
        echo'<div class="position-absolute bg-danger text-white text-center rounded shadow" style="top: 125px; left: -25px; z-index: 1; transform: rotate(-45deg); transform-origin: top left;">
                <p class="font-weight-bold m-0 pl-3 pr-3">Victime de son succès</p>
                </div>';
    }
    echo'<div class="row no-gutters">
                <a href="item.php?id='.$article->getId().'" class="col-sm-2" style="background-image: url(img/'.$article->getImage().'); background-size : cover; background-position: center, center; height:180px"></a>              
                <div class="card-body col-lg-7 col-sm-6 p-2">';
    if(method_exists($article, 'getLegendary')){
        echo '<h4 class="text-warning text-capitalize">'. $article->getLegendary() .'</h4>';
    }
                    echo'<h5 class="card-title">'.$article->getName().'</h5>
                    <p class="card-text">'.$article->getDescription().'</p>
                </div>
                <div class="col-lg-1 col-sm-2 w-50 d-flex align-items-center">
                    <a href="item.php?id='.$article->getId().'" class="btn btn-primary w-100">'.$article->getPrice().' €</a>
                </div>
                <div class="col-sm-2 w-50 d-flex align-items-center justify-content-center">';
    //Si disponible afficher un bouton ajouter
    if($article->getAvailable() == 1) {
        echo '<button type="submit" name="add" class="btn btn-success" value="'. $article->getId() .'">Ajouter</button>
                   ';
        //SINON Afficher plus disponible
    }else{
        echo '<p class="text-italic text-warning">Plus Disponible</p>';
    }
    echo'   </div>              
            </div>
        </div>
    ';
}

function displayArticlePanier(Article $article, $quantity, $error)
{
    echo '<div class="card mb-3 d-flex align-content-center shadow-sm border-0">
            <div class="row no-gutters">
                <div class="col-sm-2" style="background-image: url(img/' . $article->getImage() . '); background-size : cover; background-position: center, center; height:180px">
                </div>              
                <div class="card-body col-lg-7 col-sm-6 p-2">
                    <h5 class="card-title">' . $article->getName() . '</h5>
                    <p class="card-text">' . $article->getDescription() . '</p>
                </div>
                <div class="col-lg-1 col-sm-2 w-50 d-flex align-items-center">
                    <a href="item.php?id=' . $article->getId() .'" class="btn btn-primary w-100">' . $article->getPrice() . ' €</a>
                </div>   
                <div class="col-sm-2 w-50 d-flex align-items-center justify-content-end flex-column p-4">
                    <div class="form-group">
                        <label for="quantity' . $article->getId() . '">Quantité :</label>
                        <input type="number" step="1" min="1" max="'. $article->getQuantity() .'" class="form-control" id="quantity' . $article->getId() . '" name="basket_calcul['.$article->getId() .']" value="' . $quantity . '">
                        <span class="text-danger">' . $error . '</span>
                    </div>
                      <input type="submit" name="delete' . $article->getId()  . '" class="btn btn-danger" value="Supprimer">
                </div>          
            </div>
        </div>
    ';
}

function displayArticleSelf(Article $article){
    echo'<div class="card mb-4 d-flex align-content-center border-0 ">';
    // SI c'est n'est plus disponible

    echo'<div class="row no-gutters">
                <a href="item.php?id='.$article->getId().'" class="col-sm-6 offset-sm-3 position-relative" style="background-image: url(img/'.$article->getImage().'); background-size : cover; background-position: center, center; height:350px">';
    if($article->getAvailable() == 0){
        echo'<div class="position-absolute bg-danger text-white text-center rounded shadow" style="top: 125px; left: -25px; z-index: 1; transform: rotate(-45deg); transform-origin: top left;">
                <p class="font-weight-bold m-0 pl-3 pr-3">Victime de son succès</p>
                </div>';
    }
    echo'</a>              
                <div class="card-body col-sm-6 offset-sm-3 p-2">
                    <h5 class="card-title">'.$article->getName().'</h5>
                    <p class="card-text">'.$article->getDescription().'</p>
                </div>
                <div class=" col-sm-3 offset-sm-3 d-flex align-items-center">
                    <a href="item.php?id='.$article->getId().'" class="btn btn-primary w-100">'.$article->getPrice().' €</a>
                </div>
                <div class="col-sm-2 offset-sm-1 w-50 d-flex align-items-center justify-content-center">';
    //Si disponible afficher un bouton ajouter
    if($article->getAvailable() == 1) {
        echo '<button type="submit" name="add" class="btn btn-success w-100" value="'. $article->getId() .'">Ajouter</button>
                   ';
        //SINON Afficher plus disponible
    }else{
        echo '<p class="text-italic text-warning">Plus Disponible</p>';
    }
    echo'   </div>              
            </div>
        </div>
    ';
}


//FONCTION CATALOGUE
function displayCat(Catalogue $catalogue){
    foreach ($catalogue->getListArticle() as $article){
        displayArticle($article);
    }
}

//FUNCTION PANIER
function displayPanier(Panier $panier, $error){
    foreach ($panier->getBasketList() as $index => $quantity) {
        $bdd = connectBDD();
        $req = $bdd->prepare('SELECT * FROM products WHERE id=' . $index . ' ');
        $req->execute();
        $data = $req->fetch();
        $newArticle = new Article($data['id'], $data['name'], $data['description'], $data['price'], $data['quantity'], $data['picture'], $data['weight'], $data['available'], $data['categorie_id']);
        $req->closeCursor();
        displayArticlePanier($newArticle, $quantity, $error);
    }

}

//FUNCTION CLIENTS
function displayClient(Client $client){
    echo '
        <tr>
            <th scope="row">'.$client->getId().'</th>
            <td>'.$client->getFirstName().'</td>
            <td>'.$client->getLastName().'</td>
            <td>'.$client->getAdresse().'</td>
            <td>'.$client->getZipCode().'</td>
            <td>'.$client->getCity().'</td>
        </tr>
    ';
}

function displayAllClient(ClientList $clientList){
    foreach ($clientList->getListClient() as $client){
        displayClient($client);
    }
}