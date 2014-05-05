<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Dieter
 * Date: 3/05/14
 * Time: 20:55
 * To change this template use File | Settings | File Templates.
 */
include_once "classes/restaurant.class.php";

$r = new Restaurant();
$restaurant = $r->getObjById(3);

if(!empty($_POST["aanmaken"]))
{



} else if(isset($_POST['toonTafels'])) {

    $contactpersoon = $_POST['contactpersoon'];
    $telefoon       = $_POST['telefoon'];
    $aantal         = $_POST['aantal'];
    $datum          = $_POST['datum'];

    $datum = DateTime::createFromFormat('d/m/Y',$datum);

}

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Reservatie maken</title>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <script src="js/jquery.timepicker.js"></script>


</head>
<body>

<?php
if(isset($_POST['toonTafels'])):
?>
    <script>
        var dag = new Date(<?=$datum->format('Y ,n-1, j')?>);

        var openingsUren = <?=json_encode($restaurant->getOpeningsuren())?>;
        openingsUren = openingsUren[dag.getDay()];
    </script>
    <script src="js/reservatie.toonTafels.js"></script>
    <form method="POST">
        <input type="hidden" name="contactpersoon" value="<?=$contactpersoon?>"/>
        <input type="hidden" name="telefoon" value="<?=$telefoon?>"/>
        <input type="hidden" name="aantal" value="<?=$aantal?>"/>
        <input type="hidden" name="datum" value="<?=$datum->format('d/m/Y')?>"/>
        <input name="tijdstip" type="text" class="time">
        <input name="aanmaken" type="submit" value="go">
    </form>
<?php
else:
?>
    <script src="js/reservatie.js"></script>
    <form method="POST">
        <input type="text" name="contactpersoon" />
        <input type="text" name="telefoon" />
        <input type="text" name="aantal" />
        <input type="text" name="datum" class="datepicker" />
        <input type="submit" name="toonTafels" value="Ga verder"/>
    </form>
<?php
endif;
?>

</body>
</html>