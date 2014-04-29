<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mattias
 * Date: 29/04/14
 * Time: 22:30
 * To change this template use File | Settings | File Templates.
 */
session_start();
include_once("classes/restaurant.class.php");
include_once("classes/tafel.class.php");
include_once("classes/db.class.php");

if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}

$tafelId = $_GET['id'];

$t = new Tafel();
$tafelgegevens = $t->getById($tafelId);

if ($tafelgegevens['ownerid'] != $_SESSION['login']['id']) {
    die('Maakt dus geen reet uit :D');
}

$t->delete($tafelId);

header('Location: edit_tafel.php?id='.$tafelgegevens['restaurantid']);
exit;