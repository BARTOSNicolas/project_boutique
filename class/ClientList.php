<?php
include "database.php";
include "class/Client.php";

class ClientList
{
    private $list_client = array();

    public function __construct(){
        $bdd = connectBDD();
        $req = $bdd->prepare('SELECT * FROM customers');
        $req->execute();
        while($data = $req->fetch()){
            $client = new Client($data['id'], $data['first_name'], $data['last_name'], $data['adresse'], $data['zip_code'], $data['city']);
            array_push($this->list_client, $client);
        }
        $req->closeCursor();
    }

    public function getListClient()
    {
        return $this->list_client;
    }
}