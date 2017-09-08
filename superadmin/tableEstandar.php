<?php
      require('../saves/conexion.php');
     
     
 $query="SELECT * FROM estandares ORDER BY id_estandard DESC";
  
   $resultado=$mysqli->query($query);
  
   
if ( $resultado) {
    ?>   
      
<div class="conttabla2">
    
    <div class="datagrid">
    
      <table class="order-table table hoverable lightable" >

              <thead  >
                 <tr >
                          <td ><b></b></td>
                          <td ><b></b></td>
                          <td   class="tabla"><strong >TIEMPO DE AJUSTE ESTANDAR</strong></td>
                          <td  class="tabla"><strong>PIEZAS POR HORA</strong></td>
                          <td   class="tabla"><strong>ELEMENTO</strong></td>
                          <td   class="tabla"><strong>PROCESO</strong></td>


                      
                      </tr>  
                </thead>      
        
      <tbody>
        <?php 
        $i=0;
        while($row=$resultado->fetch_assoc()){ ?>
                      <tr style="height: 35px;">
    <td class="derecha" style="padding: 0px;  position:relative;"><a href="#" class="lightbox3"><img src="../images/e.png" alt="" width="25" height="25" onClick="edit(<?php echo $i;?>)"></a></td>
     <td style="padding: 0px; position:relative;"><a href="#" class="lightbox2" onClick="delet(<?php echo $i;?>);"><img src="../images/t.png" alt="" width="25" height="25"  ></a></td>
  
     <input type="hidden" id="i-<?php echo $i;?>" value="<?=$row['id_estandard'] ?>" >
  
   <td  class="tabla"><?php echo round($row['ajuste_standard']/60) ;?> minutos
      <input type="hidden" id="r-<?php echo $i;?>" value="<?=round($row['ajuste_standard']/60) ?>" >
   </td>
   <td  class="tabla"><?php echo $row['piezas_por_hora'];?>
      <input type="hidden" id="o-<?php echo $i;?>" value="<?=$row['piezas_por_hora'] ?>" >
   </td>
   <td  class="tabla"><?=getElement($row['id_elemento'])?>
      <input type="hidden" id="t-<?php echo $i;?>" value="<?=getElement($row['id_elemento']) ?>" >
   </td>
   <td  class="tabla"><?=getProcess($row['id_maquina']);?>
      <input type="hidden" id="n-<?php echo $i;?>" value="<?=getProcess($row['id_maquina'])?>" >
   </td>
   

                        </tr>
                      <?php $i++; } ?>
      </tbody>
      </table>
      <script type="text/javascript">
 
      
      $(document).ready(function(){
 
        $('.lightbox').click(function(){
          $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
          $('.box').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box').css('display', 'block');
        });
 
        $('.close').click(function(){
          close_box();
          close_box3();
        });
 
        $('.backdrop').click(function(){
          close_box();
        });
        $('.lightbox2').click(function(){
          $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
          $('.box2').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box2').css('display', 'block');
        });
        $('.lightbox3').click(function(){
          $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
          $('.box3').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box3').css('display', 'block');
        });
        $('.close2').click(function(){
          close_box2();
        });
 
        $('.backdrop').click(function(){
          close_box2();
          close_box3();
        });
      });
 
      function close_box()
      {
        $('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear');
        $('.backdrop, .box').css('display', 'none');
      }
  function close_box2()
      {
        $('.backdrop, .box2').animate({'opacity':'0'}, 300, 'linear');
        $('.backdrop, .box2').css('display', 'none');
      }
      function close_box3()
      {
        $('.backdrop, .box3').animate({'opacity':'0'}, 300, 'linear');
        $('.backdrop, .box3').css('display', 'none');
      }
    </script>
    </div>

    </div>
    <?php }
    else{
       printf("Errormessage: %s\n", $mysqli->error);
      }
      ?>