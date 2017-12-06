<?php
ini_set("session.gc_maxlifetime","7200");  
session_start();
date_default_timezone_set("America/Mexico_City");     
        

require('saves/conexion.php');
require('classes/functions.class.php');

function logpost($post){
  foreach ($post as $key => $value) {
    $info.=$key.": ".$value." | ";
  }
  return $info;

}

  $log = new Functions();
  $section=$_POST['section'];
  /*********** Guardando Asaichi ***********/
   if ($section=='asaichi') {
    $log->lwrite(implode(' | ', $_POST),'ASAICHIS_'.date("d-m-Y"));
            $log->lclose();
   
       $tiempo=$_POST['tiempo'];
        $mac=$_POST['mac'];
        $logged_in=$_SESSION['id'];
        $horadeldia=$_POST['horadeldia'];
        $fechadeldia=$_POST['fechadeldia'];
        $ontime      = $_POST['ontime'];
        $machineID=$_SESSION['machineID'];
        $machineName=$_SESSION['machineName'];
        $today=date("d-m-Y");
        $horafin=date(" H:i:s", time());
        if ($ontime=='false') {
           
            $tiempoasa='"00:15:00.000000"';
             
             $mysqli->query("INSERT INTO tiempo_muerto (id_tiempo_muerto, tiempo_muerto,fecha,id_maquina,id_user,numodt,id_orden, seccion,hora_del_dia,id_tiraje) VALUES (null,'$tiempo','$fechadeldia','$machineID',$logged_in,null,null,1,'$horadeldia',null)");
          }else{
            $tiempoasa= ' TIMEDIFF("00:15:00.000000","'.$tiempo.'")';
          }
          $log->lwrite('tiempo: '.$tiempo,'ASA');
          $log->lwrite('tiempo asa: '.$tiempoasa,'ASA');
          $log->lwrite(printf($mysqli->error),'ASA');
        $query="INSERT INTO asaichi (tiempo, id_maquina, id_usuario, horadeldia,hora_fin, fechadeldia) VALUES ($tiempoasa,$machineID,$logged_in,'$horadeldia','$horafin','$fechadeldia')";
        $resultado=$mysqli->query($query);
        if ($resultado) {
          echo "Todo bien";
        }else{
          
          $log->lwrite('asaichi','multi-error');
          $log->lwrite(printf($mysqli->error),'multi-error');
          $log->lwrite($query,'multi-error');
          $log->lclose();
        }
        $change_status=$mysqli->query("UPDATE operacion_estatus SET asaichi_cumplido=1 WHERE fecha='$today' AND maquina=$machineID ");

     }
     /*********** Termina Guardando Asaichi ***********/

     /*********** Guardando Ajuste ***********/
     elseif ($section=='ajuste') {
      print_r($_POST);
       $tiempo      = $_POST['tiempo'];
       $ontime      = $_POST['ontime'];
        $nommaquina  = $_SESSION['machineName'];
        $userID   = $_SESSION['id'];
        $orderodts=$_POST['orderodts'];
        $horadeldia  = $_POST['horadeldia'];
        $fechadeldia = $_POST['fechadeldia'];
        $machineID=$_SESSION['machineID'];
        $machineName=$_SESSION['machineName'];
        $tirajeActual=$_POST['actual_tiro'];
        $horafinajuste=date("H:i:s",time());
        $today=date("d-m-Y");
        $changestatus=$mysqli->query("UPDATE operacion_estatus SET en_tiempo=1 WHERE fecha='$today' AND maquina=$machineID ");
        //$odetes= explode(',',$_POST['orderodts'])
        $log->lwrite(logpost($_POST),'AJUSTES_'.date("d-m-Y"));
        $log->lwrite('hora_fin_ajuste: '.$horafinajuste,'AJUSTES_'.date("d-m-Y"));
        $log->lwrite('--------------------------------','AJUSTES_'.date("d-m-Y"));
        $log->lclose();
        if ($_POST['numodt']=='virtual') {
          $virtOdt=$_POST['odtvirtual'];
          $virtElem=$_POST['elemvirtual'];
            if ($ontime=='false') {
              if ($machineID==16) {
               $tiempoajuste='"01:00:00.000000"';
              }else{

                $tiempoajuste='"00:20:00.000000"';
              }
           
            
          }else{
            if ($machineID==16) {
                $tiempoajuste= ' TIMEDIFF("01:00:00.000000","'.$tiempo.'")';
              }else{
                
                 $tiempoajuste= ' TIMEDIFF("00:20:00.000000","'.$tiempo.'")';
              }
           
          }
            
            $query     = "UPDATE tiraje SET tiempo_ajuste=$tiempoajuste, horafin_ajuste='$horafinajuste', horadeldia_tiraje='$horafinajuste',  is_virtual=1,odt_virtual='$virtOdt',elemento_virtual='$virtElem' WHERE idtiraje=$tirajeActual";
            
            $resultado = $mysqli->query($query);
                       
             $setTiraje=$mysqli->query("UPDATE personal_process SET last_tiraje=$tirajeActual WHERE status='actual' AND proceso_actual='$machineName' ");
            if ($resultado) {
              echo "tiraje virtual insertado";
            }else{
              printf($mysqli->error);
            }
             if ($ontime=='false') {
               $deadquery     = "INSERT INTO tiempo_muerto (id_tiempo_muerto, tiempo_muerto,fecha,id_maquina,id_user,numodt,id_orden, seccion,hora_del_dia,id_tiraje) VALUES (null,'$tiempo','$fechadeldia','$machineID',$userID,'$orderodts',null,'ajuste','$horadeldia',$tirajeActual)";
            $log->lwrite($deadquery,'TIEMPO_MUERTO');
            $deadresultado = $mysqli->query($deadquery);
            if ($deadresultado) {
              $log->lwrite('se registro un tiempo muerto','TIEMPO_MUERTO');
              
              $log->lclose();
            }
            }
         } else{
        $actuals_query="SELECT  os.status, o.idorden,o.numodt, os.proceso_actual FROM personal_process os INNER JOIN ordenes o on os.id_orden=o.idorden WHERE status='actual' AND proceso_actual='$machineName'";
        $resultodt=$mysqli->query($actuals_query);

        //$numodt      = (isset($_POST['numodt'])) ? explode(',', substr($_POST['numodt'], 0, -1)) : '';
        while($arr=mysqli_fetch_assoc($resultodt)){
          $numodt[] = $arr['idorden'];
          $odt[]=$arr['numodt'];
        }
        $odetes=implode(",", $odt);
        foreach ($numodt as $odt) {
          if ($ontime=='false') {
            
            $tiempoajuste='"00:20:00.000000"';
          }else{
            $tiempoajuste= ' TIMEDIFF("00:20:00.000000","'.$tiempo.'")';
          }
            $query     = "UPDATE tiraje SET tiempo_ajuste=$tiempoajuste, horafin_ajuste='$horafinajuste', horadeldia_tiraje='$horafinajuste', id_orden=$odt WHERE idtiraje=$tirajeActual";
           

            $resultado = $mysqli->query($query);
             
             $setTiraje=$mysqli->query("UPDATE personal_process SET last_tiraje=$tirajeActual WHERE status='actual' AND proceso_actual='$machineName' ");
              if ($ontime=='false') {
               $deadquery     = "INSERT INTO tiempo_muerto (id_tiempo_muerto, tiempo_muerto,fecha,id_maquina,id_user,numodt,id_orden, seccion,hora_del_dia,id_tiraje) VALUES (null,'$tiempo','$fechadeldia','$machineID',$userID,'$orderodts',null,'ajuste','$horadeldia',$tirajeActual)";
            $log->lwrite($deadquery,'TIEMPO_MUERTO');
            $deadresultado = $mysqli->query($deadquery);
            if ($deadresultado) {
              $log->lwrite('se registro un tiempo muerto','TIEMPO_MUERTO');
              
              $log->lclose();
            }
            }
            
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
       
     } 
     /*********** Termina Guardando Ajuste ***********/

     /*********** Guardando Tiraje ***********/
      elseif ($section=='tiraje') {
                $log->lwrite($_SESSION['logged_in']." ".logpost($_POST),'TIRAJES_'.date("d-m-Y"));
            

            //$log->lwrite(json_encode($_POST),'UPDATING');
              
            if ($_POST['qty']=='single') {

            $planillas=(!empty($_POST['planillas']))? $_POST['planillas'] : 'null';  
            $isvirtual=(isset($_POST['isvirtual'])? $_POST['isvirtual'] :'false');
            $producto=(isset($_POST['producto'])) ?$_POST['producto'] : '';
            $numodt=(isset($_POST['numodt'])) ?$_POST['numodt'] : '';
            $logged_in=$_POST['logged_in'];
            $nombremaquina=$_POST['nombremaquina'];
            $table_mac=(isset($_POST['table-machine']))? $_POST['table-machine'] : 1;
            $odt=(isset($_POST['odt']))? $_POST['odt'] : '';
            $pedido=(isset($_POST['pedido'])) ?(($planillas=='null')? $_POST['pedido'] : $_POST['pedido']/$planillas) : '';
            $cantidad=(isset($_POST['cantidad'])) ?$_POST['cantidad'] : '';
            $buenos=(isset($_POST['buenos'])) ? (($planillas=='null')? $_POST['buenos'] : $_POST['buenos']/$planillas) : '';
            $defectos=(isset($_POST['defectos'])) ?$_POST['defectos'] : '';
            $merma=(isset($_POST['merma']))? $_POST['merma'] : 0;
            $ajuste=$_POST['piezas-ajuste'];
            $entregados=(isset($_POST['entregados']))? (($planillas=='null')? $_POST['entregados'] : $_POST['entregados']/$planillas) : (($planillas=='null')? $_POST['buenos'] : $_POST['buenos']/$planillas);
            $tiempoTiraje=$_POST['tiempoTiraje'];
            $fechadeldia=$_POST['fechadeldia'];
            $horadeldia=$_POST['hour'];
            $merma_entregada=(!empty($_POST['planillas']))? $_POST['merma-entregada']/$_POST['planillas'] : $_POST['merma-entregada'];
            $passmerma=$merma-($merma_entregada+$defectos+$ajuste);
            $element=$_POST['element'];
            $horainiciotiro=$_POST['horainiciotiro'];
            $horafintiraje=date("H:i:s",time());
            $log->lwrite('horafin_tiraje: '.$horafintiraje,'TIRAJES_'.date("d-m-Y"));
            $log->lwrite('--------------------------------','TIRAJES_'.date("d-m-Y"));
            $log->lclose();

      $log->lwrite( $isvirtual,'UPDATING');
           $horaTiraje     = date(" H:i:s", time());
            $userID = $_SESSION['id'];
            
            $seconds = strtotime("1970-01-01 $tiempoTiraje UTC");
            
           
            $machineID = $_SESSION['machineID'];
            $machineName = $_SESSION['machineName'];
           

             $processID=($machineID==20||$machineID==21)? 10:(($machineID==22)? 9 : $machineID );
            $standar_query2 = "SELECT * FROM estandares WHERE id_maquina=$processID AND id_elemento= $element";
            $getstandar     = mysqli_fetch_assoc($mysqli->query($standar_query2));
            $estandar       = $getstandar['piezas_por_hora'];
            
                if($isvirtual=='true'){
                  $elem_v=$_POST['element_v'];
                  if ($table_mac==2) {
                    $tiraje_estandar=($seconds*300)/3600;
                    $log->lwrite( "IMPRESION EN MESA",'UPDATING');
                  }
                  else{
                  if (!empty($estandar)) {
                    $tiraje_estandar=($seconds*$estandar)/3600;
                    $log->lwrite( "ESTANDAR: ".$estandar,'UPDATING');
                  }
                  else{
                   if ($processID==10) {
                    $tiraje_estandar=($seconds*480)/3600;
                  }else{
                    $tiraje_estandar=($seconds*600)/3600;
                  } }
                }


                  if ($tiraje_estandar>0) {
                    $predesemp=($entregados*100)/$tiraje_estandar;
                   $tiraje_desemp=($predesemp>100)? 100 : $predesemp;
                   $log->lwrite('si vale algo','desemp');
                  }else{
                    $tiraje_desemp=0;
                    $log->lwrite('no vale nada','desemp');
                  }

                    $log->lwrite(  "ESPERADO: ".$tiraje_estandar,'UPDATING');
                  $prodEsperada=round($tiraje_estandar);
                  
                  $hora=$_POST['hour'];
                   $LastT=mysqli_fetch_assoc( $mysqli->query("SELECT last_tiraje FROM personal_process WHERE status='actual' AND proceso_actual='$machineName' "));
                  $getLast=$LastT['last_tiraje'];

                  $query="UPDATE tiraje set producto='$producto', pedido='$pedido', cantidad=$cantidad, buenos=$buenos, defectos=$defectos, merma=$merma,piezas_ajuste=$ajuste, merma_entregada=$merma_entregada, entregados=$entregados, tiempoTiraje='$tiempoTiraje', fechadeldia_tiraje='$fechadeldia', horafin_tiraje='$horafintiraje', id_user=$logged_in,produccion_esperada=$prodEsperada,desempenio=$tiraje_desemp WHERE idtiraje=$getLast";
                  $log->lwrite("Ultimo ID de ".$machineName.": ".$getLast,'LAST_ID');
           $log->lclose();

            $resultado=$mysqli->query($query);
            if (!$resultado) {
              
              $log->lwrite(printf($mysqli->error),'UPDATING');

            }
             $log->lwrite($query,'UPDATING');
              $log->lclose();
            $cleanPersonal=$mysqli->query("DELETE FROM personal_process WHERE proceso_actual='$machineName'");
             $cleanall=$mysqli->query("DELETE FROM odt_flujo WHERE proceso='$machineName'");
             if (!$cleanall) {
               printf($mysqli->error);             }
               if (!$cleanPersonal) {
               printf($mysqli->error);             }
               if (!$resultado) {
               printf($mysqli->error);             }
                    
                }else{
            $getstandar     = mysqli_fetch_assoc($mysqli->query($standar_query2));
            $estandar       = $getstandar['piezas_por_hora'];
            //calculando desempeño para pieza actual
            if (is_null($estandar)) {
              
              if ($processID==10) {
                    $tiraje_estandar=($seconds*420)/3600;
                  }else{
                    $tiraje_estandar=($seconds*600)/3600;
                  }
            }else{
              $tiraje_estandar=($seconds*$estandar)/3600;
            }
            
            if ($tiraje_estandar>0) {
              $predesemp=($entregados*100)/$tiraje_estandar;
             $tiraje_desemp=($predesemp>100)? 100 : $predesemp;
             $log->lwrite('si vale algo','desemp');
            }else{
              $tiraje_desemp=0;
              $log->lwrite('no vale nada','desemp');
            }
            $log->lwrite('$tiraje_estandar '.$tiraje_estandar,'desemp');
              $log->lwrite($standar_query2,'desemp');
              $log->lclose();
            $prodEsperada=round($tiraje_estandar);
            
            $hora=$_POST['hour'];
            
           $LastT=mysqli_fetch_assoc( $mysqli->query("SELECT last_tiraje FROM personal_process WHERE status='actual' AND proceso_actual='$machineName' "));
           $getLast=$LastT['last_tiraje'];

            $query="UPDATE tiraje set producto='$producto', pedido='$pedido', cantidad=$cantidad, buenos=$buenos, defectos=$defectos, merma=$merma,piezas_ajuste=$ajuste, merma_entregada=$merma_entregada, entregados=$entregados, tiempoTiraje='$tiempoTiraje', fechadeldia_tiraje='$fechadeldia', horafin_tiraje='$horafintiraje',id_user=$logged_in,produccion_esperada=$prodEsperada,desempenio=$tiraje_desemp WHERE idtiraje=$getLast";
            print_r($mysqli);
            $log->lwrite("Ultimo ID de ".$machineName.": ".$getLast,'LAST_ID');
           $log->lclose();

            $resultado=$mysqli->query($query);
            $querymerma="UPDATE ordenes SET merma_entregada=$merma_entregada, merma_recibida=$passmerma WHERE idorden=$numodt";
            $mysqli->query($querymerma);
            if ( $resultado) {
            $mysqli->query("UPDATE ordenes SET proceso_completado='true' WHERE idorden=$numodt");  
            $_GET['mivariable'] = $nombremaquina;

            //include("encuesta.php");
            //guardando personal******************************************************
            $cleanqueryp="DELETE FROM personal_process WHERE proceso_actual='$machineName' AND status='actual'";
            $cleanp=$mysqli->query($cleanqueryp);
            if ($cleanp) {
             $sqlp="SELECT * FROM personal_process WHERE proceso_actual='$machineName' order by orden_display asc";
            $ordsp=$mysqli->query($sqlp);
            }
            //checamos si hay aun partes pendientes a completar para esta ODT
            if ($ordsp->num_rows>0) {
              
            $ip=1;
            while($arrp=mysqli_fetch_array($ordsp)) {
              $resultsp[$ip] = $arrp;
              $ip++;
            }
            $i3p=1;
            foreach ($resultsp as $row2p) {
              $idp=$row2p['id_orden'];
              $old_statusp=$row2p['status'];
              $idprsp=$row2p['id_proceso'];
                if ($old_statusp=='siguiente') {
                 $statusp='actual';
                }
                 elseif ($old_statusp=='preparacion') {
                  $statusp='siguiente';
                }
                elseif ($old_statusp=='programado1') {
                  $statusp='preparacion';
                }
                else{ 
                  $progNump=$i3p-3;
                  $statusp='programado'.$progNump;
                }
             $update3p ="UPDATE personal_process SET orden_display = $i3p , status='$statusp' WHERE id_orden= $idp AND id_proceso=$idprsp";
            $updp= $mysqli->query($update3p);
            if ($updp) {
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
              prinf($mysqli->error);
              $log->lwrite('tiraje','multi-error');
             $log->lwrite('error al establecer estatus','multi-error');
             $log->lwrite('orden'.$idp,'multi-error');
              $log->lwrite(printf($mysqli->error),'multi-error');
              $log->lwrite($update3p,'multi-error');
              $log->lclose();

            }
            $i3p++;
            }
          }else{ //si no hay mas partes pendientes para esta orden, la marcamos como completada
            $completed=$mysqli->query("UPDATE ordenes SET entregado='true' WHERE numodt='$odt'"); 
             $log->lwrite('no se pudo actualizar orden'.$odt,'ENTREGADO');
             $log->lwrite(printf($mysqli->error),'ENTREGADO');
              $log->lclose();
              //ahora actualizamos el flujo
              $quitFlow=$mysqli->query("DELETE FROM odt_flujo WHERE proceso='$machineName' AND status='actual' ");
              if ($quitFlow) {
                 $sqlpf="SELECT * FROM odt_flujo WHERE proceso='$machineName' order by orden_display asc";
            $ordspf=$mysqli->query($sqlpf);
            $ipf=1;
            while($arrpf=mysqli_fetch_array($ordspf)) {
              $resultspf[$ipf] = $arrpf;
              $ipf++;
            }
            $i3pf=1;
            foreach ($resultspf as $row2pf) {
              $idpf=$row2pf['id_flujo'];
              $old_statuspf=$row2pf['status'];
              
                if ($old_statuspf=='siguiente') {
                 $statuspf='actual';
                }
                 elseif ($old_statuspf=='preparacion') {
                  $statuspf='siguiente';
                }
                elseif ($old_statuspf=='programado1') {
                  $statuspf='preparacion';
                }
                else{ 
                  $progNumpf=$i3pf-3;
                  $statuspf='programado'.$progNumpf;
                }
             $update3pf ="UPDATE odt_flujo SET orden_display = $i3pf , status='$statuspf' WHERE id_flujo= $idpf";
            $updpf= $mysqli->query($update3pf);
          
            $i3pf++;
            }
               } 
              


          }

            //termina guardando personal******************************************************

            


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
     /*********** Termina Guardando Tiraje ***********/

     /*********** Guardando Encuesta ***********/
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
              
               $process=($machineName=='Serigrafia2'||$machineName=='Serigrafia3')?'Serigrafia':(($machineName=='Suaje2')? 'Suaje' : $machineName );
             
          $queryavance="UPDATE procesos SET estatus=1, avance=4 WHERE id_orden=$order AND nombre_proceso='$process'";
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
            $process=($machineName=='Serigrafia2'||$machineName=='Serigrafia3')?'Serigrafia':(($machineName=='Suaje2')? 'Suaje' : $machineName );
             
        $queryavance="UPDATE procesos SET estatus=1, avance=4 WHERE id_orden=$lastOrder AND nombre_proceso='$process'";
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


        $queryOrden="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$process' HAVING status='actual'";
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
     /*********** Termina Guardando Encuesta ***********/
     elseif ($section=='restart') {
               
        

        

     }  

?>

