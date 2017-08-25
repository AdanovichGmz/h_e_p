 <?php
   
    
    ?>

    <?php
     require('saves/conexion.php');
    
  
     ?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AJUSTE CORTE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
      <link href="css/general-styles.css" rel="stylesheet" />
    <!-- LOADER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="css/style.css" rel="stylesheet" />

<script src="js/easytimer.min.js"></script>

    <!-- reloj -->
    <link href="compiled/flipclock.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="compiled/flipclock.js"></script>

    <!--kendo-->
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.material.mobile.min.css" />
    <!--<script src="//kendo.cdn.telerik.com/2016.3.914/js/jquery.min.js"></script>-->
    <script src="//kendo.cdn.telerik.com/2016.3.914/js/kendo.all.min.js"></script>


    <link href="css/estiloshome.css" rel="stylesheet" />
    <link href="css/ajuste.css" rel="stylesheet" />



 <link href="css/progressbar.css" rel="stylesheet" />
 <script src="js/progressbar.js"></script>


    <script src="js/divdespegable.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<!--<script language="javascript" src="jquery-1.3.min.js"></script>-->
<script language="javascript">// <![CDATA[
$(document).ready(function() {
   // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
   // Interceptamos el evento submit
    $('#form, #fat, #fo3, #fo4').submit(function() {
      
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#result').html(data);
                $('.saveloader').hide();
                $('.savesucces').show();
                 setTimeout(function() {   
                   close_box();
                }, 1000);
                console.log(data);

            }
        })        
        return false;
    }); 
})
// ]]></script>

<script language="javascript">
         function limpiar() {
           setTimeout('document.fo3.reset()',2);
      return false;
}
</script>



  <script language="javascript">// <![CDATA[
$(document).ready(function() {
   // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function() {
        $('#loading').show();
        $('#resultaado').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#resultaado').fadeIn('slow');
    });
   // Interceptamos el evento submit
    $('#form, #fat, #tareas').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#resultaado').html('ORDEN ACTUAL'+data);
               $('#result').html(data);
                $('.saveloader').hide();
                $('.savesucces').show();
                 setTimeout(function() {   
                   close_box();
                }, 1000);
                console.log(data);
            }
        })        
        return false;
    }); 
})
</script>




<script>
function alerttime(){
  animacion = function(){
  
  document.getElementById('formulario').classList.toggle('fade');
}
setInterval(animacion, 550);
}
</script>


</head>
<body onload="setTimeout('alerttime()',2000000);">
<div id="formulario"></div>
    <style type="text/css">
       .clock{
        transform: scale(1.5);
-ms-transform: scale(1.5); 
-webkit-transform: scale(1.5); 
-o-transform: scale(1.5);
-moz-transform: scale(1.5);
      }  

#load{
  width: 100%; text-align: center; 
}

         .congral2{
            width: 100%;
            height: 100%;

        }
 .cont2{
           
          
            
        }

        #result {
	width:280px;
	padding:10px;
	border:1px solid #bfcddb;
	margin:auto;
	margin-top:10px;
	text-align:center;
}

 #success-msj{
    color: #BB1B1B!important;
    font-family: "monse-medium"!important;

}   
.backdrop
    {
      position:absolute;
      top:0px;
      left:0px;
      width:100%;
      height:100%;
      background:#000;
      opacity: .0;
      filter:alpha(opacity=0);
      z-index:50;
      display:none;
    }
 
 
    .box
    {
      position:absolute;
      top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      width:150px;
      height: 150px;
      
      background:#ffffff;
      z-index:51;
      padding:10px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      -moz-box-shadow:0px 0px 5px #444444;
      -webkit-box-shadow:0px 0px 5px #444444;
      box-shadow:0px 0px 5px #444444;
      display:none;
    }
 
    .close
    {
      float:right;
      margin-right:6px;
      cursor:pointer;
    }
    .saveloader{
      width: 100%;
      text-align: center;
      position: relative;
    }
    .saveloader img{
      width: 100%;
    }
    .saveloader p{
     margin-top: -20px;
    }
     .savesucces{
      width: 100%;
      text-align: center;
      position: relative;
    }
    .savesucces img{
      width: 60%;
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .savesucces p{
     
    }    
@media only screen and (min-width:481px) and (max-width:768px) and (orientation: portrait) {
    .contegral{
        display:none;
    }
        body {
             background-image:none;
        }
    .msj {
    display:block;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    top: 40%;
    left: 10%;
    position: absolute;
    z-index:122;
    }
}

@media screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation: landscape) {
 .msj {
 display: none;
 }
}
    </style>

     
    


   

     




    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>
  

         <div class="congral2">               
            <div class="cont2 center-block">
                

                <form name="nuevo_registro" id="nuevo_registro" method="POST" action="index3.php" >
                
                 <input hidden type="text" name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                
                 <input hidden type="text" name="horadeldia" id="horadeldia" value="<?php echo date("H:i:s",time()-25200); ?>" />
                 <input hidden type="text" name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />
                       
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                            <div class="text-center" style="font-size:18pt;">AJUSTE CORTE</div>
                              <div class="text-center2" style="font-size:18pt;">orden 9</div>
                           
                   
                    <p id="success-msj" style="display: none;">Datos guardados correctamente</p>
                        </div>
                        <div class="modal-body">
                        <div class="button-panel" >
                        <a href="logout.php" > <img src=""  href="logout.php" class="img-responsive" onClick="return confirm('estas segur@ de cerrar SESION?')" />
                        <div class="square-button red">
                          <img src="images/exit-door.png">
                        </div></a>
                        <div class="square-button green stop eatpanel goeat">
                          <img src="images/dinner.png">
                        </div>
                        <div id="stop" class="square-button blue " >
                          <img src="images/saving.png">
                        </div>
                        <div class="square-button yellow   derecha goalert">
                          <img src="images/warning.png">
                        </div>
                        <div class="square-button purple abajo">
                          <img src="images/checklist.png">
                        </div>
                        <!--
                          <div id="loop" class="square-button purple" onclick="stopClock(clock)">
                          <img src="images/ex.png">
                        </div>
                        <div id="loopstart" class="square-button rojo" onclick="startClock(clock)">
                          <img src="images/ex.png">
                        </div> -->
                        </div>
                                                   

                        </div>


                        <div class="timer-container">
                                    <div id="chronoExample">
                                    <div id="timer"><span class="values">00:00:00</span></div>
                                    
                                    <input type="hidden" id="timee" name="tiempo">
                                    
                                </div>
                                </div>
                                



                        
                          <?php
                          $valorQuePasa3 = $_GET['mivariable']; // variable que viene de otra pagina por el metodo get
                           $valorQuePasa4 = $_GET['mivariable'];
                            $valorQuePasa5 = $_GET['mivariable'];

                                                     
                          
                          //echo $valorQuePasa;
                          ?>                

                         <input hidden name="nommaquina" id="nommaquina" value="<?php echo $valorQuePasa3; ?>"  />



                        <div class="modal-footer">
                            <div class="row ">
                                <div class="col-lg-12  ">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
               


            </div>
        </div>
       <div class="backdrop"></div>

<div class="box">
  <div class="saveloader">
  
    <img src="images/loader.gif">
    <p style="text-align: center; font-weight: bold;">Guardando..</p>
  </div>
  <div class="savesucces" style="display: none;">
  
    <img src="images/success.png">
    <p style="text-align: center; font-weight: bold;">Listo!</p>
  </div>
  </div>
   <div id="panelbottom">
      <!-- <div id="panelbottom2"></div> -->
       <div class="row ">
                <legend>TAREAS</legend>
                <div style="width: 90%; margin:0 auto; position: relative;">
                
                   <div class="form-group">
                  <div class="button-panel-small2">
                  <form id="tareas" action="opp.php" method="post" name="tareas">
                  <?php
                      $query = $mysqli->query("SELECT t.*, o.numodt,o.orden,m.idmaquina FROM tiraje t  inner join ordenes o on t.id_orden = o.idorden inner join maquina m on t.id_maquina = m.idmaquina where maquina =1 order by orden asc");
                      while ($valores = mysqli_fetch_array($query)) {
                      
                     ?>
                        <div  class="rect-button-small radio-menu-small face abajo save-bottom" onclick="showLoad();">
                        <input type="hidden" name="datos"  value="<?=$valores['orden'] ?>">
                          <?php echo  $valores['numodt']; ?>
                        </div>

                        <?php } ?>
                        
                          </form>
                        </div>
                </div>
                
                </div>
                <!--
                  <div class="col-md-6">                     

                    <form id="tareas-old" action="opp.php" method="post" name="tareas-old">
                     <select id="datos2" name="datos2" class="tit-sel">
                     <?php
                      $query = $mysqli -> query ("SELECT * FROM ordenes where nommaquina = 'corte' order by orden asc");
                      while ($valores = mysqli_fetch_array($query)) {
                      echo '<option value="'.$valores['orden'].'">'.$valores['numodt'].'</option>';
                       }
                     ?>
                     </select>
                  </div>    
                     <div class="row">
                        <div class="col-md-2"> 
                         <input  type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive abajo " />
                         <input style="position: relative;top: -85px;right: -130px;" type="image" name="eviar" value="Guardar" src="images/elminar.fw.png"   class="img-responsive abajo" />
                        </div>
                     </div>
                    </form> -->
                   <div id="resultaado"></div> 

               
                <div class="form-group">
                <div id="resultaado"></div>
                  <div class="button-panel-small">
                       
                        <div  class="square-button-small red abajo ">
                          <img src="images/ex.png">
                        </div>
                        
                        
                          
                        </div>
                </div>
   </div></div>

    




   <div id="panelder">
   <div id="panelder2"></div>
      <div class="container-fluid">
          
          <div id="estilo">
             <form id="fo4" name="fo4" action="saveAjsute.php" method="post" class="form-horizontal" onSubmit="return limpiar()" >
                <fieldset>
                <input hidden type="text" name="tiempoalertamaquina" id="tiempoalertamaquina" />
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden  name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()-25200); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input  hidden name="maquina" id="maquina" value="<?php echo $valorQuePasa4; ?>"  />

                

                 <!-- Form Name -->
                <legend>ALERTA AJUSTE</legend>
                  
               <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                <div class="two-columns">
                  <div class=" radio-menu face">
                    
                    <input type="radio" name="radios" id="radios-0" value="ODT Confusa">
                    ODT Confusa
                    
                    </div>
                <div class=" radio-menu face">
                    
                    <input type="radio" name="radios" id="radios-1" value="ODT Faltante">
                    ODT Faltante
                    
                    </div>
                </div>
                <div class="two-columns">
                <div class=" radio-menu face">
                    
                    <input type="radio" name="radios" id="radios-2" value="Cambio de Cuchilla">
                    Cambio de Cuchilla
                    
                    </div>
                <div class=" radio-menu face">
                    
                    <input type="radio" name="radios" id="radios-3" value="Pieza de Plancha">
                    Pieza de Plancha
                    
                    </div>
                <div class=" radio-menu face">
                    
                    <input type="radio" name="radios" id="radios-4" value="Exceso de Dimensiones">
                    Exceso de Dimensiones
                    
                    </div>
                
                </div>
                
                </div>

              
               <!--<div class="form-group">
                <label class="col-md-4 control-label" for="radios"></label>
                <div class="col-md-6">
                <div class="radio"  style="left:20px; position:absolute;">
                    <label for="radios-0">
                    <input type="radio" name="radios" id="radios-0" value="ODT Confusa" checked="checked">
                    ODT Confusa
                    </label>
                    </div>
                <div class="radio" style="left:20px; position:absolute; top:25px;">
                    <label for="radios-1">
                    <input type="radio" name="radios" id="radios-1" value="ODT Faltante">
                    ODT Faltante
                    </label>
                    </div>
                <div class="radio"style="left:20px; position:absolute; top:50px;">
                    <label for="radios-2">
                    <input type="radio" name="radios" id="radios-2" value="Cambio de Cuchilla">
                    Cambio de Cuchilla
                    </label>
                    </div>
                <div class="radio" style="left:20px; position:absolute; top:75px;">
                    <label for="radios-3">
                    <input type="radio" name="radios" id="radios-3" value="Pieza de Plancha">
                    Pieza de Plancha
                    </label>
                    </div>
                <div class="radio"style="left:20px; position:absolute; top:100px;">
                    <label for="radios-4">
                    <input type="radio" name="radios" id="radios-4" value="Exceso de Dimensiones">
                    Exceso de Dimensiones
                    </label>
                    </div>
                </div>
                </div> -->
                <!-- Textarea -->
                <div class="form-group" style="text-align: center; color:black;">
                    <textarea placeholder="Observaciones.." class="comments" id="observaciones" name="observaciones"></textarea>
                
                </div>
                <!--
                <div class="form-group">
                <label class="col-md-4 control-label" for="textarea">Observaciones</label>
                <div class="col-md-4">                     
                    <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                </div>
                </div>-->

                <!-- Button (Double) -->
                <div class="form-group">
                  <div class="button-panel-small">
                       
                        <div class="square-button-small red derecha stopalert start reset">
                          <img src="images/ex.png">
                        </div>
                        <div id="save-ajuste" class="square-button-small derecha  blue" onclick="showLoad();">
                          <img src="images/saving.png">
                        </div>
                        
                          
                        </div>
                </div>

                <!--<div class="form-group">
                <label class="col-md-4 control-label" for="guardar"></label>
                <div class="col-md-8">
        
                <input  type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive derecha stopalert start reset2 " />
                <input style="position: relative;top: -85px;right: -130px;" type="image" name="eviar" value="Guardar" src="images/elminar.fw.png"   class="img-responsive derecha stopalert start reset " />

                  <!--  <input id="" value="Guardar" type="submit" name="enviar"  class="derecha stopalert start reset2"  />
                    
                    <input id="" value="cancelar" type="reset"   class="derecha stopalert start reset"  />
                    -->
                            
                   <!--  
                </div>
                </div>-->

                

               </fieldset>    
                
             </form>
         <!--  <div id="result"></div>     
             --> 
           
     
    <div class="reloj-container2">  
        <div class="timersmall">
                                    <div id="alertajuste">
                                    <div id="timersmall"><span class="valuesAlert">00:00:00</span></div>
                                    
                                   
                                    
                                </div>
                                </div>
    </div>
                                    <script>
                                          
                                            $( ".save-bottom").click(function() {
                                             
                                                      $( "#tareas" ).submit();
                                                   
                                             
                                            });

                                           
                                             $( "#save-ajuste").click(function() {
                                             
                                                      $( "#fo4" ).submit();
                                                   
                                             
                                            });

                                             $('.radio-menu').click(function() {
                                              $('.face-osc').removeClass('face-osc');
                                              $(this).addClass('face-osc').find('input').prop('checked', true)    
                                            });

                                             $('.radio-menu-small').click(function() {
                                              $('.face-osc').removeClass('face-osc');
                                              $(this).addClass('face-osc').find('input').prop('checked', true)    
                                            });
                                             
                                             
                                    </script>

       
   
      </div>
   </div>




    <div id="panelbrake">
    <div id="panelbrake2"></div>
      <div class="container-fluid">
          
          <div id="estilo">
             <form id="fo3" name="fo3" action="saveeat.php" method="post" class="form-horizontal" onSubmit=" return limpiar();" >
                <fieldset style="position: relative;left: -15px;">
                
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()-28800); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input hidden name="maquina" id="maquina" value="<?php echo $valorQuePasa5; ?>"  />

                
                  <!-- Form Name -->
                 <legend>Comida</legend>
                
                   <input type="hidden" id="timeeat" name="breaktime">
               
                   <!-- Multiple Radios (inline) -->
                   <div class="form-group" style="width:80% ;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                <input type="hidden" id="s-radios" name="radios">
              <div class="radio-menu face eatpanel" onclick="submitEat('Comida');showLoad();">
                <input type="radio" class=""  id="radios-0"  >
                    COMIDA</div>
               <div class="radio-menu face eatpanel" onclick="submitEat('Sanitario');showLoad();">
               <input type="radio"  id="radios-1" >
                   SANITARIO
                    
                    </div>
                    
                
                </div><!--
                   <div class="form-group">
                     <label class="col-md-4 control-label" for="radios"></label>
                     <div class="col-md-6" style="position: relative;left: -55px;"> 
                       <label class="radio-inline" for="radios-0">
                         <input type="radio" name="radios" id="radios-0" value="Comida" checked="checked">
                         Comida
                       </label> 
                       <label class="radio-inline" for="radios-1">
                         <input type="radio" name="radios" id="radios-1" value="Sanitario">
                         Sanitario
                       </label>
                     </div>
                   </div> -->
                   </br>
                   </br>
                   </br>
                                                           
               

               

                <!-- Button (Double) -->
                <div class="form-group">
                  <div class="button-panel-small">
                       
                        <div  class="square-button-small red eatpanel stopeat start reseteat2 ">
                          <img src="images/ex.png">
                        </div>
                        
                        
                          
                        </div>
                <!--
                <label class="col-md-4 control-label" for="guardar"></label>
                <div class="col-md-8">
        
                <input  type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive eatpanel stopeat start reseteat2 " />
                <input style="position: relative;top: -85px;right: -130px;" type="image" name="eviar" value="cancelar" src="images/elminar.fw.png"   class="img-responsive eatpanel stopeat start reseteat2 " />

                 
                  <input id="" value="Guardar" type="submit" name="enviar"  class="derecha stopalert start reset2"  />
                    
                    <input id="" value="cancelar" type="reset"   class="derecha stopalert start reset"  />
                   

                            
                    
                </div> -->
                </div>

                

               </fieldset>    
                
             </form>
       <!--  <div id="result"></div>     
           -->  
           
     
      <div class="reloj-container2">
    <div class="timersmall">
                                    <div id="horacomida">
                                    <div id="timersmall"><span class="valuesEat">00:00:00</span></div>
                                    
                                   
                                    
                                </div>
                                </div>
    </div>

     
                                    <script>
                                       
                     

                                    </script>

       
   
      </div>
   </div>
</div>
    
   


</body>
</html>


<script>

var element = document.getElementById('nommaquina');
    
 element.addEventListener("change", function(){ 
    var maquina = document.getElementById('maquina');
      
     
     maquina.value = this.options[this.selectedIndex].text;
    
     
 });

 

  function submitEat(suceso){
    $('#s-radios').val(suceso);
    $( "#fo3" ).submit();
  }
  function close_box()
      {
        $('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box').css('display', 'none');
        });
      }
  function showLoad(){
        $('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
          $('.box').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box').css('display', 'block');
      }

</script>

<script type="text/javascript">
 var timer = new Timer();
 var timerEat = new Timer();
 var timerAlert = new Timer();
$(document).ready(function(){
timer.start();
});
       

$('#nuevo_registro').submit(function () {
    timer.pause();
    $('#timee').val(timer.getTimeValues().toString());
    //$('#timee').val(timer.getTimeValues().toString());
});
/*$('#chronoExample .stopButton').click(function () {
    timer.stop();

});*/
timer.addEventListener('secondsUpdated', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
timer.addEventListener('started', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
     
     $( "#stop" ).click(function() {
                                              $( "#nuevo_registro" ).submit();
                                            });

   $('.goeat').click(function () {
    timerEat.start();
    //$('#timee').val(timerEat.getTimeValues().toString());
    timerEat.addEventListener('secondsUpdated', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
    });
    timerEat.addEventListener('started', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
});
});  

   $('#fo3').submit(function () {
     timerEat.pause();
    $('#timeeat').val(timerEat.getTimeValues().toString());
    timerEat.stop();
   });

   $('.stopeat').click(function () {
    
    timerEat.stop();
   });

   $('.goalert').click(function () {
    timerAlert.start();
    //$('#timee').val(timerAlert.getTimeValues().toString());
    timerAlert.addEventListener('secondsUpdated', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlert.getTimeValues().toString());
    });
    timerAlert.addEventListener('started', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlert.getTimeValues().toString());
});
});  

   $('#fo4').submit(function () {
     timerAlert.pause();
    $('#tiempoalertamaquina').val(timerAlert.getTimeValues().toString());
    timerAlert.stop();
   });

   $('.stopalert').click(function () {
    
    timerAlert.stop();
   });
 
    </script>




     <!-- Multiple Checkboxes (inline) -->
            <!--    <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes">Opciones</label>
                <div id="opcion" class="col-md-4">
                    <label class="checkbox-inline" for="checkboxes-0">
                    <input type="hidden" name="opcion[]" value="0" />
                    <input type="checkbox" name="opcion[]" id="bano-0" value="ba&ntilde;o">
                    Ba&ntilde;o
                    </label>
                    <label class="checkbox-inline" for="checkboxes-1">
                    <input type="checkbox" name="opcion[]" id="agua-1" value="agua">
                    Agua
                    </label>
                </div>
                </div> -->
