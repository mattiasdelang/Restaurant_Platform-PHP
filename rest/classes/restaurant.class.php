<?php
include_once("db.class.php");

class Restaurant
{

	private $m_sRestid;
	private $m_sRestname;
	private $m_sRestadres;
	private $m_sRestgem;
	private $m_sRestspec;
	private $m_sRestsite;
	private $m_sRestnr;
	private $m_sRestmail;
	private $m_sRestfb;
	private $m_sRestma;
	private $m_sRestdi;
	private $m_sRestwo;
	private $m_sRestdo;
	private $m_sRestvr;
	private $m_sRestza;
	private $m_sRestzo;
	private $m_sRestownerid;

    /**
     * Gaat de restaurant-gegevens ophalen uit de databank
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $db = new db;
        $query = 'SELECT * FROM restaurant WHERE id = '.$id;
        return $db->conn->query($query)->fetch_array();
    }

    public function getByOwnerId($ownerId)
    {
        $db = new db;
        $query = 'SELECT * FROM restaurant WHERE restaurantownerid = '.$ownerId;
        return $db->conn->query($query);
    }


	public function __set($p_sProperty, $p_vValue)
			{
				switch($p_sProperty)
					{	
					
						case "Restid":
							$this->m_sRestid = $p_vValue;						
						break;
						
						case "Restname":
							$this->m_sRestname = $p_vValue;						
						break;
						
						case "Restadres":
							$this->m_sRestadres = $p_vValue;						
						break;
						
						case "Restgem":
							$this->m_sRestgem = $p_vValue;						
						break;
						
						case "Restspec":
							$this->m_sRestspec = $p_vValue;						
						break;
						
						case "Restsite":
							$this->m_sRestsite = $p_vValue;						
						break;
						
						case "Restmail":
							$this->m_sRestmail = $p_vValue;						
						break;
						
						case "Restnr":
							$this->m_sRestnr = $p_vValue;						
						break;
						
						case "Restfb":
							$this->m_sRestfb = $p_vValue;						
						break;
						
						case "Restma":
							$this->m_sRestma = $p_vValue;						
						break;
						
						case "Restdi":
							$this->m_sRestdi = $p_vValue;						
						break;
						
						case "Restwo":
							$this->m_sRestwo = $p_vValue;						
						break;
						
						case "Restdo":
							$this->m_sRestdo = $p_vValue;						
						break;
						
						case "Restvr":
							$this->m_sRestvr = $p_vValue;						
						break;
						
						case "Restza":
							$this->m_sRestza = $p_vValue;						
						break;
						
						case "Restzo":
							$this->m_sRestzo = $p_vValue;						
						break;
						
						case "Restownerid":
							$this->m_sRestownerid = $p_vValue;						
						break;
						
				
					}


			}
			
		public function __get($p_sProperty)
			{
	
				switch($p_sProperty)
					{	
						case "Restid":
							return $this->m_sRestid;							
						break;
						
						case "Restname":
							return $this->m_sRestname;							
						break;
						
						case "Restadres":
							return $this->m_sRestadres;							
						break;
						
						case "Restgem":
							return $this->m_sRestgem;							
						break;
						
						case "Restspec":
							return $this->m_sRestspec;							
						break;
						
						case "Restsite":
							return $this->m_sRestsite;							
						break;
						
						case "Restnr":
							return $this->m_sRestnr;							
						break;
						
						case "Restmail":
							return $this->m_sRestmail;							
						break;
						
						case "Restfb":
							return $this->m_sRestfb;							
						break;
						
						case "Restma":
							return $this->m_sRestma;							
						break;
						
						case "Restdi":
							return $this->m_sRestdi;							
						break;
						
						case "Restwo":
							return $this->m_sRestwo;						
						break;
						
						case "Restdo":
							return $this->m_sRestdo;							
						break;
						
						case "Restvr":
							return $this->m_sRestvr;							
						break;
						
						case "Restza":
							return $this->m_sRestza;							
						break;
						
						case "Restzo":
							return $this->m_sRestzo;					
						break;
						
						case "Restownerid":
							return $this->m_sRestownerid;							
						break;
				
					}
			
			
			}

		public function Save()
		{
            if (empty($this->m_sRestid)) {
                // create
                $db = new Db();
                $sql = "insert into restaurant (naam,adres,gemeente,specialiteit,website,facebook,mail,telnr,
					maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag,restaurantownerid) values(
					'".$this->m_sRestname."',
					'".$this->m_sRestadres."',
					'".$this->m_sRestgem."',
					'".$this->m_sRestspec."',
					'".$this->m_sRestsite."',
					'".$this->m_sRestfb."',
					'".$this->m_sRestmail."',
					'".$this->m_sRestnr."',
					'".$this->m_sRestma."',
					'".$this->m_sRestdi."',
					'".$this->m_sRestwo."',
					'".$this->m_sRestdo."',
					'".$this->m_sRestvr."',
					'".$this->m_sRestza."',
					'".$this->m_sRestzo."',
					".$this->m_sRestownerid."
					);";

                $db->conn->query($sql);
                $id = $db->conn->insert_id;
                $this->m_sRestid = $id;
            } else {
                //update
                $this->Update();
            }
		}
		
		public function Update()
		{
			$db = new Db();

            $query = 'SELECT restaurantownerid FROM restaurant WHERE id = '.$this->m_sRestid;
            $row = $db->conn->query($query)->fetch_array();

            if ($row['restaurantownerid'] != $_SESSION['login']['id']) {
                echo 'Goed geprobeerd, hehe :)';
                exit;
            }

			$sql = "UPDATE restaurant SET
					naam = '".$this->m_sRestname."',
					adres = '".$this->m_sRestadres."',
					gemeente = '".$this->m_sRestgem."',
					specialiteit = '".$this->m_sRestspec."',
					website = '".$this->m_sRestsite."',
					facebook = '".$this->m_sRestfb."',
					mail = '".$this->m_sRestmail."',
					telnr = '".$this->m_sRestnr."',
					maandag = '".$this->m_sRestma."',
					dinsdag = '".$this->m_sRestdi."',
					woensdag = '".$this->m_sRestwo."',
					donderdag = '".$this->m_sRestdo."',
					vrijdag = '".$this->m_sRestvr."',
					zaterdag = '".$this->m_sRestza."',
					zondag = '".$this->m_sRestzo."'
					where id = " . $this->m_sRestid . ";";

			$db->conn->query($sql);
		}
	
		public function Printres()
		{
		
			$db = new Db();
			$sql = "Select * From restaurant where restaurantownerid = " . $this->m_sRestownerid . " AND showres = 0;";
			$result = $db->conn->query($sql);
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0)
			{
			
				return "geen restaurants gevonden";
			
			}
			else
			{
				$row = mysqli_fetch_array($result);

					
						return "<div><strong>restaurant naam:</strong> ".$row['naam'] .
								"</br><strong>adres: </strong>". $row['adres'] .
								"</br><strong>gemeente: </strong>". $row['gemeente'] .
								"</br><strong>specialiteit: </strong>". $row['specialiteit'] .
								"</br><strong>website: </strong>". $row['website'] .
								"</br><strong>facebook: </strong>". $row['facebook'] .
								"</br><strong>mail: </strong>". $row['mail'] .
								"</br><strong>telnr: </strong>". $row['telnr'] .
								"</br><strong>maandag: </strong>". $row['maandag'] .
								"</br><strong>dinsdag: </strong>". $row['dinsdag'] .
								"</br><strong>woensdag: </strong>". $row['woensdag'] .
								"</br><strong>donderdag: </strong>". $row['donderdag'] .
								"</br><strong>vrijdag:</strong> ". $row['vrijdag'] .
								"</br><strong>zaterdag: </strong>". $row['zaterdag'] .
								"</br><strong>zondag: </strong>". $row['zondag'] . "
								<a href='remove_restaurant.php?id=".$row['id']."'>Verwijder dit restaurant</a>
								<a href='edit_restaurant.php?id=".$row['id']."'>Restaurant gegevens aanpassen</a></div>";

					
			}
		}
		
		public function delete()
		{
		
			$db = new Db();
			$sql = "UPDATE restaurant SET showres = 0 where id = " . $this->m_sRestid . ";";
			$db->conn->query($sql);
		}
		
		public function Modifyres($id)
		{
		
			$db = new Db();
			$sql = "Select * From restaurant where id = " . $id . " ;";
			$result = $db->conn->query($sql);
			
			
				while($row = mysqli_fetch_array($result))
					{
					
						$id = "<form action='' method='post' >
								<input type='text' name='naam' value='".$row['naam']."' required/>
								<input type='text' name='adres' value='".$row['adres']."' required/>
								<input type='text' name='gemeente' value='".$row['gemeente']."' required/>
								<input type='text' name='specialiteit' value='".$row['specialiteit']."' required/>
								<input type='text' name='website' value='".$row['website']."' required/>
								<input type='text' name='facebook' value='".$row['facebook']."' required/>
								<input type='text' name='telnr' value='".$row['telnr']."' required/>
								<input type='email' name='email' value='".$row['mail']."' required/>
								
								<input type='text' name='maan' value='".$row['maandag']."' required/>
								<input type='text' name='dins' value='".$row['dinsdag']."' required/>
								<input type='text' name='woens' value='".$row['woensdag']."' required/>
								<input type='text' name='dond' value='".$row['donderdag']."' required/>
								<input type='text' name='vrij' value='".$row['vrijdag']."' required/>
								<input type='text' name='zat' value='".$row['zaterdag']."' required/>
								<input type='text' name='zon' value='".$row['zondag']."' required/>
								<input type='submit' name='modify' value='Pas aan' />
								</form>";
								
					
					}
					
					return $id;
					
			
		
		
		}
		
}
?>