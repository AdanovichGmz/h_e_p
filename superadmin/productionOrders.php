<?php
require('../saves/conexion.php');
$numodt=$_POST['numodt'];
    
$resultados=$mysqli->query("SELECT * FROM ordenes WHERE numodt='$numodt' ORDER BY idorden");

 function getElement($id){
         require('../saves/conexion.php');
        $elem_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$id";
        
        $getelem=mysqli_fetch_assoc($mysqli->query($elem_query));
        $elem=$getelem['nombre_elemento'];
        return $elem;
      }

function getCheckStatus($id_process,$process){
                    require('../saves/conexion.php');
                    
                    $subquery="SELECT estatus FROM procesos WHERE id_orden=$id_process AND nombre_proceso='$process'";
                    $getting=$mysqli->query($subquery);
                  $getLast = mysqli_fetch_assoc($getting);
                  $lastId=$getLast['estatus'];
                  if ($lastId=='En Tiempo') {
                    //$qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo='checkicon-on-green defcheck';
                   echo $semaforo;
                  }
                  elseif($lastId=='Tarde') {
                   
                   //$qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo='checkicon-on-yellow defcheck';
                   echo $semaforo;
                  }
                   elseif($lastId=='No se ha Realizado') {
                   
                   //$qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo='checkicon-on-red defcheck';
                   echo $semaforo;
                  }
                   elseif($lastId=='Programado') {
                   
                   // $qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo=' defcheck';
                   echo $semaforo;
                  }
                   elseif($lastId=='') {
                   
                   //$qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo='';
                   echo $semaforo;
                  }
                  
                

                  }
                  function getqty($id_process,$process){
                    require('../saves/conexion.php');
                    
                    $subquery="SELECT estatus FROM procesos WHERE id_orden=$id_process AND nombre_proceso='$process'";
                    $getting=$mysqli->query($subquery);
                  $getLast = mysqli_fetch_assoc($getting);
                  if ($getting->num_rows>1) {
                    echo "<div id=iteration-".$process."-".$id_process." class=iteration >".$getting->num_rows."</div>";
                    for ($i=0;$i<$getting->num_rows-1 ; $i++) { 
                      echo "<input class='temporal inc-proc".$process."-".$id_process."' type='hidden' name='procesos_".$id_process."[]' value='".$process."'/>";
                    }
                  }else{
                    echo "<div id='iteration-".$process."-".$id_process."' class='iteration' style='display: none' >1</div>";
                  }
                  }

                  

                  function getAllStatus($id_process){
                    require('../saves/conexion.php');
                    
                    $subquery="SELECT estatus,nombre_proceso FROM procesos WHERE id_orden=$id_process ";
                    $getting=$mysqli->query($subquery);
                    while ($stat = mysqli_fetch_array($getting) ){
                  $estatuses[$stat['nombre_proceso']]=$stat['estatus'];
                 }
                 if (!empty($estatuses)) {
                  echo json_encode($estatuses);
                 }
                 
                  }

?>

<style >
  .controls{
    visibility: hidden;
  }
</style>


<div class="modal-form-large">
  <p id="order" style="text-align: center; font-weight: bold;">ODT: <?=$_POST['numodt']; ?></p>
    <form id="new-order" method="post" onsubmit="addOrder();">
    
    
    
    <input type="hidden"  name="numodt" value="<?=$_POST['numodt']; ?>">
    <input type="hidden" id="action" name="action" value="update">
    <input type="hidden" id="order-id" name="order-id" value="">
    <input type="hidden" id="process-id" name="process-id" value="">
    

    
     
     
     <div style="width: 102%; max-height: 400px;overflow-y: scroll;">
     <?php while ($fila = mysqli_fetch_array($resultados) ){
    

      ?>

      <input type="hidden" name="estatuses<?=$fila['idorden'] ?>" value='<?=htmlspecialchars(getAllStatus($fila['idorden']));?>'>
     <input type="hidden" id="odete<?=$fila['idorden'] ?>" name="odetes[]" disabled>
     <div  class="line"><div class="separator"><?=($fila['producto']!=null)?  getElement($fila['producto']) : '--'; ?></div></div>  
     
    <div class="orderdata">Cantidad pedido: <?=$fila['cantpedido']; ?></div>
     <div class="orderdata">Cantidad recibida: <?=$fila['cantrecibida']; ?></div>
      <div class="orderdata">Fecha inicio: <?=$fila['fechaprog']; ?></div>
       <div class="orderdata">Fecha Fin: <?=$fila['fechafin']; ?></div>
      <br>
     <div class="inputs" id="inputs-<?=$fila['idorden'] ?>"> 
       <div id="Original-<?=$fila['idorden'] ?>" class="checgroup" oncontextmenu="javascript:alert('success!');return false;">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Original');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Original-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Original" name=  "procesos_<?=$fila['idorden'] ?>[]"    >
         </div>
         <div class="checktext">Ori</div>
         

         <?=getqty($fila['idorden'],'Original') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Original-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Original-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Original')"></div>
       </div>
       </div>
       <div id="Positivo-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Positivo');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Positivo-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Positivo" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Pos</div>
         
         <?=getqty($fila['idorden'],'Positivo') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Positivo-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Positivo-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Positivo')"></div>
       </div>
       </div>
       <div id="Placa-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Placa');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Placa-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Placa" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Pla</div>
         
         <?=getqty($fila['idorden'],'Placa') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Placa-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Placa-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Placa')"></div>
       </div>
       </div>
       <div id="Placa_HS-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Placa_HS');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Placa_HS-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Placa_HS" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">PHS</div>
         
         <?=getqty($fila['idorden'],'Placa_HS') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Placa_HS-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Placa_HS-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Placa_HS')"></div>
       </div>
       </div>
       <div id="LaminaOff-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'LaminaOff');?>"   onclick="checking(<?=$fila['idorden'] ?>,'LaminaOff-<?=$fila['idorden'] ?>');">
          <input type="checkbox" class="chk" value="LaminaOff" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Loff</div>
        
        <?=getqty($fila['idorden'],'LaminaOff') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('LaminaOff-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('LaminaOff-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','LaminaOff')"></div>
       </div>
       </div>
       <div id="Corte-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Corte');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Corte-<?=$fila['idorden'] ?>');">
          <input type="checkbox" class="chk" value="Corte" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Cor</div>
        
         <?=getqty($fila['idorden'],'Corte') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Corte-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Corte-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Corte')"></div>
       </div>
       </div>
       <div id="Revelado-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Revelado');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Revelado-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Revelado" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Rev</div>
         
         <?=getqty($fila['idorden'],'Revelado') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Revelado-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Revelado-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Revelado')"></div>
       </div>
       </div>
       <div id="Laser-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Laser');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Laser-<?=$fila['idorden'] ?>');">
          <input type="checkbox" class="chk" value="Laser" name=  "procesos_<?=$fila['idorden'] ?>[]"  >
         </div>
         <div class="checktext">Las</div>
        
         <?=getqty($fila['idorden'],'Laser') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Laser-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Laser-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Laser')"></div>
       </div>
       </div>
       <div id="Suaje-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Suaje');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Suaje-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Suaje" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Suaj</div>
         
         <?=getqty($fila['idorden'],'Suaje') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Suaje-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Suaje-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Suaje')"></div>
       </div>
       </div>
       <div id="Serigrafia-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Serigrafia');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Serigrafia-<?=$fila['idorden'] ?>');">
          <input type="checkbox" class="chk" value="Serigrafia" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Serig</div>
        
         <?=getqty($fila['idorden'],'Serigrafia') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Serigrafia-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Serigrafia-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Serigrafia')"></div>
       </div>
       </div>
       <div id="Offset-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Offset');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Offset-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Offset" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Off</div>
         
        <?=getqty($fila['idorden'],'Offset') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Offset-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Offset-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Offset')"></div>
       </div>
       </div>
       <div id="Digital-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Digital');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Digital-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Digital" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Dig</div>
         
         <?=getqty($fila['idorden'],'Digital') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Digital-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Digital-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Digital')"></div>
       </div>
       </div>
       <div id="LetterPress-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'LetterPress');?>"   onclick="checking(<?=$fila['idorden'] ?>,'LetterPress-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="LetterPress" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Lpr</div>
         
        <?=getqty($fila['idorden'],'LetterPress') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('LetterPress-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('LetterPress-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','LetterPress')"></div>
       </div>
       </div>
       <div id="Plastificado-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Plastificado');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Plastificado-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Plastificado" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Plas</div>
         
         <?=getqty($fila['idorden'],'Plastificado') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Plastificado-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Plastificado-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Plastificado')"></div>
       </div>
       </div>
       <div id="Encuadernacion-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Encuadernacion');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Encuadernacion-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Encuadernacion" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Enc</div>
         
         <?=getqty($fila['idorden'],'Encuadernacion') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Encuadernacion-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Encuadernacion-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Encuadernacion')"></div>
       </div>
       </div>
       <div id="HotStamping-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'HotStamping');?>"   onclick="checking(<?=$fila['idorden'] ?>,'HotStamping-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="HotStamping" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">HS</div>
         
         <?=getqty($fila['idorden'],'HotStamping') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('HotStamping-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('HotStamping-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','HotStamping')"></div>
       </div>
       </div>
       <div id="Grabado-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Grabado');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Grabado-<?=$fila['idorden'] ?>');">
          <input type="checkbox" class="chk" value="Grabado" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Grab</div>
        
         <?=getqty($fila['idorden'],'Grabado') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Grabado-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Grabado-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Grabado')"></div>
       </div>
       </div>
       <div id="Pleca-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Pleca');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Pleca-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Pleca" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Ple</div>
         
         <?=getqty($fila['idorden'],'Pleca') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Pleca-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Pleca-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Pleca')"></div>
       </div>
       </div>
       <div id="Acabado-<?=$fila['idorden'] ?>" class="checgroup">
         <div class="checkicon <?=getCheckStatus($fila['idorden'],'Acabado');?>"   onclick="checking(<?=$fila['idorden'] ?>,'Acabado-<?=$fila['idorden'] ?>');">
         <input type="checkbox" class="chk" value="Acabado" name=  "procesos_<?=$fila['idorden'] ?>[]"   >
         </div>
         <div class="checktext">Acab</div>
         
         <?=getqty($fila['idorden'],'Acabado') ?>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Acabado-<?=$fila['idorden'] ?>')"></div>
         <div   class="more" onclick="moreProcess('Acabado-<?=$fila['idorden'] ?>','<?=$fila['idorden'] ?>','Acabado')"></div>
       </div>
       </div>
       
      


     </div>
     
     <?php } ?>
     </div>
  
  <p id="minimo" style="display: none;">Debes elegir por lo menos un proceso</p>
    <br> 
    <input type="submit" style="background: #3F51B5; font-weight:bold; " value="GUARDAR"><input type="button" style="margin-left: 25px; background: #E9573E; font-weight:bold; " value="CANCELAR" onclick="$('.close').click();">
  </form>
  <div id="loader-container" style="display: none;"><div id="saveload" style="display: none;"><img src="../images/loader.gif"></div>
  </div>
  
  </div>
  <script >
    //$('.defcheck input:checkbox').attr('checked','checked');
   // $('.defcheck').prop('onclick',null).css('cursor','not-allowed');
$('.defcheck ').click();
  </script>