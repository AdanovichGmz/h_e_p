<?php
date_default_timezone_set("America/Mexico_City");
require('saves/conexion.php');
$today     = date("d-m-Y");
$hour=date("H:i:s",time());
print_r($_POST);
$user=$_POST['user'];
$ordenes=$_POST['ordenes'];
$maquina =$_POST['maquina'];
$dispon=$_POST['disponibilidad'];
$t_real=$_POST['t-real'];
$t_dispon=$_POST['t-disponible'];
$desemp=$_POST['desempenio'] ;
$p_esperada=$_POST['prod-esperada'];
$merma=$_POST['merma'];
$calidad=$_POST['calidad'];
$c_primera=$_POST['calidad-primera'] ;
$p_real=$_POST ['prod-real'];
$ete=$_POST ['ete'] ;
$query="INSERT INTO resumen_diario (`id_resumen`, `id_usuario`, `id_maquina`, `ordenes`, `disponibilidad`, `desempenio`, `calidad`, `tiempo_real`, `tiempo_disponible`, `prod_esperada`, `prod_real`, `merma`, `calidad_primera`, `porcentage_ete`, `fecha`, `hora`) VALUES (NULL, $user, $maquina, '$ordenes', $dispon, $desemp, $calidad, '$t_real', '$t_dispon', $p_esperada, $p_real, $merma, $c_primera, $ete, '$today', '$hour') ";
$inserting=$mysqli->query($query);
if ($inserting) {
  echo "resumen guardado";
}else{
  printf($mysqli->error);
  echo $query;
}




?>