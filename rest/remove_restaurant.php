<?php
    session_start();
	if(!isset($_SESSION["login"]))
		{

			header("Location:login.php");

		}

	include_once("classes/restaurant.class.php");

	$r = new Restaurant();

    $id=$_GET['id'];
	$r->setRestid($id);
	$r->delete();
    header("location:modify.php");
