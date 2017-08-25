<?php

require_once("dompdf/dompdf_config.inc.php");
include '../saves/conexion.php';
$numodt=$_POST['id'];


 $query="SELECT * FROM repordenes WHERE numodt='$numodt' ";
   
       
        $resss=$mysqli->query($query);
        
?>
<?php ob_start();?>
<html>
<head>
<style>

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

thead{
  background: #1A1F25;
  color: #fff;
}

td, th {
    border: 1px solid #E1E0E5;
    text-align: left;
    padding: 8px;
}

tbody tr:nth-child(even) {
    background-color: #EBEBEB;
}
.inhead{
  display: inline-block;
  width: 19%;
   font-family: arial, sans-serif;
   

}
.header{
  width: 100%;
  margin: 0 auto;
  padding-bottom: 10px;
  padding-top: 10px;
  border-bottom: 1px solid #E1E0E5;
  border-top: 1px solid #E1E0E5;
}
.header img{
  width: 70%;
}
#last {
  text-align: right!important;
}
#last img{
  width: 50%;
}
</style>
</head>

<body>
<div class="header">
  <div class="inhead"><img src="../img/logoIzquierda.png"></div>
  <div class="inhead">
    <p style="font-weight: bold;">Reporte de Orden</p>
    <p>ODT: <?php echo $numodt;?></p>

  </div>
  <div class="inhead"></div>
  <div class="inhead"></div>
  <div class="inhead" id="last"></div>
</div>
<div style="height: 40px;"></div>
<table>
<thead><tr>
    <th>Maquina</th>
    <th>Tiempo Ajuste</th>
    <th>Tiempo Tiraje</th>
    <th>Usuario</th>
    <th>Fecha</th>
  </tr></thead>
  <tbody>
  <?php 
                          while($row=mysqli_fetch_assoc($resss)):  ?>
                          <tr>
    <td><?php echo $row['nommaquina'];?></td>
    <td><?php echo $row['tiempo_ajuste'];?></td>
    <td><?php echo $row['tiempoTiraje'];?></td>
    <td><?php echo $row['logged_in'];?> </td>
    <td><?php echo $row['fechadeldia_tiraje'];?></td>
  </tr>
  <?php endwhile; ?>
  
  </tbody>
</table>


</body>
</html>



<?php
$html = ob_get_clean();

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("reporte_de_orden.pdf", array('Attachment' => 0));

