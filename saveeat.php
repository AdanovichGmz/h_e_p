<?php

require('saves/conexion.php');

$radios=$_POST['radios'];

//foreach ($_POST['opcion'] as $opcion); 

$breaktime=$_POST['breaktime'];
$maquina=$_POST['maquina'];

$logged_in=$_POST['logged_in'];
$horadeldiaam=$_POST['horadeldiaam'];
$fechadeldiaam=$_POST['fechadeldiaam'];
$query2="SELECT id FROM login WHERE logged_in='$logged_in'";
$query4="SELECT idmaquina FROM maquina WHERE mac='$maquina'";
$getID = mysqli_fetch_assoc($mysqli->query($query2));
$userID = $getID['id'];
$getMachine = mysqli_fetch_assoc($mysqli->query($query4));
$machineID = $getMachine['idmaquina'];



$query="INSERT INTO breaktime (radios, breaktime, id_maquina, id_usuario, horadeldiaam, fechadeldiaam, vdate) VALUES ('$radios','$breaktime',$machineID,$userID,'$horadeldiaam','$fechadeldiaam',now())";


$resultado=$mysqli->query($query);
//echo "Tus datos fueron enviados correctamente <b>".$_POST['logged_in']."</b>";

//print_r($_POST) ;
if ( $resultado) {
print_r($_POST);
 }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }


?>
