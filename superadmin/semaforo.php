<?php
        
        require('../saves/conexion.php');
       
      

       function activeProcess($id_process){
                    require('../saves/conexion.php');
                    $subquery="SELECT nombre_proceso,estatus FROM procesos WHERE id_orden=$id_process";
                  $ords=$mysqli->query($subquery);
                  $results=array();
                  $results2=array();
                    $i=0;
                    while($arr=mysqli_fetch_array($ords)) {
                      $results[$i] = $arr;
                      $i++;
                    }
                    for ($i=0; $i < count($results) ; $i++) { 
       
       $results2[]=$results[$i]['nombre_proceso'];

       
      } 
      
      echo json_encode($results);

                   
                    }

                    function gequty($idpro,$nombre){

                    require('../saves/conexion.php');
                    $subquery2="SELECT nombre_proceso FROM procesos WHERE nombre_proceso LIKE '%$nombre%' AND id_orden=$idpro";
                  $ords2=$mysqli->query($subquery2);
                  
                  if ($ords2->num_rows>1) {
                 echo " <div class='proqty'>".$ords2->num_rows."</div>";
               }
                    }
                     function gequty2($idpro,$nombre){

                    require('../saves/conexion.php');
                    $nplaca=$nombre.'-';
                    $subquery2="SELECT nombre_proceso FROM procesos WHERE (nombre_proceso='$nombre' OR nombre_proceso LIKE '%$nplaca%') AND id_orden=$idpro";
                  $ords2=$mysqli->query($subquery2);
               if ($ords2->num_rows>1) {
                 echo " <div class='proqty'>".$ords2->num_rows."</div>";
                 
               }
                  
                    }

       
       ?>


        
         <?php
                  function getStatus($id_process,$process){
                    require('../saves/conexion.php');
                    
                    $subquery="SELECT estatus FROM procesos WHERE numodt='$id_process' AND nombre_proceso='$process' ORDER BY estatus DESC";
                    $getting=$mysqli->query($subquery);
                  $getLast = mysqli_fetch_assoc($getting);
                  
                  $lastId=$getLast['estatus'];
                  if ($lastId=='En Tiempo') {
                    $qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo=$qty.' <img width="15" src="../images/ontime.png"/>';
                   return $semaforo;
                  }
                  elseif($lastId=='Tarde') {
                   
                   $qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo=$qty.' <img width="15" src="../images/late.png"/>';
                   return $semaforo;
                  }
                   elseif($lastId=='No se ha Realizado') {
                   
                   $qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo=$qty.' <img width="15" src="../images/not.png"/>';
                   return $semaforo;
                  }
                   elseif($lastId=='Programado') {
                   
                    $qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo=$qty.' <img width="15" src="../images/completed.png"/>';
                   return $semaforo;
                  }
                   elseif($lastId=='') {
                   
                   $qty=(($getting->num_rows>1)?" <div class='proqty'>".$getting->num_rows."</div>" : '');
                   $semaforo=$qty.' <img width="15" src="../images/blanco.png"/>';
                   return $semaforo;
                  }
                  
                

                  }

                  //for total count data
                  $limit = 200;
                  $countSql = "SELECT COUNT(idorden) FROM ordenes WHERE entregado NOT IN('true')";  
                  $tot_result = $mysqli->query($countSql);   
                  $row = mysqli_fetch_row($tot_result);  
                  $total_records = $row[0]; 

                  $total_pages = ceil($total_records / $limit);

                  //for first time load data
                  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                  $start_from = ($page-1) * $limit; 
                   $resultados=$mysqli->query("SELECT idorden,numodt FROM ordenes WHERE entregado NOT IN('true') ORDER BY idorden ASC LIMIT $start_from, $limit"); 
                  
                  

                 while ($fila = mysqli_fetch_assoc($resultados) ){
                  $orders[$fila['numodt']]=$fila;
                 }
                 
                 

            ?>
            <style type="text/css">

        .scrolltable {
           
            height: 100%;
            display: flex;
            display: -webkit-flex;
            flex-direction: column;
            -webkit-flex-direction: column;
        }
        .scrolltable > .header {
        }
        .scrolltable > .body {
           
            width: -webkit-fit-content;
            overflow-y: scroll;
            flex: 1;
            -webkit-flex: 1;
        }

        .header th, td {
            min-width: 40px;
        }

        #constrainer {
            width: 890px;
            height: 477px;
            overflow:hidden;
        }

        .header {
            border-collapse: collapse;
        }
        #bodyt th, td {
            
            text-align: center;
        }
        th {
            color: #C7D1DB;
    background-color: #181820;
        }
        #bodyt{
          background: #272B34;
        }
        #bodyt td {
           

        }
        tr:first-child td {
            border-top-width: 0;
        }
        #bodyt tr:nth-of-type(even) {
            background-color: #393C41;
        }

div.vertical
{

 position: absolute;
 width: 45px;
 transform: rotate(-90deg);
 -webkit-transform: rotate(-90deg); /* Safari/Chrome */
 -moz-transform: rotate(-90deg); /* Firefox */
 -o-transform: rotate(-90deg); /* Opera */
 -ms-transform: rotate(-90deg); /* IE 9 */
 bottom: 25px;
 left: -2px;
}
#bodyt{
  
  color:#C7D1DB;
  border-collapse: collapse;
}
#bodyt tr{
  cursor: pointer;
  border-top: 1px solid #3F4C53;
}
#bodyt td{
  padding-top:8px; 
  padding-bottom:8px;
  position: relative; 
}
#bodyt tr:hover{
background:#181820;
border-top: 1px solid #0D0D12;
}
th.vertical
{
 height: 105px;
 line-height: 14px;
 padding-bottom: 5px;
 text-align: left;
 position: relative;
 border-right: 1px solid #1F242A;
}
.firstth{
  width: 75px;
  font-size: 20px;
  text-align: center;
  line-height: 20px;
  border-right: 1px solid #2F333D;
}
.firsttd{
  border-right: 1px solid #2F333D;
}
tbody td:first-child{
width: 75px;
}
    </style>

          <div id="constrainer">
              <div class="scrolltable">
                  <table class="header"><thead>
                  <th class="firstth"><div class="">No.
          Orden</div></th>
                    <th class="vertical"><div class="vertical">Original</div></th>
                   <th class="vertical"><div class="vertical">Positivo</div></th>
                   <th class="vertical"><div class="vertical">Placa</div></th>
                   <th class="vertical"><div class="vertical">Placa_HS</div></th>
                    <th class="vertical"><div class="vertical">LaminaOff</div></th>
                   <th class="vertical"><div class="vertical">Corte</div></th>
                   <th class="vertical"><div class="vertical">Revelado</div></th>
                   <th class="vertical"><div class="vertical">Laser</div></th>
                    <th class="vertical"><div class="vertical">Suaje</div></th>
                   <th class="vertical"><div class="vertical">Serigrafia</div></th>
                   <th class="vertical"><div class="vertical">Offset</div></th>
                   <th class="vertical"><div class="vertical">Digital</div></th>
                    <th class="vertical"><div class="vertical">LetterPresS</div></th>
                   <th class="vertical"><div class="vertical">Plastificado</div></th>
                   <th class="vertical"><div class="vertical">Encuadernacion</div></th>
                   <th class="vertical"><div class="vertical">HotStamping</div></th>
                    <th class="vertical"><div class="vertical">Grabado</div></th>
                   <th class="vertical"><div class="vertical">Pleca</div></th>
                   <th class="vertical"><div class="vertical">Acabado</div></th>
                 
                  </thead></table>
                  <div class="body">
                      <table id="bodyt">
                          <tbody>
                  <?php 
                  if (!empty($orders)) {
                 foreach ($orders as $fila){ 

                  ?>  <input type="hidden" id="idor-<?= $fila["idorden"];?>" value="<?= $fila["idorden"];?>">
                          <tr id="<?php echo $fila["idorden"];?>" onclick='rellenar("<?= $fila["numodt"];?>");' >
                          <td class="firsttd"> <?=$fila["numodt"];?> </td> 
                          <td ><?=getStatus($fila['numodt'],'Original');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Positivo');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Placa');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Placa_HS');?> </td>
                          <td > <?=getStatus($fila['numodt'],'LaminaOff');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Corte');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Revelado');?></td>
                          <td ><?=getStatus($fila['numodt'],'Laser');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Suaje');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Serigrafia');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Offset');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Digital');?> </td>
                          <td ><?=getStatus($fila['numodt'],'LetterPress');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Plastificado');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Encuadernacion');?> </td>
                          <td ><?=getStatus($fila['numodt'],'HotStamping');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Grabado');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Pleca');?> </td>
                          <td ><?=getStatus($fila['numodt'],'Acabado');?> </td>
                          </tr>
                    <?php } } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

            <script >
             $(document).ready(function(){
        $('.controls').css('visibility','hidden')
  $('#tooltip').click(function() { return false; });
        $('.lightbox').click(function(){
          $('.backdrop, .big-box-large').animate({'opacity':'.50'}, 300, 'linear');
          $('.big-box-large').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .big-box-large').css('display', 'block');
        });
        $('.lightbox2').click(function(){
          $('.backdrop, .big-box-large2').animate({'opacity':'.50'}, 300, 'linear');
          $('.big-box-large2').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .big-box-large2').css('display', 'block');
        });
 
        $('.close').click(function(){
          close_box();
          document.getElementById('new-order').reset();
                     document.getElementById('new-order').reset();
                      $('.checkicon-on').removeClass('checkicon-on');
                      $('.checkicon-on-blue').removeClass('checkicon-on-blue');
                       $('.checkicon-on-yellow').removeClass('checkicon-on-yellow');
                        $('.checkicon-on-green').removeClass('checkicon-on-green');
                         $('.checkicon-on-red').removeClass('checkicon-on-red');
                      $('.temporal').remove();
        })
        $('.close2').click(function(){
          close_box();
          document.getElementById('update-order').reset();
                     document.getElementById('update-order').reset();
                      $('.checkicon-on').removeClass('checkicon-on');
                      $('.checkicon-on-blue').removeClass('checkicon-on-blue');
                       $('.checkicon-on-yellow').removeClass('checkicon-on-yellow');
                        $('.checkicon-on-green').removeClass('checkicon-on-green');
                         $('.checkicon-on-red').removeClass('checkicon-on-red');
                      $('.temporal').remove();
        });
 
        $('.backdrop').click(function(){
          close_box();
          document.getElementById('new-order').reset();
                      $('.checkicon-on').removeClass('checkicon-on');
                      $('.checkicon-on-blue').removeClass('checkicon-on-blue');
                       $('.checkicon-on-yellow').removeClass('checkicon-on-yellow');
                        $('.checkicon-on-green').removeClass('checkicon-on-green');
                         $('.checkicon-on-red').removeClass('checkicon-on-red');
                      $('.temporal').remove();
                      $('#ft').prop('readonly', false);
                      $('.iteration').html('1');
                      //$('input:checkbox').attr('checked', false);
        });
       
      });

              function rellenar(id){
                $('.bkloader').show();
                $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
$('.backdrop').css('display', 'block');
                 $.ajax({  
                              
                             type:"POST",
                             url:"productionOrders.php",   
                             data:{numodt:id},  
                               
                             success:function(data){
                              
      $('.bkloader').hide();
          $('.big-box-large').animate({'opacity':'1.00'}, 300, 'linear');
          $(' .big-box-large').css('display', 'block');
                                  $('.big-box-large-in').html(data);  
                             }  
                        }); 
              }
            </script>