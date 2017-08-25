

<?php
date_default_timezone_set("America/Mexico_City");
 if( !session_id() )
    {
        session_start();
    }
    if(@$_SESSION['logged_in'] != true){
       header('Location:http:'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/index2.php');
    }else{
      if (isset($_COOKIE['tiraje'])){
    setcookie('tiraje', true,  time()-3600);
    unset ($_COOKIE['tiraje']);
    }
  if (!isset($_COOKIE['ajuste'])){
    setcookie('ajuste', true,  time()+1800);
    }        
require('saves/conexion.php');

//cuando cierran sesion
$ip=getenv("REMOTE_ADDR"); 
$cmd = "arp  $ip | grep $ip | awk '{ print $3 }'"; 
$recoverSession=(!empty($_POST))? 'false' : 'true' ;

if (empty($_POST)) {
  //$recoverMac='5c:f5:da:2f:33:5e';
  $recoverMac=system($cmd);
$queryRec="SELECT * FROM maquina WHERE mac='$recoverMac'";
$recoverMachine = mysqli_fetch_assoc($mysqli->query($queryRec));
$mrecovered = $recoverMachine['nommaquina'];
$machineName=$recoverMachine['nommaquina'];
$mrecoveredId = $recoverMachine['idmaquina'];
$machineID=$mrecoveredId;
$recoverOrdenPaused="SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$mrecovered' AND avance='en pausa'";
  $recoverOrden="SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$mrecovered' AND avance='retomado'";
   $recov=$mysqli->query($recoverOrdenPaused);
  if ($recov->num_rows>0) {
     $recoOrden = mysqli_fetch_assoc($recov);
    $stoppedOrder = $recoOrden['numodt'];
$stoppedOrderID = $recoOrden['id_orden'];
header('Location:http:'.dirname($_SERVER['PHP_SELF']).'/index3.php');
  }else{
  $recov=$mysqli->query($recoverOrden);
  
    $recoOrden = mysqli_fetch_assoc($recov);
    $stoppedOrder = $recoOrden['numodt'];
    $stoppedOrderID = $recoOrden['id_orden'];
  }
  

// termina cuando cierran sesion
}

if (!empty($_POST)) {
 $cycle=$_POST['ciclo'];
if ($cycle=='start') {


 
$tiempo=$_POST['tiempo'];
$mac=$_POST['mac'];
$logged_in=$_POST['logged_in'];
$horadeldia=$_POST['horadeldia'];
$fechadeldia=$_POST['fechadeldia'];
$query2="SELECT id FROM login WHERE logged_in='$logged_in'";
$query4="SELECT * FROM maquina WHERE mac='$mac'";
//$extract_user=$mysqli->query($query2);
//$userId=mysql_fetch_assoc($extract_user);
$getID = mysqli_fetch_assoc($mysqli->query($query2));
$userID = $getID['id'];
$getMachine = mysqli_fetch_assoc($mysqli->query($query4));
$machineID = $getMachine['idmaquina'];
$machineName = $getMachine['nommaquina'];
//verificar si hay una orden en pausa 
$orderPaused="SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$machineName' AND avance='en pausa'";
  $recov=$mysqli->query($orderPaused); 
  if ($recov->num_rows==0) {

$queryOrden="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
$asoc=$mysqli->query($queryOrden);

while($get_Act=mysqli_fetch_assoc($asoc)){
 
  $getActODT[] = $get_Act['numodt'];
  $ordenActual[] = $get_Act['idorden'];
  
}


$query="INSERT INTO asaichi (tiempo, id_maquina, id_usuario, horadeldia, fechadeldia) VALUES ('$tiempo','$machineID',$userID,'$horadeldia','$fechadeldia')";
$resultado=$mysqli->query($query);
//$query3="UPDATE login SET nommaquina= ('$nommaquina') WHERE logged_in= '$logged_in'";
//$query3="SELECT nommaquina FROM ajuste WHERE logged_in= '$logged_in'";
}
else{
  header('Location:http:'.dirname($_SERVER['PHP_SELF']).'/index3.php');
}

}
elseif ($cycle=='restart') {
  
$nombremaquina=$_POST['nombremaquina'];
$lastOrder=$_POST['idorden'];
$logged_in=$_POST['logged_in'];
$horadeldia=$_POST['horadeldia'];
$fechadeldia=$_POST['fechadeldia'];
$desempeno=$_POST['desempeno'];
$problema= (isset($_POST['problema'])) ?$_POST['problema'] : '';
$calidad=$_POST['calidad'];
$problema2=(isset($_POST['problema2'])) ?$_POST['problema2'] : '';
$odt=$_POST['odt'];
$observaciones=$_POST['observaciones'];
$mac=$_POST['nombremaquina'];

$query2="SELECT id FROM login WHERE logged_in='$logged_in'";
$query4="SELECT * FROM maquina WHERE mac='$nombremaquina'";
$getID = mysqli_fetch_assoc($mysqli->query($query2));
$userID = $getID['id'];
$getMachine = mysqli_fetch_assoc($mysqli->query($query4));
$machineID = $getMachine['idmaquina'];
$machineName = $getMachine['nommaquina'];

$query="INSERT INTO encuesta (id_usuario, id_maquina, horadeldia, fechadeldia, desempeno, problema, calidad, problema2, observaciones) VALUES ('$userID','$machineID','$horadeldia','$fechadeldia','$desempeno','$problema','$calidad','$problema2','$observaciones')";


$resultado=$mysqli->query($query);


if ( $resultado) {
  function is_in_array($needle, $haystack) {
    foreach ($needle as $stack) {if (in_array($stack, $haystack)) { return true;} }
    return false;
}
  if ($_POST['qty']='multi') {
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



while($arrd=mysqli_fetch_array($deliv)) {
  $deliver[] = $arrd['avance'];
  
}

$b = array('inicio','en pausa','retomado');
function is_in_array($needle, $haystack) {

    foreach ($needle as $stack) {

        if (in_array($stack, $haystack)) {
             return true;
        }
    }

    return false;
}

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
}

$p=1;
if ( $p==1) {

?>
<!-- *********************** CONTENIDO ********************* -->
<!DOCTYPE html>

<html>
<?php include 'head.php'; ?>
<body onload="setTimeout('alerttime()',2000000);">
<div id="formulario"></div>
    <style type="text/css">
       .clock{
        transform: scale(1.5);
-ms-transform: scale(1.5); 
-webkit-transform: scale(1.5); 
-o-transform: scale(1.5);
-moz-transform: scale(1.5);
      }  

#load{
  width: 100%; text-align: center; 
}

         .congral2{
            width: 100%;
            height: 100%;

        }
 .cont2{
           
          
            
        }

        #result {
  width:280px;
  padding:10px;
  border:1px solid #bfcddb;
  margin:auto;
  margin-top:10px;
  text-align:center;
}

 #success-msj{
    color: #BB1B1B!important;
    font-family: "monse-medium"!important;

}   
.backdrop
    {
      position:absolute;
      top:0px;
      left:0px;
      width:100%;
      height:100%;
      background:#000;
      opacity: .0;
      filter:alpha(opacity=0);
      z-index:50;
      display:none;
    }
 
 
    .box
    {
      position:absolute;
      top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      width:150px;
      height: 150px;
      
      background:#ffffff;
      z-index:51;
      padding:10px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      -moz-box-shadow:0px 0px 5px #444444;
      -webkit-box-shadow:0px 0px 5px #444444;
      box-shadow:0px 0px 5px #444444;
      display:none;
    }
 
    .close
    {
      float:right;
      margin-right:6px;
      cursor:pointer;
    }
    .saveloader{
      width: 100%;
      text-align: center;
      position: relative;
    }
    .saveloader img{
      width: 100%;
    }
    .saveloader p{
     margin-top: -20px;
    }
     .savesucces{
      width: 100%;
      text-align: center;
      position: relative;
    }
    .savesucces img{
      width: 60%;
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .savesucces p{
     
    }    
@media only screen and (min-width:481px) and (max-width:768px) and (orientation: portrait) {
    .contegral{
        display:none;
    }
        body {
             background-image:none;
        }
    .msj {
    display:block;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    top: 40%;
    left: 10%;
    position: absolute;
    z-index:122;
    }
}

@media screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation: landscape) {
 .msj {
 display: none;
 }
}
    </style>
    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>
         <div class="congral2">               
            <div class="cont2 center-block">
                <form name="nuevo_registro" id="nuevo_registro" method="POST" action="index3.php" >
                
                 <input hidden type="text" name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input type="hidden" id="orderID" name="numodt" class=" diseños" value="<?= (isset($ordenActual))? implode(",", $ordenActual)  : ((isset($stoppedOrderID))? $stoppedOrderID : '') ;?>"/>
                <input type="hidden" id="orderODT" name="orderodts" class=" diseños" value="<?= (isset($getActODT))? implode(",", $getActODT)  : 'perro' ;?>"/>
                 <input hidden type="text" name="horadeldia" id="horadeldia" value="<?php echo date("H:i:s",time()); ?>" />
                 <input hidden type="text" name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />
                     <input hidden type="text" name="recover" value="<?php echo $recoverSession; ?>" />  
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                            <div class="text-center" style="font-size:18pt; text-transform: uppercase;">AJUSTE <?php echo (isset($machineName))? $machineName : $mrecovered ; ?></div>
                            <?php if (!isset($getActODT)) {?>
                            <div class="text-center2" id="currentOrder" style="font-size:18pt; color:#E9573E;">NO HAS SELECCIONADO UNA ORDEN</div>
                            <?php } else{ ?>
                              <div class="text-center2" id="currentOrder" style="font-size:18pt;">ORDEN ACTUAL: <?php echo (isset($getActODT))? implode(",", $getActODT)  : $stoppedOrder ; ?></div>
                           <?php } ?>
                   
                    <p id="success-msj" style="display: none;">Datos guardados correctamente</p>
                        </div>
                        <div class="modal-body">
                        <div class="button-panel" >
                        <a href="logout.php" > <img src=""  href="logout.php" class="img-responsive" onClick="return confirm('estas segur@ de cerrar SESION?')" />
                        <div class="square-button red">
                          <img src="images/exit-door.png">
                        </div></a>
                        <div class="square-button green stop eatpanel goeat">
                          <img src="images/dinner2.png">
                        </div>
                        <div id="stop" class="square-button blue " >
                          <img src="images/saving.png">
                        </div>
                        <div class="square-button yellow   derecha goalert">
                          <img src="images/warning.png">
                        </div>
                        <div class="square-button purple abajo">
                          <img src="images/checklist.png">
                        </div>
                        </div>
                        </div>
                        <div class="timer-container">
                                    <div id="chronoExample">
                                    <div id="timer"><span class="values">00:00:00</span></div>
                                    
                                    <input type="hidden" id="timee" name="tiempo">
                                    
                                </div>
                                </div>
                        
                          <?php
                          $valorQuePasa3 = (isset($mac))? $mac : $recoverMac; // variable que viene de otra pagina por el metodo get
                           $valorQuePasa4 = (isset($mac))? $mac : $mrecoveredId;
                            $valorQuePasa5 = (isset($mac))? $mac : $mrecoveredId;
                          ?>                

                         <input hidden name="nommaquina" id="nommaquina" value="<?php echo $valorQuePasa3; ?>"  />

</form>

                        <div class="modal-footer">
                        <form id="pauseorder" action="opp.php" method="post">
                          <input type="hidden" value="<?= (isset($getAct['idorden']))? $getAct['idorden'] : ((isset($stoppedOrderID))? $stoppedOrderID : '') ;?>" name="numodt">
                          <input type="hidden" name="action" value="pause">
                          <input type="hidden" name="pausetime" id="pausetime">
                          <input type="hidden" name="pausetime">
                        </form>
                            <div class="row ">
                                 <div class="pause"><div class="pauseicon"><img src="images/pause.png"></div><div class="pausetext">PAUSAR ORDEN</div></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
       <div class="backdrop"></div>

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
   <div id="panelbottom">
       <div id="panelbottom2"></div> 
       <div class="row ">
                <legend style="font-size:18pt; font-family: 'monse-bold';">TAREAS</legend>
                <div style="width: 95%; margin:0 auto; position: relative;">
                
                   <div class="form-group" id="tareasdiv">
                  <div class="button-panel-small2" >
                  <form id="tareas" action="opp.php" method="post" >
                  <input type="hidden" name="machine" value="<?=$machineName; ?>">
                  
                  <!-- <input type="hidden" name="ordId" value="<?=$getAct['idorden']; ?>"> -->
                  <?php
                      $query = "  SELECT o.*,p.id_proceso,p.avance,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status IS NOT NULL order by orden_display asc LIMIT 12";
                      $query2 = "  SELECT o.*,p.id_proceso,p.avance,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' AND avance NOT IN('completado') order by orden asc LIMIT 12";
                      $initquery="SELECT COUNT(*) AS conteo FROM orden_estatus WHERE proceso_actual='$machineName'";
                      $initial = mysqli_fetch_assoc($mysqli->query($initquery));
                      $init=$initial['conteo'];
                      $result=$mysqli->query(($init>0)? $query : $query2);
                      if ($result->num_rows==0) {
                       echo '<p style="font-size:18pt; color:#E9573E;font-family: monse-bold; text-align:center;">POR EL MOMENTO NO HAY ORDENES<p>';
                       
                      }
                      else{
                      while ($valores=mysqli_fetch_array($result)) {
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
                        
                        <?php } }?>
                          </form>
                        </div> 
                </div>
                </div>
                   <div id="resultaado"></div> 
                <div class="form-group">
                <div id="resultaado"></div>
                  <div class="button-panel-small">
                        <div id="close-down"  class="square-button-small red abajo ">
                          <img src="images/ex.png">
                        </div>
                        <div  class="save-bottom square-button-small blue abajo" onclick="showLoad();">
                          <img src="images/saving.png">
                        </div>
                        </div>
                </div>
   </div></div>
   <div id="panelder">
   <div id="panelder2"></div>
      <div class="container-fluid">
          <div id="estilo">
             <form id="fo4" name="fo4" action="saveAjsute.php" method="post" class="form-horizontal" onSubmit="return limpiar()" >
                <fieldset>
                <input hidden type="text" name="tiempoalertamaquina" id="tiempoalertamaquina" />
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden  name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input  hidden name="maquina" id="maquina" value="<?php echo $valorQuePasa4; ?>"  />
                 <!-- Form Name -->
                <legend style="font-size:18pt; font-family: 'monse-bold';">ALERTA AJUSTE</legend>
               <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                <div class="two-columns">
                  <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-0" value="ODT Confusa">
                    ODT Confusa
                    </div>
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-1" value="ODT Faltante">
                    ODT Faltante
                    </div>
                </div>
                <div class="two-columns">
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-2" value="Cambio de Cuchilla">
                    Cambio de Cuchilla
                    </div>
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-3" value="Pieza de Plancha">
                    Pieza de Plancha
                    </div>
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-4" value="Exceso de Dimensiones">
                    Exceso de Dimensiones
                    </div>
                </div>
                </div>
                <!-- Textarea -->
                <div class="form-group" style="text-align: center; color:black;">
                    <textarea placeholder="Observaciones.." class="comments" id="observaciones" name="observaciones"></textarea>
                
                </div>
                <!-- Button (Double) -->
                <div class="form-group">
                  <div class="button-panel-small">
                       
                        <div class="square-button-small red derecha stopalert start reset">
                          <img src="images/ex.png">
                        </div>
                        <div id="save-ajuste" class="square-button-small derecha  blue" onclick="showLoad();">
                          <img src="images/saving.png">
                        </div>
                        
                          
                        </div>
                </div>
               </fieldset>
             </form>
    <div class="reloj-container2">  
        <div class="timersmall">
                                    <div id="alertajuste">
                                    <div id="timersmall"><span class="valuesAlert">00:00:00</span></div>
                                </div>
                                </div>
    </div>
      </div>
   </div>
    <div id="panelbrake">
    <div id="panelbrake2"></div>
      <div class="container-fluid">
          <div id="estilo">
             <form id="fo3" name="fo3" action="saveeat.php" method="post" class="form-horizontal" onSubmit=" return limpiar();" >
                <fieldset style="position: relative;left: -15px;">                
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input hidden name="maquina" id="maquina" value="<?php echo $valorQuePasa5; ?>"  />
                  <!-- Form Name -->
                 <legend style="font-size:18pt; font-family: 'monse-bold';">Comida</legend>
                
                   <input type="hidden" id="timeeat" name="breaktime">
                   <!-- Multiple Radios (inline) -->
                   <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                <input type="hidden" id="s-radios" name="radios">
              <div class="radio-menu face eatpanel" onclick="submitEat('Comida');showLoad();">
                <input type="radio" class=""  id="radios-0"  >
                    COMIDA</div>
               <div class="radio-menu face eatpanel" onclick="submitEat('Sanitario');showLoad();">
               <input type="radio"  id="radios-1" >
                   SANITARIO
                    </div>
                </div>
                   </br>
                   </br>
                   </br>
                <!-- Button (Double) -->
                <div class="form-group">
                  <div class="button-panel-small">
                        <div   class="square-button-small red eatpanel stopeat start reseteat2 ">
                          <img src="images/ex.png">
                        </div>
                        </div>
                </div>
               </fieldset>    
                
             </form>
      <div class="reloj-container2">
    <div class="timersmall">
                                    <div id="horacomida">
                                    <div id="timersmall"><span class="valuesEat">00:00:00</span></div> 
                                </div>
                                </div>
    </div>
    </div>
   </div>
</div>
    
   


</body>
</html>

<!-- *********************** END CONTENIDO ********************** -->

<?php
 }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }

        }
?>

<?php 
 require('saves/conexion.php');

$datos=(isset($_POST["datos"]) ? $_POST["datos"] : null);


if (!empty($update)) {
 $mysqli->query(isset($update));
}
  
?>

<script src="js/ajuste.js"></script>