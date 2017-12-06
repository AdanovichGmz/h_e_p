

<?php

error_reporting(0);
 

    ?>

  <?php
   function isActive($machineID){
    require('saves/conexion.php');
    $today=date("d-m-Y");
    $check=$mysqli->query("SELECT * FROM operacion_estatus WHERE fecha='$today' AND maquina=$machineID");
 
  
if ($check->num_rows==0) {
 return false;
}else{
  return true;
}
  }
  function personalData($idmaquina,$maquina,$photo){
    date_default_timezone_set("America/Mexico_City");
require('saves/conexion.php');
 $process=($machineName=='Serigrafia2'||$machineName=='Serigrafia3')?'Serigrafia':(($machineName=='Suaje2')? 'Suaje' : $machineName );
             $processID=($machineID==20||$machineID==21)? 10:(($machineID==22)? 9 : $machineID );
    $query1 = "SELECT o.*,p.proceso,p.id_proceso,pp.*,(SELECT nombre_elemento FROM elementos WHERE id_elemento=o.producto) AS nombre_elemento FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden INNER JOIN personal_process pp ON pp.id_orden=o.idorden WHERE proceso_actual='$maquina' AND nombre_proceso='$process' AND status='actual' ";
    
    $actual = $mysqli->query($query1);
     
    $query2 = "SELECT o.*,p.proceso,p.id_proceso,pp.*,(SELECT nombre_elemento FROM elementos WHERE id_elemento=o.producto) AS nombre_elemento FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden INNER JOIN personal_process pp ON pp.id_orden=o.idorden WHERE proceso_actual='$maquina' AND nombre_proceso='$process' AND status='siguiente'";
    
    $siguiente = $mysqli->query($query2);
    $resultado02_5 = $mysqli->query($query2);
    $query3 = "SELECT o.*,p.proceso,p.id_proceso,pp.*,(SELECT nombre_elemento FROM elementos WHERE id_elemento=o.producto) AS nombre_elemento FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden INNER JOIN personal_process pp ON pp.id_orden=o.idorden WHERE proceso_actual='$maquina' AND nombre_proceso='$process' AND status='preparacion' ";
    
    $preparacion = $mysqli->query($query3);

     $row = mysqli_fetch_object($actual);
     $row2 =mysqli_fetch_assoc($actual);
     

     $actual=mysqli_fetch_assoc($mysqli->query("SELECT num_odt FROM personal_process WHERE proceso_actual='$maquina' "));
      $act = (!empty($actual['num_odt']))? $actual['num_odt'] : '--';
      $nom_act=(!empty($row->producto))? $row->nombre_elemento : '';
      $element   = $idmaquina;
    
      
      $row2 = mysqli_fetch_object($siguiente);
      $sig = (!empty($row2->numodt))? $row2->numodt : '--';
      $nom_sig=(!empty($row2->producto))? $row2->nombre_elemento : '';
            
          
      $row3 = mysqli_fetch_object($preparacion);
      $prep = (!empty($row3->numodt))? $row3->numodt : '--';
      $nom_prep=(!empty($row3->producto))? $row3->nombre_elemento : '';

       /****************** Calcular ETE ******************/
    $today     = date("d-m-Y");
   
     $etequery1 = "SELECT COALESCE((SELECT  IFNULL(SUM( TIME_TO_SEC( tiempoTiraje) ),0)  FROM tiraje WHERE id_maquina=$idmaquina AND fechadeldia_tiraje = '$today' )+(SELECT  IFNULL(SUM( TIME_TO_SEC( tiempo_ajuste)),0) FROM tiraje WHERE id_maquina=$idmaquina AND fechadeldia_ajuste = '$today' )) as tiempo_real";
    //obtenemos el tiempo muerto sumando las idas al sanitario
    $etequery2 = "SELECT  IFNULL(SUM( TIME_TO_SEC( breaktime)),0)+(SELECT IFNULL(SUM(TIME_TO_SEC(tiempo_muerto)),0) FROM tiempo_muerto WHERE id_maquina=$idmaquina AND fecha = '$today') AS tiempo_muerto  FROM breaktime WHERE id_maquina=$idmaquina AND radios='Sanitario' AND fechadeldiaam = '$today'";
    $tmuerto_alertas=mysqli_fetch_assoc($mysqli->query("SELECT (SELECT  IFNULL(SUM( TIME_TO_SEC( tiempoalertamaquina) ),0)  FROM alertamaquinaoperacion WHERE id_maquina=$idmaquina AND fechadeldiaam = '$today' AND es_tiempo_muerto NOT IN('false')) + (SELECT  IFNULL(SUM( TIME_TO_SEC(tiempoalertamaquina) ),0) FROM alertageneralajuste WHERE id_maquina=$idmaquina AND fechadeldiaam = '$today' AND es_tiempo_muerto NOT IN('false')) AS tmuerto_alert"));
    $t_muerto=mysqli_fetch_assoc($mysqli->query("SELECT SUM(TIME_TO_SEC(tiempo_muerto)) AS seconds_muertos FROM tiempo_muerto WHERE fecha='$today' AND id_maquina=$idmaquina "));
    //obtenemos la calidad a la primera operando entregados-defectos*100/cantidadpedida  
    $etequery3 = "SELECT COALESCE(((SELECT SUM(entregados)-SUM(merma_entregada) FROM tiraje WHERE id_maquina=$idmaquina AND fechadeldia_tiraje = '$today')-(SELECT SUM(defectos) FROM tiraje WHERE id_maquina=$idmaquina AND fechadeldia_tiraje = '$today' AND tiempoTiraje IS NOT NULL))/(SELECT SUM(entregados)-SUM(merma_entregada) FROM tiraje WHERE id_maquina=$idmaquina AND fechadeldia_tiraje = '$today'))*100 as calidad_primera";
    //obtenemos desempeño operando entregados+merma
    $etequery4 = "SELECT SUM(produccion_esperada) AS prod_esperada, SUM(buenos) AS prod_real  ,COUNT(desempenio) AS tirajes,SUM(produccion_esperada) AS esper FROM `tiraje` WHERE fechadeldia_tiraje='$today' AND id_maquina=$idmaquina AND tiempoTiraje IS NOT NULL";
    $etequery5 = "SELECT COALESCE((SELECT SUM(entregados) FROM tiraje WHERE id_maquina=$idmaquina AND fechadeldia_tiraje = '$today' AND tiempoTiraje IS NOT NULL)) as desempenio";
    //obtenemos el elemento o producto
    $getelement = mysqli_fetch_assoc($resultado02_5);
    $element    = $getelement['producto'];
    $begin      = new DateTime('08:45:00');
    $current    = new DateTime(date('H:i'));
    //obtenemos el tiempo transcurrido desde el inicio del dia hasta el momento actual
    $interval   = $begin->diff($current);
    //echo $interval->format("%H:%I");
    $time_diff  = $interval->format("%H:%I:%S");
    $timeArr    = array_reverse(explode(":", $time_diff));
    $seconds    = 0;
    foreach ($timeArr as $key => $value) {
        if ($key > 2)
            break;
        $seconds += pow(60, $key) * $value;
    }
    //obtenemos el estandar de piezas por hora para el elemento y proceso actual
   
    
    
    $getdeadTime = mysqli_fetch_assoc($mysqli->query($etequery2));
    $deadTime    = $getdeadTime['tiempo_muerto']+$tmuerto_alertas['tmuerto_alert'];
    
    $gettotalTime = mysqli_fetch_assoc($mysqli->query($etequery1));
    $totalTime    = $gettotalTime['tiempo_real'] ;
    
    $getQuality = mysqli_fetch_assoc($mysqli->query($etequery3));
    $Quality    = $getQuality['calidad_primera'];
    $getdesemp= $mysqli->query($etequery4);
    $getEfec       = mysqli_fetch_assoc($getdesemp);
    //obtenemos el porcentaje de estandar segundos*estandar/1hora
    
    if ($getEfec['prod_esperada']>0) {
      $desempenio =($getEfec['prod_real']/$getEfec['prod_esperada'])*100;
    }else{
      $desempenio=0;
    }
    //echo "real-muerto: ".gmdate("H:i", $totalTime)." disponible: ".gmdate("H:i", ($seconds>19800)?$seconds-3600 : $seconds);
    //echo $etequery3;
    //$realtime   = ($totalTime * 1) / 3600;
    $roundDesemp=($desempenio>100)? 100 : $desempenio;
    $dispon     =($seconds>19800)? ($totalTime / ($seconds-3600))*100 : ($totalTime / $seconds)*100;
    //$disponible = round($dispon, 1);
  //echo $seconds." real ".$totalTime;
    $disponible = round($dispon);
    
    $real       = mysqli_fetch_assoc($mysqli->query($etequery5));
   

    //echo "<p style='color:#fff;'>dispon ".$dispon." calidad ".$Quality." desempeño ".$desempenio." prod esperada ".$getEfec['esper']." real ".$real['desempenio']." calidad ".$Quality." tiempo hasta ahora: ".$seconds."</p>";
    $roundQuality=($Quality>100)? 100 : $Quality;
$lim_dispon=($dispon>100)? 100 : $dispon;
$lim_roundQuality=($roundQuality>100)? 100 : $roundQuality;
$lim_roundDesemp=($roundDesemp>100)? 100 : $roundDesemp;
    $getEte     = (($lim_dispon / 100) * ($lim_roundQuality / 100) * ($lim_roundDesemp / 100)) * 100;
    $showpercent=100 - $getEte;
  /****************** Calcular ETE ******************/
          
  $actividad=mysqli_fetch_assoc($mysqli->query("SELECT * FROM operacion_estatus WHERE maquina='$idmaquina' AND fecha='$today' "));
$qlty=(is_null($lim_roundQuality))? 0 : $lim_roundQuality;
    if (isActive($idmaquina)) {
      $grafica='<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(draw'.$maquina.'Chart);
    function draw'.$maquina.'Chart() {
      var data = google.visualization.arrayToDataTable([
          ["valor", "porcentaje",{ role: "style" }, { role: "annotation"}],
         
    ["DISPONIBILIDAD",'. $lim_dispon .',"#1F487C",'.round($lim_dispon,1).' ],
     ["DESEMPEÑO",'. $lim_roundDesemp  .',"#C0504E",'.round($lim_roundDesemp,1).' ],
     ["CALIDAD", '.$qlty.',"#F79647",'.round($qlty,1).' ]]);
    

        var options = { // '. $maquina .'
            chartArea: {width: "100%", height: "90%"},
            width: "100%", 
            height: "100%",
            chartArea: {left: 25, top: 10, width: "100%", height: "70%"},
            annotations: {
            
            textStyle: {
                fontSize: 20,
                 bold:true
            }},
            enableInteractivity: true,                                               
            fontSize: 11,
            hAxis: {
                    textStyle: {
                      color: "#272B34"
                    }
                  },
            vAxis: {
                textStyle: {
                      color: "#272B34"
                    },
            viewWindowMode:"explicit",
            viewWindow: {
              max:100,
              min:0
            }
        },

            colors: ["#4B5161"],    
            backgroundColor: "transparent"
        };

      var chart = new google.visualization.ColumnChart(document.getElementById("'.$maquina.'"));
      chart.draw(data,options);
  }
console.log("real time '.$maquina.' '.gmdate("H:i",$gettotalTime['tiempo_real']) .' total '.gmdate("H:i",$totalTime) .' disponible '.gmdate("H:i",$seconds) .'");
  </script>';
    }else{
      $grafica='';
    }
 
  //console.log("total time '.$maquina.' '.gmdate("H:i",$totalTime) .' seconds '.$seconds .'");
    $outtime=($actividad['en_tiempo']=='false')? 'outtime':'';
    $credencial=' '.$grafica.'
    <div class='.$outtime.'></div> <div class="ete-photo '.$actividad['actividad_actual'].'"><div class="person-photo" style=background:url("images/'.$photo.'.jpg")></div><div class="santa"></div>
    <div class="ete-num">'.round($getEte).'%</div>

    </div>
    <div class="machinename">'.(($actividad['actividad_actual']=='comida')? "comida/wc" : $actividad['actividad_actual']).'</div>
    <div class="ete-stat ">
      <table>
      <thead>
      <tr class="trh">
        <td>Orden Actual:</td>
        <td class="">'.$act.'</td>
        
        </tr></thead>
        <tbody>
        <tr style="font-size: 10px;"><td>&nbsp</td>
        <td>&nbsp</td>
        </tr>
        
        </tbody>
      </table>
      <div id="'.$maquina.'" style="bottom:0;width: 97%; height: 80%; position:absolute; "></div>
    </div>';
  echo $credencial;
}


  ?>


<div class="prod-container">
 <div class="personal <?=(!isActive(10))? 'disabled' : '' ?>">
    <?=personalData(10,'Serigrafia','12'); ?>
  </div>
  <div class="personal <?=(!isActive(20))? 'disabled' : ''?>">
    <?=personalData(20,'Serigrafia2','10'); ?>
  </div>
  
   <div class="personal <?=(!isActive(21))? 'disabled' : '' ?>">
    <?=personalData(21,'Serigrafia3','15'); ?>
  </div>
  <div class="personal <?=(!isActive(9))? 'disabled' : '' ?>">
    <?=personalData(9,'Suaje','default'); ?>
  </div>
  <div class="personal <?=(!isActive(5))? 'disabled' : '' ?>">
    <?=personalData(5,'Placa','default'); ?>
  </div>
  <div class="personal <?=(!isActive(16))? 'disabled' : '' ?>">
    <?=personalData(16,'HotStamping','7'); ?>
  </div>
 
</div>
<script>
  var wind = $(window).height();
$('.personal').height((wind/2)-25);
var grafics=((wind/2)-25)-140;
$('.ete-stat').height(grafics);
</script>