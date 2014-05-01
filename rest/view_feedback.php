<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Christof
 * Date: 1/05/14
 * Time: 21:38
 * To change this template use File | Settings | File Templates.
 */
session_start();
include_once("classes/feedback.class.php");
include_once("classes/restaurantowner.class.php");


if(!isset($_SESSION["login"]))
{

    header("Location:login.php");
    exit;

}
$f = new Feedback();
$id = $_GET["id"];

if(!empty($_POST["tijd"]))
{

    $time = $_POST["time"];
    $results = $f->getAllByScore($id,$time);

}

if(!empty($_POST["score"]))
{
    $nr = $_POST["nr"];
    $results = $f->getAllByScore($id,$nr);


}

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Feedback bekijken</title>
</head>
<body>
<form action="" method="post">

    <select name="nr">
        <option value="1" selected="selected">best</option>
        <option value="2">slecht</option>
    </select>
    <input type="submit" name="score" value="Bepaal score">
    <select name="time">
        <option value="1" selected="selected">Altijd</option>
        <option value="2">Gisteren</option>
        <option value="3">Laatste week</option>
        <option value="4">Laatste maand</option>
    </select>
    <input type="submit" name="tijd" value="Bepaal tijd">

</form>
<?php

if ($results->num_rows == 0)
{
    ?>
    <div>
        Geen reacties gevonden.
    </div>
<?php

}
else
{

    while ($result = $results->fetch_array())
    {

        if($result['fshow']== 1 )
        {

            $o = new Restaurantowner();
            $feedid= $result["ownerid"];
            $naam = $o->getNaam($feedid);
            ?>

            <div><strong>naam:</strong><?=$naam["firstname"]. " " . $naam["lastname"] ?>
        <?php
        }else
        {

            echo "<div><strong>naam:</strong> anoniem";

        }
        ?>
        <strong>feedback: </strong> <?=$result['feedback']?>
        <strong>score: </strong> <?=$result['score']?>


        </div>
    <?php

    }

}

?>
</body>
</html>

