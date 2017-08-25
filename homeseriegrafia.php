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

<?php
	$con = mysqli_connect('localhost','root','','visitors') or Die();
?>

  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    
    <!-- bar chart -->
     <script type="text/javascript" src="https://www.google.com/jsapi"></script>  
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([


          ['', ''],
          <?php 

           $query2 = "SELECT SUM(piezasprod/pzesperadas*100) / count(*) as desempeno, nommaquina FROM visitors where nommaquina = 'corte' ";

            $exec2 = mysqli_query($con,$query2);
            while($row = mysqli_fetch_array($exec2)){

              
              echo "['".$row['desempeno']."',".$row['desempeno']."],";
              
            }
            
           
            $query = "SELECT SUM(buenos/piezasprod*100) / count(*) as calidad, nommaquina FROM visitors where nommaquina = 'corte' ";

            $exec = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($exec)){

              echo "['".$row['calidad']."',".$row['calidad']."],";


              
            }
            //SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoajuste))) as tiempo_ajuste, SEC_TO_TIME(SUM(TIME_TO_SEC(tiempotiro))) as tiempo_tiro, SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalerta))) as tiempo_alerta, SEC_TO_TIME(tiempoajuste+tiempotiro/tiempoalerta*100) as resultado FROM visitors where nommaquina = 'corte'

            //SELECT SEC_TO_TIME(SUM(tiempoajuste+tiempotiro/tiempoalerta)) as porcentaje FROM visitors where nommaquina = 'corte'

            //SELECT SUM((tiempoajuste+tiempotiro)/tiempoalerta*1) as porcentaje FROM visitors where nommaquina = 'corte'
             $query3 = "SELECT SUM((tiempoajuste+tiempotiro)/tiempoalerta*.01) / count(*) as porcentaje FROM visitors where nommaquina = 'corte'";

            $exec3 = mysqli_query($con,$query3);
            while($row = mysqli_fetch_array($exec3)){

              
              echo "['".$row['porcentaje']."',".$row['porcentaje']."],";
              
            }
     
         ?>
         
        ]);

        var options = {
            chartArea: {width: '85%', height: '90%'},
            width: 315, 
            height: 230,
           
            legend: 'none',
                                                           
            fontSize: 12,
            colors: ['#00B050'],    
                                                                               
            backgroundColor: 'transparent'
        };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
      chart.draw(data,options);
  }
  </script>

  <!-- pie -->
       <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        	['', ''],
             <?php 
               //$query3 = "SELECT SELECT SUM(piezasprod/pzesperadas*100) / count(*) * SUM(buenos/piezasprod*100) / count(*) * SUM((tiempoajuste+tiempotiro)/tiempoalerta*.01) / count(*) FROM visitors where nommaquina = 'corte' FROM visitors where nommaquina = 'corte'";
	        	$query = "SELECT SUM(buenos), SUM(defectos) FROM visitors where nommaquina = 'corte' ";

	        	$exec = mysqli_query($con,$query);
	        	while($row = mysqli_fetch_array($exec)){

	        		echo "['".$row['SUM(buenos)']."',".$row['SUM(buenos)']."],";
              echo "['".$row['SUM(defectos)']."',".$row['SUM(defectos)']."],";

	        	}
	   ?>
        ]);

        var options = {chartArea: {width: '100%',  height: '90%'},
                       width: 290, 
                       height: 200,
                       
                       legend: 'none', 
                       is3D:true,                                               
                       fontSize: 14,
                       colors: ['#00B050', '#FF2626'],
                                           
                       backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>





    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  

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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    

    <script src="js/jsGrafica.js"></script>
    <script src="js/graficabarras.js"></script>
    <script src="js/divdespegable.js"></script>
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
   
    <script src="js/test.js"></script>
    

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


<script language="javascript">
         function limpiar() {
           setTimeout('document.fo3.reset()',2000);
      return false;
}
</script>




    <style type="text/css">
		body {
         overflow-x: hidden;
        }

		#slideDer {
			position: absolute;
			height: 100%;
			background-color:red;
			right:-60%;
            z-index:50;
            width:60%;
		}
         #result {
	width:280px;
	padding:10px;
	border:1px solid #bfcddb;
	margin:auto;
	margin-top:10px;
	text-align:center;
}

	</style>
    
    

  

</head>
<body style="background-color:black;">

   


   

    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>

   <div class="contegral">
   
      
        <div class="banner">
            <div class="imgbanner"></div>
            <div class="usuario" >
                 <?php                
                 echo "Bienvenido: ". $_SESSION['logged_in'];
                 ?>

    
            </div>
            <div class="fechayhora">
               
               <?php $fecha = strftime( "%Y-%m-%d", time() );
             
               echo $fecha
               ?>
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
                    <div id="hora" ></div>
 
              </div>
            <div class="btnlogout ">
                <a href="logout.php" > <img src="images/btnout.fw.png"  href="logout.php" class="img-responsive" /></a>
             </div>
        </div>

        <div class="row1"> 
         <?php
           $valorQuePasa = $_GET['mivariable'];
           $valorQuePasa2 = $_GET['mivariable'];
           //echo $valorQuePasa;
           ?>

            <input class="maquina" id="maquina" value="<?php echo $valorQuePasa; ?>" disabled /> 
           

           
           

                
            <div class="ete">ETE</div>
        </div>
        <div class="row2">
            <div class="operador">
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="porcentaje " style="height:60px; background-color: #00B050; border: 0px;" id="actual" placeholder="" disabled />
                        </div>
                        <div class="imagen">
                            <!--<img src="images/1.png" alt="Image" width="100" height="100" />-->
                            <img src="<?php echo $_SESSION['MM_Foto_user']; ?>" alt="Image" width="100" height="100" />
                        </div>

                    </div>
                    <div class="rowprox">
                        <div class="fila1">
                            <div class="tarea1">
                                <input class="txt" style="width: 100px; background-color: #00B050; border:0; text-align:center; color:red;" placeholder="2548" disabled />
                            </div>
                            <div class="divnegro">
                                <div class="tareas">ACTUAL</div>
                            </div>

                        </div>
                        <div class="fila2">
                            <div class="tarea1">
                                <input  class="txt" style="width: 100px; background-color: #00B050; border:0;" disabled />
                            </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                                <input  class="txt"  style="width: 100px; background-color: #00B050; border:0;" disabled />
                            </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>
            <div class="graficapie">
                
                <input class="pedido center-block" id="maquina" placeholder="2548" disabled />
                <div class="grafica">
                   <!-- <div id="graficajs" class="panelabajo"></div> -->
                        <div id="piechart" style="width: 100%; height: 100%;" ></div>        
                    </div>
                </div>
            <div class="graficabarras">
              <div class="tit">  
                <div class="dis">Disponibilidad</div>
                <div class="cal">Calidad</div>
                <div class="des">Desempeño</div>
              </div>  
              <div class="num">
                  <div class="cien">100</div>
                  <div class="setenta">75</div>
                  <div class="cincuenta">50</div>
                  <div class="vente">25</div>
                  <div class="cero">0</div>
              </div>
                <!-- <div id="_GraficaInter"></div> -->
                <div id="columnchart" style="top:10px; position:absolute; fill:white;"></div>

            </div>
        </div>
        <div class="row3">
            <form name="nuevo_calidad" method="POST" action="saveOperador.php">
                <div class="filabtsylejoj">
                    <div class="btnreloj">
                        <div class="btnplay">
                           <!-- <img src="images/btnplay.fw.png" class="center-block" id="start"/> -->
                        </div>
                        <div class="btnpause">

                            <img src="images/btnpause.fw.png " class="center-block" id="pause" />
                        </div>
                        <div  class="btnalerta">
   
                            <img type="buttom" id="relo" class="derecha goalert" src="images/btnalerta.fw.png" class="img-responsive " />
                        </div>
                
                    </div>

                </div>
                <div class="reloj">
                <div id="reloj" class="clock" style="margin:2em;"></div>
                                    <script>
                                            var clock;
                                            var ftime;

                                            $(document).ready(function () {


                                                clock = $('.clock').FlipClock(0, {
                                                    language: "spanish",
                                                    clockFace: 'hourCounter',
                                                    countdown: false,
                                                    autoStart: true,
                                                    callbacks: {
                                                        start: function () {
                                                            $('.message').html('aa'); //Esta etiqueta no la tienes por eso no aparece el mensaje.
                                                        }

                                                    }

                                                });

                                                $('.start').click(function () {
                                                    clock.start();
                                                });
                                                $('#pause').click(function () {
                                                    clock.stop();
                                                });
                                                 $('#relo').click(function () {
                                                    clock.stop();
                                                });
                                                $('#relo2').click(function () {
                                                    clock.start();
                                                });
                                               
                                                


                                                $('#stop').click(function () {   //El # sirve cuando estas utilizando id y el . para cuando son class, Checa abajo
                                                    clock.stop(function () {

                                                        var time = clock.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours = Math.floor(time / 7200); // para pasar de minutos  a horas
                                                        var minutes = Math.floor(time / 60); // para pasar de segundos a minutos
                                                        var seconds = time - minutes * 60; // para sacar unicamente los minutos
                                                        ftime = hours + ":" + minutes + ":" + seconds; //el resultado se guarda en la variable ftime
                                                        valor = "" + ftime + "";
                                                        document.getElementById("tiempoTiraje").value = valor;
                                                        

                                                    });


                                                });





                                              });



                                    </script>

                </div>
   
                <div class="datos "> CALIDAD
                    <input hidden type="text" name="tiempoTiraje" id="tiempoTiraje"  />
                    <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                    <input hidden  name="horadeldia" id="horadeldia" value="<?php echo date(" H:i:s",time()-21600); ?>" />
                    <input hidden  name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />
                    <input hidden type="text" name="nombremaquina" id="nombremaquina"  class="diseños" value="<?php echo $valorQuePasa2; ?>"  /> 

                    <div class="filacalidad">
                        <div class="titulos">
                            PEDIDO
                            <input id="pedido" name="pedido" class="diseños"   />
                        </div>
                        <div class="titulos">
                            CANTIDAD
                            <input  id="cantidad" name="cantidad" class="diseños" />
                        </div>
                        <div class="titulos">
                            BUENOS
                            <input id="buenos" name="buenos" type="text"  class="diseños" required/>
                        </div>
                        <div class="titulos">
                            DEFECTOS
                            <input  id="defectos" name="defectos" type="text"  class="diseños" required/>
                        </div>
                        <div hidden class="titulos">
                            MERMA
                            <input  class="diseños"/>
                        </div>
                        <div class="titulos">
                            ENTREGADOS
                            <input id="entregados" name="entregados" type="text"  class="diseños" required/>
                        </div>
                    </div>
                 <div class="btnguardarform">
                 <input type="image" id="stop" src="images/btnguardar.fw.png" class="img-responsive test "  onclick="alert('Registro Guardado');" />
                </div>
                </div>
            </form>
            
        </div>        
                    
     

    </div>
        
   </div>

  
      
   <div id="btniz">
       <img id="izquierda1" class="iconocapas" />
   </div>
   <div id="panelizqui"></div>

   
   <div id="panelder">
      <div class="container-fluid">
          
           
             <form id="fo3"name="fo3" action="savealertaserierafia.php" method="post" class="form-horizontal" onSubmit="return limpiar()" >
                <fieldset>

                <!-- Form Name -->
                <legend>ALERTA SERIEGRAFIA</legend>

                <!-- Select Basic -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="selectbasic">ODT</label>
                <div class="col-md-4">
                    <select id="odt" name="odt" class="form-control">
                    <option hidden value="0"></option>
                    <option>Confusa</option>
                    <option >Papel</option>
                    </select>
                </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="selectbasic">NO HAY</label>
                <div class="col-md-4">
                    <select id="nohay" name="nohay" class="form-control">
                    <option  hidden value="0"></option>
                    <option >Placa</option>
                    <option >Positivo</option>
                    <option >Suaje</option>
                    <option >Tinta</option>
                    </select>
                </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="selectbasic">SE PERDIO</label>
                <div class="col-md-4">
                    <select id="seperdio" name="seperdio" class="form-control">
                    <option  hidden value="0"></option>
                    <option >Placa</option>
                    <option >Positivo</option>
                    <option >Suaje</option>
                    <option >ODT</option>
                    </select>
                </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="selectbasic">ARREGLO EN FALSO</label>
                <div class="col-md-4">
                    <select id="arrenfalso" name="arrenfalso" class="form-control">
                    <option hidden value="0"></option>
                    <option >Mal Revelado</option>
                    <option >Tamaño Placa</option>
                    </select>
                </div>
                </div>

                <!-- Multiple Checkboxes (inline) -->
                <div class="form-group">
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
                </div>

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
        
                
                    <input id="" value="Guardar" type="submit" name="enviar"  class="derecha stopalert start reset2"/>
                    <input id="" value="cancelar" type="reset"   class="derecha stopalert start reset"  />

                            
                    
                </div>
                </div>

                

                <input hidden type="text" name="tiempoalertaseriegrafia" id="tiempoalertaseriegrafia"  />
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden  name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()-25200); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input hidden  type="text" name="nombremaquinaseriegrafia" id="nombremaquinaseriegrafia"   value="<?php echo $valorQuePasa2; ?>"  /> 
                </fieldset>    
                
          </form>
           <!--<div id="result"></div> -->              
     </div>
      
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

                                                       
                                                        var time = clock.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours = Math.floor(time / 7200); // para pasar de minutos  a horas
                                                        var minutes = Math.floor(time / 60); // para pasar de segundos a minutos
                                                        var seconds = time - minutes * 60; // para sacar unicamente los minutos
                                                        ftime = hours + ":" + minutes + ":" + seconds; //el resultado se guarda en la variable ftime
                                                        valor = "" + ftime + "";
                                                        document.getElementById("tiempoalertaseriegrafia").value = valor;
                                                        

                                                    });


                                                });





                                              });



                                    </script>

       
   
      </div>
   </div>
 

  

    


</body>
</html>
