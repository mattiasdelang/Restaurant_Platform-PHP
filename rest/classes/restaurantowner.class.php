<?php
include_once("db.class.php");
class Restaurantowner
{

	private $m_sLastname;
	private $m_sFirstname;
	private $m_sEmail;
	private $m_sPassword;
	private $m_sPasscheck;
	private $m_sSalt = 'ezvzeéùµùµµ(21154.$ùù$ù';
	private $m_sRandom;
	private $m_sCode;
	
	
	public function __set($p_sProperty, $p_vValue)
			{
				switch($p_sProperty)
					{	
						case "Lastname":
							$this->m_sLastname = $p_vValue;						
						break;
						
						case "Firstname":
							$this->m_sFirstname = $p_vValue;						
						break;
						
						case "Email":
							$this->m_sEmail = $p_vValue;						
						break;
						
						case "Password":
						if(strlen($p_vValue) < 9)
							{
								throw new Exception("Password must be atleast 8 characters long.");
							}
						$this->m_sPassword = md5($p_vValue.$this->m_sSalt);								
						break;
						
						case "Passcheck":
						if(strlen($p_vValue) < 9)
							{
								throw new Exception("Password must be atleast 8 characters long.");
							}
						$this->m_sPasscheck = md5($p_vValue.$this->m_sSalt);								
						break;
						
						case "Random":
							$this->m_sRandom = $p_vValue;						
						break;
						
						case "Code":
							$this->m_sCode = $p_vValue;						
						break;
				
					}


			}
			
		public function __get($p_sProperty)
			{
				switch($p_sProperty)
					{	
						case "Lastname":
							return $this->m_sLastname;						
						break;
						
						case "Firstname":
							return $this->m_sFirstname;						
						break;
						
						case "Email":
							return $this->m_sEmail;							
						break;
						
						case "Password":
							return $this->m_sPassword;								
						break;
						
						case "Passcheck":
							return $this->m_sPasscheck;								
						break;
						
						case "Random":
							return $this->m_sRandom;								
						break;
						
						case "Code":
							return $this->m_sCode;								
						break;
				
					}
			
			
			}
			
		public function Save()
		{
			$db = new Db();
			$sql = "insert into restaurantowner (firstname,lastname,email,password,randomnr) values(
					'".$this->m_sFirstname."',
					'".$this->m_sLastname."',
					'".$this->m_sEmail."',
					'".$this->m_sPassword."',
					'".$this->m_sRandom."'
					);";

			$db->conn->query($sql);
			
			$_SESSION["login"]["email"] = $this->m_sEmail;
			$_SESSION["login"]["password"] = $this->m_sPassword;
			header("refresh:2;url=index.php");
			
		}
	
		public function Checklogin()
		{
		
			$db = new Db();
			$sql = "Select * From restaurantowner where email = '" . $this->m_sEmail . "' and password = '" . $this->m_sPassword."';";
			$result = $db->conn->query($sql);
			if($result === false)
			{
			
				throw new Exception("Email or Password is wrong");
			
			}
			else
			{
				$rows =$result->num_rows;
				
				if($rows === 1)
				{
					while($row = mysqli_fetch_array($result))
					{
					
						$id = $row['id'];
					
					}
	
					$_SESSION["login"]["email"] = $this->m_sEmail;
					$_SESSION["login"]["id"] = $id;
					$_SESSION["login"]["password"] = $this->m_sPassword;
					header("Location:index.php");
				}
				else
				{
				
				throw new Exception("Error occured in the proces, contact helpdesk Error #1523");
				
				}
			}
			
		
		}
		
		public function Checkmail()
		{
		
			$db = new Db();
			$sql = "Select * From restaurantowner where email = '" . $this->m_sEmail . "';";
			$result = $db->conn->query($sql);
			$rs =$result->num_rows;
			
			if($rs == 1)
			{
			
				throw new Exception("Er bestaat al een account met dit mailadres");
			
			}
			else
			{
			
				
			
			}
			
		
		}
		
		public function Sendmail($mail)
		{
	
			$aan = $mail;
			$onderwerp = 'Verificatiemail';

			$headers = "MIME-version: 1.0\r\n"; 
			$headers .= "content-type: text/html;charset=utf-8\r\n";
		 
			
			$lastname = "moderatorteam";
			
			$email = 'no-reply@restapp.be';
			$bericht = 		"Geachte Mevr/Mr " . $this->m_sLastname . "\r\n \r\n Deze mail wordt automatisch verzonden wanneer u registreerd op restaurant-app.\r\n Om je account te bevestigen,
							moet je volgende reeks karakters kopieren en invullen in het daarvoor voorbehouden inputvenstertje.\r\n
							".$this->m_sRandom."\r\n \r\n Gelieve niet te reageren op deze mail, je antwoord zal nooit gelezen worden.\r\n\r\n Het moderatorteam\r\n\r\n";
			
			$headers .= 'From: ' . $lastname . ' '.'<' . $email . '>';
	 
			if(mail($aan, $onderwerp, nl2br($bericht), $headers))
			{
				header("Location:index.php");
			}
			else
			{
				throw new Exception('Helaas, er is wat fout gegaan tijdens het verzenden van de verificatiemail.');
			}
			
		}
		
		public function Checkverif($mail)
		{
		
			$db = new Db();
			$sql = "Select * From restaurantowner where email = '" . $mail . "';";
			$result = $db->conn->query($sql);
			
			
			while($row = mysqli_fetch_array($result))
			{
				
				$trol = $row['verif'];
				
			}
			if($trol == 1 )
			{
			
				return "ok";
			
			}
			else
			{
			
				return "false";
			
			}
		
		}
		
		public function Verify($mail)
		{
		
			$db = new Db();
			$sql = "Select * From restaurantowner where email = '" . $mail . "';";
			$result = $db->conn->query($sql);
			while($row = mysqli_fetch_array($result))
			{
				
				$trol = $row['randomnr'];
				
			}
			
			if($this->m_sCode == $trol)
			{
			
				$sql1 = "UPDATE restaurantowner SET verif=1 where email = '" . $mail . "';";
				$db->conn->query($sql1);
			
			}
			else
			{
			
				throw new Exception('fout');
			
			}
		}






}
?>