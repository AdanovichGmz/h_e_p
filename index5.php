<?php

require('saves/conexion.php');


$nombremaquina=$_POST['nombremaquina'];
$logged_in=$_POST['logged_in'];
$horadeldia=$_POST['horadeldia'];
$fechadeldia=$_POST['fechadeldia'];
$desempeno=$_POST['desempeno'];
$problema= (isset($_POST['problema'])) ?$_POST['problema'] : '';
$calidad=$_POST['calidad'];
$problema2=(isset($_POST['problema2'])) ?$_POST['problema2'] : '';

$observaciones=$_POST['observaciones'];


$query2="SELECT id FROM login WHERE logged_in='$logged_in'";
$query4="SELECT idmaquina FROM maquina WHERE mac='$nombremaquina'";
$getID = mysqli_fetch_assoc($mysqli->query($query2));
$userID = $getID['id'];
$getMachine = mysqli_fetch_assoc($mysqli->query($query4));
$machineID = $getMachine['idmaquina'];

$query="INSERT INTO encuesta (id_usuario, id_maquina, horadeldia, fechadeldia, desempeno, problema, calidad, problema2, observaciones) VALUES ('$userID','$machineID','$horadeldia','$fechadeldia','$desempeno','$problema','$calidad','$problema2','$observaciones')";


$resultado=$mysqli->query($query);

//echo $query;

//$_GET['mivariable'] = $nombremaquina;
//header('Location: areas/maquinas/corte/ajustecorte.php');
//include("areas/maquinas/corte/ajustecorte.php");
if ( $resultado) {




switch ($_GET['mivariable']= $nombremaquina){
	case 'corte':
  	include("areas/maquinas/corte/ajustecorte.php");
	//header('Location: home.php');
    //echo $nommaquina;
		break;
  case '5c:f5:da:2f:33:5e':
  		$query5="SELECT * FROM maquina WHERE mac='90:b9:31:ed:0f:6b'";
  		$getMachineNew = mysqli_fetch_assoc($mysqli->query($query5));
		$machineIDNew = $getMachineNew['idmaquina'];
		$machineNameNew = $getMachineNew['nommaquina'];
  		$mac=$getMachineNew['mac'];
		//include("areas/maquinas/suaje/ajustesuaje.php");
    //echo $nommaquina;
		break;
  case '90:b9:31:ed:0f:6b':
  	$query5="SELECT * FROM maquina WHERE mac='2c:f0:ee:3d:53:99'";
  		$getMachineNew = mysqli_fetch_assoc($mysqli->query($query5));
		$machineIDNew = $getMachineNew['idmaquina'];
		$machineNameNew = $getMachineNew['nommaquina'];
  		$mac=$getMachineNew['mac'];
		//include("areas/maquinas/suajegrande/ajustesuajegrande.php");
    //echo $nommaquina;
		break;
  case '2c:f0:ee:3d:53:99':
  	$query5="SELECT * FROM maquina WHERE mac='f0:db:f8:11:97:bc'";
  		$getMachineNew = mysqli_fetch_assoc($mysqli->query($query5));
		$machineIDNew = $getMachineNew['idmaquina'];
		$machineNameNew = $getMachineNew['nommaquina'];
  		$mac=$getMachineNew['mac'];
		//include("areas/maquinas/timbradora/ajustetimbradora.php");
    //echo $nommaquina;
		break;
  case 'f0:db:f8:11:97:bc':
  	$query5="SELECT * FROM maquina WHERE mac='f0:db:f8:11:97:bc'";
  		$getMachineNew = mysqli_fetch_assoc($mysqli->query($query5));
		$machineIDNew = $getMachineNew['idmaquina'];
		$machineNameNew = $getMachineNew['nommaquina'];
  		$mac=$getMachineNew['mac'];
		//include("areas/maquinas/hotstamping/ajustehotstamping.php");
    //echo $nommaquina;
		break;
  case 'Hot Stamping 2':
		include("areas/maquinas/hotstamping2/ajustehotstamping2.php");
    //echo $nommaquina;
		break;
  case 'b0:34:95:01:ec:2b':
		include("areas/maquinas/laminadora/ajustelaminadora.php");
    //echo $nommaquina;
		break;
	case 'Offset':
			include("areas/maquinas/offset/ajusteoffset.php");
     //echo $nommaquina;
		break;
  case 'Placa':
			include("areas/maquinas/placa/ajusteplaca.php");
     //echo $nommaquina;
		break;
    ////// cambio de area
  case '34:e2:fd:dd:d0:7b':
			include("areas/serigrafia/serigrafia1/ajusteserigrafia1.php");
     //echo $nommaquina;
		break;
  case 'Serigrafia 2':
			include("areas/serigrafia/serigrafia2/ajusteserigrafia2.php");
     //echo $nommaquina;
		break;
  case 'Serigrafia 3':
				include("areas/serigrafia/serigrafia3/ajusteserigrafia3.php");
     //echo $nommaquina;
		break;
  case 'Mesa 1':
				include("areas/serigrafia/mesa1/ajustemesa1.php");
     //echo $nommaquina;
		break;
  case 'Mesa 2':
			include("areas/serigrafia/mesa2/ajustemesa2.php");
     //echo $nommaquina;
		break;
}
if( !session_id() )
{
    session_start();
    

}
if(@$_SESSION['logged_in'] != true){
    echo '
    <script>
        alert("tu no estas autorizado para entrar a esta pagina");
        self.location.replace("index.php");
    </script>';
}else{
//echo $_SERVER['HTTP_HOST'];
header("Location: http://{$_SERVER['SERVER_NAME']}/unify/index2.php");
}
 }else{
            printf("Errormessage: %s\n", $mysqli->error);
          }
?>