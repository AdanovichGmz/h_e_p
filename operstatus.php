<?php 

 session_start();
date_default_timezone_set("America/Mexico_City"); 
require('saves/conexion.php');
 $machineID=$_SESSION['machineID'];
 $machineName=$_SESSION['machineName'];
  $logged_in=$_SESSION['id'];
  $section=$_POST['section'];
$today=date("d-m-Y");


if ($section=='asaichii') {
	$check=$mysqli->query("SELECT * FROM operacion_estatus WHERE fecha='$today' AND maquina=$machineID");
print_r($check);
if ($check->num_rows==0) {
	$op_query=$mysqli->query("INSERT INTO operacion_estatus(operador,maquina,actividad_actual,en_tiempo,fecha) VALUES($logged_in,$machineID,1,1,'$today')");
	if ($op_query) {
		echo "se inserto el operstatus";
	}else{
		printf($mysqli->error);
	}
}
}
elseif ($section=='ajuste') {
	$check=$mysqli->query("SELECT * FROM operacion_estatus WHERE fecha='$today'");

if ($check->num_rows==0) {
	$op_query=$mysqli->query("INSERT INTO operacion_estatus(operador,maquina,actividad_actual,en_tiempo,fecha) VALUES($logged_in,$machineID,1,1,'$today')");
	if ($op_query) {
		echo "se inserto el operstatus";
	}else{
		printf($mysqli->error);
	}
}else{
	$changestatus=$mysqli->query("UPDATE operacion_estatus SET actividad_actual=2 WHERE fecha='$today' AND maquina=$machineID ");
	if ($changestatus) {
		echo "estatus cambiado a ajuste";
	}else{
		printf($mysqli->error);
	}
}
	
}
elseif ($section=='tiro') {
	$check=$mysqli->query("SELECT * FROM operacion_estatus WHERE fecha='$today'");

if ($check->num_rows==0) {
	$op_query=$mysqli->query("INSERT INTO operacion_estatus(operador,maquina,actividad_actual,en_tiempo,fecha) VALUES($logged_in,$machineID,1,1,'$today')");
	if ($op_query) {
		echo "se inserto el operstatus";
	}else{
		printf($mysqli->error);
	}

}else{
	$changestatus=$mysqli->query("UPDATE operacion_estatus SET actividad_actual=3 WHERE fecha='$today' AND maquina=$machineID ");
	if ($changestatus) {
		echo "estatus cambiado a tiro";
	}else{
		printf($mysqli->error);
	}
}
	
}
elseif ($section=='comida') {
	
	$changestatus=$mysqli->query("UPDATE operacion_estatus SET actividad_actual=6 WHERE fecha='$today' AND maquina=$machineID ");
	if ($changestatus) {
		echo "estatus cambiado a comida";
	}else{
		printf($mysqli->error);
	}

}
elseif ($section=='paro') {

	$changestatus=$mysqli->query("UPDATE operacion_estatus SET actividad_actual=5 WHERE fecha='$today' AND maquina=$machineID ");

	
}
elseif ($section=='alerta') {

	$changestatus=$mysqli->query("UPDATE operacion_estatus SET actividad_actual=4 WHERE fecha='$today' AND maquina=$machineID ");

	if ($changestatus) {
		echo "estatus cambiado a alerta";
	}else{
		printf($mysqli->error);
	}
}
elseif ($section=='outtime') {

	$changestatus=$mysqli->query("UPDATE operacion_estatus SET en_tiempo=2 WHERE fecha='$today' AND maquina=$machineID ");

	if ($changestatus) {
		echo "estatus cambiado a no en tiempo";
	}else{
		printf($mysqli->error);
	}
}
elseif ($section=='intime') {

	$changestatus=$mysqli->query("UPDATE operacion_estatus SET en_tiempo=1 WHERE fecha='$today' AND maquina=$machineID ");

	if ($changestatus) {
		echo "estatus cambiado a en tiempo";
	}else{
		printf($mysqli->error);
	}
}

?>