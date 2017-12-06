<?php
require('../saves/conexion.php');


$orders=$_POST['orders'];
$sorts=$_POST['sort'];
$process=$_POST['processes'];
$proces_name=preg_replace('/\s+/', '', $_POST['process-name']);
$orderids=$_POST['orderids'];
$elems=$_POST['elems'];
$odts=$_POST['odts'];
$clean_query="DELETE FROM orden_estatus WHERE proceso_actual='$proces_name'";
  $clean=$mysqli->query($clean_query);
  $i=1;
  if ($clean) {
foreach ($orders as $order) {
  
  
   $idprocess=(isset($process[$order]))? $process[$order] :'none';
   if ($idprocess!='none') {
    $id_orden=$orderids[$order];
    $numodt=$odts[$order];
    $status=$sorts[$order];

     $upd_query="INSERT INTO orden_estatus(id_orden_status,id_orden,numodt,proceso_actual,id_proceso,status,orden_display)VALUES(null,$id_orden,'$numodt','$proces_name',$idprocess,'$status',$i)";
     $inserted=$mysqli->query($upd_query);
     if (!$inserted) {
       printf($mysqli->error);
       echo $upd_query;
     }
   }else{
    continue;
   }
    
     
     $i++;
  
 
}
}
$string=preg_replace('/\s+/', '', $_POST['process-name']);
  
   if ($string!='') {
     
  $machineName=preg_replace('/\s+/', '', $string);
  $chquery=$mysqli->query("SELECT * FROM orden_estatus WHERE proceso_actual='$machineName'");   
  
  
  if ($chquery->num_rows==0) {
    $query="SELECT o.*,p.id_proceso,p.avance,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT nombre_elemento FROM elementos WHERE id_elemento=o.producto) AS elemento,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o LEFT JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' AND avance NOT IN('completado') order by fechaprog asc";
  }else{
    $query="SELECT o.*,p.id_proceso,p.avance,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT nombre_elemento FROM elementos WHERE id_elemento=o.producto) AS elemento,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o LEFT JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='$machineName' AND avance NOT IN('completado') order by orden_display asc ";
  }
 
 


   $resultado=$mysqli->query($query);
if ( $resultado) {
    ?>   
      
<div class="conttabla2">
    
    <div class="datagrid">
    
    <input type="hidden" name="process-name" value="<?=$string ?>">
      <table class="order-table table hoverable" id="table-program">

              <thead class="" style="">
                 <tr style="">
                         
                          <td   class="tabla"><strong >ODT</strong></td>
                          
                          <td   class="tabla"><strong>ELEMENTO</strong></td>
                          <td   class="tabla"><strong>PROCESO</strong></td>
                          <td class="tabla"><strong>ORDEN</strong></td>

                      
                      </tr>  
                </thead>      
        
      <tbody>
        <?php 
        $i=0;
        while($row=$resultado->fetch_assoc()){ ?>
                      <tr style="height: 35px;" id="<?=$i ;?>">
    
     
  
    <input  type="hidden" name="orders[<?=$i ;?>]"  value="<?=$i ;?>">
  <input  type="hidden" name="orderids[<?=$i ;?>]"  value="<?=$row['idorden'] ;?>">
   <td  class="tabla"><?=$row['numodt'] ;?>
      
   </td>
   <td  class="tabla"><?= $row['elemento'];?>
      
   </td>
   <td  class="tabla"><?=$machineName?>
     
   </td>
   <td class="tabla"><input  type="text" class="sort" name="sort[<?=$i ;?>]" readonly="true" value="<?=$row['status'] ;?>" >
   <input  type="hidden" name="processes[<?=$i ;?>]" value="<?=$row['id_proceso'] ;?>">
   <input  type="hidden" name="elems[<?=$i ;?>]" value="<?=$row['elemento'] ;?>"><input  type="hidden" name="odts[<?=$i ;?>]" value="<?=$row['numodt'] ;?>"></td>
   
   

                        </tr>
                      <?php $i++; } ?>
      </tbody>
      </table>

      <script type="text/javascript">
 
      
      $(document).ready(function(e){
  $("#table-program").tableDnD();

    table_2 = $("#table-program");
        
        
        table_2.tableDnD({
            onDragClass: "tDnD_whileDrag",
            scrollAmount: 10,
            onDrop: function(table, row) {
                $('#newstandar').prop("disabled", false).removeClass('disabled');
                var rows = table.tBodies[0].rows;
                var debugStr = "Row dropped was "+row.id+". New order: ";
                for (var i=0; i<rows.length; i++) {
                    
                    debugStr += rows[i].id+" ";
                    
                }
                 
                 $('#'+rows[0].id).find('input[type="text"]').val('actual');
                 $('#'+rows[1].id).find('input[type="text"]').val('siguiente');
                 $('#'+rows[2].id).find('input[type="text"]').val('preparacion');
                   
                p=1     
                for (var i=3; i<rows.length; i++) {
                  $('#'+rows[i].id).find('input[type="text"]').val('programado'+p);
                   
                   p++; 
                }
                
            },
            
            onDragStart: function (row) {
   //$(".conttabla2").animate({scrollTop:0});
   var ofset=$('#'+row.id).offset().top;
   $(".conttabla2").animate({scrollTop:20-ofset});
   //console.log(ofset);
}

            
        });




        $('.lightbox').click(function(){
          $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
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
          $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
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


      //scroll in table
      
      
 
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
    </div>

    </div>
    <?php }
    else{
       printf("Errormessage: %s\n", $mysqli->error);
      }
    }
      ?>