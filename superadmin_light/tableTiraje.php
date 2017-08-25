 <?php
       require('../saves/conexion.php');
     $query="SELECT * FROM tiraje inner join maquina on tiraje.id_maquina = maquina.idmaquina INNER JOIN login ON tiraje.id_user=login.id";
  
   $resultado=$mysqli->query($query);

    ?>
<div class="conttabla">
    
  <div class="datagrid" >

          <table class="order-table table hoverable" >
                  <thead class="color" style="background-color: #212121;">
                    <tr>
                  <td width="1%"><b></b></td>
                          <td width="1%"><b></b></td>
                      <td width="2%"  class="tabla"><strong >ID</strong></td>
                      <td width="2%"  class="tabla"><strong>PRODUCTO</strong></td>
                      <td width="2%"  class="tabla"><strong>USUARIO</strong></td>
                      <td width="4%"  class="tabla"><strong>MAQUINA</strong></td>
                      <td width="2%"  class="tabla"><strong>PEDIDO</strong></td>
                      <td width="2%"  class="tabla"><strong>CANTIDAD</strong></td>
                      <td width="2%"  class="tabla"><strong>BUENOS</strong></td>
                      <td width="2%"  class="tabla"><strong>DEFECTOS</strong></td>
                      <td width="2%"  class="tabla"><strong>ENTREGADOS</strong></td>
                      <td width="2%"  class="tabla"><strong>TIEMPO TIRAJE</strong></td>
                      <td width="5%"  class="tabla"><strong>HORA DEL DIA</strong></td>
                      <td width="5%"  class="tabla"><strong>FECHA DEL DIA</strong></td>


                      
                      </tr>
                    <tbody>
                      <?php 
                      $i=0;
                      while($row=$resultado->fetch_assoc()){ ?>
                      <tr>
                        <td style="padding: 0px; top:4px; position:relative;"><a href="#" class="lightbox" onClick="edit(<?php echo $i;?>)"><img src="../images/e.png" alt="" width="25" height="25"></a></td>
                        <td style="padding: 0px; top:4px; position:relative;"><a href="#" class="lightbox2" onClick="delet(<?php echo $i;?>);"><img src="../images/t.png" alt="" width="25" height="25"  ></a></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['idtiraje'];?></p>
                        <input type="hidden" id="id-<?php echo $i;?>" value="<?=$row['idtiraje'] ?>" ></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['producto'];?>
                          <input type="hidden" id="pro-<?php echo $i;?>" value="<?=$row['producto'] ?>" >
                        </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['logged_in'];?>
                              <input type="hidden" id="usu-<?php echo $i;?>" value="<?=$row['id'] ?>" >
                            </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['nommaquina'];?>
                          <input type="hidden" id="maq-<?php echo $i;?>" value="<?=$row['id_maquina'] ?>" >
                        </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['pedido'];?>
                              <input type="hidden" id="ped-<?php echo $i;?>" value="<?=$row['pedido'] ?>" >
                            </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['cantidad'];?>
                          <input type="hidden" id="can-<?php echo $i;?>" value="<?=$row['cantidad'] ?>" >
                        </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['buenos'];?>
                              <input type="hidden" id="bue-<?php echo $i;?>" value="<?=$row['buenos'] ?>" >
                            </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['defectos'];?>
                              <input type="hidden" id="def-<?php echo $i;?>" value="<?=$row['defectos'] ?>" >
                            </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['entregados'];?>
                              <input type="hidden" id="ent-<?php echo $i;?>" value="<?=$row['entregados'] ?>" >
                            </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['tiempoTiraje'];?>
                              <input type="hidden" id="tie-<?php echo $i;?>" value="<?=$row['tiempoTiraje'] ?>" >
                            </td>                            
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['horadeldia_tiraje'];?>
                              <input type="hidden" id="hor-<?php echo $i;?>" value="<?=$row['horadeldia_tiraje'] ?>" >
                            </td>
                            <td style="padding: 0px; top:4px; position:relative;" class="tabla"><?php echo $row['fechadeldia_tiraje'];?>
                              <input type="hidden" id="fech-<?php echo $i;?>" value="<?=$row['fechadeldia_tiraje'] ?>" >
                            </td>

                        </tr>
                      <?php $i++;} ?>
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