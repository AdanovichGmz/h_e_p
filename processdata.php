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
$i=1;

$disponibles=$mysqli->query("SELECT nombre_elemento FROM elementos");
while ( $row=mysqli_fetch_assoc($disponibles)) {
 $disp[]=$row['nombre_elemento'];
}


foreach ($arr as $key=> $value) {
    $odt=$value['numodt'];
    $elem=($value['elemento']=='')? 'Desconocido':$value['elemento'];
    $nproc=($value['nombre_proceso']=='Hot Stamping')? 'HotStamping' : $value['nombre_proceso'];
    switch ($elem) {
      case 'Esquela':
        $element='Esquela Sencilla';
        break;
      case 'Esquela 2 Dobleces':
        $element='Esquela Doble';
        break;
         case 'Hojas Interiores':
        $element='Hoja Interior';
        break;
         case 'Hojas interiores':
        $element='Hoja Interior';
        break;
        case 'Mini':
        $element='Mini Agradecimiento';
        break;
        case 'mini':
        $element='Mini Agradecimiento';
        break;
        default:
        $element=$elem;
        break;
        
    }
    $el= (in_array($element, $disp))? $element : 'Desconocido';
    $getidelemquery="SELECT id_elemento FROM elementos WHERE nombre_elemento='$el'";
    $getidelem=mysqli_fetch_assoc($mysqli->query($getidelemquery));
    $idelem=(!is_null($getidelem['id_elemento']))? $getidelem['id_elemento'] : 143;
    $getidquery="SELECT idorden FROM ordenes WHERE numodt='$odt' AND producto=$idelem ";

    $getid=mysqli_fetch_assoc($mysqli->query($getidquery));
    $id=(is_null($getid['idorden']))? 'NULL' :  $getid['idorden'];
    echo $i."id orden= ".$id." donde odt es ".$odt." y producto es ".$idelem." ".$elem."<br><br>";
    $result[$key]['idorden']=$id;
    $result[$key]['numodt']=$odt;
    $result[$key]['nombre_proceso']=$value['nombre_proceso'];
    $insert=$mysqli->query("INSERT INTO `procesos` (`id_proceso`, `id_orden`, `numodt`, `fecha_inicio`, `fecha_fin`, `proceso`, `nombre_proceso`, `estatus`, `avance`, `tiempo_pausa`, `fecha_pausa`) VALUES (NULL, $id, '$odt', NULL, NULL, NULL, '$nproc', 4, 1, NULL, NULL)");
    if (!$insert) {
       printf($mysqli->error);
    }
    $i++;
}
//echo '<pre>';
//print_r($arr);
//echo '</pre>';
/*
$fp = fopen('outprocess.csv', 'w');
foreach ( $arr as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
*/
?>