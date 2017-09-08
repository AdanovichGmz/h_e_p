
<?php
require('saves/conexion.php');
$csv = array();
$lines = file('elementostoid.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value)

{   
    $nelem=str_getcsv($value);
    $getidquery="SELECT id_elemento FROM elementos WHERE nombre_elemento='$value' ";
    $getid=mysqli_fetch_assoc($mysqli->query($getidquery));
    $id=$getid['id_elemento'];
    
    if ($value=='Mini') {
       $id=93;
    }
    elseif ($value=='Papel') {
       $id=101;
    }
    elseif ($value=='Esquela 2 Dobleces') {
       $id=56;
    }
    elseif ($value=='Esquela') {
       $id=62;
    }
    elseif ($value=='Hojas Interiores') {
       $id=140;
    }
    if ($id==null) {
        $faltantes[]=$value;
    }
    $csv[] = $id;
}

echo '<pre>';
print_r(array_unique($faltantes));
echo '</pre>';
$falt=array_unique($faltantes);
/*
echo '<pre>';
print_r($csv);
echo '</pre>';


$fp = fopen('php://output', 'w');
foreach ( $data as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);
*/
$fp = fopen('output.csv', 'w');
foreach ( $csv as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);
$fp2 = fopen('faltantes.csv', 'w');
foreach ( $falt as $line ) {
    $val = explode(",", $line);
    fputcsv($fp2, $val);
}
fclose($fp2);

?>