 <?php  
require('../saves/conexion.php');
  

 if(!empty($_POST))  
 {  
    
       
       /*
       $recibido=$_POST['recibido'];
       $pedido=$_POST['pedido'];
       $inicio=$_POST['inicio'];
       $fin=$_POST['fin']; */
       $odetes=$_POST['odetes'];
        $action=$_POST['action'];
        $numodt= $_POST['numodt'];
          

      if($action=='insert'){
       $getMax="SELECT MAX(orden) as orden FROM ordenes";
      $getlastSort = mysqli_fetch_assoc($mysqli->query($getMax));
      $lastSort = $getlastSort['orden']+1;




       $query1="INSERT INTO ordenes(idorden, numodt,cantpedido,producto,cantrecibida,orden,fechaprog,fechafin,maquina) VALUES(null,'$odt',$pedido,'$producto',$recibido,$lastSort,'$inicio','$fin',1 )";
       
       

$resultado=$mysqli->query($query1);

     if ($resultado) {
      
       
        $id_ord =$mysqli->insert_id;
        
          $p=1;
          foreach ($procesos as $proceso) {
            $pro='proceso'.$p;
            $query3="INSERT INTO procesos (id_proceso,id_orden,numodt,fecha_inicio,fecha_fin,proceso,nombre_proceso,estatus,avance)VALUES(null,'$id_ord',DATE(NOW()),null,'$pro','$proceso',4,1)";
            $resultado3= $mysqli->query($query3);
            if ($resultado3) {
              
            }else{echo "<script>console.log('".printf($mysqli->error)."'')</script>";}
            $p++;
          }
         
          
          include 'semaforo.php' ;
        
     

      
     }else{
          printf($mysqli->error);
        }
    
       
}else{
  
    
   
    foreach ($odetes as $odete) {
      /*
       $query1="UPDATE ordenes SET cantpedido=$pedido,cantrecibida=$recibido,fechaprog='$inicio',fechafin='$fin' WHERE idorden=$odete ";
      $update=$mysqli->query($query1); */

      $estatuses=$_POST['estatuses'.$odete];
      $estatArr=json_decode($estatuses, true);

     $delquery1="DELETE FROM procesos WHERE id_orden=$odete";
     $cleanprocess=$mysqli->query($delquery1);
     $p=1;
     $postPro='procesos_'.$odete;
     $procesos=$_POST[$postPro];
          foreach ($procesos as $proceso) {
            $stt=(isset($estatArr[$proceso]))? $estatArr[$proceso] : 'Programado';
            $pro='proceso'.$p;
            $query3="INSERT INTO procesos (id_proceso,id_orden,numodt,fecha_inicio,fecha_fin,proceso,nombre_proceso,estatus,avance)VALUES(null,$odete,'$numodt',DATE(NOW()),null,'$pro','$proceso','$stt',1)";
            $resultado3= $mysqli->query($query3);
            if ($resultado3) {
              
            }else{echo "<script>console.log('".printf($mysqli->error)."'')</script>";}
            $p++;
          }
    }
    
      
        
        
       
          


          include 'semaforo.php' ;
        
     

  
}
      
      
       
 }
 
 
 ?>