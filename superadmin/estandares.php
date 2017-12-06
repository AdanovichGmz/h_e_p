 <?php
if( !session_id() )
{
    session_start();
    

}
if(@$_SESSION['logged_in'] != true){
    echo '
     <script>
        alert("No has iniciado sesion");
        self.location.replace("../index.php");
    </script>';
}else{
    echo '';
}
    ?>


     <?php
     require('../saves/conexion.php');
        function getProcess($id){
          if (!empty($id)) {
            require('../saves/conexion.php');
        $maq_query="SELECT nommaquina FROM maquina WHERE idmaquina=$id";
        
        $getmaq=mysqli_fetch_assoc($mysqli->query($maq_query));
        $maq=$getmaq['nommaquina'];
        return $maq;
          }else{
            return '';
          }
        
      }
      function getElement($id){
         require('../saves/conexion.php');
        $elem_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$id";
        
        $getelem=mysqli_fetch_assoc($mysqli->query($elem_query));
        $elem=$getelem['nombre_elemento'];
        return $elem;
      }
      function getMinutes($seconds){

      } 
  
     $maquinas="SELECT nommaquina, idmaquina FROM maquina";
    $n_maquinas=$mysqli->query($maquinas);
    $usuarios="SELECT * FROM elementos ORDER BY nombre_elemento ASC";
      $n_usuarios=$mysqli->query($usuarios);


    $elem_filter="SELECT * FROM elementos ORDER BY nombre_elemento ASC";
    $filter=$mysqli->query($elem_filter);

    $maq_filter="SELECT idmaquina,nommaquina FROM maquina";
    $filter2=$mysqli->query($maq_filter);

    ?>



  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>ESTANDARES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  


    <link href="../css/estilosadmin.css" rel="stylesheet" />

   
      <link rel="stylesheet" href="../fonts/style.css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="../js/main.js"></script>




<script type="text/javascript">
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
</script>



<style type="text/css">
  body {
  font: normal medium/1.4 sans-serif;
}
   


#buscar{
  width: 300px;
  font-size: 18px;
  color:black;
  background: #383838 ;
  padding-left: 20px ;
  text-align: center;
  border-radius: 5px;
  padding: 10px;
  margin:10px; 
}
td{
  vertical-align: middle !important;
}
.conttabla2{
      width: 98%; 
    height: 80%; 
    position: absolute; 
    overflow: auto; 
    
    left: 1%;
    color: white;
}
.left-form2{
  width: 20%!important;
}
.left-form{
 width: 30%!important; 
}

  </style>
  
</head>
<body style=";">

<?php include("topbar.php");  ?>



 <div class="top-form">

  <div class="left-form2">
 
   <p style="margin-bottom: 2px!important;">Filtrar por Elemento</p>
   <input type="hidden" name="activef" value="ok">
   <div class=""><select id="filterElem" name="dateFilter">
   <option disabled="true" selected="true">Elige el elemento</option>
     <?php while($rowf=mysqli_fetch_assoc($filter)){ ?>
     <option value="<?=$rowf['id_elemento']?>"><?=$rowf['nombre_elemento'] ?></option>
     <?php } ?>
   </select>
<input hidden  name="datepicker" id="fechadeldia" value="<?php echo date("d/m/Y"); ?>" />
   </div>
   
 
 </div>
 
  <div class="left-form2">
 
   <p style="margin-bottom: 2px!important;">Filtrar por Proceso</p>
   <input type="hidden" name="activef" value="ok">
   <div class=""><select id="filterProces" name="dateFilter">
   <option disabled="true" selected="true">Elige el proceso</option>
     <?php while($rowf2=mysqli_fetch_assoc($filter2)){ ?>
     <option value="<?=$rowf2['idmaquina']?>"><?=$rowf2['nommaquina']; ?></option>
     <?php } ?>
   </select>
<input hidden  name="datepicker" id="fechadeldia" value="<?php echo date("d/m/Y"); ?>" />
   </div>
  
 
 </div>
 <div  class="left-form2"><button style="margin-top: 25px;" type="button" id="newstandar" onclick="newstandar()" class="btn btn-primary lightbox">AGREGAR ESTANDAR</button></div>
 <div class="left-form"><div><input type="search" class="light-table-filter" data-table="order-table" placeholder="Busqueda"></div>
    
 </div>

</div>
   
<div class="div-tabla">
<?php include("tableEstandar.php");  ?>
</div>

</div>







 
  <div class="backdrop"></div>
  <div class="box"><div class="close">x</div>
  <div class="modal-form">
  <p id="order" style="text-align: center; font-weight: bold;"></p>
    <form id="update_form" method="post" onsubmit="updateRow();">
    <input type="hidden" value="edit" id="form" name="form" >
   <input type="hidden" id="fi" name="idstandard" >
    
    
    <select  name="nommaquina" id="fm">
      <option disabled="true" selected="true" value="none">Proceso</option>
     <?php while($rowf=mysqli_fetch_assoc($n_maquinas)){ ?>
     <option value="<?=$rowf['idmaquina']?>"><?php echo $rowf['nommaquina']; ?></option>
     <?php } ?>
   </select>
    </select>
    <input type="text" id="fp" name="ajuste" placeholder="Tiempo Estandar de Ajuste">
    <input type="text" id="fo" name="piezas" placeholder="Piezas por Minuto">
    <select  name="elemento" id="fu">
      <option disabled="true" >Elemento</option>
     
   </select>
  
    <input type="submit" value="Guardar">
  </form>
  </div>



  </div>


   <div class="box2"><div class="close2">x</div>
  <div class="modal-form">
  <p id="orderdelete" style="text-align: center; font-weight: bold;"></p>
    <form id="delete_form" method="post" onsubmit="deleteRow();">
    <input type="hidden" value="delete" name="form" >
   <input type="hidden" id="dfi" name="idstandard" >
    
    
    <input type="submit" value="BORRAR">
    <input type="button" value="CANCELAR" class="close2">
  </form>
  </div>
  </div>

  <div class="box3"><div class="close">x</div>
  <div class="modal-form">
  <p id="orderupdate" style="text-align: center; font-weight: bold;"></p>
    <form id="update_form2" method="post" onsubmit="updateRow2();">
    <input type="hidden" value="edit"  name="form" >
   <input type="hidden" id="fi2" name="idstandard" >
    <input type="text" id="proces" name="nommaquina" readonly="true">
    
    <input type="text" id="fpu" name="ajuste" placeholder="Tiempo Estandar de Ajuste">
    <input type="text" id="fou" name="piezas" placeholder="Piezas por Minuto">
    <input type="text" id="elem" name="elemento" readonly="true">
  
    <input type="submit" value="Guardar">
  </form>
  </div>



  </div>
  <script>
                        function startTime() {
                            today = new Date();
                            h = today.getHours();
                            m = today.getMinutes();
                            s = today.getSeconds();
                            m = checkTime(m);
                            s = checkTime(s);
                            document.getElementById('hora').innerHTML = h + ":" + m + ":" + s;
                            t = setTimeout('startTime()', 500);
                        }
                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }
                        window.onload = function() {
                            startTime();
                        }
                        function edit(id){

                          var aid=$("#i-"+id).val();
                          var rad=$("#r-"+id).val();
                          var obs=$("#o-"+id).val();
                          var tim=$("#t-"+id).val();
                          var maq=$("#n-"+id).val();
                          

                          $("#order").html('Estandar: '+aid);
                          $("#proces").val(maq);
                          $("#elem").val(tim);
                          

                          $("#fi2").val(aid);
                           $('#fpu').val(rad);
                          $("#fou").val(obs);
                         
                          
                        }
                        function delet(id){
                          var aid=$("#i-"+id).val();
                         
                          $("#orderdelete").html('Desea eliminar el Estandar: '+aid+' ?');
                          $("#dfi").val(aid);
                          
                        }
                        function updateRow(){  
            event.preventDefault();
           if($('#ft').val() == "")  
           {  
                alert("Name is required");  
           }  
           else if($('#fm').val() == '')  
           {  
                alert("Address is required");  
           }  
           else if($('#fu').val() == '')  
           {  
                alert("Designation is required");  
           }  
           else if($('#fh').val() == '')  
           {  
                alert("Age is required");  
           }
           else if($('#ff').val() == '')  
           {  
                alert("Age is required");  
           }    
           else  
           {  
                $.ajax({  
                      
                     type:"POST",
                     url:"newStandard.php",   
                     data:$('#update_form').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          $('.close').click();  
                          $('.div-tabla').html(data);
                          //$('#fm').val('none');
                          console.log('perro');
                          $('#fm option[value=none]').attr('selected','selected');
                          $("#fu option").remove();

                     }  
                });  
           }  
      }
      function updateRow2(){  
            event.preventDefault();
           if($('#ft').val() == "")  
           {  
                alert("Name is required");  
           }  
           else if($('#fm').val() == '')  
           {  
                alert("Address is required");  
           }  
           else if($('#fu').val() == '')  
           {  
                alert("Designation is required");  
           }  
           else if($('#fh').val() == '')  
           {  
                alert("Age is required");  
           }
           else if($('#ff').val() == '')  
           {  
                alert("Age is required");  
           }    
           else  
           {  
                $.ajax({  
                      
                     type:"POST",
                     url:"newStandard.php",   
                     data:$('#update_form2').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          $('.close').click();  
                          $('.div-tabla').html(data);
                          //$('#fm').val('none');
                          
                         

                     }  
                });  
           }  
      }
      function newstandar(){
        $('#form').val('insert');
        $('#update_form')[0].reset();
        
      }


       function deleteRow(){  
            event.preventDefault();
          
                $.ajax({  
                      
                     type:"POST",
                     url:"newStandard.php",   
                     data:$('#delete_form').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          $('.close2').click();  
                          $('.div-tabla').html(data);  
                     }  
                });  
            
      }

      $( "#filterElem" ).change(function() {
        var emlem_id= $( "#filterElem" ).val();
        $.ajax({  
                      
                     type:"POST",
                     url:"filterStandard.php",   
                     data:{value:emlem_id,filterby:'element'},  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close2').click();  
                          $('.div-tabla').html(data);  
                     }  
                });


 console.log($( "#filterElem" ).val());
});

      $( "#fm" ).change(function() {
        var emlem_id= $( "#fm" ).val();
        $.ajax({  
                      
                     type:"POST",
                     url:"standardForm.php",   
                     data:{maquina:emlem_id},  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close2').click();  
                          $('#fu').html(data);
                          console.log(data);  
                     }  
                });


 console.log($( "#filterElem" ).val());
});

        $( "#filterProces" ).change(function() {
        var emlem_id= $( "#filterProces" ).val();
        $.ajax({  
                      
                     type:"POST",
                     url:"filterStandard.php",   
                     data:{value:emlem_id,filterby:'process'},  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close2').click();  
                          $('.div-tabla').html(data);  
                     }  
                });


 console.log($( "#filterProces" ).val());
});
                    </script>



 





<script>
                        function startTime() {
                            today = new Date();
                            h = today.getHours();
                            m = today.getMinutes();
                            s = today.getSeconds();
                            m = checkTime(m);
                            s = checkTime(s);
                            document.getElementById('hora').innerHTML = h + ":" + m + ":" + s;
                            t = setTimeout('startTime()', 500);
                        }
                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }
                        window.onload = function() {
                            startTime();
                        }
                    </script>




</body>
</html>
