 <?php
    if( !session_id() )
    {
        session_start();
     
        
    }
    if(@$_SESSION['logged_in'] != true){
        echo '
    <script>
        alert("tu no estas autorizado para entrar a esta pagina");
        self.location.replace("index.php");
    </script>';
    }else{
        echo '';
    }
    ?>

    <?php
     require('saves/conexion.php');
    
  
     ?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AJUSTE OFFSET</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
    
    <!-- LOADER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="css/style.css" rel="stylesheet" />



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
    $('#form, #fat, #fo3').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#result').html(data);
            }
        })        
        return false;
    }); 
})
// ]]></script>

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
                $('#resultaado').html(data);
            }
        })        
        return false;
    }); 
})
</script>

<script language="javascript">
         function limpiar() {
           setTimeout('document.fo3.reset()',2);
      return false;
}
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
<body onload="setTimeout('alerttime()',1000);">
<div id="formulario"></div>
    <style type="text/css">
        body {
            background-image: url('images/fondogancho.fw.png');
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
   
            position: absolute;
            z-index:-1;
        }


         .congral2{
            width: 100%;
            height: 100%;

        }
 .cont2{
           
           width: 60%;
    height: 70%;
    position: absolute;
    top: 50px;
    left: 20%;
            
        }

        #result {
	width:280px;
	padding:10px;
	border:1px solid #bfcddb;
	margin:auto;
	margin-top:10px;
	text-align:center;
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

                <form name="nuevo_registro" method="POST" action="index3.php">
                 <input hidden type="text"  name="tiempo" id="tiempo" />
                 <input hidden type="text" name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                
                 <input hidden type="text" name="horadeldia" id="horadeldia" value="<?php echo date("H:i:s",time()-21600); ?>" />
                 <input hidden type="text" name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />
                       
                    <div class="modal-content" style="background-color:lightgray;">
                        <div class="modal-header">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                            <div class="text-center" style="font-size:18pt;">AJUSTE</div>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                               <div class="col-lg-2  col-sm-2 col-sm-offset-1 ">
                                  <a href="logout.php" > <img src="images/btnoutoper.fw.png"  href="logout.php" class="img-responsive" onClick="return confirm('estas segur@ de cerrar SESION?')" /></a>
            
                                </div> 
                                <div class="col-lg-2  col-sm-2 ">
                                    
                                  <img  type="image" name="comer" src="images/btneat.fw.png" class="stop img-responsive eatpanel goeat" />
                                   
                                </div> 
                                <div class="col-lg-2 col-sm-2 ">
                                    <input id="stop" type="image" name="eviar" value="Registrar" src="images/btnguardar.fw.png" class="img-responsive "  />
                                </div>
                                <div class="col-lg-2 col-sm-2 ">
                                    <img type="buttom" class="derecha goalert img-responsive" src="images/btnalerta.fw.png"   />
                      
                                </div>

                                <div class="col-lg-2 col-sm-2 ">
                                    <img type="buttom" class="abajo img-responsive" src="images/tarea.fw.png"   />
                      
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-sm-2"></div>
                                <div class="col-lg-7 col-sm-7 ">
                                    <div id="reloj" class="clock" style="margin:2em;"></div>
                                    <script>
                                            var clock;
                                            var ftime;

                                            $(document).ready(function () {


                                                clock = $('.clock').FlipClock(0, {
                                                    language: "spanish",
                                                    clockFace: 'MinuteCounter',
                                                    countdown: false,
                                                    autoStart: true,
                                                    callbacks: {
                                                        start: function () {
                                                            $('.message').html('aa'); //Esta etiqueta no la tienes por eso no aparece el mensaje.
                                                        }

                                                    }

                                                });
                                                 /*$('#relo').click(function () {
                                                    clock.stop();
                                                });*/
                                                 $('.start').click(function () {
                                                    clock.start();
                                                });

                                                $('#start').click(function () {
                                                    clock.start();
                                                });

                                                 $('.stop').click(function () {
                                                    clock.start();
                                                });

                                                $('#stop').click(function() {   //El # sirve cuando estas utilizando id y el . para cuando son class, Checa abajo
                                                        clock.stop(function() {  
                      
                                                        var time = clock.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours = Math.floor(time / 7200); // para pasar de minutos  a horas
                                                        var minutes = Math.floor(time / 60); // para pasar de segundos a minutos
                                                        var seconds = time - minutes * 60; // para sacar unicamente los minutos
                                                        ftime = hours + ":" + minutes + ":" + seconds; //el resultado se guarda en la variable ftime
                                                        valor = "" + ftime + "";
                                                        document.getElementById("tiempo").value = valor;
                                                       // alert (ftime); 

                                                    });


                                                });





                                              });



                                    </script>


                                </div>

                            </div>

                        </div>

                        
                          <?php
                          $valorQuePasa3 = $_GET['mivariable'];
                           $valorQuePasa4 = $_GET['mivariable'];
                            $valorQuePasa5 = $_GET['mivariable'];

                                                     
                          
                          //echo $valorQuePasa;
                          ?>                

                         <input hidden name="nommaquina" id="nommaquina" value="<?php echo $valorQuePasa3; ?>"  />



                        <div class="modal-footer">
                            <div class="row ">
                                <div class="col-lg-5 col-lg-4 col-sm-5  ">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

     <div id="panelbottom">
       <div id="panelbottom2"></div>
       <div class="row ">
                <legend>TAREAS</legend>
                  <div class="col-md-6">                     

                    <form id="tareas" action="opp.php" method="post" name="tareas">
                     <select id="datos" name="datos" class="tit-sel"  >
                     <?php
                      $query = $mysqli -> query ("SELECT * FROM ordenes where nommaquina = 'offset' order by orden asc");
                      while ($valores = mysqli_fetch_array($query)) {
                      echo '<option value="'.$valores[orden].'">'.$valores[numodt].'</option>';
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
                    </form>
                   <div id="resultaado"></div> 

               </div>  

   </div>

    

    

    
       <div id="panelder">
       <div id="panelder2"></div>
      <div class="container-fluid">
          
          <div id="estilo">
             <form id="fo3"name="fo3" action="saveAjsute.php" method="post" class="form-horizontal" onSubmit="return limpiar()" >
                <fieldset>
                <input hidden type="text" name="tiempoalertamaquina" id="tiempoalertamaquina" value="00:00:00.000000" />
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden  name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()-28800); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input  hidden name="maquina" id="maquina" value="<?php echo $valorQuePasa4; ?>"  />

                

                 <!-- Form Name -->
                <legend>ALERTA AJUSTE</legend>
                  
               

               <!-- Multiple Radios -->
                
                   <div class="form-group">
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
                    <input type="radio" name="radios" id="radios-2" value="Falta Lampara">
                    Falta Lampara
                    </label>
                    </div>
                <div class="radio" style="left:20px; position:absolute; top:75px;">
                    <label for="radios-3">
                    <input type="radio" name="radios" id="radios-3" value="Falta Tinta">
                    Falta Tinta
                    </label>
                    </div>
                <div class="radio"style="left:20px; position:absolute; top:100px;">
                    <label for="radios-4">
                    <input type="radio" name="radios" id="radios-4" value="Material Incompleto">
                    Material Incompleto
                    </label>
                    </div>
                 <div class="radio"style="left:20px; position:absolute; top:125px;">
                    <label for="radios-4">
                    <input type="radio" name="radios" id="radios-5" value="Ajuste de Maquina">
                    Ajuste de Maquina
                    </label>
                    </div> 
                  <div class="radio"style="left:20px; position:absolute; top:150px;">
                    <label for="radios-4">
                    <input type="radio" name="radios" id="radios-6" value="Laminas en Mal Estado">
                    Laminas en Mal Estado
                    </label>
                    </div>       
                </div>
                </div>

                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                
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
 <!-- Textarea -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="textarea">Observaciones</label>
                <div class="col-md-4">                     
                    <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="guardar"></label>
                <div class="col-md-8">
        
                <input  type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive derecha stopalert start reset2 " />
                <input style="position: relative;top: -85px;right: -130px;" type="image" name="eviar" value="Guardar" src="images/elminar.fw.png"   class="img-responsive derecha stopalert start reset " />

                  <!--  <input id="" value="Guardar" type="submit" name="enviar"  class="derecha stopalert start reset2"  />
                    
                    <input id="" value="cancelar" type="reset"   class="derecha stopalert start reset"  />
                    -->
                            
                    
                </div>
                </div>

                

               </fieldset>    
                
             </form>
         <!--  <div id="result"></div>     
             --> 
           
     
      
    <div  id="relojajuste" class="relojajuste" style="margin:2em;"></div>
                                    <script>
                                          var relojajuste;
                                            var ftimeajuste;

                                            $(document).ready(function () {


                                                relojajuste = $('.relojajuste').FlipClock(0, {
                                                    language: "spanish",
                                                    clockFace: 'hourCounter',
                                                    countdown: false,
                                                    autoStart: false,
                                                    callbacks: {
                                                        start: function () {
                                                            $('.message').html('aa');
                                                        }

                                                    }

                                                });

                                                $('.goalert').click(function () {
                                                    relojajuste.start();

                                                    
                                                });
                                                

                                                 /* $('.onrest').click(function () {
                                                    relojajuste.onReset();
                                                });*/

                                                

                                                $('.reset').click(function () {
                                                    relojajuste.reset();
                                                });

                                                $('.stopalert').click(function () {   
                                                    relojajuste.stop(function () {

                                                        var time2 = relojajuste.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours2 = Math.floor(time2 / 7200); // para pasar de minutos  a horas
                                                        var minutes2 = Math.floor(time2 / 60); // para pasar de segundos a minutos
                                                        var seconds2 = time2 - minutes2 * 60; // para sacar unicamente los minutos
                                                        ftimeajuste = hours2 + ":" + minutes2 + ":" + seconds2; //el resultado se guarda en la variable ftime
                                                        valor2 = "" + ftimeajuste + "";
                                                        document.getElementById("tiempoalertamaquina").value = valor2;
                                                        
                                                       

                                                    });


                                                });





                                              });  



                                    </script>

       
   
      </div>
   </div>




    <div id="panelbrake">
      <div id="panelbrake2"></div>
      <div class="container-fluid">
          
          <div id="estilo">
             <form id="fo3"name="fo3" action="saveeat.php" method="post" class="form-horizontal" onSubmit="return limpiar()" >
                <fieldset style="position: relative;left: -15px;">
                <input hidden type="text" name="breaktime" id="breaktime"  />
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()-28800); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input hidden name="maquina" id="maquina" value="<?php echo $valorQuePasa5; ?>"  />

                
                  <!-- Form Name -->
                 <legend>Comida</legend>
                
                  
               
                   <!-- Multiple Radios (inline) -->
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
                   </div>
                   </br>
                   </br>
                   </br>
                                                           
               

               

                <!-- Button (Double) -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="guardar"></label>
                <div class="col-md-8">
        
                <input  type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive eatpanel stopeat start reseteat2 " />
                <input style="position: relative;top: -85px;right: -130px;" type="image" name="eviar" value="Guardar" src="images/elminar.fw.png"   class="img-responsive eatpanel stopeat start reseteat2 " />

                  <!--  <input id="" value="Guardar" type="submit" name="enviar"  class="derecha stopalert start reset2"  />
                    
                    <input id="" value="cancelar" type="reset"   class="derecha stopalert start reset"  />
                    -->
                            
                    
                </div>
                </div>

                

               </fieldset>    
                
             </form>
       <!--  <div id="result"></div>     
           -->  
           
     
      
    <div  id="breaktime" class="breaktime" style="margin:2em;"></div>
                                    <script>
                                            var breaktime;
                                            var ftimebreak;

                                            $(document).ready(function () {


                                                breaktime = $('.breaktime').FlipClock(0, {
                                                    language: "spanish",
                                                    clockFace: 'hourCounter',
                                                    countdown: false,
                                                    autoStart: false,
                                                    callbacks: {
                                                        start: function () {
                                                            $('.message').html('aa');
                                                        }

                                                    }

                                                });

                                                $('.goeat').click(function () {
                                                    breaktime.start();

                                                    
                                                });
                                                

                                                 /* $('.onrest').click(function () {
                                                    relojajuste.onReset();
                                                });*/

                                                

                                                $('.reseteat').click(function () {
                                                    breaktime.reset();
                                                });

                                                $('.stopeat').click(function () {   
                                                    breaktime.stop(function () {

                                                        var timebreak = breaktime.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours3 = Math.floor(timebreak / 7200); // para pasar de minutos  a horas
                                                        var minutes3 = Math.floor(timebreak / 60); // para pasar de segundos a minutos
                                                        var seconds3 = timebreak - minutes3 * 60; // para sacar unicamente los minutos
                                                        ftimebreak = hours3 + ":" + minutes3 + ":" + seconds3; //el resultado se guarda en la variable ftime
                                                        valor3 = "" + ftimebreak + "";
                                                        document.getElementById("breaktime").value = valor3;
                                                        
                                                       

                                                    });


                                                });





                                              });  



                                    </script>

       
   
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

</script>
