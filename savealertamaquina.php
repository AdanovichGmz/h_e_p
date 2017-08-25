<?php
require('saves/conexion.php');
$radios=$_POST['radios'];
$observaciones=$_POST['observaciones'];

//foreach ($_POST['opcion'] as $opcion); 

$tiempoalertamaquina=$_POST['tiempoalertamaquina'];
$nombremaquinaajuste=$_POST['nombremaquinaajuste'];

$logged_in=$_POST['logged_in'];
$horadeldiaam=$_POST['horadeldiaam'];
$fechadeldiaam=$_POST['fechadeldiaam'];

$query2="SELECT id FROM login WHERE logged_in='$logged_in'";
$query4="SELECT idmaquina FROM maquina WHERE mac='$nombremaquinaajuste'";
$getID = mysqli_fetch_assoc($mysqli->query($query2));
$userID = $getID['id'];
$getMachine = mysqli_fetch_assoc($mysqli->query($query4));
$machineID = $getMachine['idmaquina'];


$query="INSERT INTO alertamaquinaoperacion (radios, observaciones, tiempoalertamaquina, id_maquina, id_usuario, horadeldiaam, fechadeldiaam) VALUES ('$radios','$observaciones','$tiempoalertamaquina','$machineID','$userID','$horadeldiaam','$fechadeldiaam')";


$resultado=$mysqli->query($query);
if ( $resultado) {
print_r($_POST);
 }else{
            printf("ERROR!!! %s\n", $mysqli->error);
          }
/*

require('saves/conexion.php');
$odt=$_POST['odt'];
$nohay=$_POST['nohay'];
$seperdio=$_POST['seperdio'];
$arrenfalso=$_POST['arrenfalso'];
//$opcion = $_POST['opcion'];
foreach ($_POST['opcion'] as $opcion); 
$observaciones=$_POST['observaciones'];
$tiempoalertamaquina=$_POST['tiempoalertamaquina'];
$nombremaquinaajuste=$_POST['nombremaquinaajuste'];
$logged_in=$_POST['logged_in'];
$horadeldiaam=$_POST['horadeldiaam'];
$fechadeldiaam=$_POST['fechadeldiaam'];




$query="INSERT INTO alertaMaquinaOperacion (odt, nohay, seperdio, arrenfalso, opcion, observaciones, tiempoalertamaquina, nombremaquinaajuste, logged_in, horadeldiaam, fechadeldiaam) VALUES ('$odt','$nohay','$seperdio','$arrenfalso','$opcion','$observaciones','$tiempoalertamaquina','$nombremaquinaajuste','$logged_in','$horadeldiaam','$fechadeldiaam')";


$resultado=$mysqli->query($query);
//echo "Tus datos fueron enviados correctamente <b>".$_POST['logged_in']."</b>";
echo $query; */
?>

