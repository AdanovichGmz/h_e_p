<?php 
 require('saves/conexion.php');


$datos=$_POST["datos"]; 
$display=$_POST["display"];
 $order=($_POST["order"]==1)? 2 : $_POST["order"];
$maqID=$_POST["machine"]; 
$idpro=$_POST["idpro"];
$odetes=$_POST['odetes'];
foreach ($datos as $dato) {
  $results4[]=$dato;
}

 $times=count($datos);


$sql="SELECT o.idorden,o.orden,p.id_proceso FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$maqID'  order by idorden asc";

$sql2="SELECT o.idorden,o.orden,p.id_proceso,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$maqID' HAVING status IS NOT NULL order by idorden asc";

$initquery="SELECT COUNT(*) AS conteo FROM orden_estatus WHERE proceso_actual='$maqID'";
                      $initial = mysqli_fetch_assoc($mysqli->query($initquery));
                      $init=$initial['conteo'];
                      $fin=($init>0)? $sql2 : $sql;
                      $result=$mysqli->query($fin);
                      $i=1;
                     
                    
while($arr=mysqli_fetch_assoc($result)){
  $results[$i] = $arr;
  $i++;
}


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

$queryclean="DELETE FROM orden_estatus WHERE proceso_actual='$maqID'";
$mysqli->query($queryclean);

$i2=1;
foreach ($results as $row) {

  $id=$row['idorden'];
 $ord=($row['orden']!=null)?$row['orden'] : $i2;
 $idpr=$row['id_proceso'];
$queryst="INSERT INTO orden_estatus(id_orden_status,id_orden,proceso_actual,id_proceso,status,orden_display) VALUES(null,$id,'$maqID',$idpr,'programado',$ord)";

if (!$mysqli->query($queryst)) {
  printf($mysqli->error);
}
 

$i2++;
}




$i0=0;
$sql2="SELECT * FROM orden_estatus WHERE proceso_actual='$maqID' order by orden_display asc";
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
   
 $update3 = "UPDATE orden_estatus SET orden_display = $i3 WHERE id_orden= $id AND id_proceso=$idprs";
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
 $update3 = "UPDATE orden_estatus SET status='$status' WHERE id_orden= $id AND id_proceso=$idprs";
$mysqli->query($update3);
$i4++;
}
//Guardando estatus actuales
$i5=1;
foreach ($temp as $row4) {
 
  $id=$row4['id_orden'];
  $idprs=$row4['id_proceso'];
    
 $update3 = "UPDATE orden_estatus SET status='actual' WHERE id_orden= $id AND id_proceso=$idprs";
$mysqli->query($update3);
$i5++;
}

    $resultado=true;
    if ( $resultado) {
?>
            
                
                  <input type="hidden" name="machine" value="<?=$maqID; ?>">
                 <input type='hidden' id='returning' name="returning" value="<?=implode(",", $odetes); ?>">
                 <input type='hidden' id='returning2' name="returning2" value="<?=implode(",", $datos); ?>">
                  <?php
                      $query = $mysqli->query("SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display, (SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$maqID'  HAVING status IS NOT NULL order by orden_display asc LIMIT 12");
                      
                      while ($valores = mysqli_fetch_array($query)) {
                      $prod=$valores['producto'];
                      $element_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$prod";
                      $get_elem=mysqli_fetch_assoc($mysqli->query($element_query));
                      $element=$get_elem['nombre_elemento'];
                     ?>
                        <div id="<?=$valores['idorden'] ?>" style="text-transform: uppercase;"  class="rect-button-small radio-menu-small face    <?=($valores['status']=='actual')? 'face-osc': '' ; ?>" onclick=" sendOrder('<?=$valores['idorden'] ?>'); selectOrders(this.id,'<?=$valores['numodt'] ?>')">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="odetes[]" value="<?=$valores['numodt']; ?>">
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="datos[]"  value="<?=$valores['idorden'] ?>"  >
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="order[]"  value="<?=$valores['orden'] ?>"  >
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="display[]"  value="<?=$valores['orden'] ?>"  >
                        <input type="checkbox" <?=($valores['status']=='actual')? 'checked': '' ; ?> name="idpro[]"  value="<?=$valores['id_proceso'] ?>"  >
                          <?php echo  $valores['numodt']; ?>
                          <p class="product" ><?=$element ?></p>
                        </div>
                       
                        <?php } ?>
                        
                         

<?php
 }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }

          
?>

