
<?php



session_start();
require("saves/conexion.php");

$username=$_POST['usuario'];
$pass=$_POST['pass'];
//$nmac=$_POST['maquina'];


$sql2=mysqli_query($mysqli,"SELECT * FROM login WHERE usuario='$username'");
if($f2=mysqli_fetch_assoc($sql2)){
    if($pass==$f2['pasadmin']){
        $_SESSION['id']=$f2['id'];
        $_SESSION['logged_in']=$f2['logged_in'];
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


     

  
    

if (isset($_COOKIE['ajuste'])){
    header("Location: index2.php");
}

elseif (isset($_COOKIE['tiraje'])){
    header("Location: index3.php");
    } 
else{
    header("Location: asaichii.php");
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