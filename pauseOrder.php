<?php 
require('saves/conexion.php');

$idorden=$_POST['id_orden'];
$proceso=$_POST['proceso'];
$action=(isset($_POST['action']))? $_POST['action'] : '';
$tpausa=(isset($_POST['tpausa']))? $_POST['tpausa'] : '';
$cantrecib=$_POST['cantrecib'];
$cantpedido=$_POST['cantpedido'];
$merma=$_POST['merma'];
$buenos=$_POST['buenos'];
$ajuste=$_POST['ajuste'];
$defectos=$_POST['defectos'];
$entregados=$_POST['entregados'];
$mermaent=$_POST['mermaent'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$producto=$_POST['producto'];

if ($action=='exit') {
	$query="UPDATE procesos SET avance=3 WHERE id_orden=$idorden AND proceso='$proceso'";
$paused=$mysqli->query($query);
if ($paused) {
	echo "Cerrando Sesion";
}else{
	printf($mysqli->error);
}
}else{
	$querytiraje="UPDATE tiraje SET pedido=$cantpedido, cantidad=$cantrecib, buenos=$buenos, piezas_ajuste=$ajuste, defectos=$defectos, merma=$merma, entregados=$entregados, tiempoTiraje='$tpausa', horadeldia_tiraje='$hora', fechadeldia_tiraje='$fecha', producto='$producto' WHERE id_orden=$idorden AND fechadeldia_ajuste='$fecha'";
	$query="UPDATE procesos SET avance=2, tiempo_pausa='$tpausa', fecha_pausa='$fecha' WHERE id_orden=$idorden AND proceso='$proceso'";
	
	$paused=$mysqli->query($querytiraje);
	if ($mysqli->query($query)) {
		if ($paused) {
	echo "Orden Pausada, Cerrando Sesion";
}else{
	printf($mysqli->error);
}
	}else{
	printf($mysqli->error);
}

}

?>