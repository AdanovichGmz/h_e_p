<?php
ini_set("session.gc_maxlifetime","7200");  
        session_start();
     
        

require('saves/conexion.php');
require('classes/functions.class.php');
  $log = new Functions();
  $section=$_POST['section'];
   if ($section=='asaichi') {

   
       $tiempo=$_POST['tiempo'];
        $mac=$_POST['mac'];
        $logged_in=$_SESSION['id'];
        $horadeldia=$_POST['horadeldia'];
        $fechadeldia=$_POST['fechadeldia'];
        
        $machineID=$_SESSION['machineID'];
        $machineName=$_SESSION['machineName'];
       
        $query="INSERT INTO asaichi (tiempo, id_maquina, id_usuario, horadeldia, fechadeldia) VALUES ('$tiempo',$machineID,$logged_in,'$horadeldia','$fechadeldia')";
        $resultado=$mysqli->query($query);
        if ($resultado) {
          echo "Todo bien";
        }else{
          
          $log->lwrite('asaichi','multi-error');
          $log->lwrite(printf($mysqli->error),'multi-error');
          $log->lwrite($query,'multi-error');
          $log->lclose();
        }

     }
     elseif ($section=='ajuste') {
      print_r($_POST);
       $tiempo      = $_POST['tiempo'];
        $nommaquina  = $_SESSION['machineName'];
        $userID   = $_SESSION['id'];
        $horadeldia  = $_POST['horadeldia'];
        $fechadeldia = $_POST['fechadeldia'];
        $machineID=$_SESSION['machineID'];
        $machineName=$_SESSION['machineName'];
        //$odetes= explode(',',$_POST['orderodts']);
        $actuals_query="SELECT  os.status, o.idorden,o.numodt, os.proceso_actual FROM orden_estatus os INNER JOIN ordenes o on os.id_orden=o.idorden WHERE status='actual' AND proceso_actual='$machineName'";
        $resultodt=$mysqli->query($actuals_query);
        //$numodt      = (isset($_POST['numodt'])) ? explode(',', substr($_POST['numodt'], 0, -1)) : '';
        while($arr=mysqli_fetch_assoc($resultodt)){
          $numodt[] = $arr['idorden'];
          $odt[]=$arr['numodt'];
        }
        $odetes=implode(",", $odt);
        foreach ($numodt as $odt) {
            
            $query     = "INSERT INTO tiraje (tiempo_ajuste, id_maquina, id_user, horadeldia_ajuste, fechadeldia_ajuste, id_orden) VALUES ('$tiempo','$machineID','$userID','$horadeldia','$fechadeldia', $odt)";
            $resultado = $mysqli->query($query);
            if ($resultado) {
        } else {
            printf($mysqli->error);
             $log->lwrite('ajuste','multi-error');
             $log->lwrite('error al insertar ajuste','multi-error');
             $log->lwrite('orden'.$odt,'multi-error');
              $log->lwrite(printf($mysqli->error),'multi-error');
              $log->lwrite($query,'multi-error');
              $log->lclose();
        }
        }
       
     } 
      elseif ($section=='tiraje') {
            
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
            $horadeldia=$_POST['hour'];
            $merma_entregada=$_POST['merma-entregada'];
            $passmerma=$merma-($merma_entregada+$defectos+$ajuste);
            $element=$_POST['element'];
    
           
            $userID = $_SESSION['id'];
            
            $seconds = strtotime("1970-01-01 $tiempoTiraje UTC");
            
           
            $machineID = $_SESSION['machineID'];
            $machineName = $_SESSION['machineName'];

            $standar_query2 = "SELECT * FROM estandares WHERE id_maquina=$machineID AND id_elemento= $element";
            
            $getstandar     = mysqli_fetch_assoc($mysqli->query($standar_query2));
            $estandar       = $getstandar['piezas_por_hora'];
            //calculando desempeño para pieza actual
            $tiraje_estandar=($seconds*$estandar)/3600;
            
            $tiraje_desemp=($entregados*100)/$tiraje_estandar;
            echo $standar_query2;
            $_query="select MAX(idtiraje) as last FROM tiraje";
            $hora=$_POST['hour'];
            $getLast = mysqli_fetch_assoc($mysqli->query($_query));
            $lastId=$getLast['last'];
            $query="UPDATE tiraje set producto='$producto', pedido='$pedido', cantidad=$cantidad, buenos=$buenos, defectos=$defectos, merma=$merma,piezas_ajuste=$ajuste, merma_entregada=$merma_entregada, entregados=$entregados, tiempoTiraje='$tiempoTiraje', fechadeldia_tiraje='$fechadeldia', horadeldia_tiraje='$horadeldia', id_user=$logged_in,desempenio=$tiraje_desemp WHERE horadeldia_ajuste='$hora'  AND id_maquina=$machineID AND id_orden=$numodt";

           

            $resultado=$mysqli->query($query);
            $querymerma="UPDATE ordenes SET merma_entregada=$merma_entregada, merma_recibida=$passmerma WHERE idorden=$numodt";
            $mysqli->query($querymerma);
            if ( $resultado) {

            $_GET['mivariable'] = $nombremaquina;

            //include("encuesta.php");

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
              $log->lwrite('tiraje','multi-error');
             $log->lwrite('error al establecer estatus','multi-error');
             $log->lwrite('orden'.$id,'multi-error');
              $log->lwrite(printf($mysqli->error),'multi-error');
              $log->lwrite($update3,'multi-error');
              $log->lclose();

            }
            $i3++;
            }


            }else{
                        printf($mysqli->error);
                        echo $query;
                        $log->lwrite('tiraje single','multi-error');
                       $log->lwrite('error al completar ajustes con tirajes','multi-error');
                       $log->lwrite('orden'.$numodt,'multi-error');
                        $log->lwrite(printf($mysqli->error),'multi-error');
                        $log->lwrite($query,'multi-error');
                        $log->lclose();
                      }
            } elseif ($_POST['qty']=='multi') {
              print_r($_POST);
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
              $logged=$_SESSION['id'];
              $fecha=$_POST['fechadeldia'];
              $mac_maquina=$_POST['nombremaquina'];
              $horasdeldia=$_POST['horadeldia'];
              $numodt=$_POST['numodt'];
              $odt=$_POST['odt'];
                 $seconds = strtotime("1970-01-01 $tiempotiraje UTC");          
              $log->lwrite('Ordenes guardadas','multi');
              $log->lwrite($odetes,'multi');
              $log->lclose();

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
                
                
               
                
                $machineID = $_SESSION['machineID'];
                $machineName = $_SESSION['machineName'];
                
                 $standar_query2 = "SELECT * FROM estandares WHERE id_maquina=$machineID AND id_elemento= $producto";
            
            $getstandar     = mysqli_fetch_assoc($mysqli->query($standar_query2));
            $estandar       = $getstandar['piezas_por_hora'];
            //calculando desempeño para pieza actual
            $tiraje_estandar=($seconds*$estandar)/3600;
            
            $tiraje_desemp=($entregados*100)/$tiraje_estandar;
            echo $standar_query2;
                $query="UPDATE tiraje set producto='$producto', pedido='$pedido', cantidad=$cantidad, buenos=$buenoss, defectos=$defecto, merma=$merma,piezas_ajuste=$ajust, merma_entregada=$merma_entregada, entregados=$entregados, tiempoTiraje='$tiempotiraje', fechadeldia_tiraje='$fecha', horadeldia_tiraje='$horasdeldia',desempenio=$tiraje_desemp, id_user=$logged WHERE horadeldia_ajuste='$hora'  AND id_maquina=$machineID AND id_orden=$key";
                $inserted=$mysqli->query($query);
                  if ($inserted) {
                    
                  }
                  else{
                    printf($mysqli->error);
                    echo "<pre>";
                    print_r($_POST);
                    echo "</pre>";
                    echo $query;
                    $log->lwrite('tiraje multi','multi-error');
                       $log->lwrite('error al completar ajustes con tirajes','multi-error');
                       $log->lwrite('orden'.$key,'multi-error');
                        $log->lwrite(printf($mysqli->error),'multi-error');
                        $log->lwrite($query,'multi-error');
                        $log->lclose();

                  }
              }
                //include("encuesta.php");

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




     } 
      elseif ($section=='encuesta') {

        print_r($_POST);
        
        $horadeldia=$_POST['horadeldia'];
        $fechadeldia=$_POST['fechadeldia'];
        $desempeno=$_POST['desempeno'];
        $problema= (isset($_POST['problema'])) ?$_POST['problema'] : '';
        $calidad=$_POST['calidad'];
        $problema2=(isset($_POST['problema2'])) ?$_POST['problema2'] : '';
        $odt=$_POST['odt'];
        $observaciones=$_POST['observaciones'];
        $lastOrder=$_POST['idorden'];

        
        $userID = $_SESSION['id'];
        
        $machineID = $_SESSION['machineID'];
        $machineName = $_SESSION['machineName'];

        $query="INSERT INTO encuesta (id_usuario, id_maquina, horadeldia, fechadeldia, desempeno, problema, calidad, problema2, observaciones) VALUES ('$userID','$machineID','$horadeldia','$fechadeldia','$desempeno','$problema','$calidad','$problema2','$observaciones')";


        $resultado=$mysqli->query($query);
        if ( $resultado) {
          /*
          function is_in_array($needle, $haystack) {
            foreach ($needle as $stack) {if (in_array($stack, $haystack)) { return true;} }
            return false;
        } */
        function is_in_array($needle, $haystack) {

            foreach ($needle as $stack) {

                if (in_array($stack, $haystack)) {
                     return true;
                }
            }

            return false;
        }
          if ($_POST['qty']=='multi') {
            $arr_odetes=explode(',', $odt);
            foreach (explode(',',$lastOrder) as $key => $order) {
              $arr_odt=$arr_odetes[$key];
          $queryavance="UPDATE procesos SET estatus=1, avance=4 WHERE id_orden=$order AND nombre_proceso='$machineName'";
        $mysqli->query($queryavance);
        $query_deliv="SELECT avance FROM procesos WHERE numodt='$arr_odt' AND id_orden=$order ";

        $deliv=$mysqli->query($query_deliv);
        while($arrd=mysqli_fetch_array($deliv)) { $deliver[] = $arrd['avance']; }
        $b = array('inicio','en pausa','retomado');

        $is_complete=is_in_array($b, $deliver);
        
        if ($is_complete==false) {
          $querydeliv="UPDATE ordenes SET entregado='true' WHERE idorden=$lastOrder";
        $mysqli->query($querydeliv);
        }
        }
        $queryOrden="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
        $asoc=($mysqli->query($queryOrden));
        while($getAct=mysqli_fetch_assoc($asoc)){
          $getActODT[] = $getAct['numodt'];
          $ordenActual[] = $getAct['idorden'];
          
        }
        if( !session_id() ){ session_start(); }
        if(@$_SESSION['logged_in'] != true){
            echo '
            <script>
                alert("tu no estas autorizado para entrar a esta pagina");
                self.location.replace("index.php");
            </script>';
        }

        }
        else{

        $queryavance="UPDATE procesos SET estatus=1, avance=4 WHERE id_orden=$lastOrder AND nombre_proceso='$machineName'";
        $mysqli->query($queryavance);

        $query_deliv="SELECT avance FROM procesos WHERE numodt='$odt' AND id_orden=$lastOrder ";
        $deliv=$mysqli->query($query_deliv);
        if (!$deliv) {
         printf($mysqli->error);
         echo $query_deliv;
         $log->lwrite('encuesta multi','multi-error');
                       $log->lwrite('error al actualizar avance','multi-error');
                       $log->lwrite('orden'.$lastOrder,'multi-error');
                        $log->lwrite(printf($mysqli->error),'multi-error');
                        $log->lwrite($query_deliv,'multi-error');
                        $log->lclose();
        }
        

        while($arrd=mysqli_fetch_array($deliv)) {
          $deliver[] = $arrd['avance'];
          
        }

        $b = array('inicio','en pausa','retomado');
        echo $query_deliv;

        $is_complete=is_in_array($b, $deliver);
       
        if ($is_complete==false) {
          $querydeliv="UPDATE ordenes SET entregado='true' WHERE idorden=$lastOrder";
        $mysqli->query($querydeliv);
        }


        $queryOrden="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
        $asoc=($mysqli->query($queryOrden));
        //$ordenActual = $getAct['numodt'];

        while($getAct=mysqli_fetch_assoc($asoc)){
          $getActODT[] = $getAct['numodt'];
          $ordenActual[] = $getAct['idorden'];
          
        }

        if( !session_id() )
        {
            session_start();
            

        }
        if(@$_SESSION['logged_in'] != true){
            echo '
            <script>
                alert("tu no estas autorizado para entrar a esta pagina");
                self.location.replace("index.php");
            </script>';
        }else{
        //echo $_SERVER['HTTP_HOST'];
        //header("Location: http://{$_SERVER['SERVER_NAME']}/unify/index2.php");
        }

        }

         }else{
                    printf("Errormessage: %s\n", $mysqli->error);
                  }
       
     }
     elseif ($section=='restart') {
               
        

        

     }  

?>

