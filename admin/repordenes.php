 <?php
//error_reporting(0);
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
require('../saves/conexion.php');
    ?>

<?php

      $page=(isset($_REQUEST['p'])?$_REQUEST['p'] : 0);
      $limit=400;
      if($page=='')
      {
       $page=1;
       $start=0;
      }
      else
      {
       $start=$limit*($page-1);
      }
      

    ?>
    
  <?php
     
    /* $query="SELECT * FROM login
             INNER JOIN asaichi ON login.logged_in = asaichi.logged_in
             INNER JOIN alertaMaquinaOperacion on alertaMaquinaOperacion.logged_in = login.logged_in
             INNER JOIN ordenes on ordenes.nommaquina = alertaMaquinaOperacion.nombremaquinaajuste
             INNER JOIN tiraje on tiraje.nombremaquina = ordenes.nommaquina";
    */
    //$activeFilter=(isset($_POST['activef'])) ? true : false;
    $activeFilter=(isset($_POST['activef'])?$_POST['activef'] : 'no');
    $datef=(isset($_POST['dateFilter'])?$_POST['dateFilter']: 0);
    if ($activeFilter=="ok") {
      /*
      $query3="SELECT o.numodt, t.fechadeldia_tiraje, t.tiempoTiraje, m.nommaquina, l.logged_in, t.idtiraje, t.tiempo_ajuste FROM tiraje t inner join ordenes o on o.idorden = t.id_orden inner join maquina m on t.id_maquina=m.idmaquina INNER JOIN login l on t.id_user=l.id ORDER BY a.idajuste DESC limit $start , $limit";
      */
        
        $query="SELECT * FROM repordenes WHERE fechadeldia_tiraje='".$datef."' limit $start , $limit ";
        $query2="SELECT * FROM repordenes WHERE fechadeldia_tiraje='".$datef."' ";
        $resss=$mysqli->query($query);
        $resss2=$mysqli->query($query2);
        $total=$resss2->num_rows;
        $num_page=ceil($total/$limit);
        
    }else{
       $query3="SELECT * FROM repordenes ORDER BY idtiraje DESC limit $start , $limit";
    //$query="SELECT * FROM repordenes limit $start , $limit ";
        $query2="SELECT * FROM repordenes";
        $resss=$mysqli->query($query3);
        $resss2=$mysqli->query($query2);
        $total=$resss2->num_rows;
        $num_page=ceil($total/$limit);

    }

    


    $queryFilter="SELECT fechadeldia_tiraje FROM repordenes GROUP BY fechadeldia_tiraje";
    $filter=$mysqli->query($queryFilter);
    ?>

 

  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Reporte Ordenes</title>
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


  
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.7.2.custom.css" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
  <script type="text/javascript">
   jQuery(function($){
  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '&#x3c;Ant',
    nextText: 'Sig&#x3e;',
    currentText: 'Hoy',
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'],
    dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
    dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['es']);
});    

        $(document).ready(function() {
           $("#datepicker").datepicker();
        });
   </script>





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
      table {
  border-collapse: collapse;
  text-align: center;
  margin: auto;
   background-color: #393939;
}

th, td {
  padding: 0.25rem;
 border-top: 1px solid #444444!important;

}
tbody tr:nth-child(odd) {
   background: #333333;
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

  </style>
  
</head>
<body style="">



    <header>
    <div class="menu_bar">
      <a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
    </div>
  <nav>
      <ul>
      <li class="nohover" style=""><span class="button-labels"><div class="logo-ul"><img  src="../images/white-logo.png"></div></span></li>

      <li class="nohover"><span class="labels">Bienvenido: <?=$_SESSION['logged_in']; ?></span></li>
      <li><a href="reporteindex.php">Inicio</a></li>
        
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
  
  <center>
    
    </center>
     
    
<div class="top-form">

  <div class="left-form2">
 <form  method="post" action="../pdfrepajustemaquina/creaPDF.php" target="_blank" >
   <p>Generar Reporte</p>
   <div class="mini-left"><input id="id" name="id" type="text" placeholder="Ingresa el ID" class="form-control input-md" required="">
<input hidden  name="datepicker" id="fechadeldia" value="<?php echo date("d/m/Y"); ?>" />
   </div>
   <div class="mini-right"> <button id="button1id" name="button1id" class="btn btn-primary">Generar</button></div>
 </form>
 </div>
 
  <div class="left-form2">
 <form name="filterDate" id="filterDate" method="post" action="repordenes.php" >
   <p>Filtrar por periodo</p>
   <input type="hidden" name="activef" value="ok">
   <div class="mini-left"><select id="filterSelect" name="dateFilter">
   <option disabled="true" selected="true">Elige el periodo</option>
     <?php while($rowf=mysqli_fetch_assoc($filter)){ ?>
     <option value="<?=$rowf['fechadeldia_tiraje']?>"><?php echo $rowf['fechadeldia_tiraje']; ?></option>
     <?php } ?>
   </select>
<input hidden  name="datepicker" id="fechadeldia" value="<?php echo date("d/m/Y"); ?>" />
   </div>
   <div class="mini-right"> <button type="button" id="" name="" class="btn btn-primary">RESET</button></div>
 </form>
 </div>
 <div class="left-form"><div><input type="search" class="light-table-filter" data-table="order-table" placeholder="Busqueda"></div>
    
 </div>

</div>
 
<div class="div-tabla-page">
 
<div class="conttabla2"  >

<table id="tableData" class="order-table table" >
                  <thead  class="color">
                    <tr style="background-color: #212121; ">
                  
                      <td width="2%"  class="tabla"><strong>ID</strong></td>
                      <td width="2%"  class="tabla"><strong>ODT</strong></td>
                      <td width="2%"  class="tabla"><strong>TIEMPO AJUSTE</strong></td>
                      <td width="2%"  class="tabla"><strong>TIEMPO TIRAJE</strong></td>
                      <td width="2%"  class="tabla"><strong>MAQUINA</strong></td>
                      <td width="2%"  class="tabla"><strong>USUARIO</strong></td>
                  
                      <td width="2%"  class="tabla"><strong>FECHA DEL DIA</strong></td>
                     
                      </tr>
                     
                      </thead>
                    <tbody>
                      <?php 
                          while($row=mysqli_fetch_assoc($resss)){ 
                        ?>
                      <tr>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['idtiraje'];?></p></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['numodt'];?></p></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['tiempo_ajuste'];?>      </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['tiempoTiraje'];?>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['nommaquina'];?>  </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['logged_in'];?>   </td>
                        
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['fechadeldia_tiraje'];?> </td>
                    

                        </tr>
                      <?php }
                      //$resss->free(); ?>
                    </tbody>
                  </table>

    
  

    </div>
</div>
<div class="paginator" style="color: #fff;">
  <?php
  
  function pagination($page,$num_page)
{
  echo'<ul style="list-style-type:none; margin-bottom:0; display:inline-table;">';
  for($i=1;$i<=$num_page;$i++)
  {
     if($i==$page)
{
 echo'<li style="float:left;padding:5px;"><div class="page-sel">'.$i.'</div></li>';
}
else
{
 echo'<li style="float:left;padding:5px;"><a  href="repordenes.php?p='.$i.'"><div class="page">'.$i.'</div></a></li>';
}
  }
  echo'</ul>';
}
if($num_page>1)
{
 pagination($page,$num_page);
}
?> 
</div>
</div>




<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/paging.js"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                //$('#tableData').paging({limit:20});
            });
        </script>
        <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

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

                        $(document).ready(function() {
                        $('#filterSelect').on('change', function() {
                           $('#filterDate').submit()

                           
                        });
                      });
                    </script>





 










</body>
</html>
