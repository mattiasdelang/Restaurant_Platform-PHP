<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 1/05/14
 * Time: 19:10
 * To change this template use File | Settings | File Templates.
 */

session_start();
include_once("classes/restaurant.class.php");
include_once("classes/restaurantowner.class.php");
include_once("classes/menu.class.php");
include_once("classes/tafel.class.php");
include_once("classes/Feedback.class.php");

if(!isset($_SESSION["login"]))
{

    header("Location:login.php");
    exit;

}

$id = $_GET["id"];
$ownerid = $_SESSION["login"]["id"];
$r = new Restaurant();
$m = new Menu();
$f = new Feedback();
$t = new Tafel();
$result = $r->getById($id);

$menus = $m->getByRestaurantId($id);
$menu = $menus->fetch_array();
$tafels = $t->getByRestaurantId($id);

$feeds = $f->getAllById($id);

if(!empty($_POST["post"]))
{
    $subcheck = (isset($_POST['show'])) ? 1 : 0;
    $f->setFeedback($_POST["feedback"]);
    $f->setScore($_POST["score"]);
    $f->setShow($subcheck);
    $f->create($id,$ownerid);





}

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Picked restaurant</title>
</head>
<body>


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
        </div></br></br>


        <div>

            <strong>gerecht naam:</strong> <?=$menu['naam']?><br>
            <strong>omschrijving: </strong> <?=$menu['omschrijving']?><br>
            <strong>type: </strong> <?=$menu['type']?><br>
            <strong>prijs: </strong> <?=$menu['prijs']?><br>

        </div></br>
    <?php
    if ($tafels->num_rows == 0)
    {
        ?>
        <div>
            Geen restauranten gevonden.
        </div>
    <?php

    }

    else
    {

    while ($tafel = $tafels->fetch_array())
    {

    ?>
        <div>
            <strong>tafel nr:</strong> <?=$tafel['tafelnummer']?>
            <strong>plaatsen: </strong> <?=$tafel['plaatsen']?>

        </div>
    <?php

    }

    }


    ?>


        <br>
<form action="" method="post">

    <textarea type="text" name="feedback" placeholder="Feedback"></textarea><br>
    <input type="number" min="1" max="10" name="score"><br>
    show naam<input type="checkbox" name="show" checked>
    <input type="submit" name="post" value="Post feedback">

</form>

        <?php

        if ($feeds->num_rows == 0)
        {
            ?>
            <div>
                Geen reacties gevonden.
            </div>
        <?php

        }

        else
        {
            $i = 1;
            while ($feed = $feeds->fetch_array())
            {
                if($i <6){
                    ?>
                    <div>
                        <?php
                        if($feed['fshow']== 1 )
                        {

                            $o = new Restaurantowner();
                            $feedid= $feed["ownerid"];
                            $naam = $o->getNaam($feedid);
                            ?>

                          <strong>naam:</strong><?=$naam["firstname"]. " " . $naam["lastname"] ?>
                        <?php
                        }else
                        {

                             echo "<strong>naam:</strong> anoniem";

                        }
                        ?>
                        <strong>feedback: </strong> <?=$feed['feedback']?>
                        <strong>score: </strong> <?=$feed['score']?>






                    </div>
                    <?php
                    $i++;
                }
            }

        }


        ?>




</body>
</html>