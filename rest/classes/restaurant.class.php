<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 30/04/14
 * Time: 14:22
 * To change this template use File | Settings | File Templates.
 */
include_once("db.class.php");

class Restaurant {

    private $Restid;
    private $Restname;
    private $Restadres;
    private $Restgem;
    private $Restspec;
    private $Restsite;
    private $Restnr;
    private $Restmail;
    private $Restfb;
    private $Restma;
    private $Restdi;
    private $Restwo;
    private $Restdo;
    private $Restvr;
    private $Restza;
    private $Restzo;
    private $Restownerid;


    public function getById($id)
    {

        $db = new db;
        $query = 'SELECT * FROM restaurant WHERE id = '.$id;
        return $db->conn->query($query)->fetch_array();

    }

    public function getByOwnerId($ownerId)
    {

        $db = new db;
        $query = 'SELECT * FROM restaurant WHERE restaurantownerid = '.$ownerId.' AND showres = 1;';
        return $db->conn->query($query);

    }


    public function setRestadres($Restadres)
    {

        $this->Restadres = $Restadres;

    }

    public function getRestadres()
    {

        return $this->Restadres;

    }

    public function setRestdi($Restdi)
    {

        $this->Restdi = $Restdi;

    }

    public function getRestdi()
    {

        return $this->Restdi;

    }

    public function setRestdo($Restdo)
    {

        $this->Restdo = $Restdo;

    }

    public function getRestdo()
    {

        return $this->Restdo;

    }

    public function setRestfb($Restfb)
    {

        $this->Restfb = $Restfb;

    }

    public function getRestfb()
    {

        return $this->Restfb;

    }

    public function setRestgem($Restgem)
    {

        $this->Restgem = $Restgem;

    }

    public function getRestgem()
    {

        return $this->Restgem;

    }

    public function setRestid($Restid)
    {

        $this->Restid = $Restid;

    }

    public function getRestid()
    {

        return $this->Restid;

    }

    public function setRestma($Restma)
    {

        $this->Restma = $Restma;

    }

    public function getRestma()
    {

        return $this->Restma;

    }

    public function setRestmail($Restmail)
    {

        $this->Restmail = $Restmail;

    }

    public function getRestmail()
    {

        return $this->Restmail;

    }

    public function setRestname($Restname)
    {

        $this->Restname = $Restname;

    }

    public function getRestname()
    {

        return $this->Restname;

    }

    public function setRestnr($Restnr)
    {

        $this->Restnr = $Restnr;

    }

    public function getRestnr()
    {

        return $this->Restnr;

    }

    public function setRestownerid($Restownerid)
    {

        $this->Restownerid = $Restownerid;

    }

    public function getRestownerid()
    {

        return $this->Restownerid;

    }

    public function setRestsite($Restsite)
    {

        $this->Restsite = $Restsite;

    }

    public function getRestsite()
    {

        return $this->Restsite;

    }

    public function setRestspec($Restspec)
    {

        $this->Restspec = $Restspec;

    }

    public function getRestspec()
    {

        return $this->Restspec;

    }

    public function setRestvr($Restvr)
    {

        $this->Restvr = $Restvr;

    }

    public function getRestvr()
    {

        return $this->Restvr;

    }

    public function setRestwo($Restwo)
    {

        $this->Restwo = $Restwo;

    }

    public function getRestwo()
    {

        return $this->Restwo;

    }

    public function setRestza($Restza)
    {

        $this->Restza = $Restza;

    }

    public function getRestza()
    {

        return $this->Restza;

    }

    public function setRestzo($Restzo)
    {

        $this->Restzo = $Restzo;

    }

    public function getRestzo()
    {

        return $this->Restzo;

    }

    public function Save()
    {

        if (empty($this->Restid))
        {

            $db = new db();
            $sql = "insert into restaurant (naam,adres,gemeente,specialiteit,website,facebook,mail,telnr,
				    maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag,restaurantownerid) values(
					'".$this->Restname."',
					'".$this->Restadres."',
					'".$this->Restgem."',
					'".$this->Restspec."',
					'".$this->Restsite."',
					'".$this->Restfb."',
 					'".$this->Restmail."',
					'".$this->Restnr."',
					'".$this->Restma."',
					'".$this->Restdi."',
					'".$this->Restwo."',
					'".$this->Restdo."',
					'".$this->Restvr."',
					'".$this->Restza."',
					'".$this->Restzo."',
					".$this->Restownerid."
					);";


            $db->conn->query($sql);
            $id = $db->conn->insert_id;
            $this->Restid = $id;
        }
        else
        {

            $this->Update();

        }
    }

    public function Update()
    {

        $db = new db();

        $query = 'SELECT restaurantownerid FROM restaurant WHERE id = '.$this->Restid;
        $row = $db->conn->query($query)->fetch_array();

        if ($row['restaurantownerid'] != $_SESSION['login']['id'])
        {

            echo 'Goed geprobeerd, hehe :)';
            exit;

        }

        $sql = "UPDATE restaurant SET
					naam = '".$this->Restname."',
					adres = '".$this->Restadres."',
					gemeente = '".$this->Restgem."',
					specialiteit = '".$this->Restspec."',
					website = '".$this->Restsite."',
					facebook = '".$this->Restfb."',
					mail = '".$this->Restmail."',
					telnr = '".$this->Restnr."',
					maandag = '".$this->Restma."',
					dinsdag = '".$this->Restdi."',
					woensdag = '".$this->Restwo."',
					donderdag = '".$this->Restdo."',
					vrijdag = '".$this->Restvr."',
					zaterdag = '".$this->Restza."',
					zondag = '".$this->Restzo."'
					where id = " . $this->Restid . ";";

        $db->conn->query($sql);

    }



    public function delete()
    {

        $db = new db();
        $query = 'SELECT restaurantownerid FROM restaurant WHERE id = '.$this->Restid;


        $row = $db->conn->query($query)->fetch_array();
        if ($row['restaurantownerid'] != $_SESSION['login']['id'])
        {

            echo 'Goed geprobeerd, hehe :)';
            exit;

        }

        $sql = "UPDATE restaurant SET showres = 0 where id = " .$this->Restid . ";";
        $db->conn->query($sql);

    }



}