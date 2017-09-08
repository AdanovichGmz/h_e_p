
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
$lines = file('dates.csv', FILE_IGNORE_NEW_LINES);
$arr=getJsonFromCsv('dates.csv', ',');

foreach ($arr as $key => $value) {
    $result[$value['odt']][($value['Proceso1']=='')? 1: $value['Proceso1']]['fecha']=$value['Fecha1'];
    $result[$value['odt']][($value['Proceso1']=='')? 1: $value['Proceso1']]['fechaF']=$value['Fecha1F'];
    $result[$value['odt']][($value['Proceso2']=='')? 2: $value['Proceso2']]['fecha']=$value['Fecha2'];
    $result[$value['odt']][($value['Proceso2']=='')? 2: $value['Proceso2']]['fechaF']=$value['Fecha2F'];
    $result[$value['odt']][($value['Proceso3']=='')?3:$value['Proceso3']]['fecha']=$value['Fecha3'];
    $result[$value['odt']][($value['Proceso3']=='')?3:$value['Proceso3']]['fechaF']=$value['Fecha3F'];
    $result[$value['odt']][($value['Proceso4']=='')?4:$value['Proceso4']]['fecha']=$value['Fecha4'];
    $result[$value['odt']][($value['Proceso4']=='')?4:$value['Proceso4']]['fechaF']=$value['Fecha4F'];
    $result[$value['odt']][($value['Proceso5']=='')?5:$value['Proceso5']]['fecha']=$value['Fecha5'];
    $result[$value['odt']][($value['Proceso5']=='')?5:$value['Proceso5']]['fechaF']=$value['Fecha5F'];
    $result[$value['odt']][($value['Proceso6']=='')?6:$value['Proceso6']]['fecha']=$value['Fecha6'];
    $result[$value['odt']][($value['Proceso6']=='')?6:$value['Proceso6']]['fechaF']=$value['Fecha6F'];

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