<?php


class Client
{
    private $id;
    private $first_name;
    private $last_name;
    private $adresse;
    private $zip_code;
    private $city;

    public function __construct($id, $first_name, $last_name, $adresse, $zip_code, $city){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->adresse = $adresse;
        $this->zip_code = $zip_code;
        $this->city = $city;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }

    public function setZipCode($zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    public function setCity($city): void
    {
        $this->city = $city;
    }

}