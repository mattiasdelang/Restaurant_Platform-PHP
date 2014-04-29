<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 29/04/14
 * Time: 20:29
 * To change this template use File | Settings | File Templates.
 */

include_once "db.class.php";

class Tafel {

    private $id;
    private $tafelnummer;
    private $aantalPlaatsen;
    private $restaurantId;
    private $ownerId;

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Gaat tafel-gegevens ophalen uit de databank
     *
     * @param int $id
     */
    public function getById($id)
    {
        $db = new db();
        return $db->conn->query('SELECT * FROM tafel WHERE tafelshow = 1 AND id = '.$id)->fetch_array();
    }

    public function getByRestaurantId($id)
    {
        $db = new db();
        $query = 'SELECT * FROM tafel WHERE tafelshow = 1 AND restaurantid = '.$id;
        return $db->conn->query($query);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAantalPlaatsen($aantalPlaatsen)
    {
        $this->aantalPlaatsen = $aantalPlaatsen;
    }

    public function getAantalPlaatsen()
    {
        return $this->aantalPlaatsen;
    }

    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    public function setTafelnummer($tafelnummer)
    {
        $this->tafelnummer = $tafelnummer;
    }

    public function getTafelnummer()
    {
        return $this->tafelnummer;
    }

    /**
     * Gaat de gegevens opslaan in de databank
     *
     * @return void;
     */
    public function save()
    {
        if (empty($this->id)) {
            // nieuwe record maken
            $db = new db;
            $query = 'INSERT INTO tafel (tafelnummer,plaatsen,restaurantid,ownerid) values('.$this->tafelnummer.','.$this->aantalPlaatsen.','.$this->restaurantId.','.$this->ownerId.')';
            $db->conn->query($query);
            $id = $db->conn->insert_id;
            $this->id = $id;
        } else {
            // bestaand record updaten
            $this->update();
        }
    }

    private function update()
    {
        $db = new db;
        $query = 'UPDATE tafel
            SET tafelnummer = '.$this->tafelnummer.',
                plaatsen = '.$this->aantalPlaatsen.',
                plaatsen = '.$this->restaurantId.',
                plaatsen = '.$this->ownerId.'
            WHERE id = '.$this->id;
        $db->conn->query($query);
    }

    public function delete($id)
    {
        $db = new db;
        $query = 'UPDATE tafel
            SET tafelshow = 0
         WHERE id = '.$id;
        $db->conn->query($query);
    }
}