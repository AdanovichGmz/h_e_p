

<?php
ini_set("session.gc_maxlifetime","7200");  
date_default_timezone_set("America/Mexico_City");
 if( !session_id() )
    {
        session_start();
    }
    if(@$_SESSION['logged_in'] != true){
      echo '
     <script>
        alert("No has iniciado sesion");
        self.location.replace("index.php");
    </script>';
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
<style>
  .modal-body{
    height: 350px;
  }
</style>
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
                            <div class="text-center" style="font-size:18pt; text-transform: uppercase;">AREA: <?php echo (isset($machineName))? $machineName : $mrecovered ; ?></div>
                            <?php $sql=$mysqli->query("SELECT numodt FROM odt_flujo WHERE status='actual' AND proceso='$machineName'");
                            $actodt=mysqli_fetch_object($sql); 

                            ?>
                            <div class="text-center2" id="currentOrder" style="font-size:18pt; color: #96989A;">ORDEN ACTUAL: <?=(isset($actodt->numodt))? $actodt->numodt : '--';  ?></div>
                   
                    <p id="success-msj" style="display: none;">Datos guardados correctamente</p>
                        </div>
                        <div class="modal-body">
                        <div class="button-panel" >
                       
                        <div class="square-button yellow" onclick="sendActODT('<?=(isset($actodt->numodt))? $actodt->numodt : ''; ?>');">
                          <img src="images/ajuste.png">
                        </div>
                        <div class="square-button purple  eatpanel goeat">
                          <img src="images/clean.png">
                        </div>
                        <div class="square-button green  derecha goalert">
                          <img src="images/other.png">
                        </div>
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
                            <a href="logout.php" > 
                                 <div class="pause red"><div class="pauseicon"><img src="images/exit-door.png"></div><div class="pausetext">SALIR</div></div></a>
                                 <div class="pause blue" onclick="requireOrder()" style="line-height:60px;color:#fff;font-size: 18px; font-weight: bolder;"><div class="">CAMBIAR ORDEN</div></div>
                                  
                            
                            </div>
                        </div>
                    </div>
            </div>
        </div>
       <div class="backdrop" onclick="close_box();"></div>

<div class="boxorder">
<div class="odtsearch">
  <input type="text" id="getodt" onkeyup="gatODT()" placeholder="Buscar ODT">
</div>
  <div id="odtresult">
    <?php if ($actodt->numodt!='') { ?>
    <div id="<?=$actodt->numodt ?>" style="text-transform: uppercase;"  class="rect-button-small radio-menu-small face face-osc" onclick=" sendActODT('<?=$actodt->numodt ?>'); ">
                       
                          <?php echo  $actodt->numodt; ?>
                          <p class="product" ></p>
                        </div>
    <?php } ?>
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
                <legend style="font-size:18pt; font-family: 'monse-bold';">OTRA ACTIVIDAD</legend>
               <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                
                 
               
                
                </div>
                <!-- Textarea -->
                <div class="form-group" style="text-align: center; color:black;">
                    <textarea placeholder="Especifica la actividad.." class="comments" id="observaciones" name="observaciones"></textarea>
                
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
                 <legend style="font-size:18pt; font-family: 'monse-bold';">LIMPIEZA</legend>
                
                   <input type="hidden" id="timeeat" name="breaktime">
                   <!-- Multiple Radios (inline) -->
                   <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                <input type="hidden" id="s-radios" name="radios">
              <div class="radio-menu face eatpanel" onclick="submitEat('Comida');showLoad();">
                <input type="radio" class=""  id="radios-0"  >
                    GUARDAR</div>
               
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


<script>
 function requireOrder(){
   $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
          $('.boxorder').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .boxorder').css('display', 'block');
 }
 
  function gatODT(){
    var odt=$('#getodt').val();
     $.ajax({  
                      
                     type:"POST",
                     url:"getODTS.php",   
                     data:{numodt:odt},  
                       
                     success:function(data){ 
                          
                          $('#odtresult').html(data);
                          console.log(data);
                     }  
                });
  }

  function sendODT(odt){
    $.ajax({  
                      
                     type:"POST",
                     url:"opp.php",   
                     data:{entorno:'general',odt:odt,machine:'<?=$machineName?>'},  
                       
                     success:function(data){ 
                          console.log(data);
                         window.location.replace("index2.php?odt="+odt);
                     }  
                });
    
  }  
  function sendActODT(odt){
    
                         window.location.replace("index2.php?odt="+odt);
                  
  }  
$('.radio-menu-small').click(function() {
                                              $('.face-osc').find('input').prop('checked', false);
                                              $('.face-osc').removeClass('face-osc');
                                              $(this).addClass('face-osc').find('input').prop('checked', true);
                                              sendOrder();
                                            });
function close_box()
      {
        $('.backdrop, .box, .boxorder').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box, .boxorder').css('display', 'none');
        });
      }
</script>