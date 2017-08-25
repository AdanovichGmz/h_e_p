<?php

require('saves/conexion.php');
$odt=$_POST['odt'];
$nohay=$_POST['nohay'];
$seperdio=$_POST['seperdio'];
$arrenfalso=$_POST['arrenfalso'];
//$opcion = $_POST['opcion'];
foreach ($_POST['opcion'] as $opcion); 
$observaciones=$_POST['observaciones'];
$tiempoalertaseriegrafia=$_POST['tiempoalertaseriegrafia'];
$nombremaquinaseriegrafia=$_POST['nombremaquinaseriegrafia'];
$logged_in=$_POST['logged_in'];
$horadeldiaam=$_POST['horadeldiaam'];
$fechadeldiaam=$_POST['fechadeldiaam'];




$query="INSERT INTO alertaSeriegrafiaOperacion (odt, nohay, seperdio, arrenfalso, opcion, observaciones, tiempoalertaseriegrafia, nombremaquinaseriegrafia, logged_in, horadeldiaam, fechadeldiaam) VALUES ('$odt','$nohay','$seperdio','$arrenfalso','$opcion','$observaciones','$tiempoalertaseriegrafia','$nombremaquinaseriegrafia','$logged_in','$horadeldiaam','$fechadeldiaam')";


$resultado=$mysqli->query($query);
echo "Tus datos fueron enviados correctamente <b>".$_POST['logged_in']."</b>";

?>