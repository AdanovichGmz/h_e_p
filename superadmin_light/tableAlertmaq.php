 <?php
     require('../saves/conexion.php');
     $query="SELECT * FROM alertaMaquinaOperacion a inner join maquina m on a.id_maquina = m.idmaquina INNER JOIN login l on a.id_usuario=l.id ORDER BY idalertamaquina DESC";
  
   $resultado=$mysqli->query($query);

    ?>
<div class="conttabla">
    
  <div class="datagrid" >

          <table class="order-table table hoverable" >
                  <thead class="color">
                    <tr style="background-color: #212121;">
                      <td width="1%"><b></b></td>
                      <td width="1%"><b></b></td>
                      <td width="1%"  class="tabla"><strong >ID</strong></td>
                      <td width="1%"  class="tabla"><strong>MAQUINA</strong></td>
                      <td width="5%"  class="tabla"><strong>PROBLEMA</strong></td>
                      <td width="5%"  class="tabla"><strong>OBSERVACIONES</strong></td>
                      <td width="4%"  class="tabla"><strong>TIEMPO</strong></td>
                      <td width="4%"  class="tabla"><strong>USUARIO</strong></td>
                      <td width="4%"  class="tabla"><strong>HORA DEL DIA</strong></td>
                      <td width="4%"  class="tabla"><strong>FECHA DEL DIA</strong></td>


                      
                      </tr>
                    <tbody>
                      <?php 
                      $i=0;
                      while($row=$resultado->fetch_assoc()){ ?>
                      <tr>
                       
                      <td style="padding: 0px; top:4px; position:relative;"><a href="#" class="lightbox" onClick="edit(<?php echo $i;?>)"><img src="../images/e.png" alt="" width="25" height="25"></a></td>
                      <td style="padding: 0px; top:4px; position:relative;"><a href="#" class="lightbox2" onClick="delet(<?php echo $i;?>);"><img src="../images/t.png" alt="" width="25" height="25"  ></a></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['idalertamaquina'];?></p>
                        <input type="hidden" id="i-<?php echo $i;?>" value="<?=$row['idalertamaquina'] ?>" ></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['nommaquina'];?>
                          <input type="hidden" id="n-<?php echo $i;?>" value="<?=$row['id_maquina'] ?>" ></td>
                        </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['radios'];?>
                          <input type="hidden" id="r-<?php echo $i;?>" value="<?=$row['radios'] ?>" ></td>
                        </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['observaciones'];?>
                          <input type="hidden" id="o-<?php echo $i;?>" value="<?=$row['observaciones'] ?>" ></td>
                        </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['tiempoalertamaquina'];?>
                          <input type="hidden" id="t-<?php echo $i;?>" value="<?=$row['tiempoalertamaquina'] ?>" ></td>
                        </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['logged_in'];?>
                          <input type="hidden" id="l-<?php echo $i;?>" value="<?=$row['id'] ?>" ></td>
                        </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['horadeldiaam'];?>
                          <input type="hidden" id="h-<?php echo $i;?>" value="<?=$row['horadeldiaam'] ?>" ></td>
                        </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['fechadeldiaam'];?>
                          <input type="hidden" id="f-<?php echo $i;?>" value="<?=$row['fechadeldiaam'] ?>" ></td>
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
        $('.lightbox2').click(function(){
          $('.backdrop, .box2').animate({'opacity':'.50'}, 300, 'linear');
          $('.box2').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box2').css('display', 'block');
        });
 
        $('.close2').click(function(){
          close_box2();
        });
 
        $('.backdrop').click(function(){
          close_box2();
        });
      });
 
      function close_box()
      {
        $('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box').css('display', 'none');
        });
      }
  function close_box2()
      {
        $('.backdrop, .box2').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box2').css('display', 'none');
        });
      }

 
    </script>