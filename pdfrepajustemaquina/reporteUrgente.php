<?php
error_reporting(0);
require_once("dompdf/dompdf_config.inc.php");
include '../saves/conexion.php';
$numodt = $_POST['id'];
$userid = $_POST['iduser'];
function getComida($idtiraje, $section)
{
    include '../saves/conexion.php';
    $query         = "SELECT TIME_TO_SEC(breaktime) AS real_comida FROM breaktime WHERE id_tiraje=$idtiraje AND seccion='$section' AND radios='Comida'";
    $tiempo_comida = mysqli_fetch_assoc($mysqli->query($query));
    return $tiempo_comida['real_comida'];
}

function getTiros($odt)
{
    include '../saves/conexion.php';
    
    $id_elem = mysqli_fetch_assoc($mysqli->query("SELECT SUM(buenos) AS tiros FROM tiraje WHERE odt_virtual='$odt' "));

    return $id_elem['tiros'];
}

$query = "SELECT * FROM tiraje WHERE fechadeldia_ajuste='$numodt' AND id_maquina NOT IN(9,22) AND odt_virtual IS NOT NULL";

$asa_query = "SELECT *, TIME_TO_SEC(tiempo) AS tiempo_asaichi,TIME_TO_SEC(timediff(hora_fin,horadeldia)) AS dispon_asaichi, (SELECT TIME_TO_SEC(tiempo_muerto) FROM tiempo_muerto WHERE seccion='asaichi' AND fecha='$numodt' AND id_user=$userid) AS tmuerto_asa FROM asaichi WHERE fechadeldia='$numodt' AND id_usuario=$userid";

$resss     = $mysqli->query($query);
$asa_resss = $mysqli->query($asa_query);
$getuser   = mysqli_fetch_assoc($mysqli->query("SELECT logged_in FROM login WHERE id=$userid"));



?>
<?php
ob_start();
?>
<html>
<head>
<style>
@page {
            margin: 1.3em 1.3em;
            
        }
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

thead{
  background: #1A1F25;
  color: #fff;
  text-transform: uppercase;
  font-size: 7px!important;
  padding: 1px!important;
}

td, th {
    border: 1px solid #E1E0E5;
    text-align: center;
    padding: 2px;
    font-size: 9px;
}


.inhead{
  display: inline-block;
  width: 68%;
   font-family: arial, sans-serif;
   
   height: 50px;
  

}
.inhead table{
  width: 100%;
  text-align: center;

}
.inhead th{
 padding: 2px;
 text-align: center;
 border:1px solid #E1E0E5!important;

}
.inhead td{
border:1px solid #E1E0E5!important;
 text-align: center;

}
.logo{
  display: inline-block;
  width: 12%;
   font-family: arial, sans-serif;
   height: 50px;
   position: relative;
   

}
.logo img{
  position: absolute;
  top:-7px;
}
.title{
  display: inline-block;
  width: 20%;
  font-size: 12px;
  text-align: center;
   font-family: arial, sans-serif;
  font-weight: bold;
   height: 50px;
   line-height: 50px;
   vertical-align: middle;
   

}

.header{
  width: 100%;
  margin: 0 auto;
  padding-bottom: 5px;
  padding-top: 5px;
  height: 50px;
  
}
.header img{
  width: 100%;
}
#last {
  text-align: right!important;
}
#last img{
  width: 50%;
}
.botom-stats{
  display: inline-block;
  border:1px solid #E1E0E5;
  position: relative;
  font-family: arial, sans-serif;
}
.botom-stats div{
  position: relative;
  font-size: 12px;
}
.botom-stats td,th{
  font-size: 10px;
  font-weight: normal;
  border-top:none;
}
.botom-stats td{
  border-bottom:1px dashed #E1E0E5;
  border-left: none;
  border-right: none;
}
.botom-stats th{
  border-bottom:1px dashed #E1E0E5;
  border-right:1px dashed #E1E0E5;
}
.extra{
  border-right: 1px dashed #E1E0E5!important;
}
.extrath{
  border-bottom: none!important;
}
.sub-head{
  padding: 0!important;
  font-size: 6px!important;
}
.alertime{
  font-weight: bold;
}
</style>
</head>

<body>
<div class="header">
  <div class="logo"><img src="../img/logoDerecha.png">
  </div><div class="title">REPORTE
 
 </div> <div class="inhead">

 
  </div>
</div>

<table>
<thead><tr>
    
    
    <th >ODT</th>
    <th >Tiros</th>
    
    
   
  </tr>

  </thead>
  <tbody>
  <?php
$i             = 0;
$sum_esper     = 0;
$sum_merm      = 0;
$sum_real      = 0;
$sum_tiraje    = 0;
$sum_ajuste    = 0;
$sum_muerto    = 0;
$sum_defectos  = 0;
$sum_calidad   = 0;
$sum_dispon    = 0;
$sum_recibidos = 0;
$comida_exist  = '';
$comida_exist2 = '';
$asa_exist     = ($asa_resss->num_rows > 0) ? true : false;

?>
  <?php
while ( $r= mysqli_fetch_assoc($resss)){
  $ordenes[$r['odt_virtual']]=$r;
}
foreach ($ordenes as $row):
    if ($i == 0) {
        if (!$asa_exist) {
            $transcur = strtotime($row['horadeldia_ajuste']) - strtotime("08:45:00");
            $sum_muerto += $transcur;
            $sum_dispon += $transcur;
        }
        
    }
    //$comida_exist = (!empty($row['comida_ajuste'])) ? 'Comida ' . gmdate("H:i", $row['ini_comida_ajuste']) . "-" . gmdate("H:i", $row['fin_comida_ajuste']) : '';
    $comida_exist = (!empty($row['comida_ajuste'])) ? '<tr><td colspan="24" style="color:#fff;background:#A6A6A6;"> COMIDA ' . gmdate("H:i", $row['ini_comida_ajuste']) . "-" . gmdate("H:i", $row['fin_comida_ajuste']).' </td></tr>' : '';
    //$sum_muerto+=$row['comida_ajuste'];
    $sum_esper += $row['produccion_esperada'];
    $sum_merm += $row['merma_entregada'];
    $sum_real += $row['entregados'] - $row['merma_entregada'];
    $sum_recibidos += $row['cantidad'];
    $sum_ajuste += $row['seconds_ajuste'];
    $sum_muerto += $row['seconds_muertos_tiro'];
    $sum_defectos += $row['defectos'];
    $sum_calidad += $row['calidad'];
    $comida = (!empty($row['comida_ajuste'])) ? $row['dispon_ajuste']-$row['comida_ajuste'] : $row['dispon_ajuste'];
    $sum_dispon += $comida;
    $processID=($row['id_maquina']==20||$row['id_maquina']==21)? 10:(($row['id_maquina']==22)? 9 : $row['id_maquina'] );
    if (is_null($row['estandar'])) {
        
        if ($processID == 10) {
            $tiraje_estandar = 420;
        } else {
            $tiraje_estandar = 600;
        }
    } else {
        $tiraje_estandar = $row['estandar'];
    }
    $idtiro      = $row['idtiraje'];
    $alertaquery = $mysqli->query("SELECT *,TIME_TO_SEC(horadeldiaam)  AS inicio,TIME_TO_SEC(horafin_alerta) AS fin,  TIME_TO_SEC(tiempoalertamaquina) AS alert_real,TIME_TO_SEC(timediff(horafin_alerta ,horadeldiaam)) AS dispon_alertajuste FROM alertageneralajuste WHERE id_tiraje=$idtiro");
    $alertaTiro  = $mysqli->query("SELECT *,TIME_TO_SEC(horadeldiaam)  AS inicio,TIME_TO_SEC(horafin_alerta) AS fin,  TIME_TO_SEC(tiempoalertamaquina) AS alert_real,TIME_TO_SEC(timediff(horafin_alerta ,horadeldiaam)) AS dispon_alertatiro FROM alertamaquinaoperacion WHERE id_tiraje=$idtiro");
    
    
    while ($alertaAjuste = mysqli_fetch_assoc($alertaquery)) {
        
        $alert[$i][]      = ($alertaAjuste['radios'] == 'Otro') ? $alertaAjuste['observaciones'] . " <span class='alertime'>" . gmdate("H:i", $alertaAjuste['inicio']) . "-" . gmdate("H:i", $alertaAjuste['fin']) . "</span>" : $alertaAjuste['radios'] . " <span class='alertime'>" . gmdate("H:i", $alertaAjuste['inicio']) . "-" . gmdate("H:i", $alertaAjuste['fin']) . "</span>";
        $alertA_Sum[$i][] = $alertaAjuste['alert_real'];
    }
    if (isset($alertA_Sum)) {
      $sum_muerto += array_sum($alertA_Sum[$i]);
    }
   
    
    
    
    
    
?>
                         
  
<?php
    //$sum_muerto+=$row['comida_tiro'];
    //$comida_exist2 = (!empty($row['comida_tiro'])) ? 'Comida ' . gmdate("H:i", $row['ini_comida_tiro']) . "-" . gmdate("H:i", $row['fin_comida_tiro']) : '';
    $comida_exist2 = (!empty($row['comida_tiro'])) ? '<tr><td colspan="24" style="color:#fff;background:#A6A6A6;"> COMIDA ' . gmdate("H:i", $row['ini_comida_tiro']) . "-" . gmdate("H:i", $row['fin_comida_tiro']).' </td></tr>' : '';
    
    
    while ($alertaT = mysqli_fetch_assoc($alertaTiro)) {
        $alertTiro[$i][] = ($alertaT['radios'] == 'Otro') ? $alertaT['observaciones'] : $alertaT['radios'];
        
        
        $alertT_Sum[$i][] = $alertaT['alert_real'];
        
    }

    if (isset($alertT_Sum)) {
      $sum_muerto += array_sum($alertT_Sum[$i]);
    }
    
    
?>
      <tr>
                         
    
    <td> <?= ($row['is_virtual'] == 'true') ? $row['odt_virtual'] : $row['numodt'] ?> </td>
   
    
    <td><?=getTiros($row['odt_virtual']) ?></td>
    
   
   
  </tr>
           
  <?php
    $i++;
endforeach;
?>
  
  </tbody>
</table>
<br>
<p>Ordenes Trabajadas: <?=count($ordenes); ?></p>

</body>
</html>



<?php
$html = ob_get_clean();

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('letter', 'landscape');
$dompdf->render();
$dompdf->stream("reporte_de_orden.pdf", array(
    'Attachment' => 0
));
