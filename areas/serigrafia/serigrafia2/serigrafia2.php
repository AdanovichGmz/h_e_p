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
      $query0="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 2' ";
	
	 $resultado0=$mysqli->query($query0);

     $query01="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 2' ";
	
	 $resultado01=$mysqli->query($query01);


     $query02="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 2' ";
	
	 $resultado02=$mysqli->query($query02);   



     $query1="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 2' ";
	
	 $resultado1=$mysqli->query($query1);
   

    $query2="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'serigrafia 2'";
	
	 $resultado2=$mysqli->query($query2);
  
    $query3="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'serigrafia 2' ";
	
	 $resultado3=$mysqli->query($query3);

    $resultete = '';
    $ete = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($ete);
            while ($row= mysqli_fetch_array($resultado)){
            $resultete=$resultete+$row[0];
            
            }
    



    ?>




     <?php
   require('saves/conexion.php');
  

    ?>

<?php
	$con = mysqli_connect('localhost','root','','sistema') or Die();
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


           $query3 = "select sum( ((select sum(tiempo) from ajuste  where nommaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC )+
         (select sum(tiempoTiraje) from tiraje where nombremaquina= 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) -

        ((select sum(tiempoalertamaquina) from alertageneralajuste  where maquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+
         (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / 
         
         
         
         ((select sum(tiempo) from ajuste  where nommaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+
         (select sum(tiempoTiraje) from tiraje where nombremaquina= 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC))
         
          ) *.01 / count(*) as disponibilidad";

            $exec3 = mysqli_query($con,$query3);
            while($row = mysqli_fetch_array($exec3)){

              
              echo "['".$row['disponibilidad']."',".$row[0]."],";
              
            }

            
            $query = "SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC ";
          

            $exec = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($exec)){

              echo "['".$row['calidad']."',".$row[0]."],";


              
            }

            $query2 = "SELECT SUM(entregados/cantidad*100) / count(*) as desempeno  FROM tiraje where nombremaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC";


            $exec2 = mysqli_query($con,$query2);
            while($row = mysqli_fetch_array($exec2)){

              
              echo "['".$row['desempeno']."',".$row[0]."],";
              
            }
            
           
            
     
         ?>
         
        ]);

        var options = {
            chartArea: {width: '85%', height: '90%'},
            width: 315, 
            height: 230,
          
            legend: 'none',
            enableInteractivity: false,                                               
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
               
	        	$query = "select ( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'b0:34:95:01:ec:2b' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'b0:34:95:01:ec:2b'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 )as ete union (SELECT total   from ordenes where nommaquina= 'b0:34:95:01:ec:2b')";

	        	$exec = mysqli_query($con,$query);
	        	while($row = mysqli_fetch_array($exec)){
                    

	        		echo "['".$row['ete']."',".$row['ete']."],";
                    //echo "['".$row['sum(total)']."',".$row['sum(total)']."],";

	        	}
	   ?>
        ]);

        var options = {chartArea: {width: '90%',  height: '90%'},
                       width: 290, 
                       height: 250,
                       pieSliceTextStyle: {color: 'white', fontSize: 14},
                       
                       legend: 'none', 
                       is3D:true,                                               
                      // enableInteractivity: false,
                       colors: ['#00B050', '#FF2626'],
                                           
                       backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>





    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SERIGRAFIA 2</title>
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
    
    <script src="js/clock.js"></script>

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
           setTimeout('document.fo3.reset()',20);
      return false;
       
}
</script> 







    <style type="text/css">
		body {
         overflow: hidden;
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
    
     <script type="text/javascript">
                                            
     


</script> 

  

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
                <a href="logout.php" > <img src="images/btnout.fw.png"   class="img-responsive" /></a>
             </div>
        </div>

        <div class="row1"> 
         <?php
           $valorQuePasa = $_GET['mivariable'];
           $valorQuePasa2 = $_GET['mivariable'];
           //echo $valorQuePasa;
           ?>

            <input class="maquina" id="maquina" value="<?php echo $valorQuePasa; ?>" readonly /> 
           

           
           

                
            <div class="ete">ETE</div>
        </div>
        <div class="row2">
            <div class="operador">
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $resultete ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <!--<img src="images/1.png" alt="Image" width="100" height="100" />-->
                            <img src="<?php echo $_SESSION['MM_Foto_user']; ?>" alt="Image" width="100" height="100" />
                        </div>

                    </div>
                    <div class="rowprox">                    
                         <div class="fila1">
                            <div class="tarea1">
                              <form name="fvalida" method="POST" action="index4.php"> 
                               <?php
                                        if ($row = mysqli_fetch_object ($resultado1)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($resultado2)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly style="width: 100px; background-color: #00B050; border:0; text-align:center; color:white; font-size:15pt"/>
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($resultado3)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly style="width: 100px; background-color: #00B050; border:0; text-align:center; color:white; font-size:15pt"/>
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>
            <div class="graficapie">
                
                
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
            
            <div class="filabtsylejoj">
                    <div class="btnreloj">
                        <div class="btnplay">
                           <!-- <img src="images/btnplay.fw.png" class="center-block" id="start"/> -->
                        </div>
                        <div class="btnpause">

                           <!-- <img src="images/btnpause.fw.png " class="center-block" id="pause" /> -->
                        </div>
                        <div  class="btnalerta">
   
                            <img type="buttom"  class="derecha goalert" src="images/btnalerta.fw.png" class="img-responsive " />
                        </div>
                
                    </div>

            </div>
    
            
            
          
                   <input hidden class="diseños"  type="text" name="tiempoTiraje" id="tiempoTiraje"  />
                   <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                   <input hidden  name="horadeldia" id="horadeldia" value="<?php echo date(" H:i:s",time()-28800); ?>" />
                   <input hidden  name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />
                   <input hidden type="text" name="nombremaquina" id="nombremaquina"  class="diseños" value="<?php echo $valorQuePasa2; ?>"  /> 

          
                <fieldset>

                 
                
   
                <div class="datos "> CALIDAD</br>
                 <?php
                          if ($row = mysqli_fetch_object ($resultado02)) 
                          { 
                            ?>
                                                         
                            <input hidden id="producto" name="producto" class=" diseños" value="<?=$row->producto?>"/>
                            <input hidden id="numodt" name="numodt" class=" diseños" value="<?=$row->numodt?>"/>
                      
                             <?
                          } 
                          ?>
              
                  
                    
                    <div class="filacalidad">
                        <div class="titulos">
                        CANTIDAD DE PEDIDO
                           <?php
                          if ($row = mysqli_fetch_object ($resultado0)) 
                          { 
                            ?>
                                                         
                            <input  id="pedido" name="pedido" class=" diseños" value="<?=$row->cantpedido?>" readonly />
                      
                             <?
                          } 
                          ?>
            
                         
                        </div>

                        <script language="javascript"> 
                           function opera(){ 
                           var cantidad = document.all.cantidad.value; 
                           var buenos = document.all.buenos.value;	
                           
                            resta =  (cantidad - buenos) ;
                            document.getElementById("defectos").value = resta;
                           
                           } 
                        </script> 
                        
                        <div class="titulos">
                            CANTIDAD RECIBIDA
                             <?php
                          if ($row = mysqli_fetch_object ($resultado01)) 
                          { 
                            ?>
                                                         
                            <input  id="cantidad" name="cantidad" class=" diseños" value="<?=$row->cantrecibida?>"readonly/>
                      
                             <?
                          } 
                          ?>
                            
                        </div>
                        <div class="titulos">
                            BUENOS
                            <input id="buenos" name="buenos" type="number"  class="diseños" required/>
                        </div>
                        <div class="titulos">
                            DEFECTOS
                            <input  id="defectos" name="defectos" type="number" value="0" class="diseños" readonly/>
                        </div>
                        <div  class="titulos">
                            SOBRANTE
                            <input id="merma" name="merma" type="number" class="diseños"  onclick="opera();"/>
                        </div>
                        <div class="titulos">
                            ENTREGADOS
                            <input id="entregados" name="entregados" type="number"  class="diseños" required/>
                        </div>
                    </div>
                 <div  class="btnguardarform">
               <input id="stop" type="image" name="eviar" value="Registrar" src="images/btnguardar.fw.png" class="img-responsive " onclick="valida_envia()" />
                

               
                </div>
                </div>

                </fieldset>
            </form>
            
            
            
                 
            
        </div>  
        <div class="reloj">
                <div id="reloj" class="clock" style="margin:2em;"></div>
            </div>      
               
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
                                                /* $('#relo').click(function () {
                                                    clock.stop();
                                                });
                                                /*$('#relo').click(function () {
                                                    clock.start();
                                                });*/
                                               
                                                


                                               $('#stop').click(function() {   //El # sirve cuando estas utilizando id y el . para cuando son class, Checa abajo
                                                        clock.stop(function() {  
                      
                                                        var time = clock.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours = Math.floor(time / 7200); // para pasar de minutos  a horas
                                                        var minutes = Math.floor(time / 60); // para pasar de segundos a minutos
                                                        var seconds = time - minutes * 60; // para sacar unicamente los minutos
                                                        ftime = hours + ":" + minutes + ":" + seconds; //el resultado se guarda en la variable ftime
                                                        valor = "" + ftime + "";
                                                        document.getElementById("tiempoTiraje").value = valor;
                                                       // alert (ftime);

                                                                });     
                                                    });





                                              });



                                    </script>

    
    
</div>

  
      
   <!--  
   <div id="btniz">
       <img id="izquierda1" class="iconocapas" /> 
   </div> -->
   <div id="panelizqui"></div>

   
   <div id="panelder">
      <div class="container-fluid">
          
           <div id="estilo">
            <form id="fo3"name="fo3" action="savealertamaquina.php" method="post" class="form-horizontal" onSubmit="return limpiar()" >
                <input hidden type="text" name="tiempoalertamaquina" id="tiempoalertamaquina" value="00:00:00.000000" />
                <input hidden type="text"  name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                <input hidden  name="horadeldiaam" id="horadeldiaam" value="<?php echo date(" H:i:s",time()-28800); ?>" />
                <input hidden name="fechadeldiaam" id="fechadeldiaam" value="<?php echo date("d-m-Y"); ?>" />
                <input hidden  type="text" name="nombremaquinaajuste" id="nombremaquinaajuste"   value="<?php echo $valorQuePasa2; ?>"  /> 
               
                <fieldset>

                 <!-- Form Name -->
                <legend>ALERTA MAQUINA</legend>

               

               <!-- Multiple Radios -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="radios"></label>
                <div class="col-md-6">
                <div class="radio">
                    <label for="radios-0">
                    <input type="radio" name="radios" id="radios-0" value="ODT Confusa" checked="checked">
                    ODT Confusa
                    </label>
                    </div>
                <div class="radio">
                    <label for="radios-1">
                    <input type="radio" name="radios" id="radios-1" value="ODT Faltante">
                    ODT Faltante
                    </label>
                    </div>
                <div class="radio">
                    <label for="radios-2">
                    <input type="radio" name="radios" id="radios-2" value="Fallo de Maquina">
                    Fallo de Maquina
                    </label>
                    </div>
                <div class="radio">
                    <label for="radios-3">
                    <input type="radio" name="radios" id="radios-3" value="Mal Ajuste">
                    Mal Ajuste
                    </label>
                    </div>
                <div class="radio">
                    <label for="radios-4">
                    <input type="radio" name="radios" id="radios-4" value="Basura en la Area">
                    Basura en la Area
                    </label>
                    </div>
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
        
                
                   <input  type="image" name="eviar" value="Guardar" src="images/btnguardar.fw.png" class="img-responsive derecha stopalert start reset2 " />
                <input style="position: relative;top: -85px;right: -130px;" type="image" name="eviar" value="Guardar" src="images/elminar.fw.png"   class="img-responsive derecha stopalert start reset " />

                  <!--  <input id="" value="Guardar" type="submit" name="enviar"  class="derecha stopalert start reset2"  />
                    
                    <input id="" value="cancelar" type="reset"   class="derecha stopalert start reset"  />
                    -->    
                    
                </div>
                </div>

                

               </fieldset>    
                
             </form>
             <!-- <div id="result"></div>     
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
 

  

    


</body>
</html>
