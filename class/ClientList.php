<?php
//Inclusion Classe Client et connection BDD
require "database/database.php";
require "class/Client.php";

class ClientList
{
    private $_list_client = array();

    public function __construct(){
        $bdd = connectBDD();
        $req = $bdd->prepare('SELECT * FROM customers');
        $req->execute();
        while($data = $req->fetch()){
            $client = new Client($data['id'], $data['first_name'], $data['last_name'], $data['adresse'], $data['zip_code'], $data['city']);
            array_push($this->_list_client, $client);
        }
        $req->closeCursor();
    }

    public function getListClient()
    {
        return $this->_list_client;
    }

    public function displayAllClient(){
        foreach ($this->_list_client as $client){
            $client->displayClient();
        }
    }
}