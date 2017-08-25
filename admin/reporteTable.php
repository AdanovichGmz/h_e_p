<?php
      require('../saves/conexion.php');
     

        $query="SELECT * FROM tiraje inner join maquina on tiraje.id_maquina = maquina.idmaquina INNER JOIN login on tiraje.id_user=login.id ORDER BY idtiraje DESC";
  
        $resultado=$mysqli->query($query);
  
   

    ?>   
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
        <table id="ajuste-tabla" class="order-table table" >
                  <thead  class="color">
                    <tr style="background-color: #212121;">
                      
                      <td width="1%"  class="tabla"><strong >ID</strong></td>
                      <td width="7%"  class="tabla"><strong>TIEMPO</strong></td>
                      <td width="7%"  class="tabla"><strong>MAQUINA</strong></td>
                      <td width="7%"  class="tabla"><strong>USUARIO</strong></td>
                      <td width="7%"  class="tabla"><strong>HORA DEL DIA</strong></td>
                      <td width="7%"  class="tabla"><strong>FECHA DEL DIA</strong></td>

                     
                      </tr>
                    <tbody>
                      <?php 
                      $i=0;
                          while($row=$resultado->fetch_assoc()){ 
                          

                            $idd=$row['idtiraje'];
                        ?>
                      <tr>
                       
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['idtiraje'];?></p></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><input type="hidden" id="t-<?php echo $i;?>" name="" value="<?php echo $row['tiempo_ajuste'];?>">    <?php echo $row['tiempo_ajuste'];?>      </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><input type="hidden" id="n-<?php echo $i;?>" name="" value="<?php echo $row['idmaquina'];?>">    <?php echo $row['nommaquina'];?>  </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><input type="hidden" id="u-<?php echo $i;?>" name="" value="<?php echo $row['id'];?>">    <?php echo $row['logged_in'];?>   </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><input type="hidden" id="h-<?php echo $i;?>" name="" value="<?php echo $row['horadeldia_ajuste'];?>">    <?php echo $row['horadeldia_ajuste'];?>  </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><input type="hidden" id="f-<?php echo $i;?>" name="" value="<?php echo $row['fechadeldia_ajuste'];?>">    <?php echo $row['fechadeldia_ajuste'];?> </td>

                        </tr>
                      <?php $i++; } ?>
                    </tbody>
                  </table>

    
    
