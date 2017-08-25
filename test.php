 


<?php
       require('saves/conexion.php');
     $query="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'corte' ";
	
	 $resultado=$mysqli->query($query);
     

    $query2="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'corte'";
	
	 $resultado2=$mysqli->query($query2);
  
    $query3="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'corte' ";
	
	 $resultado3=$mysqli->query($query3);







    ?>

<input type="text"  value="<?php echo $query ?>"  />

<?php


?>




<?php






$con = mysql_connect("localhost", "root", ""); 
mysql_select_db("sistema",$con); 
$consulta = "SELECT * FROM ordenes  ";	 
$query = mysql_query($consulta, $con); 

if($row = mysql_fetch_array($query)){ 
?> 


<? 
} 
?>
<!--
<input type="text" name="direccionp" value="<?=$row['status']?>">
<input type="text" name="direccionp" value="<?=$row['numodt']?>">
-->



<br>
<br>

<br>


<form id="formulario" name="fo3" action="savetest.php" method="post"  >
             

<?php
if ($row = mysqli_fetch_object ($resultado)) 
{ 
  ?>
 <!-- <tr>
   <td><?=$row->status?></td>
  <td><?=$row->numodt?></td>
 
  </tr> -->

  <input type="text"  value="<?=$row->status?>" disabled />
  <input type="text"  value="<?=$row->numodt?>" disabled />
    <input type="text"  value="<?=$row->cantidad?>" disabled />
 
  <?
} 
?>
<br>
<br>




<?php
if ($row = mysqli_fetch_object ($resultado2)) 
{ 
  ?>
 
  <input type="text"  value="<?=$row->status?>" disabled />
  <input type="text" value="<?=$row->numodt?>" disabled />
  <input type="text"  value="<?=$row->cantidad?>" disabled />
 
 
 
  <?
} 
?>

<br>
<br>
<?php
if ($row = mysqli_fetch_object ($resultado3)) 
{ 
  ?>
   <input type="text" value="<?=$row->status?>" disabled />
  <input type="text" value="<?=$row->numodt?>" disabled />
      <input type="text"  value="<?=$row->cantidad?>" disabled />
  
  <?
} 
?>
<br>
<br>
<input id="formulario" type="submit" />


</form>

<!--  -->



<br>
<br>





<br>

<?php /*
$resultado = mysql_query("SELECT * FROM ordenes ");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
$fila = mysql_fetch_row($resultado);

echo $fila[1]; 
echo $fila[13]; 
?>

<br>
<br>


<?php
$resultado = mysql_query("SELECT * FROM ordenes ");

while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    printf(" %s   %s", $fila[13], $fila[1]);  
}

mysql_free_result($resultado);
?>


<br>




<select id="nommaquina" class="form-control">
    <option value="0">Selección:</option>
    <?php
    $query = $mysqli -> query ("SELECT * FROM ordenes");
    while ($valores = mysqli_fetch_array($query)) {
        echo '<option value="'.$valores[idordenes].'">'.$valores[numodt].'</option>';
    }
    ?>
</select> */