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


       <?php
       
       $conn= mysqli_connect("localhost","root","");
       mysqli_select_db($conn, "historias_sistema");
       
       
       
       $resultados=mysqli_query($conn,"SELECT * FROM ordenes");
       
       
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



   <header>
		<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
		</div>
 
		 <nav>
      <ul>
      <li class="nohover" style="display: none;"><span class="button-labels"><div class="logo-ul"><img  src="../images/white-logo.png"></div></span></li>
      <li class="nohover"><span class="labels">Bienvenido: <?=$_SESSION['logged_in']; ?></span></li>
      <li><a href="reporteindex.php">Inicio</a></li>
        <li><a href="repordenes.php"><span class="icon-clipboard"></span>Ordenes</a></li>
        <!--<li><a href="#"><span class="icon-suitcase"></span>Trabajos</a></li>-->

        <li class="submenu">
          <a href="#"><span class="icon-cog"></span>Maquinas<span class="caret icon-arrow-down6"></span></a>
          <ul class="children">
          <li><a href="repajustemaquina.php">Ajuste <span class="icon-cogs"></span></a></li>
            <li><a href="RepAlertAjuste.php">Alerta Ajuste<span class="icon-warning"></span></a></li>
                        <li><a href="reptirajemaquina.php">Tiraje<span class="icon-hammer"></span></a></li>
                        <li><a href="repalertmaquina.php"> Alerta Maquina <span class="icon-warning"></span></a></li>
            <li><a href="repencuesta.php">Encuesta<span class="icon-question"></span></a></li>
                        
          </ul>
        </li>
                <li class="submenu" hidden>
          <a href="#"><span class="icon-droplet"></span>Serigrafía<span class="caret icon-arrow-down6"></span></a>
          <ul class="children">
            <li><a href="#">Ajuste <span class="icon-cogs"></span></a></li>
            <li><a href="#">Alerta Seriegrafía <span class="icon-warning"></span></a></li>
            <li><a href="#">Tiraje<span class="icon-hammer"></span></a></li>
                        <li><a href="#">Encuesta<span class="icon-question"></span></a></li>
          </ul>
        </li>
        <li class="lefting nohover">
         <span class="button-labels"><a class="salir" href="logoutadmin.php" ><div class="admin-button"><img src="../images/salir.png"></div></a></span>
        </li>
        <li class="lefting nohover">
          <span class="labels"><?php $fecha = strftime( "%Y-%m-%d", time() ); echo $fecha; ?></span>
        </li>
        <li class="lefting nohover">
          <span class="labels"><div id="hora" ></div></span>
        </li>
        
        <!--<li><a href="#"><span class="icon-earth"></span>Servicios</a></li>-->
        <!--<li><a href="#"><span class="icon-mail"></span>Contacto</a></li> -->
      </ul>
    </nav>
	</header>
      
</div>

 
<div class="container">

  <center>
    
    </center>
      <br />

      <div class="vthead" style="display: none;">
        <div class="col-md-9 ">
           <div class="row"> 
            <table id="vhead">
            <tr>
            <td  class="col-md-2"><font color='white'><h3>Orden</h3></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">positivo</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Placa</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Placa_HS</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">LaminaOff</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Corte</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Revelado</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Laser</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Suaje</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Serografia</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Offset</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Digital</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">LetterPres</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Encuaderna</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">HotStamping</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Grabado</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Pleca</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Acabado</h7></font></td>
            <td  class="txt__tit"><font color='yellow'><h7 class="h7">CompraPapel</h7></font></td>
            <td  class="txt__tit"><font color='yellow'><h7 class="h7">CompraAcc</h7></font></td>
            <td  class="txt__tit"><font color='green'><h7 class="h7">Entrega</h7></font></td>
            </tr>
            </table>
            
            
     

        </div>

        </div>
        <div class="col-md-3 "> <!-- estilo de columna de bootstrap  http://getbootstrap.com/css/ -->
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

        </div>
      </div>

      <div class="focos">
      <div class="fix">
      <div class="fix-inner">
            <table id="vhead">
            <tr>
            <td  class="" style="width: 100px;"><font color='white'><h3 style="line-height: 1px; text-align: center;">No.</h3><h3 style="line-height: 1px;text-align: center;">Orden</h3></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">positivo</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Placa</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Placa_HS</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">LaminaOff</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Corte</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Revelado</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Laser</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Suaje</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Serografia</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Offset</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Digital</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">LetterPres</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Encuaderna</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">HotStamping</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Grabado</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Pleca</h7></font></td>
            <td  class="txt__tit" ><font color='white'><h7 class="h7">Acabado</h7></font></td>
            <td  class="txt__tit"><font color='yellow'><h7 class="h7">CompraPapel</h7></font></td>
            <td  class="txt__tit"><font color='yellow'><h7 class="h7">CompraAcc</h7></font></td>
            <td  class="txt__tit"><font color='green'><h7 class="h7">Entrega</h7></font></td>
            </tr>
            </table>
            
            </div> 
     

        </div>
        <div id="scrolling">
         <?php
                 while ($fila = mysqli_fetch_array($resultados) )/*un ciclo para la busqueda de todos los datos*/
                 
                 {
            ?>
            <table id="" class="order-table table tv-body hoverable" style="margin-bottom: 0px!important;">
            <tr>
            <td width='100px' class=" txt_tit"> <?php echo $fila["numodt"];?> </td> <!-- estilo en ../css/adminestilos.css -->
            <td width='30px'> <img width="15" src="<?php echo $fila["positivo"];?>"/></a> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["placas"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["placas_hs"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["lamina_off"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["corte"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["revelado"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["laser"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["suaje"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["serigrafia"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["offset"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["digital"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["leter_pres"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["encuadernacion"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["hotstamping"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["grabado"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["pleca"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["acabado"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["compra_papel"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["compra_acc"];?>"/> </td>
            <td width='30px'> <img width="15" src="<?php echo $fila["entregado"];?>"/> </td>
             </tr></table>
              
              
             <?php
               }
            mysqli_close($conn);
            ?>
            </div>
      </div>
      



       
</div>

<div style="width: 100%; position: relative; height: 100px">
  <div class="derecha" id="buscar" style="float: right;"> <input type="search" class="light-table-filter" data-table="order-table" placeholder="Busqueda"></div>
</div>
<div style="width: 100%; height: 150px; position: relative;">
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

        </div>
      
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






</body>
</html>
