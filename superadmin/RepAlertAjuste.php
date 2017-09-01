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
        
  
     $maquinas="SELECT nommaquina, idmaquina FROM maquina";
    $n_maquinas=$mysqli->query($maquinas);
    $usuarios="SELECT * FROM login";
      $n_usuarios=$mysqli->query($usuarios);

    ?>



  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Alerta Ajuste</title>
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
  background: #fff ;
  padding-left: 20px ;
  text-align: center;
  border-radius: 5px;
  padding: 10px;
  margin:10px;
  border: 1px solid #E6E8E7; 
}
#buscar input{
  border:1px solid #ccc;
}

  </style>
  
</head>
<body style=";">

<?php include("topbar.php");  ?>



  <center>
    
    <div class="derecha" id="buscar"> <input type="search" class="light-table-filter" data-table="order-table" placeholder="Busqueda"></div>
  </center>
   
<div class="div-tabla">
<?php include("tableAlert.php");  ?>
</div>

</div>







 
  <div class="backdrop"></div>
  <div class="box"><div class="close">x</div>
  <div class="modal-form">
  <p id="order" style="text-align: center; font-weight: bold;"></p>
    <form id="update_form" method="post" onsubmit="updateRow();">
    <input type="hidden" value="alerta-ajuste" name="form" >
   <input type="hidden" id="fi" name="idalert" >
    <input type="text" id="ft" name="tiempo" placeholder="Tiempo">
    
    <select  name="nommaquina" id="fm">
      <option disabled="true" >Maquina</option>
     <?php while($rowf=mysqli_fetch_assoc($n_maquinas)){ ?>
     <option value="<?=$rowf['idmaquina']?>"><?php echo $rowf['nommaquina']; ?></option>
     <?php } ?>
   </select>
    </select>
    <input type="text" id="fp" name="problem" placeholder="Problema">
    <input type="text" id="fo" name="observ" placeholder="Observaciones">
    <select  name="logged_in" id="fu">
      <option disabled="true" >Usuario</option>
     <?php while($rowu=mysqli_fetch_assoc($n_usuarios)){ ?>
     <option value="<?=$rowu['id']?>"><?php echo $rowu['logged_in']; ?></option>
     <?php } ?>
   </select>
    <input type="text" id="fh" name="horadeldia" placeholder="Hora del dia">
     <input type="text" id="ff" name="fechadeldia" placeholder="Fecha del dia">
    <input type="submit" value="Guardar">
  </form>
  </div>



  </div>


   <div class="box2"><div class="close2">x</div>
  <div class="modal-form">
  <p id="orderdelete" style="text-align: center; font-weight: bold;"></p>
    <form id="delete_form" method="post" onsubmit="deleteRow();">
    <input type="hidden" value="alerta-ajuste" name="form" >
   <input type="hidden" id="dfi" name="idajuste" >
    
    
    <input type="submit" value="BORRAR">
    <input type="button" value="CANCELAR" class="close2">
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
                          var usu=$("#l-"+id).val();
                          var hor=$("#h-"+id).val();
                          var fech=$("#f-"+id).val();

                          $("#order").html('Alerta: '+aid);
                          $("#fi").val(aid);
                          $("#ft").val(tim);
                          //$("#fm").val(maq);
                           $('#fp').val(rad);
                          $("#fo").val(obs);
                          $('#fm').val(maq);
                          $("#fu").val(usu);
                          $("#fh").val(hor);
                          $("#ff").val(fech);
                        }
                        function delet(id){
                          var aid=$("#i-"+id).val();
                         
                          $("#orderdelete").html('Desea eliminar la Orden: '+aid+' ?');
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
                     url:"updates.php",   
                     data:$('#update_form').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          $('.close').click();  
                          $('.div-tabla').html(data);  
                     }  
                });  
           }  
      }

       function deleteRow(){  
            event.preventDefault();
          
                $.ajax({  
                      
                     type:"POST",
                     url:"deletes.php",   
                     data:$('#delete_form').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          $('.close2').click();  
                          $('.div-tabla').html(data);  
                     }  
                });  
            
      }
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
