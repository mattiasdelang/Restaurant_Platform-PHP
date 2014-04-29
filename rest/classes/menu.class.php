<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 29/04/14
 * Time: 23:23
 * To change this template use File | Settings | File Templates.
 */
include_once "db.class.php";

class Menu {

    private $id;
    private $naam;
    private $omschrijving;
    private $type;
    private $prijs;
    private $restaurantid;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNaam($naam)
    {
        $this->naam = $naam;
    }

    public function getNaam()
    {
        return $this->naam;
    }

    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;
    }

    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;
    }

    public function getPrijs()
    {
        return $this->prijs;
    }

    public function setRestaurantid($restaurantid)
    {
        $this->restaurantid = $restaurantid;
    }

    public function getRestaurantid()
    {
        return $this->restaurantid;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function save()
    {

        if(empty($this->id))
        {

            $db = new db();
            $query = "INSERT INTO menu (naam, omschrijving, type, prijs, restaurantid) values ('$this->naam','$this->omschrijving','$this->type',$this->prijs,$this->restaurantid)";

            $db->conn->query($query);
            $this->id = $db->conn->insert_id;

        }
        else
        {

            $this->update();

        }

    }

    private function update()
    {

        $db = new db();
        $query = "UPDATE menu set naam = '$this->naam',omschrijving = '$this->omschrijving',type = '$this->type',prijs = $this->prijs,restaurantid = $this->restaurantid WHERE id = $this->id;";
        $db->conn->query($query);

    }

    public function delete($id)
    {

        $db = new db();
        $query = "UPDATE menu set showmenu = 0 WHERE id = $id;";
        $db->conn->query($query);

    }

    public function getById($id)
    {

        $db = new db();
        return $db->conn->query("SELECT * FROM menu WHERE showmenu = 1 AND id = $id")->fetch_array();

    }

    public function getByRestaurantId($restaurantid)
    {

        $db = new db();
        return $db->conn->query("SELECT * FROM menu WHERE showmenu = 1 AND restaurantid = $restaurantid");

    }
}