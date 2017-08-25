


<?php
require('conexion.php');
if( !session_id() )
{
    session_start();
}






//$sql2=mysqli_query($mysqli,"SELECT * FROM login ");
//while ($registro = mysqli_fetch_array($sql2)){
//    echo

//    " <td >".$registro['qr']."</td>";


//if($registro['qr'] == 'rick' ){

//    echo $registro['qr'];
//        $arr['success'] = true;
//    } else {
//        echo $registro['qr'];
//        $arr['success'] = false;
//    }
//echo  $arr['success'];
//$rick = "".$registro['qr'];
if(isset($_POST['send'])){

    $arr= array();
    if($_POST['credential'] == "rick"){  //no se esta comparando los mismo caracteres

        //if($_POST['credential'] == 'rick'){

        $_SESSION['logged_in'] = true;

        $arr['success'] = true;
    } else {
        $arr['success'] = false;
    }

    echo json_encode($arr);

}


//}




?>



