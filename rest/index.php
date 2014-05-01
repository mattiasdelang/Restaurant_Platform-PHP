<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Christof
 * Date: 01/05/14
 * Time: 18:07
 * To change this template use File | Settings | File Templates.
 */

error_reporting(0);// turns errors off



session_start();
include_once("classes/restaurant.class.php");
include_once("classes/restaurantowner.class.php");



if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}
$u = new Restaurantowner();
$mail = $_SESSION["login"]["email"];
$uitkomst = $u->Checkverif($mail);


if(!empty($_POST["klik"]))
{

    $u->setCode($_POST["code"]);
    $u->Verify($mail);

}

$r = new Restaurant();



if(!empty($_POST["zoek"]))
{
    $gem = $_POST["gem"];

    $results = $r->getAllByGem($gem);

}else
{

    $results = $r->getAllByGem($gem);

}


?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Zoek een restaurant</title>
</head>
<body>

<?php

    if($uitkomst != "ok")
    {

    echo	"<form action='' method='post'>
                    <input type='text' name='code'/>
                    <input type='submit' name='klik' value='validate'/>
                    </form>";

    }
?>
<form action="" method="post">

    <input type="text" name="gem" placeholder="gemeente">
    <input type="submit" name="zoek" value="Zoek">

</form>
<?php
if ($results->num_rows == 0)
{
?>
    <div>
        Geen restauranten gevonden.
    </div>
<?php

}

else
{

    while ($result = $results->fetch_array())
    {

        ?>
        <a href="restaurant.php?id=<?=$result['id']?>"/>
        <div>
            <strong>restaurant naam:</strong> <?=$result['naam']?><br>
            <strong>adres: </strong> <?=$result['adres']?><br>
            <strong>gemeente: </strong> <?=$result['gemeente']?><br>
            <strong>specialiteit: </strong> <?=$result['specialiteit']?><br>
            <strong>website: </strong> <?=$result['website']?><br>
            <strong>facebook: </strong> <?=$result['facebook']?><br>
            <strong>mail: </strong> <?=$result['mail']?><br>
            <strong>telnr: </strong> <?=$result['telnr']?><br>
            <strong>maandag: </strong> <?=$result['maandag']?><br>
            <strong>dinsdag: </strong> <?=$result['dinsdag']?><br>
            <strong>woensdag: </strong> <?=$result['woensdag']?><br>
            <strong>donderdag: </strong> <?=$result['donderdag']?><br>
            <strong>vrijdag:</strong> <?=$result['vrijdag']?><br>
            <strong>zaterdag: </strong> <?=$result['zaterdag']?><br>
            <strong>zondag: </strong><?=$result['zondag']?><br>
        </div></a></br></br>
    <?php

    }

}


?>



</body>
</html>