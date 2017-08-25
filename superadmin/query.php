 <?php
 error_reporting(0);

require('../saves/conexion.php');
    ?>

<?php
      $page=$_REQUEST['p'];
      $limit=300;
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
    $query="SELECT * FROM repordenes limit $start , $limit ";
   $query2="SELECT * FROM repordenes ";
    $resss=$mysqli->query($query);
    $resss2=$mysqli->query($query2);
    $total=$resss2->num_rows;
    $num_page=ceil($total/$limit);
  

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

    
<div class="div-tabla-page">
 
<div class="conttabla2"  >
<table id="tableData" class="order-table table" >
                  <thead  class="color">
                    <tr style="background-color: #212121;">
                  
                      <td width="2%"  class="tabla"><strong>ID</strong></td>
                      <td width="2%"  class="tabla"><strong>ODT</strong></td>
                      <td width="2%"  class="tabla"><strong>TIEMPO AJUSTE</strong></td>
                      <td width="2%"  class="tabla"><strong>TIEMPO TIRAJE</strong></td>
                      <td width="2%"  class="tabla"><strong>MAQUINA</strong></td>
                      <td width="2%"  class="tabla"><strong>USUARIO</strong></td>
                  
                      <td width="2%"  class="tabla"><strong>FECHA DEL DIA</strong></td>
                     

                     
                      </tr>
                    <tbody>
                      <?php 
                          while($row=mysqli_fetch_assoc($resss)){ 
                        ?>
                      <tr>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['idajuste'];?></p></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla"><p> <?php echo $row['numodt'];?></p></td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['tiempo'];?>      </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['tiempoTiraje'];?>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['nommaquina'];?>  </td>
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['logged_in'];?>   </td>
                        
                        <td style="padding: 0px; top:4px; position:relative;" class="tabla">    <?php echo $row['fechadeldia'];?> </td>
                    

                        </tr>
                      <?php }
                      $resss->free(); ?>
                    </tbody>
                  </table>

    
  

    </div>
</div>
<div class="paginator" style="color: #fff;">
  <?php
  echo "Total ".$total;
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
 echo'<li style="float:left;padding:5px;"><a  href="query.php?p='.$i.'"><div class="page">'.$i.'</div></a></li>';
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
                    </script>





 










</body>
</html>
