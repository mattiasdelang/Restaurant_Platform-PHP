<?php
include_once("db.class.php");
class Restaurantowner
{

	private $Lastname;
	private $Firstname;
    private $Email;
    private $Password;
    private $Passcheck;
    private $Random;
    private $Code;
    private $Salt = 'ezvzeéùµùµµ(21154.$ùù$ù';

    public function setCode($Code)
    {

        $this->Code = $Code;

    }

    public function getCode()
    {

        return $this->Code;

    }

    public function setEmail($Email)
    {

        $this->Email = $Email;

    }

    public function getEmail()
    {

        return $this->Email;

    }

    public function setFirstname($Firstname)
    {

        $this->Firstname = $Firstname;

    }

    public function getFirstname()
    {

        return $this->Firstname;

    }

    public function setLastname($Lastname)
    {

        $this->Lastname = $Lastname;

    }

    public function getLastname()
    {

        return $this->Lastname;

    }

    public function setPasscheck($Passcheck)
    {

        if(strlen($Passcheck) < 9)
        {

            throw new Exception("Password must be atleast 8 characters long.");

        }

        $this->Passcheck = md5($Passcheck.$this->Salt);

    }

    public function getPasscheck()
    {

        return $this->Passcheck;

    }

    public function setPassword($Password)
    {

        if(strlen($Password) < 9)
        {

            throw new Exception("Password must be atleast 8 characters long.");

        }

        $this->Password = md5($Password.$this->Salt);

    }

    public function getPassword()
    {

        return $this->Password;

    }

    public function setRandom($Random)
    {

        $this->Random = $Random;

    }

    public function getRandom()
    {

        return $this->Random;

    }


		public function Save()
		{

			$db = new Db();
			$sql = "insert into restaurantowner (firstname,lastname,email,password,randomnr) values(
					'".$this->Firstname."',
					'".$this->Lastname."',
					'".$this->Email."',
					'".$this->Password."',
					'".$this->Random."'
					);";

			$db->conn->query($sql);
			
			$_SESSION["login"]["email"] = $this->Email;
			$_SESSION["login"]["password"] = $this->Password;

		}
	
		public function Checklogin()
		{
		
			$db = new Db();
			$sql = "Select * From restaurantowner where email = '" . $this->Email . "' and password = '" . $this->Password."';";
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

					$_SESSION["login"]["email"] = $this->Email;
					$_SESSION["login"]["id"] = $id;
					$_SESSION["login"]["password"] = $this->Password;
					header("Location:index.php");

				}
				else
				{
				
				    throw new Exception("Error occurred in the proces, contact helpdesk Error #1523");
				
				}
			}
			
		
		}
		
		public function Checkmail()
		{
		
			$db = new Db();
			$sql = "Select * From restaurantowner where email = '" . $this->Email . "';";
			$result = $db->conn->query($sql);
			$rs =$result->num_rows;
			
			if($rs == 1)
			{
			
				throw new Exception("Er bestaat al een account met dit mailadres");
			
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
			$bericht = 		"Geachte Mevr/Mr " . $this->Lastname . "\r\n \r\n Deze mail wordt automatisch verzonden wanneer u registreerd op restaurant-app.\r\n Om je account te bevestigen,
							moet je volgende reeks karakters kopieren en invullen in het daarvoor voorbehouden inputvenstertje.\r\n
							".$this->Random."\r\n \r\n Gelieve niet te reageren op deze mail, je antwoord zal nooit gelezen worden.\r\n\r\n Het moderatorteam\r\n\r\n";
			
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
			
			if($this->Code == $trol)
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