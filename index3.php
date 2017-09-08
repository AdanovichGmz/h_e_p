
<?php
ini_set("session.gc_maxlifetime","7200");  
date_default_timezone_set("America/Mexico_City");
if (isset($_COOKIE['ajuste'])) {
    setcookie('ajuste', true, time() - 3600);
    unset($_COOKIE['ajuste']);
}
if (!isset($_COOKIE['tiraje'])) {
    setcookie('tiraje', true, time() + 3600);
}
require('saves/conexion.php');
if (!session_id()) {
    session_start();
}
if (@$_SESSION['logged_in'] != true) {
    echo '
    <script>
        alert("tu no estas autorizado para entrar a esta pagina");
        self.location.replace("index.php");
    </script>';
} else {
    //echo $_SESSION['machineName'];

    $mac=(isset($_SESSION['mac']))?$_SESSION['mac'] : system($cmd) ;

    $machineName=$_SESSION['machineName'];
    $machineID = $_SESSION['machineID'];
    $pause_exist = false;
    $getPaused = "SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$machineName' AND avance='en pausa'";
    $getretaking       = "SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$machineName' AND avance='retomado'";

    $paused = $mysqli->query($getPaused);
    $retaking       = $mysqli->query($getretaking);
        if ($paused->num_rows > 0) {
            $pause_exist    = true;
           
            $usID           = $_SESSION['id'];
            $recoOrden      = mysqli_fetch_assoc($paused);
            $OrderODT   = $recoOrden['numodt'];
            $orderID[] = $recoOrden['id_orden'];
            //$secondspaused  = $recoOrden['seconds'];
            //$fecha_pausa    = $recoOrden['fecha_pausa'];
            $horaAjuste     = date(" H:i:s", time());
            $newtiraje      = "INSERT INTO tiraje(id_maquina,id_orden,id_user,horadeldia_ajuste) VALUES ($machineID,$OrderID, $usID,'$horaAjuste')";
            $inserting      = $mysqli->query($newtiraje);
            if (!$inserting) {
                echo $newtiraje . "<br>";
                printf($mysqli->error);
            }
        } elseif ($retaking->num_rows > 0)  {
            
            //$secondspaused  = 'false';
            $recoOrden      = mysqli_fetch_assoc($retaking);
            $OrderODT   = $recoOrden['numodt'];
            $orderID[] = $recoOrden['id_orden'];
            $singleID=$recoOrden['id_orden'];
            $getretakingTiro    = "SELECT * FROM tiraje WHERE id_orden=$singleID ORDER BY idtiraje DESC";
            $retakingTiro       = mysqli_fetch_assoc($mysqli->query($getretakingTiro));
            $horaAjuste     = $retakingTiro['horadeldia_ajuste'];
        }else{

            $orderID = explode(",", $_GET['order']);
           
            $singleID=$orderID[0];
            $userID      = $_SESSION['id'];
            $getAjuste    = "SELECT horadeldia_ajuste FROM tiraje WHERE id_orden=$singleID AND id_maquina=$machineID";
            $Ajuste       = mysqli_fetch_assoc($mysqli->query($getAjuste));
            $horaAjuste     = $Ajuste['horadeldia_ajuste'];
            foreach ($orderID as $order) {
              $getOdt="SELECT numodt FROM ordenes WHERE idorden=$order";
              $odt=mysqli_fetch_assoc($mysqli->query($getOdt));
            $odetesArr[]=$odt['numodt'];
            }
            $odetes=implode(",", $odetesArr);

        }


    
    
    $_GET['mivariable'] = $machineName;
    $query0             = "SELECT o.*,p.proceso,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
    
    $resultado0 = $mysqli->query($query0);
    
    $query01 = "SELECT o.*,p.proceso,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
    
    $resultado01 = $mysqli->query($query01);
    
    
    $query02 = "SELECT o.*,p.proceso,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual' ";
    
    $resultado02   = $mysqli->query($query02);
    $resultado02_5 = $mysqli->query($query02);
    
    
    $query1 = "SELECT o.*,p.proceso,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
    
    $resultado1 = $mysqli->query($query1);
    
    
    $query2 = "SELECT o.*,p.proceso,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='siguiente' ";
    
    $resultado2 = $mysqli->query($query2);
    
    $query3 = "SELECT o.*,p.proceso,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='preparacion'";
    
    $resultado3 = $mysqli->query($query3);
?>
<!-- ************************ Contenido ******************** -->
  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    <?php
    $today     = date("d-m-Y");
    //obtenemos el tiempo real sumando tiempoTiraje + tiempo_ajuste +tiempoalertamaquina + tiempoajuste
    $etequery1 = "SELECT COALESCE((SELECT  IFNULL(SUM( TIME_TO_SEC( tiempoTiraje) ),0)  FROM tiraje WHERE id_maquina=$machineID AND fechadeldia_tiraje = '$today')+(SELECT  IFNULL(SUM( TIME_TO_SEC( tiempo_ajuste)),0) FROM tiraje WHERE id_maquina=$machineID AND fechadeldia_ajuste = '$today')+(SELECT  IFNULL(SUM( TIME_TO_SEC( tiempoalertamaquina) ),0)  FROM alertamaquinaoperacion WHERE id_maquina=$machineID AND fechadeldiaam = '$today') + (SELECT  IFNULL(SUM( TIME_TO_SEC(tiempoalertamaquina) ),0) FROM alertageneralajuste WHERE id_maquina=$machineID AND fechadeldiaam = '$today')) as tiempo_real";
    //obtenemos el tiempo muerto sumando las idas al sanitario
    $etequery2 = "SELECT  IFNULL(SUM( TIME_TO_SEC( breaktime) ),0) AS tiempo_muerto  FROM breaktime WHERE id_maquina=$machineID AND radios='Sanitario' AND fechadeldiaam = '$today'";
    //obtenemos la calidad a la primera operando entregados-defectos*100/cantidadpedida  
    $etequery3 = "SELECT COALESCE((SELECT SUM( entregados ) FROM tiraje WHERE id_maquina=$machineID AND fechadeldia_tiraje = '$today')/ (SELECT SUM(cantidad) FROM tiraje WHERE id_maquina=$machineID AND fechadeldia_tiraje = '$today'))*100 as calidad_primera";
    //obtenemos desempeño operando entregados+merma
    $etequery4 = "SELECT SUM(desempenio) AS desemp ,COUNT(desempenio) AS tirajes,SUM(produccion_esperada) AS esper FROM `tiraje` WHERE fechadeldia_tiraje='$today' AND id_maquina=$machineID";
    $etequery5 = "SELECT COALESCE((SELECT SUM(entregados) FROM tiraje WHERE id_maquina=$machineID AND fechadeldia_tiraje = '$today')) as desempenio";
    //obtenemos el elemento o producto
    $getelement = mysqli_fetch_assoc($resultado02_5);
    $element    = $getelement['producto'];
    $begin      = new DateTime('09:00');
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
    $standar_query2 = "SELECT * FROM estandares WHERE id_maquina=$machineID AND id_elemento= $element";
    
    $getstandar     = mysqli_fetch_assoc($mysqli->query($standar_query2));
    $estandar       = $getstandar['piezas_por_hora'];
    
    
    $getdeadTime = mysqli_fetch_assoc($mysqli->query($etequery2));
    $deadTime    = $getdeadTime['tiempo_muerto'];
    
    $gettotalTime = mysqli_fetch_assoc($mysqli->query($etequery1));
    $totalTime    = $gettotalTime['tiempo_real'] - $getdeadTime['tiempo_muerto'];
    
    $getQuality = mysqli_fetch_assoc($mysqli->query($etequery3));
    $Quality    = $getQuality['calidad_primera'];
    $getdesemp= $mysqli->query($etequery4);
    $getEfec       = mysqli_fetch_assoc($getdesemp);
    //obtenemos el porcentaje de estandar segundos*estandar/1hora
    $estandar_prod = (($seconds-3600) * $estandar) / 3600;
    
    $desempenio =($getEfec['tirajes']>0)? ($getEfec['desemp']*100)/($getEfec['tirajes']*100) : 0;
    //echo $etequery3;
    //$realtime   = ($totalTime * 1) / 3600;
    
    $dispon     =($seconds>14400)? ($totalTime * 100) / ($seconds-3600) : ($totalTime * 100) / $seconds;
    //$disponible = round($dispon, 1);
    $disponible = round($dispon);
    
    $real       = mysqli_fetch_assoc($mysqli->query($etequery5));


    //echo "<p style='color:#fff;'>dispon ".$dispon." calidad ".$Quality." desempeño ".$desempenio." prod esperada ".$getEfec['esper']." real ".$real['desempenio']." calidad ".$Quality." tiempo hasta ahora: ".$seconds."</p>";
    $getEte     = (($dispon / 100) * ($Quality / 100) * ($desempenio / 100)) * 100;
    $showpercent=100 - $getEte;
    
?>
    <!-- bar chart -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
  <!-- pie -->
       <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Type', 'ETE'],['<?="ETE ".round($getEte)."%" ?>', <?php
    echo $getEte;
?>],['<?="MUDA ".round(($showpercent<0)? 0 : $showpercent)."%" ?>', <?=($showpercent<0)? 0 : $showpercent;
     
?>] ]);
        var options = {chartArea: {width: '90%',  height: '90%'},
                       
                       pieSliceTextStyle: {color: 'white', fontSize: 16},
                       
                       legend: 'none',
                    pieSliceText: 'label',
                       is3D:false,                                               
                      // enableInteractivity: false,
                       colors: ['#05BDE3','#1F242A' ],
                                           
                       backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

    </script>
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ['valor', 'porcentaje'],
         <?php
    echo "['DISPONIBILIDAD'," . $dispon . "],";
    echo "['DESEMPEÑO'," . $desempenio  . "],";
    echo "['CALIDAD'," . $Quality . "],";
    
?> ]);
        var options = { // api de google chats, son estilos css puestos desde js
            chartArea: {width: '100%', height: '90%'},
            width: "100%", 
            height: "100%",
            chartArea: {left: 25, top: 10, width: "100%", height: "80%"},
            legend: 'none',
            enableInteractivity: true,                                               
            fontSize: 11,
            hAxis: {
                    textStyle: {
                      color: '#ffffff'
                    }
                  },
            vAxis: {
                textStyle: {
                      color: '#ffffff'
                    },
            viewWindowMode:'explicit',
            viewWindow: {
              max:100,
              min:0
            }
        },

            colors: ['#05BDE3'],    
            backgroundColor: 'transparent'
        };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
      chart.draw(data,options);
  }
  </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php
    echo $machineName;
?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- reloj -->   
    <link href="compiled/flipclock.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="compiled/flipclock.js"></script>
    <script src="js/easytimer.min.js"></script>
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.material.mobile.min.css" />

    <script src="//kendo.cdn.telerik.com/2016.3.914/js/kendo.all.min.js"></script>
  <link href="css/corte.css" rel="stylesheet" />
    <link href="css/estiloshome.css" rel="stylesheet" />
    <link href="css/general-styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jsGrafica.js"></script>
    <script src="js/graficabarras.js"></script>
    <script src="js/divdespegable.js"></script>
   
    <script src="js/test.js"></script>
    
    <script src="js/clock.js"></script>

    <script language="javascript">// <![CDATA[

// ]]></script>


<script language="javascript">
         function limpiar() {
           setTimeout('document.fo3.reset()',20);
      return false;
       
}
</script> 

<style type="text/css">
  #cantpedido{
    width: 170px;
    height: 82px;
  text-align: left;
    position: absolute;
    right: 15px;
    top: 0;
  
  }
  #cantpedido div{
    width: 100%;
    color: #fff;
        font-size: 14px;
   text-align: left;
    font-family: "monse-bold";

  }
  #cantpedido input{
    width: 160px;
    padding: 2px;
    text-align: center;
    border-radius: 3px;
    border: 1px solid #B2BDC8;
    background: #F3F5F7;
    font-size: 40px!important;

    color: #606062;
    font-family: "monse-bold";
  }
  .darkinput{
    background: #343434!important;
    color: #fff!important;
        border: 1px solid #5C5C5C!important;
  }
  .diferentbutton{
    cursor: pointer;
    margin-top: 80px;
  }
  .diferentbutton div{
    display: inline-block;
    padding: 0!important;
    margin: 0!important;
  }
  .diferentbutton div:first-child{
    width: 80px;
    height: 80px;
    background: #B05326;
    position: relative;
    border-top-left-radius:4px;
    border-bottom-left-radius:4px;


  }
  .diferentbutton div:first-child img{
    width: 50px;
    position: absolute;
    top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);

  }
  .diferentbutton div:last-child{
    width: 170px;
    height: 80px;
    background: #FC7736;
    color: #fff;
     border-top-right-radius:4px;
    border-bottom-right-radius:4px;
    position: relative;
  }
  .diferentbutton div:last-child p{
    top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
    position: absolute;
    font-family: "monse-bold";
    font-size: 20px;

  }

  .orderform{
    width: 200px;
    height: 300px;
    display: inline-block;
    margin: 10px;
    text-align: center;
    border-radius:6px;
    
    border: 1px solid #CCCCCC;
  }
  .orderform input{
    width: 100%;
    padding: 6px 12px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc!important;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 24px;
  }
  .headbar{
    width: 100%;
    background: #ccc;
    height: 50px;
    line-height: 50px;
    color: #fff;
    font-family: "monse-bold";
    font-size: 22px;
    border-top-left-radius:4px;
    border-top-right-radius:4px;
  }
  .orderform p{
    margin: 0!important;
  }
  .formbody{
    width: 90%;
    position: relative;
    margin:0 auto;

  }
</style>

</head>
<body style="">
<input type="hidden" id="display-ete" value="<?php
    echo "getete " . $getEte . " dispon " . $dispon . " quality " . $Quality . " efec " . $desempenio;
?>">
<input type='hidden' id='pausedorder' value="<?= (isset($secondspaused)) ? $secondspaused : 'false' ?>">
 
  <?php
    $valorQuePasa  = (isset($_GET['mivariable'])) ? $_GET['mivariable'] : $recoverMac;
    $valorQuePasa2 = (isset($_GET['mivariable'])) ? $_GET['mivariable'] : $recoverMac;
    
    
    $machine    = "SELECT * FROM maquina m INNER JOIN asaichi a ON m.idmaquina = a.id_maquina WHERE nommaquina = '$machineName' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC";
    //echo $valorQuePasa;
    $deamachine = $mysqli->query($machine);
    
?>         

<?php
    if ($row = mysqli_fetch_object($deamachine)) {
        $mach_name = $row->nommaquina;
    }
?>

    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>
<div class="contegral">
   
      <ul>
  <li> <div id="divPHOTO" class="user-photo"></div></li>
  <li><span><?php
    echo "Bienvenido: " . $_SESSION['logged_in'];
?></span></li>
  <li><span>Area: <?php
    echo $machineName;
?></span></li>

           
  <li style="float:right"></li>
   <li style="float:right"><span id="hora" >Produccion esperada: 12</span></li>
    <li style="float:right ;display:none;"><span><?php
    $fecha = strftime("%Y-%m-%d", time());
    echo $fecha;
?></span></li>
              
</ul>
        
<div class="statistics">
  <div class="stat-panel">
  <div class="stat-head"><div class="efectivity"><?php
    echo round($getEte);
?>%</div></div>
    <table class="orders gree">
 
  <tr class="trhead">
    <td class="orders-td2">ACTUAL:</td>
    
  </tr>
  <tr>
    
    <td class="orders-td"> <?php if (count($orderID) > 1) {
        echo $odetes;
   
     } else{
        if ($row = mysqli_fetch_object($resultado1)) {
        $prodact       = $row->producto;
        $element_query = "SELECT nombre_elemento FROM elementos WHERE id_elemento=$prodact";
        $get_elem      = mysqli_fetch_assoc($mysqli->query($element_query));
        $actelement    = $get_elem['nombre_elemento'];
        echo $row->numodt . " <span style='color:#2FE3BF'>" . $actelement . "</span>";
    } else {
        echo "--";
    }
     }
    
?></td>
  </tr>
  
</table>
<table class="orders gree">
 
  <tr class="trhead">
    <td class="orders-td2">SIGUIENTE:</td>
    
  </tr>
  <tr>
    
    <td class="orders-td"><?php
    if ($row2 = mysqli_fetch_object($resultado2)) {
        $prodsig          = $row2->producto;
        $sigelement_query = "SELECT nombre_elemento FROM elementos WHERE id_elemento=$prodsig";
        $get_sigelem      = mysqli_fetch_assoc($mysqli->query($sigelement_query));
        $sigelement       = $get_sigelem['nombre_elemento'];
        echo $row2->numodt . " <span style='color:#2FE3BF'>" . $sigelement . "</span>";
    } else {
        echo "--";
    }
?>
   </td>
  </tr>
  
</table>
<table class="orders gree">
 
  <tr class="trhead">
    <td class="orders-td2">PREPARACIÓN:</td>
    
  </tr>
  <tr>
     
    <td class="orders-td" ><?php
    if ($row3 = mysqli_fetch_object($resultado3)) {
        $prodprep          = $row3->producto;
        $prepelement_query = "SELECT nombre_elemento FROM elementos WHERE id_elemento=$prodprep";
        $get_prepelem      = mysqli_fetch_assoc($mysqli->query($prepelement_query));
        $prepelement       = $get_prepelem['nombre_elemento'];
        echo $row3->numodt . " <span style='color:#2FE3BF'>" . $prepelement . "</span>";
    } else {
        echo "--";
    }
?>
      
    </td>
   
    
  </tr>
</table>
  </div>
  <div class="stat-panel" style="">
  <?php //print_r($_POST); 
?>
  <div style="width: 100%;height: 100%; position: absolute;">
   <div class="grafica">
                   <!-- <div id="graficajs" class="panelabajo"></div> -->
                        <div id="piechart" style="width: 100%; height: 100%;" ></div>        
                    </div>
                    </div>
  </div>
  <div class="stat-panel" style="">

    
                <!-- <div id="_GraficaInter"></div> -->
                <div id="columnchart" style="top:10px;width: 100%; height: 300px; position:absolute; "></div>

            

  </div>
</div>
 <form name="fvalida" id="fvalida" method="POST" onsubmit="saveTiro()">
 <input type="hidden" name="element" value="<?=$element ?>">
  <input type="hidden" name="section" value="tiraje">
 <input type="hidden" name="hour" value="<?= (isset($_POST['horadeldia'])) ? $_POST['horadeldia'] : $horaAjuste; ?>"> 
<div class="statistics">
  <div class="left-sec" style="position: relative;">
      <div class="timersmall">
          <div id="tirajeTime">
          <div id="timersmall"><span class="valuesTiraje">00:00:00</span></div>
          </div>
          </div>
          <?php
    if ($row = mysqli_fetch_object($resultado0)) {
        $cpedido = $row->cantpedido;
    }
?>
  <?php
    
    if (count($orderID)== 1) {
?>
          <div id="cantpedido">
            <div> CANTIDAD DE PEDIDO</div>
            <input id="pedido" class="darkinput" name="pedido" value="<?= $cpedido ?>" readonly  style="margin-right: 10px;">
          </div>
          <?php } ?>
          <div class="button-panel" id="leftbuttons">
                        <a href="#" onClick="endSesion()"> <img src=""  href="#" class="img-responsive"  />
                        <div class="square-button-h red">
                          <img src="images/exit-door.png">
                        </div></a>
                        <div class="square-button-h green stop eatpanel goeat">
                          <img src="images/dinner2.png">
                        </div>
                        <?php if (count($orderID)== 1) { ?>
                        <div class="square-button-h blue " id="saving">
                          <img src="images/saving.png">
                        </div>
                        <?php } ?>
                        <div class="square-button-h yellow   derecha goalert">
                          <img src="images/warning.png">
                        </div>
                       <div class="square-button-h prple" onclick="pauseConfirm();">
                          <div class="square-text"> PAUSAR Y CONTINUAR MAÑANA</div>
                        </div>
                        
                        </div>
              
  </div>
  <div class="right-sec">

  <?php
    
    if (count($orderID) > 1) {
?>
   <div class="diferentbutton" onclick="multiOrders()">
       <div ><img src="images/insert.png"></div><div><p>INGRESAR DATOS</p></div>
       
   </div>

<!-- ********************** Ventana multiples ordenes seleccionadas ******************** -->
<div class="boxmulti">
 <div class="close" onclick="close_box()">x</div>
  <div style="width: 100%; height: 420px;overflow-y: scroll; ">
  <?php
foreach ($orderID as $odt) {
    $data_query = "SELECT * FROM ordenes WHERE idorden=$odt";
    $result     = $mysqli->query($data_query);
    while ($row = mysqli_fetch_object($result)) {
        $odete = $row->numodt;
        $pedidos=$row->cantpedido;
        $recibidos=$row->cantrecibida;
        $producto=$row->producto;
    }
?>
     <div class="orderform">
     <div class="headbar"><p>Orden <?= $odete ?></p></div>
     <div class="formbody">
        
     <p>Buenos</p>
        <input id="buenos-<?=$odt?>" type="number" name="buenos[<?=$odt?>]" >
     <p>Defectos</p>
         <input id="defectos-<?=$odt?>" type="number" name="defectos[<?=$odt?>]" onkeyup="operaMulti(<?=$odt?>)">
     <p>Pieza de Ajuste</p>
         <input id="ajuste-<?=$odt?>" type="number" name="ajuste[<?=$odt?>]" onkeyup="operaMulti(<?=$odt?>)">
     </div>
     <input id="odetes-<?=$odt?>" type="hidden" name="odetes[<?=$odt ?>]" value="<?=$odete ?>" />
     <input id="mermasrecib-<?=$odt?>" type="hidden" name="mermasrecib[<?=$odt ?>]" value="<?= $recibidos-$pedidos ?>"/>
     <input id="mermasent-<?=$odt?>" type="hidden" name="mermasent[<?=$odt?>]" />
     <input  type="hidden" name="productos[<?=$odt?>]"  value="<?= $producto ?>"/>
     <input id="recibidos-<?=$odt?>" type="hidden" name="recibidos[<?=$odt?>]"  value="<?= $recibidos ?>"/>
     <input id="pedidos-<?=$odt?>" type="hidden" name="pedidos[<?=$odt?>]" value="<?= $pedidos ?>" />
    
     </div>
 <?php
}
?>
</div>
<div style="width: 100%; text-align: center; "> <div class="square-button-h blue " id="saving">
                          <img src="images/saving.png">
    </div>
    </div>
  </div>
  <!-- ********************** Termina Ventana multiples ordenes seleccionadas ******************** -->
 <input type="hidden" id="numodt" name="numodt" value="<?= implode(",", $orderID) ?>"/>
 <input  type="hidden" id="qty" name="qty" value="multi" />
<input  type="hidden" id="odt" name="odt" value="<?=$odetes ?>" />
  <?php
    } else {
?>
  <div style="width: 100%; text-align: center;">
  <?php
        if ($pause_exist != true) {
?>
     <table id="former">
  <input  type="hidden" id="qty" name="qty" value="single" />
  <tr>
    <td class="title-form">CANTIDAD RECIBIDA</td>
    <td class="title-form">BUENOS</td>
  </tr>
  <tr>
    <?php
            if ($row = mysqli_fetch_object($resultado01)) {
                $cantrecib = $row->cantrecibida;
                
                $merm = ($row->merma_recibida != null) ? $cantrecib - $cpedido : $cantrecib - $cpedido;
            }
?>
    <td class=""><input id="cantidad" class="darkinput" name="cantidad" value="<?= $cantrecib ?>"  readonly></td>
   
   
   <td class=""><input id="buenos"  name="buenos" type="number"  name="" style="margin-right: 10px;" required="required"></td>
    
    
  </tr>
  <tr>
    <td class="title-form">MERMA &nbsp&nbsp&nbsp&nbsp&nbsp DEFECTOS</td>
    <td class="title-form">PIEZAS DE AJUSTE</td>
  </tr>
  <tr>
    <td class=""><input id="merma" class="darkinput" name="merma" type="number"  readonly value="<?= $merm ?>"  style="width: 75px;margin-right: 10px;" required="required"><input id="defectos" class="darkinput" name="defectos" type="number" value="0"  readonly  style="width: 75px;"></td>
    <td class=""><input  id="piezas-ajuste" name="piezas-ajuste" type="number"    style="margin-right: 10px;" onkeyup="opera();" > </td>
  </tr>
  <tr>
    <td class="title-form">MERMA ENTREGADA</td>
    <td class="title-form">ENTREGADOS</td>
  </tr>
  <tr>
    <td class=""><input class="darkinput" value="0" id="merma-entregada" name="merma-entregada" type="number" readonly   style="margin-right: 10px;" ></td>
      <td class=""><input id="entregados" name="entregados" type="number" value="0" required="true" readonly style="background: #4C89DC; border:1px solid rgba(255,255,255,.5); color: #fff;"></td>
  </tr>
</table>

<?php
        } else {
?>
<table id="former">
 
  <tr>
    <td class="title-form">CANTIDAD RECIBIDA</td>
    <td class="title-form">BUENOS</td>
  </tr>
  <tr>
    <?php
            $query_avance   = "SELECT * FROM tiraje WHERE id_orden=$stoppedOrderID AND fechadeldia_tiraje='$fecha_pausa'";
            $resultadopause = $mysqli->query($query_avance);
            
            if ($row = mysqli_fetch_object($resultadopause)) {
                
                $cantrecib = $row->cantidad;
                $merm      = ($row->merma == null) ? $cantrecib - $cpedido : $row->merma;
                $buen      = $row->buenos;
                $adjust    = $row->piezas_ajuste;
                $defect    = $row->defectos;
            }
?>
    <td class=""><input id="cantidad" class="darkinput" name="cantidad" value="<?= $cantrecib ?>"  readonly></td>
   
   
   <td class=""><input id="buenos"  name="buenos" type="number"  name="" style="margin-right: 10px;" required="required" onkeyup="operaPaused();"></td>
    
    
  </tr>
  <tr>
    <td class="title-form">MERMA &nbsp&nbsp&nbsp&nbsp&nbsp DEFECTOS</td>
    <td class="title-form">AVANCE</td>
  </tr>
  <tr>
  <input type="hidden" value="<?= $adjust ?>" id="piezas-ajuste" name="piezas-ajuste">
    <td class=""><input id="merma" class="darkinput" name="merma" type="number"  readonly value="<?= $merm ?>"  style="width: 75px;margin-right: 10px;" required="required"><input id="defectos" class="darkinput" name="defectos" type="number" value="<?= $defect ?>"  readonly  style="width: 75px;"></td>
    <td class=""><input class="darkinput" id="avance" name="avance" type="number"  readonly  style="margin-right: 10px;"  value="<?= $buen ?>"> </td>
  </tr>
  <tr>
    <td class="title-form">MERMA ENTREGADA</td>
    <td class="title-form">ENTREGADOS</td>
  </tr>
  <tr>
    <td class=""><input class="darkinput" value="0" id="merma-entregada" name="merma-entregada" type="number" readonly   style="margin-right: 10px;" ></td>
      <td class=""><input id="entregados" name="entregados" type="number" value="0" required="true" readonly style="background: #4C89DC; border:1px solid rgba(255,255,255,.5); color: #fff;"></td>
  </tr>
</table> 
<?php
        }
?>
<?php
    
    while ($row = mysqli_fetch_object($resultado02)) {
        
?>
                                                         
                            <input hidden id="producto" name="producto" class=" diseños" value="<?= $row->producto ?>"/>
                             <input hidden id="numodt" name="numodt" class="diseños" value="<?= implode(',', $orderID) ?>"/>
                             <input hidden id="odt" name="odt" class=" diseños" value="<?= $row->numodt ?>"/>
                      <input hidden id="numproceso"  class=" diseños" value="<?= $row->proceso ?>"/>
                             <?php
        
    }
?>
</div>
<?php
    }
?>
         <input hidden class="diseños"  type="text" name="tiempoTiraje" id="tiempoTiraje" />
                   <input hidden type="text"  name="logged_in" id="logged_in" value="<?php
    echo "" . $_SESSION['id'];
?>" />
                   <input hidden  name="horadeldia" id="horadeldia" value="<?php
    echo date(" H:i:s", time() - 28800);
?>" />
                   <input hidden  name="fechadeldia" id="fechadeldia" value="<?php
    echo date("d-m-Y");
?>" />
                   <input hidden type="text" name="nombremaquina" id="nombremaquina"  class="diseños" value="<?php
    echo $valorQuePasa2;
?>"  /> 
                    


                          <input id="formbutton" type="submit" style="visibility: hidden;"></button>
       
</form>
</div>
    
    </div>
<div class="backdrop"></div>
<!-- ********************** Ventanita loader ******************** -->
<div class="box">
  <div class="saveloader">
  
    <img src="images/loader.gif">
    <p style="text-align: center; font-weight: bold;">Guardando..</p>
  </div>
  <div class="savesucces" style="display: none;">
  
    <img src="images/success.png">
    <p style="text-align: center; font-weight: bold;">Listo!</p>
  </div>
  </div>
<!-- ********************** Termina Ventanita loader ******************** -->

<!-- ********************** Panel Alerta Maquina ******************** -->
   <div id="panelizqui">
       
   </div>
   <div id="panelder">
      <div class="container">
          
            <div id="estilo">
             <form id="alerta-tiro" name="alerta-tiro" method="post"  class="form-horizontal"  >
                
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php
    echo "" . $_SESSION['logged_in'];
?>" />
                <input hidden  name="horadeldiaam" id="horadeldiaam" value="<?php
    echo date(" H:i:s", time() - 28800);
?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php
    echo date("d-m-Y");
?>" />
                <input hidden  type="text" name="nombremaquinaajuste" id="nombremaquinaajuste"   value="<?php
    echo $valorQuePasa2;
?>"  /> 
               
                <fieldset>

                 <!-- Form Name -->
                <legend>ALERTA MAQUINA</legend>
                 <!-- Multiple Radios -->
                <div class="form-group" style="width:80% ;margin:0 auto;">
                <?php
    include "alertsTiraje.php";
?>
                
                </div>

               

                <!-- Textarea -->
                <div class="form-group" style="text-align: center; color:black;">
                    <textarea placeholder="Observaciones.." class="comments" id="observaciones" name="observaciones"></textarea>
                
                </div>
                <div class="form-group">
                  <div class="button-panel-small">
                       
                        <div class="square-button-small red derecha stopalert start reset">
                          <img src="images/ex.png">
                        </div>
                        <div id="savealerta" class="square-button-small derecha blue " onclick="showLoad(); saveAlert();">
                          <img src="images/saving.png">
                        </div>
                        
                          
                        </div>
                </div>
                <!-- reloj -->
                
                 <div class="reloj-container2">  
        <div class="timersmall">
                                    <div id="alertajuste" style="text-align: center;">
                                    <div id="timersmall"><span class="valuesAlert">00:00:00</span></div>
                                    <input type="hidden"  name="tiempoalertamaquina" id="timealerta"  />
                                   
                                    
                                </div>
                                </div>
    </div>
                <input id="eviar" type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive derecha stopalert start reset2 " style="display: none;">

               </fieldset>    
                
             </form>
          <!-- <div id="result"></div>     
          -->  
           
      <div class="reloj-container2">
        <div  id="relojajuste" class="relojajuste" ></div>
      </div>
      </div>
   </div>
 </div>
 <!-- ********************** Termina Panel Alerta Maquina ******************** -->
 
  <!-- ********************** Inicia Panel comida ******************** -->
   <div id="panelbrake">
    <div id="panelbrake2"></div>
      <div class="container-fluid" style="text-align: center;">
          
          <div id="estilo" style="text-align: center;">
             <form id="fo4" name="fo4"  method="post" class="form-horizontal" >
                <fieldset style="position: relative;left: -15px;">
                
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php
    echo "" . $_SESSION['logged_in'];
?>" />
                <input hidden name="horadeldiaam" id="horadeldiaam" value="<?php
    echo date(" H:i:s", time() - 28800);
?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php
    echo date("d-m-Y");
?>" />
                <input hidden name="maquina" id="maquina" value="<?php
    echo $valorQuePasa2;
?>"  />         
                  <!-- Form Name -->
                 <legend>Comida</legend>
                
                   <input type="hidden" id="timeeat" name="breaktime">
               
                   <!-- Multiple Radios (inline) -->
                   <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>

              <div class=" radio-menu face  eatpanel" onclick="showLoad();submitEat();">
                <input type="radio" class="" name="radios" id="radios-0" value="Comida">
                    COMIDA</div>
               <div class=" radio-menu face eatpanel" onclick="showLoad();submitEat();">
               <input type="radio" name="radios" id="radios-1" value="Sanitario" >
                   SANITARIO
                    
                    </div>
                    
                
                </div>
                   </br>
                   </br>
                   </br>
                <div class="form-group">
                  <div class="button-panel-small">
                       
                        <div  class="square-button-small red eatpanel stopeat start reseteat2 ">
                          <img src="images/ex.png">
                        </div>
                        </div>
               
                </div>
               </fieldset>    
                
             </form>
      
      <div class="reloj-container2" style="text-align: center;">
    <div class="timersmall">
                                    <div id="horacomida" style="text-align: center;">
                                    <div id="timersmall" style="text-align: center;">
                                    <span class="valuesEat">00:00:00</span>
                                    </div>
                                    
                                   
                                    
                                </div>
                                
                                </div>
    </div>
                                    <script>

                        $(document).ready(function(){
                        $('#divPHOTO').css("background-image", "url('<?php
    echo $_SESSION['MM_Foto_user'];
?>')");  
                        console.log('<?php
    echo $_SESSION['MM_Foto_user'];
?>');
                    });
                                </script>

      </div>
   </div>
</div>

<!-- ********************** Termina Panel comida ******************** -->

  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
 $('.radio-menu').click(function() {
  $('.face-osc').removeClass('face-osc');
  $(this).addClass('face-osc').find('input').prop('checked', true)    
});                         
                         $( "#saving").click(function() {
                          var buenos=$('#buenos').val();
                          var merma=$('#merma').val();
                          var entre=$('#entregados').val();
                          var ajuste=$('#piezas-ajuste').val();
                          var defectos=$('#defectos').val();
                         if (parseInt(entre)<0||parseInt(ajuste)<0||parseInt(defectos)<0) { alert('No puedes enviar valores negativos');}
                         
                          else{
                           <?php
    if (count($orderID) > 1) {

?>                           tiempoTiraje
                            timer.pause();
                            $('#tiempoTiraje').val(timer.getTimeValues().toString());   
                            $( "#formbutton" ).click();
                             showLoad();
                            <?php
    } else {
?>
                                if (buenos!=''&&ajuste!='') {
                                    timer.pause();
                            $('#tiempoTiraje').val(timer.getTimeValues().toString());  
                             $( "#formbutton" ).click();
                             showLoad();
                           }else{
                            if (buenos==''){
                              $('#buenos').addClass("errror").attr("placeholder", "?").effect( "shake" );

                            }
                            if (ajuste==''){
                              $('#piezas-ajuste').addClass("errror").attr("placeholder", "?").effect( "shake" );

                            }
                           }
                            <?php
    }
?>
                          
                         }
                                             
                                            });

                         
                    </script>

<script type="text/javascript">
 
  function pauseOrder(){
    var input_buenos=$('#pausebuenos').val();
    var input_ajuste=$('#pauseajuste').val();
  if (input_buenos=='') {
    $('#buenos-messaje').show();
  }
  if (input_ajuste=='') {
    $('#ajuste-messaje').show();
  }
    else{
    timer.pause();
    var tpausa=timer.getTimeValues().toString();
    var recib=<?= (isset($cantrecib)) ? (($cantrecib != null) ? $cantrecib : 0) : 0; ?>;
    var merm=<?= (isset($cantrecib)) ? $cantrecib - $cpedido : 0 ?>;
    var pedido=<?= (isset($cpedido)) ? $cpedido : 0 ?>;
    var fech=$('#fechadeldia').val();
    var hor=$('#horadeldia').val();
    var buen=$('#pausebuenos').val();
    var defec;
    
    
    var ajus=$('#pauseajuste').val();
    var prod=$('#producto').val();
    timer.stop();
    if (ajus>2) {
                              defec =(parseInt(ajus)-2);
                            }else{
                              defec =0;
                            }
    var merm_entreg=((parseInt(buen)-parseInt(pedido))-parseInt(ajus))-parseInt(defec);
    var entreg=(parseInt(ajus)+parseInt(merm_entreg))+parseInt(buen);
   
    var idord=$('#numodt').val();
    var proceso=$('#numproceso').val();
    console.log(idord);
    $.ajax({  
                             type:"POST",
                             url:"pauseOrder.php",   
                             data:{id_orden:idord,proceso:proceso,tpausa:tpausa,cantrecib:recib,cantpedido:pedido,merma:merm,buenos:buen,ajuste:ajus,defectos:defec,entregados:entreg,fecha:fech,hora:hor,producto:prod,mermaent:merm_entreg},  
                               
                             success:function(data){
                               
                                  $('.boxPause').html(data);
                                  setTimeout(function() {   
                   location.href = 'logout.php';
                }, 1000);
                                  
                             }  
                        });
  }
  }                   
    </script>
 
</body>

</html>

<!-- ************************ Contenido ******************** -->

<?php
    
}


?>

<!-- ********************** Ventana de pausar ordenes ******************** -->
<div class="boxPause">
  <p></p>
  <p style="font-size:26px; font-weight: bold;">Pausar tiraje</p>
  <p><input type="number" id="pausebuenos" placeholder="Buenos"></p>
  <p id="buenos-messaje" style="display: none;">Debes ingresar la cantidad de buenos</p>
  <p><input type="number" id="pauseajuste" placeholder="Piezas de ajuste"></p>
  <p id="ajuste-messaje" style="display: none;">Debes ingresar las piezas de ajuste</p>
  <div class="confirmbutton blue" onclick="pauseOrder()">ACEPTAR</div><div class="confirmbutton red" onclick="close_box()">CANCELAR</div>
  
  </div>
<!-- ********************** Termina Ventana de pausar ordenes ******************** -->



  <script src="js/tiraje.js"></script>