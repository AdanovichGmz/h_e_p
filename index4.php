<?php
date_default_timezone_set("America/Mexico_City");
require('saves/conexion.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_POST['qty']=='single') {
 
$producto=(isset($_POST['producto'])) ?$_POST['producto'] : '';
$numodt=(isset($_POST['numodt'])) ?$_POST['numodt'] : '';
$logged_in=$_POST['logged_in'];
$nombremaquina=$_POST['nombremaquina'];
$odt=$_POST['odt'];
$pedido=(isset($_POST['pedido'])) ?$_POST['pedido'] : '';
$cantidad=(isset($_POST['cantidad'])) ?$_POST['cantidad'] : '';
$buenos=(isset($_POST['buenos'])) ?$_POST['buenos'] : '';
$defectos=(isset($_POST['defectos'])) ?$_POST['defectos'] : '';
$merma=($_POST['merma']!=null)? $_POST['merma'] : 0;
$ajuste=$_POST['piezas-ajuste'];
$entregados=$_POST['entregados'];
$tiempoTiraje=$_POST['tiempoTiraje'];
$fechadeldia=$_POST['fechadeldia'];
$horadeldia=$_POST['horadeldia'];
$merma_entregada=$_POST['merma-entregada'];
$passmerma=$merma-($merma_entregada+$defectos+$ajuste);
$query2="SELECT id FROM login WHERE logged_in='$logged_in'";
$query4="SELECT idmaquina,nommaquina FROM maquina WHERE mac='$nombremaquina'";
$getID = mysqli_fetch_assoc($mysqli->query($query2));
$userID = $getID['id'];

$getMachine = mysqli_fetch_assoc($mysqli->query($query4));
$machineID = $getMachine['idmaquina'];
$machineName = $getMachine['nommaquina'];
$_query="select MAX(idtiraje) as last FROM tiraje";
$hora=$_POST['hour'];
$getLast = mysqli_fetch_assoc($mysqli->query($_query));
$lastId=$getLast['last'];
$query="UPDATE tiraje set producto='$producto', pedido='$pedido', cantidad=$cantidad, buenos=$buenos, defectos=$defectos, merma=$merma,piezas_ajuste=$ajuste, merma_entregada=$merma_entregada, entregados=$entregados, tiempoTiraje='$tiempoTiraje', fechadeldia_tiraje='$fechadeldia', horadeldia_tiraje='$horadeldia', id_user=$logged_in WHERE horadeldia_ajuste='$hora'  AND id_maquina=$machineID AND id_orden=$numodt";

echo "merma_entregada ".$merma_entregada." defectos ".$defectos." ajuste ".$ajuste;
print_r($_POST);

$resultado=$mysqli->query($query);
$querymerma="UPDATE ordenes SET merma_entregada=$merma_entregada, merma_recibida=$passmerma WHERE idorden=$numodt";
$mysqli->query($querymerma);
if ( $resultado) {

$_GET['mivariable'] = $nombremaquina;

include("encuesta.php");

$cleanquery="DELETE FROM orden_estatus WHERE proceso_actual='$machineName' AND status='actual'";
$clean=$mysqli->query($cleanquery);
if ($clean) {
 $sql="SELECT * FROM orden_estatus WHERE proceso_actual='$machineName' order by orden_display asc";
$ords=$mysqli->query($sql);
}

$i=1;


while($arr=mysqli_fetch_array($ords)) {
  
  $results[$i] = $arr;
  $i++;
}

$i3=1;

foreach ($results as $row2) {
 
  $id=$row2['id_orden'];
  $old_status=$row2['status'];
  $idprs=$row2['id_proceso'];
    if ($old_status=='siguiente') {
     $status='actual';
    }
     elseif ($old_status=='preparacion') {
      $status='siguiente';
    }
    elseif ($old_status=='programado1') {
      $status='preparacion';
    }
    else{ 
      $progNum=$i3-3;
      $status='programado'.$progNum;
    }
 $update3 = "UPDATE orden_estatus SET orden_display = $i3 , status='$status' WHERE id_orden= $id AND id_proceso=$idprs";
$upd= $mysqli->query($update3);
if ($upd) {
 echo "todo bien";
}else{
  prinf($mysqli->error);
}
$i3++;
}


}else{
            printf($mysqli->error);
            echo $query;
          }
} elseif ($_POST['qty']=='multi') {

  $hora=$_POST['hour'];
  $buenos=$_POST['buenos'];
  $defectos=$_POST['defectos'];
  $ajuste=$_POST['ajuste'];
  $productos=$_POST['productos'];
  $odetes=$_POST['odetes'];
  $mermasrecib=$_POST['mermasrecib'];
  $mermasent=$_POST['mermasent'];
  $recibidos=$_POST['recibidos'];
  $pedidos=$_POST['pedidos'];
  $tiempotiraje=$_POST['tiempoTiraje'];
  $logged=$_POST['logged_in'];
  $fecha=$_POST['fechadeldia'];
  $mac_maquina=$_POST['nombremaquina'];
  $horasdeldia=$_POST['horadeldia'];
  $numodt=$_POST['numodt'];
  $odt=$_POST['odt'];
  foreach ($buenos as $key =>$bueno) {

    $producto=$productos[$key];
    $pedido=$pedidos[$key];
    $cantidad=$recibidos[$key];
    $buenoss=$buenos[$key];
    $defecto= $defectos[$key];
    $merma= $mermasrecib[$key];
    $ajust= $ajuste[$key];
    $merma_entregada= $mermasent[$key];
    $entregados= $buenos[$key];
    
    
   
    $query4="SELECT idmaquina,nommaquina FROM maquina WHERE mac='$mac_maquina'";
    $getMachine = mysqli_fetch_assoc($mysqli->query($query4));
    $machineID = $getMachine['idmaquina'];
    $machineName = $getMachine['nommaquina'];
    

    $query="UPDATE tiraje set producto='$producto', pedido='$pedido', cantidad=$cantidad, buenos=$buenoss, defectos=$defecto, merma=$merma,piezas_ajuste=$ajust, merma_entregada=$merma_entregada, entregados=$entregados, tiempoTiraje='$tiempotiraje', fechadeldia_tiraje='$fecha', horadeldia_tiraje='$horasdeldia', id_user=$logged WHERE horadeldia_ajuste='$hora'  AND id_maquina=$machineID AND id_orden=$key";
    $inserted=$mysqli->query($query);
      if ($inserted) {
        
      }
      else{
        printf($mysqli->error);
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        echo $query;

      }
  }
    include("encuesta.php");

        $cleanquery="DELETE FROM orden_estatus WHERE proceso_actual='$machineName' AND status='actual'";
        $clean=$mysqli->query($cleanquery);
        if ($clean) {
         $sql="SELECT * FROM orden_estatus WHERE proceso_actual='$machineName' ORDER BY orden_display ASC";
         $ords=$mysqli->query($sql);
        }

        $i=1;


        while($arr=mysqli_fetch_array($ords)) {
          
          $results[$i] = $arr;
          $i++;
        }

        $i3=1;
        print_r($results);
        foreach ($results as $row2) {
         
          $id=$row2['id_orden'];
          $old_status=$row2['status'];
          $idprs=$row2['id_proceso'];
            if ($old_status=='siguiente') {
             $status='actual';
            }
             elseif ($old_status=='preparacion') {
              $status='siguiente';
            }
            elseif ($old_status=='programado1') {
              $status='preparacion';
            }
            else{ 
              $progNum=$i3-3;
              $status='programado'.$progNum;
            }
         $update3 = "UPDATE orden_estatus SET orden_display = $i3 , status='$status' WHERE id_orden= $id AND id_proceso=$idprs";
        $upd= $mysqli->query($update3);
        if ($upd) {
         echo "todo bien";
        }else{
          prinf($mysqli->error);
        }
        $i3++;
        }

 
}
?>



