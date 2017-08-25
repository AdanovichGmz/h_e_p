 <?php  
require('../saves/conexion.php');
  

 if(!empty($_POST))  
 {  
 
    $whatForm=$_POST['form'];
    
     

if ($whatForm=='alerta-ajuste') {
  

  $idajuste=$_POST['idajuste'];
    
    $query="DELETE FROM alertageneralajuste  WHERE idalertamaquina=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("tableAlert.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}
elseif ($whatForm=='ajuste') {
  
    $idajuste=$_POST['idajuste'];
    
    $query="DELETE FROM tiraje WHERE idtiraje=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("reporteTable.php"); 
    echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
      
}
elseif ($whatForm=='tiraje') {
    $idtiraje=$_POST['idajuste'];
    
    $query="DELETE FROM tiraje WHERE idtiraje=$idtiraje";
         
          if ( $mysqli->query($query)) {
            $output= include("tableTiraje.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}
elseif ($whatForm=='alerta-maquina') {
 
  $idajuste=$_POST['idajuste'];
   
    $query="DELETE FROM alertamaquinaoperacion WHERE idalertamaquina=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("tableAlertmaq.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}
elseif ($whatForm=='encuesta') {

    $idajuste=$_POST['idajuste'];
    
    $query="DELETE FROM encuesta WHERE idencuesta=$idajuste";
         
          if ( $mysqli->query($query)) {
            $output= include("tableEncuesta.php"); 
            echo $output;
          }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
}        
             
         
 }
 
 
 ?>