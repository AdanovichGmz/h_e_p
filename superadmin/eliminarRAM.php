<?php 
	
	require('../saves/conexion.php');
	
	$idajuste=$_GET['idajuste'];
	
	$consu="DELETE FROM ajuste WHERE idajuste='$idajuste'";
	
	$ret=$mysqli->query($consu);
	
?>
	<center>
			<p>
			  <?php 
				if($ret>0){
				?>
		  </p>
			
		  <h1>Registro Eliminado</h1>
				
				<?php 	}else{ ?>
				
				<h1>Error al Eliminar </h1>
				
			<?php	} ?>
		</center>	
			
			
 <script type="text/javascript">

  function redirection(){  

  window.location ="repajustemaquina.php";

  }  setTimeout ("redirection()", 10000); //tiempo en milisegundos

  </script>
			
