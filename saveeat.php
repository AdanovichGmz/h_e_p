<?php
session_start();
require('saves/conexion.php');

$radios=$_POST['radios'];

//foreach ($_POST['opcion'] as $opcion); 

$breaktime=$_POST['breaktime'];
$maquina=$_POST['maquina'];

$logged_in=$_POST['logged_in'];
$horadeldiaam=$_POST['horadeldiaam'];
$fechadeldiaam=$_POST['fechadeldiaam'];

$userID = $_SESSION['id'];

$machineID = $_SESSION['machineID'];



$query="INSERT INTO breaktime (radios, breaktime, id_maquina, id_usuario, horadeldiaam, fechadeldiaam, vdate) VALUES ('$radios','$breaktime',$machineID,$userID,'$horadeldiaam','$fechadeldiaam',now())";


$resultado=$mysqli->query($query);
//echo "Tus datos fueron enviados correctamente <b>".$_POST['logged_in']."</b>";

//print_r($_POST) ;
if ( $resultado) {
print_r($_POST);
 }else{	print_r($_POST);
            printf("Errormessage: %s\n", $mysqli->error);
            echo $query;
          }


?>
