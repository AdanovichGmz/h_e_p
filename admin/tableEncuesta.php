<?php
     require('../saves/conexion.php');
     $query="SELECT * FROM encuesta e inner join maquina m on e.id_maquina = m.idmaquina inner join login l on e.id_usuario = l.id ORDER BY idencuesta DESC";
  
   $resultado=$mysqli->query($query);

    ?>

<div class="conttabla">
    
  <div class="datagrid" >

          <table class="order-table table hoverable" >
                  <thead class="color">
                    <tr style="background-color: #212121;">
                      
                      <td width="4%"  class="tabla"><strong >ID</strong></td>
                      <td width="4%"  class="tabla"><strong>USUARIO</strong></td>
                      <td width="4%"  class="tabla"><strong>MAQUINA</strong></td>
                      <td width="5%"  class="tabla"><strong>HORA DEL DIA</strong></td>
                      <td width="4%"  class="tabla"><strong>FECHA DEL DIA</strong></td>
                      <td width="8%"  class="tabla"><strong>¿SE REALIZO LENTO?</strong></td>
                      <td width="3%"  class="tabla"><strong>PROBLEMA</strong></td>
                      <td width="8%"  class="tabla"><strong >¿FUE HECHO A LA PRIMERA?</strong></td>
                      <td width="4%"  class="tabla"><strong>PROBLEMA</strong></td>
                      <td width="4%"  class="tabla"><strong>OBSERVACIONES</strong></td>
                     
                      
                      </tr>
                    <tbody>
                      <?php 
                      $i=0;
                      while($row=$resultado->fetch_assoc()){ ?>
                      <tr>
                        
                        
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['idencuesta'];?></p>
                          <input type="hidden" id="i-<?php echo $i;?>" value="<?=$row['idencuesta'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['logged_in'];?>
                          <input type="hidden" id="l-<?php echo $i;?>" value="<?=$row['id'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['nommaquina'];?>
                          <input type="hidden" id="n-<?php echo $i;?>" value="<?=$row['id_maquina'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['horadeldia'];?>
                          <input type="hidden" id="h-<?php echo $i;?>" value="<?=$row['horadeldia'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['fechadeldia'];?>
                          <input type="hidden" id="f-<?php echo $i;?>" value="<?=$row['fechadeldia'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['desempeno'];?>
                          <input type="hidden" id="d-<?php echo $i;?>" value="<?=$row['desempeno'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['problema'];?>
                          <input type="hidden" id="p-<?php echo $i;?>" value="<?=$row['problema'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['calidad'];?>
                          <input type="hidden" id="c-<?php echo $i;?>" value="<?=$row['calidad'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['problema2'];?>
                          <input type="hidden" id="pp-<?php echo $i;?>" value="<?=$row['problema2'] ?>" >
                        </td>
                        <td  style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['observaciones'];?>
                          <input type="hidden" id="o-<?php echo $i;?>" value="<?=$row['observaciones'] ?>" >
                        </td>
                            

                        </tr>
                      <?php $i++; } ?>
                    </tbody>
                  </table>


   </div> 
     </div> 
        <script type="text/javascript">
 
      $(document).ready(function(){
 
        $('.lightbox').click(function(){
          $('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
          $('.box').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box').css('display', 'block');
        });
 
        $('.close').click(function(){
          close_box();
        });
 
        $('.backdrop').click(function(){
          close_box();
        });
 
      });
 
      function close_box()
      {
        $('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box').css('display', 'none');
        });
      }

     


 
    </script>