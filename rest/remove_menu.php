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
$r = new Restaurant();

$menugegevens = $m->getById($menuid);
$restaurantgegevens = $r->getById($menugegevens["restaurantid"]);

if ($restaurantgegevens['restaurantownerid'] != $_SESSION['login']['id'])
{

    die('Maakt dus geen reet uit :D');

}

$m->delete($menuid);

header('Location: show_menu.php?id='.$menugegevens['restaurantid']);
exit;
