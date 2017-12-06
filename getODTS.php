<?php
session_start();
require('saves/conexion.php');
$numodt=$_POST['numodt'];
$machineName=$_SESSION['machineName'];
if ($numodt!=null) {


$process=($machineName=='Serigrafia2'||$machineName=='Serigrafia3')?'Serigrafia':(($machineName=='Suaje2')? 'Suaje' : $machineName );

$query="SELECT o.numodt FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE p.nombre_proceso='$process' AND o.numodt LIKE '%" . $numodt . "%' AND entregado NOT IN('true') GROUP BY o.numodt";
$result=$mysqli->query($query);

if (!$result) {
	printf($mysqli->error);
}

?>

                
                  
                  
                  
                  <!-- <input type="hidden" name="ordId" value="<?=$getAct['idorden']; ?>"> -->
                  <?php
                      
                      if ($result->num_rows==0) {
                       echo '<p style="font-size:18pt; color:#E9573E;font-family: monse-bold; text-align:center; margin-bottom:0;">NO HAY ORDENES</p>';
                       ?>
                       <div id="" style="text-transform: uppercase;line-height: 65px;width: 250px"   class="rect-button-small radio-menu-small2 face" onclick="addOrder();getKeys('virtualodt','pedido')">
                      
                          REGISTRAR 
                          <p class="suborder" >ORDEN</p>
                        </div>
                       <?php 
                       
                      }
                      else{
                      while ($valores=mysqli_fetch_array($result)) {
                        
                      
                     ?>
                        <div id="<?=$valores['numodt'] ?>" style="text-transform: uppercase;"  class="rect-button-small radio-menu-small2 face" onclick=" sendODT('<?=$valores['numodt'] ?>','<?=$machineName?>'); ">
                       
                          <?php echo  $valores['numodt']; ?>
                          <p class="product" ></p>
                        </div>
                        
                        <?php } } }?>
                         
                  