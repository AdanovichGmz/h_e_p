<?php 
require('classes/functions.class.php');
  $log = new Functions();
 require('saves/conexion.php');
$entorno=(isset($_POST["entorno"]))? $_POST["entorno"] : 'personal';
$machineName=(isset($_POST['machine']))? $_POST['machine'] :'';

if ($entorno=='general') {
  $datos=(isset($_POST["odt"]))? explode(",",$_POST["odt"] ):''; 

$getodt=$_POST["odt"];
$maqID=$_POST["machine"]; 
$old_odt=mysqli_fetch_assoc($mysqli->query("SELECT num_odt FROM personal_process WHERE proceso_actual='$maqID' AND status='actual' "));

?> <form id="tareas" action="opp.php" method="post" >
                  <input type="hidden" name="machine" value="<?=$machineName; ?>">
                  <input type="hidden" name="init" value="true">
                <input type="hidden" name="anterior" value="<?=$old_odt['num_odt'] ?>">
                 <input type='hidden' id='returning' name="returning" value="<?=implode(",", $datos); ?>">
                 
                  <?php
                    
                     $process=($machineName=='Serigrafia2'||$machineName=='Serigrafia3')?'Serigrafia':(($machineName=='Suaje2')? 'Suaje' : $machineName );
                    $q="SELECT  o.idorden AS id_orden,o.numodt AS num_odt,o.fechafin,o.fechareg,o.producto,p.id_proceso,p.avance,(SELECT orden_display FROM personal_process WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM personal_process WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o LEFT JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$process' AND o.numodt='$getodt' AND avance NOT IN('completado') order by fechafin asc LIMIT 12";
                      $query = $mysqli->query($q);
                      $i=1;
                      
                      while ($valores = mysqli_fetch_array($query)) {
                        
                      $prod=$valores['producto'];
                      $element_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$prod";
                      $get_elem=mysqli_fetch_assoc($mysqli->query($element_query));
                      $element=$get_elem['nombre_elemento'];
                     ?>
                        <div id="<?=$i ?>" style="text-transform: uppercase;"  class="rect-button-small radio-menu-small face    <?=($valores['status']=='actual')? 'face-osc': '' ; ?>" onclick="showLoad(); selectOrders(this.id,'<?=$valores['num_odt'] ?>')">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="odetes[]" value="<?=$valores['num_odt']; ?>">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="datos[]"  value="<?=$valores['id_orden'] ?>"  >
                        
                       
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="idpro[]"  value="<?=$valores['id_proceso'] ?>"  >
                          <p class="elem" ><?php echo  trim($element); ?></p>
                          <p class="product" style="display: none;"><?= $valores['num_odt']?></p>
                        </div>
                       
                        <?php $i++; } ?>
                        
                          <input type='hidden' id='returning2' name="returning2" value="<?php echo  (isset($element))? trim($element) :'';; ?>">
                         
</form>
                        </div> 
 <?php # termina general
}elseif ($entorno=='virtual') {
 
 $vodt=strtoupper ($_POST['virtualodt']);
 $velem=ucfirst($_POST['virtualelem']);
 $videlem=(!empty($_POST['idelem']))? $_POST['idelem']:'null';
 $plans=(isset($_POST['plans']))? $_POST['plans']:'null';
 $machineName=$_POST['machine'];
 
  $process=($machineName=='Serigrafia2'||$machineName=='Serigrafia3')?'Serigrafia':(($machineName=='Suaje2')? 'Suaje' : $machineName );
 
 $clean=$mysqli->query("DELETE FROM personal_process WHERE proceso_actual='$machineName'");
 if ($clean) {
   $addvirtual=$mysqli->query("INSERT INTO `personal_process` (`id_pp`, `id_orden`, `num_odt`, `proceso_actual`, `id_proceso`, `status`, `orden_display`, `elemento_virtual`,id_elemento_virtual,planillas_de) VALUES (NULL, NULL, '$vodt', '$machineName', NULL, 'actual', 1, '$velem',$videlem,$plans)");
   //$inquery="INSERT INTO `personal_process` (`id_pp`, `id_orden`, `num_odt`, `proceso_actual`, `id_proceso`, `status`, `orden_display`, `elemento_virtual`,id_elemento_virtual) VALUES (NULL, NULL, '$vodt', '$machineName', NULL, 'actual', 1, '$velem',$videlem)";
   if ($addvirtual) {
    $getvirtual=$mysqli->query("SELECT * FROM personal_process WHERE proceso_actual='$machineName' ORDER BY orden_display ASC");
    while ($valores = mysqli_fetch_array($getvirtual)) {
     $getprocessId=$mysqli->query("SELECT idmaquina FROM maquina WHERE nommaquina='$process'");
    $procId=mysqli_fetch_assoc($getprocessId);
    $vi=1;
   ?>
    <div id="<?=$vi ?>" style="text-transform: uppercase;"  class="rect-button-small radio-menu-small face    <?=($valores['status']=='actual')? 'face-osc': '' ; ?>" onclick="showLoad(); selectOrders(this.id,'<?=$valores['num_odt'] ?>')">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="odetes[]" value="<?=$valores['num_odt']; ?>">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="datos[]"  value="<?=$valores['id_orden'] ?>"  >
                        
                       
                       
                          <p class="elem" style="<?=(strlen(trim($valores['elemento_virtual']))>16)? 'font-size: 15px; line-height: 18px!important;' : ''; ?>"><?= trim($valores['elemento_virtual']); ?></p>
                          <p class="product" style="display: none;"><?= $valores['num_odt']?></p>
                        </div>
                         <input type='hidden' id='returning' name="returning" value="<?=$valores['num_odt']; ?>">
                        <input type='hidden' id='returning2' name="returning2" value="<?=$valores['elemento_virtual']; ?>">
                          <input type='hidden' id='returning3' name="returning3"    value="virtual">
                          <input type='hidden' id='returning4' name="returning3"    value="<?=$videlem ?>">
   <?php
   $vi++;
 }
   }else{
    echo "ocurrio un error     ";
    printf($mysqli->error);
    //echo $inquery;
   }
 }



}else{
  //************************************************************
  function searchArrayKeyVal($sKey, $id, $array) {
   foreach ($array as $key => $val) {
       if ($val[$sKey] == $id) {
           return $key;
       }
   }
   return false;
}
 function move_to_top($array, $key) {
    $temp = array($key => $array[$key]);
    unset($array[$key]);
    $array = $temp + $array;
  }
  $initial=$_POST['init'];
  $maqID=$_POST['machine'];
$datosflow=(isset($_POST["odetes"]))? $_POST["odetes"]:''; 
$odetesflow=(isset($_POST["odetes"]))? $_POST["odetes"]:'';
if ($initial=='true') {
  $log->lwrite('si entro','PRIMERA_VEZ');
  $log->lclose();
foreach ($datosflow as $datoflow) {
  $results4flow[]=$datoflow;
}
$getodtflow=$odetesflow[0];
 $timesflow=count($datosflow);

//$processID=($maqID==20||$maqID==21)?10:$maqID;

 $process=($maqID=='Serigrafia2'||$maqID=='Serigrafia3')?'Serigrafia':(($maqID=='Suaje2')? 'Suaje' : $maqID );

$sqlflow="SELECT o.numodt FROM ordenes o INNER JOIN procesos p WHERE p.nombre_proceso='$process'  GROUP BY o.numodt";
$sql2flow="SELECT * FROM odt_flujo WHERE proceso='$process' order by orden_display ASC";




$initqueryflow="SELECT COUNT(*) AS conteo FROM odt_flujo WHERE proceso='$process'";
                      $initialflow = mysqli_fetch_assoc($mysqli->query($initqueryflow));
                      $initflow=$initialflow['conteo'];
                      $finflow=($initflow>0)? $sql2flow : $sqlflow;
                      $resultflow=$mysqli->query($finflow);
                      $iflow=1;
                     
                 
while($arrflow=mysqli_fetch_assoc($resultflow)){
  $resultsflow[$iflow] = $arrflow;
  $iflow++;
}
//echo count($results);


$querycleanflow="DELETE FROM odt_flujo WHERE proceso='$maqID'";

$cleanFlow=$mysqli->query($querycleanflow);
if ($cleanFlow) {
  
}else{
  printf($mysqli->error);
}
$i2flow=1;
foreach ($resultsflow as $rowflow) {
$numodtflow=$rowflow['numodt'];
 
 $ordflow=$i2flow;
 
$querystflow="INSERT INTO odt_flujo(id_flujo,numodt,proceso,status,orden_display) VALUES(null,'$numodtflow','$maqID','programado',$ordflow)";
$inserted=$mysqli->query($querystflow);
if (!$inserted) {
  printf($mysqli->error);
}else{

}
 

$i2flow++;
}




$i0flow=0;
$sql3flow="SELECT * FROM odt_flujo WHERE proceso='$maqID' order by orden_display asc";
$ords2flow=$mysqli->query($sql3flow);

while($arr2flow=mysqli_fetch_assoc($ords2flow)) {
  
  $results2flow[$i0flow] = $arr2flow;
  $i0flow++;
}


$totalflow=count($results2flow);

//print_r($datos);

$actualesflow = array_slice($results2flow, 0, $timesflow);
$siguientesflow = array_slice($results2flow, $timesflow, $totalflow);


foreach ($datosflow as $ordenflow) {
  
  $arrayKeyflow = searchArrayKeyVal("numodt", $ordenflow, $results2flow);
if ($arrayKeyflow!==false) {
    $theKeyflow= $arrayKeyflow;
     $tempflow[]=$results2flow[$theKeyflow];
     $keysflow[]=$arrayKeyflow;
} else {
    echo "No se encontro ".$ordenflow." ";
}
}

foreach ($keysflow as $keyflow) {
 unset($results2flow[$keyflow]);
}



$results3flow=array_merge($tempflow,$results2flow);

 
/*
unset($results3[$theKey]);
array_unshift($results3, $temp);
 */
//Guardando orden de display
$i3flow=1;

foreach ($results3flow as $row2flow) {
 
  $idflow=$row2flow['id_flujo'];
 
   
 $update3flow = "UPDATE odt_flujo SET orden_display = $i3flow WHERE id_flujo= $idflow ";
$mysqli->query($update3flow);
$i3flow++;
}

//Guardando estatus siguientes
$i4flow=1;

foreach ($results2flow as $row3flow) {
 
  $idflow=$row3flow['id_flujo'];
  
    if ($i4flow==1) {
      $statusflow='siguiente';
    }
    elseif ($i4flow==2) {
     $statusflow='preparacion';
    }     
    else{ 
      $progNumflow=$i4flow-2;
      $statusflow='programado'.$progNumflow;
    }
 $update3flow = "UPDATE odt_flujo SET status='$statusflow' WHERE id_flujo= $idflow";
$mysqli->query($update3flow);
$i4flow++;
}
//Guardando estatus actuales
$i5flow=1;
foreach ($tempflow as $row4flow) {
 
  $idflow=$row4flow['id_flujo'];
  
 $update3flow = "UPDATE odt_flujo SET status='actual' WHERE id_flujo= $idflow ";
$mysqli->query($update3flow);
$i5flow++;
}
} else{$log->lwrite('no entro','PRIMERA_VEZ');
          $log->lclose();}

  //*************************************************
$datos=$_POST["datos"]; 

$oldOdt=(isset($_POST["anterior"]))? $_POST["anterior"] : '';
$maqID=$_POST["machine"]; 
$idpro=$_POST["idpro"];
$odetes=$_POST['odetes'];
foreach ($datos as $dato) {
  $results4[]=$dato;
}
$getodt=$odetes[0];
 $times=count($datos);

 $process=($maqID=='Serigrafia2'||$maqID=='Serigrafia3')?'Serigrafia':(($maqID=='Suaje2')? 'Suaje' : $maqID );
$sql="SELECT o.*, pp.*,(SELECT producto FROM ordenes WHERE idorden=pp.id_orden) AS producto,p.nombre_proceso FROM personal_process pp INNER JOIN procesos p ON pp.id_proceso=p.id_proceso INNER JOIN ordenes o ON o.idorden=pp.id_orden WHERE proceso_actual='$machineName' AND nombre_proceso='$process' order by orden_display asc";

$sql2="SELECT o.idorden,o.numodt,o.orden,p.id_proceso,(SELECT status FROM personal_process WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status,(SELECT orden_display FROM personal_process WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS display FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$process' AND o.numodt='$getodt'  order by display ASC";

$initquery="SELECT COUNT(*) AS conteo FROM personal_process WHERE proceso_actual='$machineName'";
                      $initial_ = mysqli_fetch_assoc($mysqli->query($initquery));
                      $init_=$initial_['conteo'];
                      if ($oldOdt!='') {
                        
                      if ($getodt==$oldOdt) {
                         $fin=($init_>0)? $sql : $sql2;
                                           
                      } else{
                        $fin=$sql2; 
                        
                      }                     
                      }else{
                        $fin=($init_>0)? $sql : $sql2;
                      }

                      $result=$mysqli->query($fin);
                      $i=1;
                     
           
while($arr=mysqli_fetch_assoc($result)){
  $results[$i] = $arr;
  $i++;
}


$queryclean="DELETE FROM personal_process WHERE proceso_actual='$maqID'";
$mysqli->query($queryclean);

$i2=1;
foreach ($results as $row) {
$numodt=$row['numodt'];
  $id=$row['idorden'];
 $ord=($row['orden']!=null)?$row['orden'] : $i2;
 $idpr=$row['id_proceso'];
$queryst="INSERT INTO personal_process(id_pp,id_orden,num_odt,proceso_actual,id_proceso,status,orden_display) VALUES(null,$id,'$numodt','$maqID',$idpr,'programado',$ord)";

if (!$mysqli->query($queryst)) {
  printf($mysqli->error);
}
 

$i2++;
}




$i0=0;
$sql2="SELECT * FROM personal_process WHERE proceso_actual='$maqID' order by orden_display asc";
$ords2=$mysqli->query($sql2);

while($arr2=mysqli_fetch_assoc($ords2)) {
  
  $results2[$i0] = $arr2;
  $i0++;
}


$total=count($results2);

//print_r($datos);

$actuales = array_slice($results2, 0, $times);
$siguientes = array_slice($results2, $times, $total);




foreach ($datos as $orden) {
  $arrayKey = searchArrayKeyVal("id_orden", $orden, $results2);
if ($arrayKey!==false) {
    $theKey= $arrayKey;
     $temp[]=$results2[$theKey];
     $keys[]=$arrayKey;
} else {
    echo "No se encontro ".$orden."  ";
}
}

foreach ($keys as $key) {
 unset($results2[$key]);
}



$results3=array_merge($temp,$results2);

 
/*
unset($results3[$theKey]);
array_unshift($results3, $temp);
 */
//Guardando orden de display
$i3=1;
foreach ($results3 as $row2) {
 
  $id=$row2['id_orden'];
  $idprs=$row2['id_proceso'];
   
 $update3 = "UPDATE personal_process SET orden_display = $i3 WHERE id_orden= $id AND id_proceso=$idprs";
$mysqli->query($update3);
$i3++;
}

//Guardando estatus siguientes
$i4=1;
foreach ($results2 as $row3) {
 
  $id=$row3['id_orden'];
  $idprs=$row3['id_proceso'];
    if ($i4==1) {
      $status='siguiente';
    }
    elseif ($i4==2) {
     $status='preparacion';
    }     
    else{ 
      $progNum=$i4-2;
      $status='programado'.$progNum;
    }
 $update3 = "UPDATE personal_process SET status='$status' WHERE id_orden= $id AND id_proceso=$idprs";
$mysqli->query($update3);
$i4++;
}
//Guardando estatus actuales
$i5=1;
foreach ($temp as $row4) {
 
  $id=$row4['id_orden'];
  $idprs=$row4['id_proceso'];
    
 $update3 = "UPDATE personal_process SET status='actual' WHERE id_orden= $id AND id_proceso=$idprs";
$mysqli->query($update3);
$i5++;
}

    $resultado=true;
    if ( $resultado) {
?>
            
                <input type="hidden" name="init" value="false">
                  <input type="hidden" name="machine" value="<?=$maqID; ?>">
                 <input type='hidden' id='returning' name="returning" value="<?=implode(",", $odetes); ?>">
                 
                  <?php
                    $q="SELECT pp.*,(SELECT producto FROM ordenes WHERE idorden=pp.id_orden) AS producto,p.nombre_proceso FROM personal_process pp INNER JOIN procesos p ON pp.id_proceso=p.id_proceso WHERE proceso_actual='$machineName' AND nombre_proceso='$process' order by orden_display asc";
                      $query = $mysqli->query($q);
                      
                      $i=1;
                      while ($valores = mysqli_fetch_array($query)) {
                        
                      $prod=$valores['producto'];
                      $element_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$prod";
                      $get_elem=mysqli_fetch_assoc($mysqli->query($element_query));
                      $element=(isset($get_elem['nombre_elemento']))? $get_elem['nombre_elemento'] : '';
                     ?>
                        <div id="<?=$i ?>" style="text-transform: uppercase;"  class="rect-button-small radio-menu-small face    <?=($valores['status']=='actual')? 'face-osc': '' ; ?>" onclick="showLoad(); selectOrders(this.id,'<?=$valores['num_odt'] ?>')">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="odetes[]" value="<?=$valores['num_odt']; ?>">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="datos[]"  value="<?=$valores['id_orden'] ?>"  >
                        
                       
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="idpro[]"  value="<?=$valores['id_proceso'] ?>"  >
                          <p class="elem" ><?php echo  trim($element); ?></p>
                          <p class="product" style="display: none;"><?= $valores['num_odt']?></p>
                        </div>
                       
                        <?php $i++; } 
                        $getActual=mysqli_fetch_assoc($mysqli->query("SELECT pp.*,(SELECT producto FROM ordenes WHERE idorden=pp.id_orden) AS element,(SELECT nombre_elemento FROM elementos WHERE id_elemento=element) AS nom_element FROM personal_process pp WHERE proceso_actual='$machineName' AND status='actual'"));
                       
                        ?>
                        
                          <input type='hidden' id='returning2' name="returning2" value="<?=$getActual['nom_element']; ?>">
                          <input type='hidden' id='returning3' name="returning3"    value="<?=$getActual['id_orden'] ?>">

<?php
 }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
        }

          
?>

