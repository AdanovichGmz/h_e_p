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
    /* require('../saves/conexion.php');
     $query="SELECT * FROM alertaMaquinaOperacion ORDER BY idalertamaquina DESC";
	
	 $resultado=$mysqli->query($query);*/

    ?>


       



  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Index</title>
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

    <script src="../js/search.js"></script>



  
</head>
<body style="">

<?php include("topbar.php");  ?>

  
 
<div class="container">

  <center>
    
    </center>
      <br />

    

      <div class="focos">
      <?php include 'semaforo.php' ?>
      </div>
      



       
</div>

<div style="width: 100%; position: relative; height: 100px">
  <div class="derecha" id="buscar" style="float: right;"> <input type="search" class="light-table-filter" data-table="order-table" placeholder="Busqueda"></div>
</div>
<div style="width: 100%; height: 230px; position: relative;">
  <div class="col-md-3 " style="float: right;"> <!-- estilo de columna de bootstrap  http://getbootstrap.com/css/ -->
          <div class="row">
             <div class="col-md-10 txt_tit">En Tiempo</div>
             <div class="col-md-1"><img width="15" src="../images/verde.jpg"/></div>
          </div>
          <div class="row">
             <div class="col-md-10 txt_tit">Tarde</div>
             <div class="col-md-1"><img width="15" src="../images/amarillo.jpg"/></div>
          </div>
          <div class="row">
             <div class="col-md-10 txt_tit">No se ha Realizado</div>
             <div class="col-md-1"><img width="15" src="../images/rojo.jpg"/></div>
          </div>
          <div class="row">
             <div class="col-md-10 txt_tit">Programado</div>
             <div class="col-md-1"><img width="15" src="../images/azul.jpg"/></div>
          </div>
          <div class="row">
             <div class="col-md-10 txt_tit">No Aplica</div>
             <div class="col-md-1"><img width="15" src="../images/blanco.jpg"/></div>
          </div>
          <br>
          <br>
          <a href="#" class="lightbox addOrder"> Agregar Ordenes </a>

        </div>
      
</div>

 <div class="backdrop"></div>
  <div class="big-box-large"><div class="close">x</div>
  <div class="modal-form-large">
  <p id="order" style="text-align: center; font-weight: bold;"></p>
    <form id="new-order" method="post" onsubmit="addOrder();">
    
    <input type="text" id="ft" name="odt" placeholder="ODT" required="true">
    
    
   
    <input type="text" id="fp" name="product" placeholder="Producto" required="true">
    <input type="text" id="fo" name="recibido" placeholder="Cantidad Recibida" required="true">
    <input type="text" id="fc" name="pedido" placeholder="Cantidad de Pedido" required="true">
    <input type="text" id="fc" name="prioridad" placeholder="Orden de Prioridad" required="true">
    <input type="text" id="datepicker" name="inicio" placeholder="Fecha Inicio" required="true">
     <input type="text" id="datepicker2" name="fin" placeholder="Fecha Fin" required="true">
     <br>
     <br>
     <p style="text-align: center; font-weight: bold;">----- Procesos ------</p>
     <br>
     <div class="inputs">
       <div id="Corte" onclick="checking('Corte')" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Ori</div>
         <input type="checkbox" value="Original" name="procesos[]"> 
       </div>
       <div id="Positivo" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Pos</div>
         <input type="checkbox" value="Positivo" name="procesos[]">
       </div>
       <div id="Placas" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Pla</div>
         <input type="checkbox" value="Placa" name="procesos[]">
       </div>
       <div id="Placas_hs" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">PHS</div>
         <input type="checkbox" value="Placa_HS" name="procesos[]">
       </div>
       <div id="Lamina_off" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Loff</div>
         <input type="checkbox" value="Laminaoff" name="procesos[]">
       </div>
       <div id="Revelado" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Cor</div>
         <input type="checkbox" value="Corte" name="procesos[]">
       </div>
       <div id="Laser" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Rev</div>
         <input type="checkbox" value="Revelado" name="procesos[]">
       </div>
       <div id="Suaje" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Las</div>
         <input type="checkbox" value="Laser" name="procesos[]">
       </div>
       <div id="Serigrafia" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Suaj</div>
         <input type="checkbox" value="Suaje" name="procesos[]">
       </div>
       <div id="Offset0" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Serig</div>
         <input type="checkbox" value="Serigrafia" name="procesos[]">
       </div>
       <div id="Digital" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Off</div>
         <input type="checkbox" value="Offset" name="procesos[]">
       </div>
       <div id="Letter_pres" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Dig</div>
         <input type="checkbox" value="Digital" name="procesos[]">
       </div>
       <div id="Encuadernacion" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Lpr</div>
         <input type="checkbox" value="Letterpress" name="procesos[]">
       </div>
       <div id="Hotstamping" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Plas</div>
         <input type="checkbox" value="Plas" name="procesos[]">
       </div>
       <div id="Grabado" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Enc</div>
         <input type="checkbox" value="Encuadernacion" name="procesos[]">
       </div>
       <div id="Pleca" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">HS</div>
         <input type="checkbox" value="HS" name="procesos[]">
       </div>
       <div id="Acabado" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Grab</div>
         <input type="checkbox" value="Grab" name="procesos[]">
       </div>
       <div id="Compra_papel" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Pie</div>
         <input type="checkbox" value="Pie" name="procesos[]">
       </div>
       <div id="Compra_acc" onclick="checking(this.id)" class="checgroup">
         <div class="checkicon"></div>
         <div class="checktext">Acab</div>
         <input type="checkbox" value="Acab" name="procesos[]">
       </div>



     </div>
     
  <br>
    <br> 
    <input type="submit" value="Guardar">
  </form>
  <div id="saveload" style="display: none;"><img src="../images/loader.gif"></div>
  </div>


<script type="text/javascript">
$('.tv-body:odd').css('background-color', '#333333');
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


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
 
      var i = 2;
      $(document).ready(function(){
 
        $('.lightbox').click(function(){
          $('.backdrop, .big-box-large').animate({'opacity':'.50'}, 300, 'linear');
          $('.big-box-large').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .big-box-large').css('display', 'block');
        });
 
        $('.close').click(function(){
          close_box();
          document.getElementById('new-order').reset();
                      $('.checkicon-on').removeClass('checkicon-on');
        });
 
        $('.backdrop').click(function(){
          close_box();
          document.getElementById('new-order').reset();
                      $('.checkicon-on').removeClass('checkicon-on');
        });
       
      });
 
      function close_box()
      {
        $('.backdrop, .big-box-large').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .big-box-large').css('display', 'none');
        });
      }


      $(document).ready(function(){

        

        

        

        $('.backdrop').click(function() {
        while(i > 2) {
        $('.field:last').remove();
        i--;
        }
        });
         $('.close').click(function() {
        while(i > 2) {
        $('.field:last').remove();
        i--;
        }
        });

        // here's our click function for when the forms submitted

        $('.submit').click(function(){

        var answers = [];
        $.each($('.field'), function() {
        answers.push($(this).val());
        });

        if(answers.length == 0) {
        answers = "none";
        }

        alert(answers);

        return false;

        });

});

$( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
  } );
$( function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd'});
  } );

  function removeProcess(){
         
        if(i > 2) {
        $('.field:last').remove();
        i--;
        }
        }

       


        function checking(id){

          var $checkbox = $('#'+id).find('input:checkbox');
          var $checkboxicon = $('#'+id).find('div:first');
        $checkbox.prop('checked', !$checkbox.prop('checked'));
        $checkboxicon.toggleClass('checkicon-on');
        //$checkbox.attr('name', 'proceso' +i);
        i++;
        }
 function addOrder(){  
  $('#new-order').hide();
  $('#saveload').show();
            event.preventDefault();
            
                $.ajax({  
                      
                     type:"POST",
                     url:"newOrder.php",   
                     data:$('#new-order').serialize(),  
                       
                     success:function(data){
                      document.getElementById('new-order').reset();
                      $('.checkicon-on').removeClass('checkicon-on');
                      $('#saveload').hide();
                       $('#new-order').show();
                          //$('#update-form')[0].reset();  
                          $('.close').click();  
                          $('.focos').html(data);  
                     }  
                });  
            
      }
      
    </script>

</body>
</html>
