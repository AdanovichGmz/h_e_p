<?php 
require('saves/conexion.php');
print_r($_POST);
$idorden=(isset($_POST['id_orden']))? $_POST['id_orden'] : '';
$proceso=(isset($_POST['proceso']))? $_POST['proceso'] : '';
$action=(isset($_POST['action']))? $_POST['action'] : '';
$tpausa=(isset($_POST['tpausa']))? $_POST['tpausa'] : '';
$cantrecib=(isset($_POST['cantrecib']))? $_POST['cantrecib'] : '';
$cantpedido=(isset($_POST['cantpedido']))? $_POST['cantpedido'] : '';
$merma=(isset($_POST['merma']))? $_POST['merma'] : '' ;
$buenos=(isset($_POST['buenos']))? $_POST['buenos'] : '' ;
$ajuste=(isset($_POST['ajuste']))? $_POST['ajuste'] : '' ;
$defectos=(isset($_POST['defectos']))? $_POST['defectos'] : '' ;
$entregados=(isset($_POST['entregados']))? $_POST['entregados'] : '' ;
$mermaent=(isset($_POST['mermaent']))? $_POST['mermaent'] : '';
$fecha=(isset($_POST['fecha']))? $_POST['fecha'] : '';
$hora=(isset($_POST['hora']))? $_POST['hora'] : '';
$producto=(isset($_POST['producto']))? $_POST['producto'] : '';

if ($action=='exit') {
	$query="UPDATE procesos SET avance=3 WHERE id_orden=$idorden AND id_proceso='$proceso'";
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