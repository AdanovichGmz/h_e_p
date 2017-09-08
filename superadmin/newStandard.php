<?php
require('../saves/conexion.php');
function getProcess($id){
         require('../saves/conexion.php');
        $maq_query="SELECT nommaquina FROM maquina WHERE idmaquina=$id";
        
        $getmaq=mysqli_fetch_assoc($mysqli->query($maq_query));
        $maq=$getmaq['nommaquina'];
        return $maq;
      }
      function getElement($id){
         require('../saves/conexion.php');
        $elem_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$id";
        
        $getelem=mysqli_fetch_assoc($mysqli->query($elem_query));
        $elem=$getelem['nombre_elemento'];
        return $elem;
      }



 if(!empty($_POST)){ 
 	$action=$_POST['form'];
 	if ($action=='edit') {
 		$idstandard=$_POST['idstandard'];
 		$ajuste=$_POST['ajuste']*60;
 		$piezas=$_POST['piezas'];
 		
 		$upadte_query="UPDATE estandares SET ajuste_standard=$ajuste,piezas_por_hora=$piezas WHERE id_estandard=$idstandard";
 		$result=$mysqli->query($upadte_query);

 		if ($result) {
 			include("tableEstandar.php");
 			
 			
 		}
 		else{
 			printf($mysqli->error);
      echo $upadte_query;
 		}
 		
 	}
 	elseif ($action=='insert') {
 		$ajuste=$_POST['ajuste']*60;
 		$piezas=$_POST['piezas'];
 		$elemento=$_POST['elemento'];
 		$proceso=$_POST['nommaquina'];
 		$insert_query="INSERT INTO estandares(ajuste_standard,piezas_por_hora,id_elemento,id_maquina) VALUES($ajuste,$piezas,$elemento,$proceso)";
 		$result=$mysqli->query($insert_query);

 		if ($result) {
 			include("tableEstandar.php");
 			
 			
 		}
 		else{
 			printf($mysqli->error);
 		}
 	}
 	elseif ($action=='delete') {
 		$idstandard=$_POST['idstandard'];
		$delete_query="DELETE FROM estandares WHERE id_estandard=$idstandard";
 		$result=$mysqli->query($delete_query);

 		if ($result) {
 			include("tableEstandar.php");
 			
 			
 		}
 		else{
 			printf($mysqli->error);
 		}
 	}

  }

?>