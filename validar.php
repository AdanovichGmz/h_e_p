
<?php


ini_set("session.gc_maxlifetime","7200");  
session_start();
require("saves/conexion.php");
date_default_timezone_set("America/Mexico_City");
$username=$_POST['usuario'];
$pass=$_POST['pass'];
//$nmac=$_POST['maquina'];


$sql2=mysqli_query($mysqli,"SELECT * FROM login WHERE usuario='$username'");
if($f2=mysqli_fetch_assoc($sql2)){
    if($pass==$f2['pasadmin']){
        $_SESSION['id']=$f2['id'];
        $_SESSION['logged_in']=$f2['id'];
        $_SESSION['rol']=$f2['rol'];

       
        echo "<script>location.href='admin/reporteindex.php'</script>";

    }
}

$sql3=mysqli_query($mysqli,"SELECT * FROM login WHERE usuario='$username'");
if($f3=mysqli_fetch_assoc($sql3)){
    if($pass==$f3['sudopass']){
        $_SESSION['id']=$f3['id'];
        $_SESSION['logged_in']=$f3['logged_in'];
        $_SESSION['rol']=$f3['rol'];

        
        echo "<script>location.href='superadmin/reporteindex.php'</script>";

    }
}


$sql=mysqli_query($mysqli,"SELECT * FROM login WHERE usuario='$username'");
if($f=mysqli_fetch_assoc($sql)){
    if($pass==$f['password']){
        $_SESSION['id']=$f['id'];
        $_SESSION['logged_in']=$f['logged_in'];
        $_SESSION['rol']=$f['rol'];
        $_SESSION['MM_Foto_user'] = $f['foto'];
       
        //$_SESSION['nommaquina'] = $nmac;
            
        $ip=getenv("REMOTE_ADDR"); 
        $cmd = "arp  $ip | grep $ip | awk '{ print $3 }'"; 
        $recoverSession=(!empty($_POST))? 'false' : 'true' ;
        //$mac=system($cmd);
       // $mac='5c:f5:da:2f:33:5e';
        $mac=$f['area'];
        $machine = mysqli_fetch_assoc($mysqli->query("SELECT * FROM maquina WHERE idmaquina='$mac'"));
        
        $_SESSION['machineID']=$f['area'];
        $_SESSION['machineName']=$machine['nommaquina'];
        if ($machine['nommaquina']=='Serigrafia1'||$machine['nommaquina']=='Serigrafia2'||$machine['nommaquina']=='Serigrafia3') {
            $pseudomachine = mysqli_fetch_assoc($mysqli->query("SELECT * FROM maquina WHERE idmaquina=10"));
            $_SESSION['pseudoID']=$pseudomachine['idmaquina'];
            $_SESSION['pseudoName']=$pseudomachine['nommaquina'];
        }
     $mac_id=$machine['idmaquina'];   
    
 $today=date("d-m-Y");
$check=$mysqli->query("SELECT * FROM operacion_estatus WHERE fecha='$today' AND maquina=$mac_id");
$datas=mysqli_fetch_assoc($check);
//echo '<script>alert("'.$datas['actividad_actual'].'")</script> ';
if ($check->num_rows>0) {
   if ($datas['actividad_actual']=='ajuste'){

    header("Location: index2.php");
}

elseif ($datas['actividad_actual']=='tiro'){
    $machineName=$_SESSION['machineName'];
    $isVirtual=mysqli_fetch_assoc( $mysqli->query("SELECT elemento_virtual FROM personal_process WHERE status='actual' AND proceso_actual='$machineName' "));
    if ($isVirtual['elemento_virtual']!=null) {
       header("Location: index3_5.php");
    }else{
        header("Location: index3.php");
    }
    }
    else{
       
header("Location: index2.php"); 
       
    } 
}
else{
    if(date("w")==1||date("w")==3||date("w")==5){
        $hora_actual=date(" H:i:s", time());
        if ( strtotime($hora_actual)>=strtotime('10:24:00')) {
             $logged_in=$_SESSION['id'];
        $op_query=$mysqli->query("INSERT INTO operacion_estatus(operador,maquina,actividad_actual,en_tiempo,asaichi_cumplido,fecha) VALUES($logged_in,$mac_id,2,1,1,'$today')");
        if ($op_query) {
        header("Location: index2.php");
    }else{
        printf($mysqli->error);
    }
        }else{
            header("Location: asaichii.php");
        }
        
    }else{
         $logged_in=$_SESSION['id'];
    $op_query=$mysqli->query("INSERT INTO operacion_estatus(operador,maquina,actividad_actual,en_tiempo,asaichi_cumplido,fecha) VALUES($logged_in,$mac_id,2,1,1,'$today')");
    if ($op_query) {
       header("Location: index2.php");
    }else{
        printf($mysqli->error);
    }

        
    }

    
} 
        //header("Location: asaichii.php");
        }else{
        echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';

        echo "<script>location.href='index.php'</script>";
        }
        }else{

        echo '<script>alert("ESTE USUARIO NO EXISTE, VERIFIQUE CON SU ADMINISTRADOR DE USUARIOS")</script> ';

    echo "<script>location.href='index.php'</script>";

}

?>