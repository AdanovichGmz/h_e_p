<?php

require('saves/conexion.php');

$radios=$_POST['radios'];
$observaciones=$_POST['observaciones'];

//foreach ($_POST['opcion'] as $opcion); 

$tiempoalertamaquina=$_POST['tiempoalertamaquina'];
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


$query="INSERT INTO alertageneralajuste (radios, observaciones, tiempoalertamaquina, id_maquina, id_usuario, horadeldiaam, fechadeldiaam) VALUES ('$radios','$observaciones','$tiempoalertamaquina','$machineID','$userID','$horadeldiaam','$fechadeldiaam')";


$resultado=$mysqli->query($query);
//echo "Tus datos fueron enviados correctamente <b>".$_POST['logged_in']."</b>";
//print_r($_POST) ;
if ( $resultado) {
print_r($_POST);
 }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }

/*
mysqli_query("INSERT INTO alertaMaquina (odt, nohay, seperdio, arrenfalso, opcion, observaciones, tiempoalertamaquina, nombremaquinaajuste, logged_in, horadeldiaam, fechadeldiaam) VALUES ('$odt','$nohay','$seperdio','$arrenfalso','$opcion','$observaciones','$tiempoalertamaquina','$nombremaquinaajuste','$logged_in','$horadeldiaam','$fechadeldiaam')");
echo "<h2>Thank You !</h2>";
*/



?>


<?php
/*
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




$query="INSERT INTO alertaMaquina (odt, nohay, seperdio, arrenfalso, opcion, observaciones, tiempoalertamaquina, nombremaquinaajuste, logged_in, horadeldiaam, fechadeldiaam) VALUES ('$odt','$nohay','$seperdio','$arrenfalso','$opcion','$observaciones','$tiempoalertamaquina','$nombremaquinaajuste','$logged_in','$horadeldiaam','$fechadeldiaam')";


$resultado=$mysqli->query($query);

//include("home.php");
//header('Location: submit.php');

echo $query;

------

if($_SERVER["REQUEST_METHOD"] == "POST")
{

   
$odt=mysql_real_escape_string($_POST['odt']);
$nohay=mysql_real_escape_string($_POST['nohay']);
$seperdio=mysql_real_escape_string($_POST['seperdio']);
$arrenfalso=mysql_real_escape_string($_POST['arrenfalso']);
foreach ($_POST['opcion'] as $opcion); 
$observaciones=mysql_real_escape_string($_POST['observaciones']);
$tiempoalertamaquina=mysql_real_escape_string($_POST['tiempoalertamaquina']);
$nombremaquinaajuste=mysql_real_escape_string($_POST['nombremaquinaajuste']);
$logged_in=mysql_real_escape_string($_POST['logged_in']);
$horadeldiaam=mysql_real_escape_string($_POST['horadeldiaam']);
$fechadeldiaam=mysql_real_escape_string($_POST['fechadeldiaam']);

if(strlen($odt)>0 && strlen($nohay)>0 && strlen($seperdio)>0 && strlen($arrenfalso)>0 && strlen($opcion)>0 && strlen($observaciones)>0 && strlen($tiempoalertamaquina)>0 && strlen($nombremaquinaajuste)>0 && strlen($logged_in)>0 && strlen($horadeldiaam)>0 && strlen($fechadeldiaam)>0)
{

$query="INSERT INTO alertaMaquina (odt, nohay, seperdio, arrenfalso, opcion, observaciones, tiempoalertamaquina, nombremaquinaajuste, logged_in, horadeldiaam, fechadeldiaam) VALUES ('$odt','$nohay','$seperdio','$arrenfalso','$opcion','$observaciones','$tiempoalertamaquina','$nombremaquinaajuste','$logged_in','$horadeldiaam','$fechadeldiaam')";
echo "<h2>Thank You !</h2>";

}
}








 */

?>