 <?php  
require('../saves/conexion.php');
  

 if(!empty($_POST))  
 {  
 
    $whatForm=$_POST['form'];
    
     

if ($whatForm=='alerta-ajuste') {
  

  $idajuste=$_POST['idalert'];
    $tiempo=$_POST['tiempo'];
    $observ=$_POST['observ'];
    $problem=$_POST['problem'];
    $nommaquina=$_POST['nommaquina'];
    $logged_in=$_POST['logged_in'];
    $horadeldia=$_POST['horadeldia'];
    $fechadeldia=$_POST['fechadeldia'];
    $query="UPDATE alertageneralajuste SET tiempoalertamaquina='$tiempo', id_maquina=$nommaquina, observaciones='$observ', radios='$problem', id_usuario='$logged_in', horadeldiaam='$horadeldia',  fechadeldiaam='$fechadeldia' WHERE idalertamaquina=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("tableAlert.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}
elseif ($whatForm=='ajuste') {
  
    $idajuste=$_POST['idajuste'];
    $tiempo=$_POST['tiempo'];
    $nommaquina=$_POST['nommaquina'];
    $logged_in=$_POST['logged_in'];
    $horadeldia=$_POST['horadeldia'];
    $fechadeldia=$_POST['fechadeldia'];
    $query="UPDATE tiraje SET tiempo_ajuste='$tiempo', id_maquina=$nommaquina, id_user='$logged_in', horadeldia_ajuste='$horadeldia',  fechadeldia_ajuste='$fechadeldia' WHERE idtiraje=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("reporteTable.php"); 
    echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
      
}
elseif ($whatForm=='tiraje') {
    $idtiraje=$_POST['idtiraje'];
    $tiempo=$_POST['tiempo'];
    $product=$_POST['product'];
    $pedido=$_POST['pedido'];
    $nommaquina=$_POST['nommaquina'];
    $logged_in=$_POST['logged_in'];
    $horadeldia=$_POST['horadeldia'];
    $fechadeldia=$_POST['fechadeldia'];
    $cantidad=$_POST['cantidad'];
    $buenos=$_POST['buenos'];
    $defectos=$_POST['defectos'];
    $entregados=$_POST['entregados'];
    $query="UPDATE tiraje SET tiempoTiraje='$tiempo', id_maquina=$nommaquina, producto='$product', pedido='$pedido', id_user='$logged_in', cantidad='$cantidad', buenos='$buenos', defectos='$defectos',entregados='$entregados', horadeldia_tiraje='$horadeldia',  fechadeldia_tiraje='$fechadeldia' WHERE idtiraje=$idtiraje";
         
          if ( $mysqli->query($query)) {
            $output= include("tableTiraje.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}
elseif ($whatForm=='alerta-maquina') {
 
  $idajuste=$_POST['idalert'];
    $tiempo=$_POST['tiempo'];
    $observ=$_POST['observ'];
    $problem=$_POST['problem'];
    $nommaquina=$_POST['nommaquina'];
    $logged_in=$_POST['logged_in'];
    $horadeldia=$_POST['horadeldia'];
    $fechadeldia=$_POST['fechadeldia'];
    $query="UPDATE alertamaquinaoperacion SET tiempoalertamaquina='$tiempo', id_maquina=$nommaquina, observaciones='$observ', radios='$problem', id_usuario='$logged_in', horadeldiaam='$horadeldia',  fechadeldiaam='$fechadeldia' WHERE idalertamaquina=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("tableAlertmaq.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}
elseif ($whatForm=='encuesta') {

    $idajuste=$_POST['idencuesta'];
    $nommaquina=$_POST['nommaquina'];
    $hora=$_POST['hora'];
    $fecha=$_POST['fecha'];
    $desemp=$_POST['desemp'];
    $logged_in=$_POST['logged_in'];
    $problema=$_POST['problema'];
    $calidad=$_POST['calidad'];
    $problema2=$_POST['problema2'];
     $observ=$_POST['observ'];
    $query="UPDATE encuesta SET problema='$problema', problema2='$problema2', id_maquina=$nommaquina, observaciones='$observ', desempeno='$desemp', id_usuario='$logged_in', horadeldia='$hora',  fechadeldia='$fecha' WHERE idencuesta=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("tableEncuesta.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}        
             
         
 }
 
 
 ?>