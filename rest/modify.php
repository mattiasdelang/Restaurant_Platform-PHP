<?php
/**
* Created by JetBrains PhpStorm.
* User: Christof
* Date: 1/05/14
* Time: 21:38
* To change this template use File | Settings | File Templates.
*/

include_once("classes/restaurantowner.class.php");
include_once("classes/restaurant.class.php");
session_start();

if(!isset($_SESSION["login"]))
{

    header("Location:login.php");

}
$r = new Restaurant();

$id = $_SESSION["login"]["id"];


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>modify page</title>
</head>
<body>
<?php


$restauranten = $r->getByOwnerId($id);

if ($restauranten->num_rows == 0)
{
    ?>
    <div>
        Geen restauranten gevonden.
    </div>
<?php

}
else
{

    while ($restaurant = $restauranten->fetch_array())
    {

        ?>
        <div>
            <strong>restaurant naam:</strong> <?=$restaurant['naam']?><br>
            <strong>adres: </strong> <?=$restaurant['adres']?><br>
            <strong>gemeente: </strong> <?=$restaurant['gemeente']?><br>
            <strong>specialiteit: </strong> <?=$restaurant['specialiteit']?><br>
            <strong>website: </strong> <?=$restaurant['website']?><br>
            <strong>facebook: </strong> <?=$restaurant['facebook']?><br>
            <strong>mail: </strong> <?=$restaurant['mail']?><br>
            <strong>telnr: </strong> <?=$restaurant['telnr']?><br>
            <strong>maandag: </strong> <?=$restaurant['maandag']?><br>
            <strong>dinsdag: </strong> <?=$restaurant['dinsdag']?><br>
            <strong>woensdag: </strong> <?=$restaurant['woensdag']?><br>
            <strong>donderdag: </strong> <?=$restaurant['donderdag']?><br>
            <strong>vrijdag:</strong> <?=$restaurant['vrijdag']?><br>
            <strong>zaterdag: </strong> <?=$restaurant['zaterdag']?><br>
            <strong>zondag: </strong><?=$restaurant['zondag']?><br>
            <a href="remove_restaurant.php?id=<?=$restaurant['id']?>">Verwijder dit restaurant</a>
            <a href="edit_restaurant.php?id=<?=$restaurant['id']?>">Restaurant gegevens aanpassen</a>
            <a href="new_tafel.php?id=<?=$restaurant['id']?>">Tafels toevoegen</a>
            <a href="edit_tafel.php?id=<?=$restaurant['id']?>">Tafels aanpassen</a>
            <a href="show_menu.php?id=<?=$restaurant['id']?>">Menu tonen</a>
            <a href="new_menu.php?id=<?=$restaurant['id']?>">Menu toevoegen</a>
            <a href="view_feedback.php?id=<?=$restaurant['id']?>">Feedback bekijken</a>
        </div>
    <?php

    }

}



?>
<a href="logout.php">log out</a>
<a href="new_restaurant.php">restaurant aanmaken</a>
</body>
</html>
