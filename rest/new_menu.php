<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 29/04/14
 * Time: 23:25
 * To change this template use File | Settings | File Templates.
 */

session_start();
include_once("classes/restaurant.class.php");
include_once("classes/tafel.class.php");
include_once("classes/menu.class.php");

if(!isset($_SESSION["login"]))
{

    header("Location:login.php");
    exit;

}

$restaurantid = $_GET['id'];

if(isset($_POST["create"]))
{

    foreach ($_POST['naam'] as $index => $naam)
    {

        $omschrijving = $_POST['omschrijving'][$index];
        $type = $_POST['type'][$index];
        $prijs= $_POST['prijs'][$index];

        $menu = new Menu();
        $menu->setNaam($naam);
        $menu->setOmschrijving($omschrijving);
        $menu->setType($type);
        $menu->setPrijs($prijs);
        $menu->setRestaurantid($restaurantid);

        $menu->save();

    }

    header("location:show_menu.php?id=".$restaurantid);
    exit;

}
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Aanmaken menu</title>
</head>
<body>
<form action="" method="post">

    <input type="number" name="aantal" placeholder="aantal gerechten">
    <input type="submit" name="toonform" value="aanmaken">

</form>


<?php
if(isset($_POST["toonform"]))
{

?>
<form action="" method="post">
<?php
    for($i = 0; $i < $_POST['aantal']; $i++) {
?>
    <input type="text" name="naam[]" placeholder="naam">
    <input type="text" name="omschrijving[]" placeholder="omschrijving">

    <select name="type[]">
        <option value="Hapje">Hapje</option>
        <option value="Voorgerecht">Voorgerecht</option>
        <option value="Hoofgerecht">Hoofgerecht</option>
        <option value="Desert">Desert</option>
    </select>

    <input type="text" name="prijs[]" placeholder="prijs">
    <hr /><br />
<?php

}
?>
    <input type="submit" name="create" value="aanmaken">
</form>

<?php
}
?>

</body>
</html>