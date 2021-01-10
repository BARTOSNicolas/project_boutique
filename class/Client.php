<?php

class Client
{
    private $_id;
    private $_first_name;
    private $_last_name;
    private $_adresse;
    private $_zip_code;
    private $_city;

    public function __construct($id, $first_name, $last_name, $adresse, $zip_code, $city){
        $this->_id = $id;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_adresse = $adresse;
        $this->_zip_code = $zip_code;
        $this->_city = $city;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getFirstName()
    {
        return $this->_first_name;
    }

    public function getLastName()
    {
        return $this->_last_name;
    }

    public function getAdresse()
    {
        return $this->_adresse;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function getZipCode()
    {
        return $this->_zip_code;
    }

    public function displayClient(){
        echo '
        <tr>
            <th scope="row">'.$this->_id.'</th>
            <td>'.$this->_first_name.'</td>
            <td>'.$this->_last_name.'</td>
            <td>'.$this->_adresse.'</td>
            <td>'.$this->_zip_code.'</td>
            <td>'.$this->_city.'</td>
        </tr>
    ';
    }
}