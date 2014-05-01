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
$restaurantid=$_GET["id"];

$m = new Menu();
$menus = $m->getByRestaurantId($restaurantid);


?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Overzicht menu's</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<?php
if($menus->num_rows>0)
{
?>
<ul>
<?php
    while($menu = $menus->fetch_array())
    {
?>
    <li>
        <?=$menu['naam']?><br />
        <?=$menu['omschrijving']?><br />
        <?=$menu['type']?><br />
        <?=$menu['prijs']?><br />
        <a href="edit_menu.php?id=<?=$menu['id']?>">Aanpassen</a><br />
        <a href="remove_menu.php?id=<?=$menu['id']?>">Verwijder</a>
    </li>

<?php
}
?>
    </ul>
<?php
} else
{
    echo "Geen menu gevonden";
}
?>
</body>
</html>