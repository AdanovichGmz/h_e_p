 <?php  
require('../saves/conexion.php');
  function getProcess($id){
         require('../saves/conexion.php');
        $maq_query="SELECT nommaquina FROM maquina WHERE idmaquina=$id";
        
        $getmaq=mysqli_fetch_assoc($mysqli->query($maq_query));
        $maq=$getmaq['nommaquina'];
        return $maq;
      }
      function getElement($id){
         require('../saves/conexion.php');
        $elem_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$id";
        
        $getelem=mysqli_fetch_assoc($mysqli->query($elem_query));
        $elem=$getelem['nombre_elemento'];
        return $elem;
      }

 if(!empty($_POST))  
 {  
 
    $filterby=$_POST['filterby'];
    $value=$_POST['value'];
    if ($filterby=='element') {
      $filter_query="SELECT * FROM estandares WHERE id_elemento=$value ORDER BY id_estandard DESC";
      $resultado=$mysqli->query($filter_query);
    }
    elseif ($filterby=='process') {
      $filter_query="SELECT * FROM estandares WHERE id_maquina=$value ORDER BY id_estandard DESC";
      $resultado=$mysqli->query($filter_query);
    }
             
         
 }
 
 if ( $resultado) {
 ?>

 <div class="conttabla2">
    
    <div class="datagrid">
    
      <table class="order-table table hoverable lightable" >

              <thead class="color" >
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
    <td class="derecha" style="padding: 0px;  position:relative;"><a href="#" class="lightbox"><img src="../images/e.png" alt="" width="25" height="25" onClick="edit(<?php echo $i;?>)"></a></td>
     <td style="padding: 0px; position:relative;"><a href="#" class="lightbox2" onClick="delet(<?php echo $i;?>);"><img src="../images/t.png" alt="" width="25" height="25"  ></a></td>
  
     <input type="hidden" id="i-<?php echo $i;?>" value="<?=$row['id_estandard'] ?>" >
  
   <td  class="tabla"><?php echo round($row['ajuste_standard']/60) ;?> minutos
      <input type="hidden" id="r-<?php echo $i;?>" value="<?=round($row['ajuste_standard']/60) ?>" >
   </td>
   <td  class="tabla"><?php echo $row['piezas_por_hora'];?>
      <input type="hidden" id="o-<?php echo $i;?>" value="<?=$row['piezas_por_hora'] ?>" >
   </td>
   <td  class="tabla"><?=getElement($row['id_elemento'])?>
      <input type="hidden" id="t-<?php echo $i;?>" value="<?=$row['id_elemento'] ?>" >
   </td>
   <td  class="tabla"><?=getProcess($row['id_maquina']);?>
      <input type="hidden" id="n-<?php echo $i;?>" value="<?=$row['id_maquina'] ?>" >
   </td>
   

                        </tr>
                      <?php $i++; } ?>
      </tbody>
      </table>
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
  
    </script>
    </div>

    </div>
    <?php }
    else{
      echo $filter_query;
       printf($mysqli->error);
      }
      ?>