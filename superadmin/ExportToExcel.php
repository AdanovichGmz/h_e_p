<?php


include '../saves/conexion.php';
$numodt=$_POST['fecha'];
$userid=$_POST['usuario'];

 $query="SELECT t.*, m.nommaquina,o.numodt,o.producto,u.logged_in,(SELECT nombre_elemento FROM elementos WHERE id_elemento=o.producto) AS element,((t.entregados-t.merma_entregada)-t.defectos) AS calidad,(SELECT piezas_por_hora FROM estandares WHERE id_elemento=o.producto AND id_maquina= 10) AS estandar,TIME_TO_SEC(tiempoTiraje) AS seconds_tiraje,TIME_TO_SEC(timediff(horafin_tiraje,horadeldia_tiraje)) AS dispon_tiro,TIME_TO_SEC(timediff(horafin_ajuste,horadeldia_ajuste)) AS dispon_ajuste, (SELECT TIME_TO_SEC(breaktime) FROM breaktime WHERE id_tiraje=t.idtiraje AND seccion='ajuste' AND radios='Comida')AS comida_ajuste,(SELECT TIME_TO_SEC(breaktime) FROM breaktime WHERE id_tiraje=t.idtiraje AND seccion='tiro' AND radios='Comida')AS comida_tiro, TIME_TO_SEC(tiempo_ajuste) AS seconds_ajuste,(SELECT TIME_TO_SEC(tiempo_muerto) FROM tiempo_muerto WHERE id_tiraje=t.idtiraje AND seccion='ajuste') AS seconds_muertos,(SELECT TIME_TO_SEC(tiempo_muerto) FROM tiempo_muerto WHERE id_tiraje=t.idtiraje AND seccion='tiraje') AS seconds_muertos_tiro  FROM tiraje t LEFT JOIN maquina m ON m.idmaquina=t.id_maquina LEFT JOIN login u ON u.id=t.id_user LEFT JOIN ordenes o ON o.idorden=t.id_orden WHERE fechadeldia_ajuste='$numodt' AND t.id_user=$userid ORDER BY horadeldia_ajuste ASC";

  $asa_query="SELECT *, TIME_TO_SEC(tiempo) AS tiempo_asaichi,TIME_TO_SEC(timediff(hora_fin,horadeldia)) AS dispon_asaichi, (SELECT TIME_TO_SEC(tiempo_muerto) FROM tiempo_muerto WHERE seccion='asaichi' AND fecha='$numodt' AND id_user=$userid) AS tmuerto_asa FROM asaichi WHERE fechadeldia='$numodt' AND id_usuario=$userid" ;
       
        $resss=$mysqli->query($query);
        $asa_resss=$mysqli->query($asa_query);
        $getuser=mysqli_fetch_assoc($mysqli->query("SELECT logged_in FROM login WHERE id=$userid"));


        
?>






<table id="texcel">
<thead><tr>
    <th >Inicio</th>
    <th >Fin</th>
    <th>Producto</th>
    
    <th>STD</th>
    <th colspan="2">Tiempo Disponible</th>
    <th colspan="2">Tiempo Muerto</th>
    <th colspan="2">Tiempo Real</th>
    <th colspan="2">Produccion Esperada</th>
    <th colspan="2">Produccion Real</th>
    <th colspan="2">Merma</th>
    <th colspan="2">Calidad a la Primera</th>
    <th colspan="2">Defectos</th>
    <th>Porque no se hizo bien a la primera?</th>
    <th>Porque se hizo mas lento?</th>
    <th>Porque se perdio tiempo?</th>
    
  </tr></thead>
  <tbody>
  <?php 
   $i=0;
  $sum_esper=0;
  $sum_merm=0;
  $sum_real=0;
  $sum_tiraje=0;
   $sum_ajuste=0;
   $sum_muerto=0;
   $sum_defectos=0;
  $sum_calidad=0;
  $sum_dispon=0;
  $sum_recibidos=0;
  $comida_exist='';
  $comida_exist2='';
  $asa_exist=($asa_resss->num_rows>0)? true : false;
  while ($asa=mysqli_fetch_assoc($asa_resss)) {
if ($i==0) {
  if ($asa_exist) {
                              $transcur=strtotime($asa['horadeldia'])-strtotime("08:45:00"); 
                              $sum_muerto+=$transcur; 
                              $sum_dispon+=$transcur;
                            }
}
   ?>
  <tr>
     <td><?= substr($asa['horadeldia'],0,-3);?></td>                     
    <td><?= substr($asa['hora_fin'],0,-3);?></td>
    <td> Asaiichi </td>
    <!-- <td <?=($row['is_virtual']=='true')? 'style="color:red;"':'' ?>><?=($row['is_virtual']=='true')? $row['odt_virtual'] : $row['numodt'];?> </td> -->
    <td>0</td>
    <?php $sum_tiraje+=$asa['tiempo_asaichi'];
    $sum_tiraje+=$asa['tmuerto_asa']; ?>
    <td><?=gmdate("H:i",$asa['dispon_asaichi']);  ?></td>
   <?php $sum_dispon+= $asa['dispon_asaichi']?>
    <td><?=gmdate("H:i",$sum_dispon);  ?></td>
    <?php $sum_muerto+=$asa['tmuerto_asa']; 
    
    ?>
    <td><?=gmdate("H:i", $asa['tmuerto_asa']); ?></td>
    <td><?=gmdate("H:i", $sum_muerto); ?></td>
    <td><?=gmdate("H:i", $asa['tiempo_asaichi']); ?></td>

    <td><?=gmdate("H:i",$sum_tiraje) ?></td>
   
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>
    
    <!--
   
    <td><?= round($row['desempenio'],2);?>%</td> -->
  </tr>
  <?php } ?>
  <?php 
 
                          while($row=mysqli_fetch_assoc($resss)):
                            echo $row['comida_tiro']." prueba ";
                            if ($i==0) {
                              if (!$asa_exist) {
                                 $transcur=strtotime($row['horadeldia_ajuste'])-strtotime("08:45:00"); 
                              $sum_muerto+=$transcur; 
                              $sum_dispon+=$transcur;
                              }
                             
                            }
                            $comida_exist=($row['comida_auste']>0)?'Comida' : '' ;
                          $sum_muerto+=$row['comida_ajuste'];
                            $sum_esper+=$row['produccion_esperada'];
                          $sum_merm+=$row['merma_entregada'];
                          $sum_real+=$row['entregados']-$row['merma_entregada'];
                          $sum_recibidos+=$row['cantidad'];
                           $sum_ajuste+=$row['seconds_ajuste'];
                            $sum_muerto+=$row['seconds_muertos_tiro'];
                            $sum_defectos+=$row['defectos'];
                            $sum_calidad+=$row['calidad'];
                            $sum_dispon+=$row['dispon_ajuste'];

                            $processID=($row['id_maquina']==20||$row['id_maquina']==21)? 10:$row['id_maquina'];
                            if (is_null($row['estandar'])) {
              
                            if ($processID==10) {
                                  $tiraje_estandar=420;
                                }else{
                                  $tiraje_estandar=600;
                                }
                          }else{
                            $tiraje_estandar=$row['estandar'];
                          }
                          $idtiro=$row['idtiraje'];
                          $alertaquery=$mysqli->query("SELECT *,TIME_TO_SEC(horadeldiaam)  AS inicio,TIME_TO_SEC(horafin_alerta) AS fin,  TIME_TO_SEC(tiempoalertamaquina) AS alert_real,TIME_TO_SEC(timediff(horafin_alerta ,horadeldiaam)) AS dispon_alertajuste FROM alertageneralajuste WHERE id_tiraje=$idtiro");
                          $alertaTiro=$mysqli->query("SELECT *,TIME_TO_SEC(horadeldiaam)  AS inicio,TIME_TO_SEC(horafin_alerta) AS fin,  TIME_TO_SEC(tiempoalertamaquina) AS alert_real,TIME_TO_SEC(timediff(horafin_alerta ,horadeldiaam)) AS dispon_alertatiro FROM alertamaquinaoperacion WHERE id_tiraje=$idtiro");
                          $alertaAjuste=mysqli_fetch_assoc($alertaquery);
                        if (!empty($alertaAjuste['alert_real'])) {
                         $sum_muerto+= $alertaAjuste['alert_real'];
                        }
                        
                        $alert=($alertaAjuste['radios']=='Otro')? $alertaAjuste['observaciones'] : $alertaAjuste['radios'];

                         $alertaT=mysqli_fetch_assoc($alertaTiro);
                        
                        $alertTiro=($alertaT['radios']=='Otro')? $alertaT['observaciones'] : $alertaT['radios'];

                          ?>
                          <tr>
     <td><?= substr($row['horadeldia_ajuste'],0,-3);?></td>                     
    <td><?= substr($row['horafin_ajuste'],0,-3);?></td>
    <td <?=($row['is_virtual']=='true')? 'style="color:red;"':'' ?> >Ajuste </td>
    <!-- <td <?=($row['is_virtual']=='true')? 'style="color:red;"':'' ?>><?=($row['is_virtual']=='true')? $row['odt_virtual'] : $row['numodt'];?> </td> -->
    <td>0</td>
    <td><?=gmdate("H:i",$row['dispon_ajuste']);  ?></td>
   
    <td><?=gmdate("H:i",$sum_dispon);  ?></td>
    <?php $sum_muerto+=$row['seconds_muertos']; ?>
    <td><?=gmdate("H:i", $row['seconds_muertos']+$alertaAjuste['alert_real']); ?></td>
    <td><?=gmdate("H:i", $sum_muerto); ?></td>
    <td><?= gmdate("H:i", $row['seconds_ajuste']);?></td>
  <?php $sum_tiraje+=$row['seconds_ajuste']; ?>
    <td><?= gmdate("H:i", $sum_tiraje);
    ?></td>
   
    <td>0</td>
    <td><?=$sum_esper ?></td>
    <td>0</td>
    <td><?=$sum_real ?></td>
    <td>0</td>
    <td><?=$sum_merm ?></td>
    <td>0</td>
    <td><?=$sum_calidad ?></td>
    <td>0</td>
    <td><?=$sum_defectos ?></td>
    <?php if (!empty($alert)) { ?>
    <td colspan="3">Alerta: <?=$alert." ".$comida_exist ?></td>
    <?php } else{ ?>
    <td>--</td>
    <td><?=($comida_exist!=null)?  $comida_exist :'--' ?></td>
    <td>--</td>
    
    <?php }?>
    <!--
   
    <td><?= round($row['desempenio'],2);?>%</td> -->
  </tr>
<?php 
$sum_muerto+=$row['comida_tiro'];
$comida_exist2=($row['comida_tiro']>0)? 'Comida' : '';
    if (!empty($alertaT['alert_real'])) {
                          $sum_muerto+= $alertaT['alert_real'];
                        }
?>
      <tr style=" background-color: #EBEBEB;">
     <td><?= substr($row['horadeldia_tiraje'],0,-3);?></td>                     
    <td><?= substr($row['horafin_tiraje'],0,-3);?></td>
    <td <?=($row['is_virtual']=='true')? 'style="color:red;"':'' ?> ><?=($row['is_virtual']=='true')? $row['elemento_virtual'] : $row['element'];?> </td>
    <!-- <td <?=($row['is_virtual']=='true')? 'style="color:red;"':'' ?>><?=($row['is_virtual']=='true')? $row['odt_virtual'] : $row['numodt'];?> </td> -->
    <td><?= $tiraje_estandar;?></td>
    <td><?=gmdate("H:i", $row['dispon_tiro'])  ?></td>
     <?php $sum_dispon+=$row['dispon_tiro'] ?>
    <?php $sum_muerto+=$row['seconds_muertos_tiro']; ?>
   <?php $sum_tiraje+=$row['seconds_tiraje']; ?>
    <td><?= gmdate("H:i",$sum_dispon);?></td>
    <td><?=gmdate("H:i",$alertaT['alert_real']); ?></td>
    <td><?=gmdate("H:i", $sum_muerto); ?></td>
    <td><?= gmdate("H:i", $row['seconds_tiraje']); ?></td>
    <td><?= gmdate("H:i", $sum_tiraje); ?></td>
    <td><?= $row['produccion_esperada'];?></td>
    <td><?=$sum_esper ?></td>
    <td><?= $row['entregados']-$row['merma_entregada'];?></td>
    <td><?=$sum_real ?></td>
    <td><?= $row['merma_entregada'];?></td>
    <td><?=$sum_merm ?></td>
    <td><?= $row['calidad'];?></td>
    <td><?=$sum_calidad ?></td>
    <td><?= $row['defectos'];?></td>
    <td><?=$sum_defectos ?></td>
    <?php if (!empty($alertTiro)) { ?>
    <td colspan="3">Alerta: <?=$alertTiro." ".$comida_exist2 ?></td>
    <?php } else{ ?>
    <td>--</td>
    <td><?=($comida_exist2!=null)?  $comida_exist2 :'--' ?></td>
    <td>--</td>
    
    <?php }?>
   
  </tr>
              
  <?php 
$i++;
   endwhile; ?>
  
  </tbody>
</table>
