<?php 
	
	require('../saves/conexion.php');
	
	$idajuste=$_POST['idajuste'];
	$tiempo=$_POST['tiempo'];
	$nommaquina=$_POST['nommaquina'];
	$logged_in=$_POST['logged_in'];
	$horadeldia=$_POST['horadeldia'];
	$fechadeldia=$_POST['fechadeldia'];
	
	
	$query="UPDATE ajuste SET tiempo='$tiempo',  horadeldia='$horadeldia', fechadeldia='$fechadeldia' WHERE idajuste='$idajuste'";
	
	$resultado=$mysqli->query($query);
    echo $resultado;
	
?>

	        <?php 
				if($resultado>0){
				?>
    </p>
	<center>
	<h1>Registro Modificad0</h1>
				
					<?php 	}else{ ?>
				
		  <h1>Error al Modificar el Registrp</h1>
				
			<?php	} ?>
			
		
			
			
             
            <script type="text/javascript">

  function redirection(){  

  window.location ="repajustemaquina.php";

  }  setTimeout ("redirection()", 0); //tiempo en milisegundos

  </script>
			
	