<?php
require('../saves/conexion.php');
$machineId=$_POST['maquina'];

$maquinas="SELECT nommaquina, idmaquina FROM maquina";
$n_maquinas=$mysqli->query($maquinas);
$usuarios="SELECT * FROM elementos ORDER BY nombre_elemento ASC";
$n_usuarios=$mysqli->query($usuarios);
$getSaved="SELECT id_elemento FROM estandares WHERE id_maquina=$machineId ORDER BY id_elemento ASC";
$saved=$mysqli->query($getSaved);

while($rowu=mysqli_fetch_assoc($n_usuarios)){
        $disponibles[]=$rowu['id_elemento'];
        $nombres[$rowu['id_elemento']]=$rowu['nombre_elemento'];
}

if ($saved->num_rows>0) {
  while($rows=mysqli_fetch_assoc($saved)){
        $savedstands[]=$rows['id_elemento'];
}
}else{
  $savedstands[]='';
}

$faltantes=array_diff($disponibles, $savedstands);

?>


    <option disabled="true" >Elemento</option>
    <?php foreach($faltantes as $key=>$faltante){ ?>
    <option value="<?=$faltante?>"><?php echo $nombres[$faltante]; ?></option>
    <?php } ?>
  