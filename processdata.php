
<?php
require('saves/conexion.php');
function getJsonFromCsv($file,$delimiter) { 
    if (($handle = fopen($file, 'r')) === false) {
        die('Error opening file');
    }

    $headers = fgetcsv($handle, 4000, $delimiter);
    $csv2json = array();

    while ($row = fgetcsv($handle, 4000, $delimiter)) {
      $csv2json[] = array_combine($headers, $row);
    }

    fclose($handle);
    return $csv2json; 
}



$csv = array();
$lines = file('procesos.csv', FILE_IGNORE_NEW_LINES);
$arr=getJsonFromCsv('procesos.csv', ',');




foreach ($arr as $key=> $value) {
    $odt=$value['numodt'];
    $elem=$value['elemento'];
    $nproc=($value['nombre_proceso']=='Hot Stamping')? 'HotStamping' : $value['nombre_proceso'];
    $getidelemquery="SELECT id_elemento FROM elementos WHERE nombre_elemento='$elem'";
    $getidelem=mysqli_fetch_assoc($mysqli->query($getidelemquery));
    $idelem=($getidelem['id_elemento']!=null)? $getidelem['id_elemento'] : 'null';

    $getidquery="SELECT idorden FROM ordenes WHERE numodt='$odt' AND producto=$idelem ";
    $getid=mysqli_fetch_assoc($mysqli->query($getidquery));
    $id=($getid['idorden']!=null)? $getid['idorden'] : 'NULL';
    $result[$key]['idorden']=$id;
    $result[$key]['numodt']=$odt;
    $result[$key]['nombre_proceso']=$value['nombre_proceso'];
    $insert=$mysqli->query("INSERT INTO `procesos` (`id_proceso`, `id_orden`, `numodt`, `fecha_inicio`, `fecha_fin`, `proceso`, `nombre_proceso`, `estatus`, `avance`, `tiempo_pausa`, `fecha_pausa`) VALUES (NULL, $id, '$odt', NULL, NULL, NULL, '$nproc', 4, 1, NULL, NULL)");
    if (!$insert) {
       printf($mysqli->error);
    }
}

echo '<pre>';
print_r($result);
echo '</pre>';

/*


$fp = fopen('outprocess.csv', 'w');
foreach ( $arr as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
*/


?>