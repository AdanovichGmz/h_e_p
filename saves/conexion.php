<?php
$mysqli=new mysqli("localhost","root","","sistema7"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
mysqli_set_charset($mysqli,"utf8");
if(mysqli_connect_errno()){
    echo 'Conexion Fallida : ', mysqli_connect_error();
    exit();
}

/*define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
 */
//define("DB_NAME", "sistema");


?>



