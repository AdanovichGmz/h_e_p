<?php
class bd{
    /*declaración de atributos de la clase */
    private $host;
    private $user;
    private $pass;
    private $db;
    private $link;
    private $st;
    private $cierra;
    private $liberar;
    private $array;
    static $_instance;
    private $numRows;
 
    /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
    private function __construct(){
     
    $this->host="localhost"; //ipservidor de base de datos
    $this->user="root";    //usuario base de datos
    $this->pass="";   //contraseña base de datos
    $this->db="sistema";  //nombre base de datos
     
    $this->connect();
    }
 
    /*Evitamos el clonaje del objeto. Patrón Singleton*/
    private function __clone(){}
 
    /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera
    de la    clase para instanciar el objeto, y así, poder utilizar sus métodos*/
    public static function getInstance(){
    if (!(self::$_instance instanceof self)){
        self::$_instance=new self();
    }
        return self::$_instance;
    }
 
    /*Realiza la conexión a la base de datos.*/
    private function connect(){
        $this->link = mysqli_connect($this->host,$this->user,$this->pass);
            if(!$this->link){
                echo "no existe conexion con base de datos";
                return false;
                die;
            }else{
                $sdb=mysqli_select_db($this->link,$this->db);
                if(!$sdb){
                    echo "No se encuentra la base de datos";
                    return false;
                }else{
    //mysqli_query($this->link,"SET NAMES 'utf8'");
    //echo "Conectado!";
                    return true;
                }
            }
    }
 
    /*Método para ejecutar una sentencia sql*/
    public function executeQuery($sql){
        $this->st = mysqli_query($this->link,$sql);
        return $this->st;
    }
 
    /*Método para Cerrar la DB sql*/
    public function close(){
        $this->cierra= mysqli_close($this->link);
        return $this->cierra;
    }
    /*Método para Liberar la memoria o a willy la ballena*/
     
    public function free(){
        $this->liberar = mysqli_free_result($this->st);
        return $this->liberar;
    }
 
/*Método para obtener una fila de resultados de la sentencia sql*/
public function getDataArray($stmt,$fila,$MYSQL_ASSOC=""){
if ($fila==0){
$this->array=mysqli_fetch_array($stmt);
}else{
mysqli_data_seek($stmt,$fila);
$this->array=mysqli_fetch_array($stmt);
}
return $this->array;
}
 
/*Método para obtener la cantidad de filas del resultado*/
public function getNumRows($rs){
$this->numRows = mysqli_num_rows($rs);
return $this->numRows;
}
 
/*Devuelve el último id del insert introducido */
public function lastId(){
return mysqli_insert_id($this->link);
}
/*Devuelve usuario de la Base de datos */
public function getUser(){
return $this->user;
}
/*Devuelve el error */
public function error(){
return mysqli_error($this->link);
}
/*devuelve el nombre de la base de datos */
public function getDB(){
return $this->db;
}
}
?>