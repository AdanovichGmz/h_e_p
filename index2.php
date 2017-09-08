

<?php
ini_set("session.gc_maxlifetime","7200");  
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

$mac=(isset($_SESSION['mac']))?$_SESSION['mac'] : system($cmd) ;

$machineName=$_SESSION['machineName'];
$machineID = $_SESSION['machineID'];

if (isset($_GET['order'])) {
  $currentOrder=$_GET['order'];

}else{
  
  $pausedOrder=$mysqli->query("SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$machineName' AND avance='en pausa'");
  //verificar si hay una orden en pausa 
  if ($pausedOrder->num_rows>0) {
     $getOrder = mysqli_fetch_assoc($pausedOrder);
    $getActODT[] = $getOrder['numodt'];
    $ordenActual[] = $getOrder['id_orden'];
    header('Location:http:'.dirname($_SERVER['PHP_SELF']).'/index3.php');
    echo "<script>console.log('orden pausa');</script>";

  }else{

  $retaking=$mysqli->query("SELECT *,TIME_TO_SEC(tiempo_pausa) AS seconds FROM procesos WHERE  nombre_proceso='$machineName' AND avance='retomado'");
    
    if ($retaking->num_rows>0) {
      $getOrder = mysqli_fetch_assoc($retaking);
    $getActODT[] = $getOrder['numodt'];
    $ordenActual[] = $getOrder['id_orden'];
    echo "<script>console.log('orden retomada');</script>";


    } else{

      $queryOrden="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' HAVING status='actual'";
      $asoc=$mysqli->query($queryOrden);
     
      while($get_Act=mysqli_fetch_assoc($asoc)){
       
        $getActODT[] = $get_Act['numodt'];
        $ordenActual[] = $get_Act['idorden'];
  
}
    echo "<script>console.log('orden normal');</script>";


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
    <input type="hidden" id="mac" value="<?=$mac ?>">
    <input type="hidden" id="order" value="<?= (isset($ordenActual))? implode(",", $ordenActual)  : ((isset($stoppedOrderID))? $stoppedOrderID : '') ;?>">
    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>
         <div class="congral2">               
            <div class="cont2 center-block">
                <form name="nuevo_registro" id="nuevo_registro" method="POST">
                  <input type="hidden" name="section" value="ajuste">
                 <input hidden type="text" name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input type="hidden" id="orderID" name="numodt" class=" diseños" value="<?= (isset($ordenActual))? implode(",", $ordenActual)  : ((isset($stoppedOrderID))? $stoppedOrderID : '') ;?>"/>
                <input type="hidden" id="orderODT" name="orderodts" class=" diseños" value="<?= (isset($getActODT))? implode(",", $getActODT)  : '' ;?>"/>
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
                        <div id="stop" class="square-button blue " onclick="saveAjuste()" >
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
                <?php if ($_SESSION['machineName']=='Serigrafia') { ?>
               

                <div class="two-columns">
                  <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-0" value="Preparar Tinta">
                    Preparar Tinta
                    </div>
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-1" value="Impresion Mesa">
                    Impresion Mesa
                    </div>
                </div>
                <div class="two-columns">
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-2" value="Marco mal revelado">
                    Marco mal revelado
                    </div>
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-3" value="Marco con poro">
                    Marco con poro
                    </div>
                <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-4" value="ODT confusa">
                    ODT confusa
                    </div>
                    <div class=" radio-menu face">
                    <input type="radio" name="radios" id="radios-5" value="Tirar basura">
                    Tirar basura
                    </div>
                </div>
                <?php }else{ ?>
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
                <?php } ?>
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