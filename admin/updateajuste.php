 <?php  
require('../saves/conexion.php');
  
error_log(print_r($_POST,true), 3, "errors.log");
 if(!empty($_POST))  
 {  
  error_log(print_r($_POST,true), 3, "elif.log");
    $idajuste=$_POST['idajuste'];
    $tiempo=$_POST['tiempo'];
    $nommaquina=$_POST['nommaquina'];
    $logged_in=$_POST['logged_in'];
    $horadeldia=$_POST['horadeldia'];
    $fechadeldia=$_POST['fechadeldia'];
      error_log($logged_in, 3, "datas.log");

        
          $query="UPDATE ajuste SET tiempo='$tiempo', idmaquina=$nommaquina, horadeldia='$horadeldia', logged_in='$logged_in', fechadeldia='$fechadeldia' WHERE idajuste=$idajuste";
          $mysqli->query($query);
     $output= include("reporteTable.php"); 
 echo $output;     
         
 }
 
 
 ?>