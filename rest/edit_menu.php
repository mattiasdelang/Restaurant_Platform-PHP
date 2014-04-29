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

if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}

$menuid = $_GET['id'];

$m = new Menu();

$menugegevens = $m->getById($menuid);

if(isset($_POST["aanpassen"]))
{

    $menu = new Menu();
    $menu->setId($menuid);
    $menu->setNaam($_POST["naam"]);
    $menu->setOmschrijving($_POST["omschrijving"]);
    $menu->setPrijs($_POST["prijs"]);
    $menu->setType($_POST["type"]);
    $menu->setRestaurantid($menugegevens["restaurantid"]);
    $menu->save();

    header("Location: show_menu.php?id=".$menugegevens["restaurantid"]);
    exit;

}

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Menu aanpassen</title>
</head>
<body>
<form action="" method="post">

    <input type="text" name="naam" placeholder="naam" value="<?=$menugegevens['naam']?>">
    <input type="text" name="omschrijving" placeholder="omschrijving" value="<?=$menugegevens['omschrijving']?>">
    <select name="type">
        <option value="Hapje" <?=$menugegevens['type'] == "Hapje" ? 'selected="selected"' : '' ?> >Hapje</option>
        <option value="Voorgerecht" <?=$menugegevens['type'] == "Voorgerecht" ? 'selected="selected"' : '' ?>>Voorgerecht</option>
        <option value="Hoofgerecht" <?=$menugegevens['type'] == "Hoofgerecht" ? 'selected="selected"' : '' ?>>Hoofgerecht</option>
        <option value="Desert" <?=$menugegevens['type'] == "Desert" ? 'selected="selected"' : '' ?>>Desert</option>
    </select>
    <input type="text" name="prijs" placeholder="prijs" value="<?=$menugegevens['prijs']?>">
    <br />

    <input type="submit" name="aanpassen" value="Aanpassen">

</form>
</body>
</html>