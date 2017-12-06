<?php
require('saves/conexion.php');
if (isset($_POST['maquina'])) {
$machineID=$_POST['maquina'];
$element=$_POST['elemento'];
$table_mac=(isset($_POST['tabm']))? $_POST['tabm'] : 1;


$processID=($machineID==20||$machineID==21)? 10:(($machineID==22)? 9 : $machineID );
$tiempoTiraje=(isset($_POST['tiempo']))? $_POST['tiempo'] :'00:00:00';
$seconds = strtotime("1970-01-01 $tiempoTiraje UTC");
if ($table_mac==2) {
  $def_estandar=300;
} else{
  if ($element!='') {
	 

 $standar_query2 = "SELECT * FROM estandares WHERE id_maquina=$processID AND id_elemento= $element";
            
            $getstandar     = mysqli_fetch_assoc($mysqli->query($standar_query2));
            $get_estandar       = $getstandar['piezas_por_hora'];
           
            if (is_null($get_estandar)) {
            	if ($processID==10) {
                    $def_estandar=420;
                  }else{
                    $def_estandar=600;
                    
                  }
            }else{
            	$def_estandar=$get_estandar;
            }
}else{
	if ($processID==10) {
                    $def_estandar=420;
                  }else{
                    $def_estandar=600;

                  }
}
}

            
           
            //calculando desempeño para pieza actual
            $tiraje_estandar=($seconds*$def_estandar)/3600;
            
             $prodEsperada=($tiraje_estandar>0)? round($tiraje_estandar):'<label style="color:red; font-size:11px;">Indefinido</label>';
 ?>

 <span>Produccion Esperada: <?=$prodEsperada?></span>
 <?php 
}else{
 ?>
<span>Produccion Esperada: 0</span>
 <?php
}
?>

