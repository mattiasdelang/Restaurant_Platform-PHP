<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 29/04/14
 * Time: 21:55
 * To change this template use File | Settings | File Templates.
 */
session_start();
include_once("classes/restaurant.class.php");
include_once("classes/tafel.class.php");
include_once("classes/db.class.php");

$restaurantId = $_GET['id'];

if(!isset($_SESSION["login"]))
{

    header("Location:login.php");

}

if(!empty($_POST["go"]))
{

    $tafels = array();
    for($i = 0; $i < $_POST['aantal']; $i++) {
        $tafels[] = new Tafel();
    }

}

if(!empty($_POST["aanmaken"]))
{
    foreach ($_POST['tafelnr'] as $index => $tafelnummer) {
        $aantalPlaatsen = $_POST['plaatsen'][$index];

        $tafel = new Tafel();
        $tafel->setTafelnummer($tafelnummer);
        $tafel->setAantalPlaatsen($aantalPlaatsen);
        $tafel->setOwnerId($_SESSION['login']['id']);
        $tafel->setRestaurantId($restaurantId);
        $tafel->save();

        header('Location: index.php');
        exit;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Tafel maken</title>

</head>
<body>

<h1>Tafel aanmaken</h1>
<form action="" method="post">

    <input type="number" name="aantal" placeholder="aantal tafels">
    <input type="submit" name="go" value="aanmaken">

</form>
<?php
if( isset($_POST['aantal'])) {
?>
<div id="tafels">

    <form action="" method="post">
<?php
        for($i = 0; $i < $_POST['aantal']; $i++) {
?>
           <input type="number" name="tafelnr[]" value="" placeholder="Tafelnummer" required />
           <input type="number" name="plaatsen[]" value="" placeholder="Aantal plaatsen" required/><br>
<?php
        }
?>
        <input type="submit" name="aanmaken" value="aanmaken">
    </form>

</div>
<?php
}
?>
</body>
</html>