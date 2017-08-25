<?php
require('saves/conexion.php');


/*
$query="UPDATE ordenes SET status = 'en proceso', prosig = 'suaje' WHERE status = 'actual'";
$query2="UPDATE ordenes SET status = 'actual' WHERE status = 'siguiente'";
$query3="UPDATE ordenes SET status = 'siguiente' WHERE status = 'preparacion'";
$query4="UPDATE ordenes SET status = 'preparacion' WHERE status = 'programado1'";
$query5="UPDATE ordenes SET status = 'programado1' WHERE status = 'programado2'";
$query6="UPDATE ordenes SET status = 'programado2' WHERE status = 'programado3'";
$query7="UPDATE ordenes SET status = 'programado3' WHERE status = 'programado4'";
$query8="UPDATE ordenes SET status = 'programado4' WHERE status = 'programado5'";
$query9="UPDATE ordenes SET status = 'programado5' WHERE status = 'programado6'";
$query10="UPDATE ordenes SET status = 'programado6' WHERE status = 'programado7'";
$query11="UPDATE ordenes SET status = 'programado7' WHERE status = 'programado8'";
$query12="UPDATE ordenes SET status = 'programado8' WHERE status = 'programado9'";




$resultado=$mysqli->query($query);
$resultado=$mysqli->query($query2);
$resultado=$mysqli->query($query3);
$resultado=$mysqli->query($query4);
$resultado=$mysqli->query($query5);
$resultado=$mysqli->query($query6);
$resultado=$mysqli->query($query7);
$resultado=$mysqli->query($query8);
$resultado=$mysqli->query($query9);
$resultado=$mysqli->query($query10);
$resultado=$mysqli->query($query11);
$resultado=$mysqli->query($query11);



 //header("Location: test.php");*/


$totaltx = '';
$totaltx2 = '';
$tota = '';
$resultete = '';
           
         

//$time ="select sec_to_time(sum( extract(hour from tiempo) * 3600 + extract(minute from tiempo) * 60 + extract(second from tiempo) )) AS total_mv_time from ajuste";

$time ="SELECT TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))),'%H:%i' ) FROM ajuste";

$time2 ="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) as tiempo2 FROM tiraje";
         //  $tiempoTiraje ="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) FROM tiraje";

          // $result = $tiempo + $tiempoTiraje;
          
          // echo $tiempoTiraje;
          // echo $result;


$time3 ="select( (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste where nommaquina = 'Corte') + (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje where nombremaquina= 'Corte') -  (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertageneralajuste where maquina = 'Corte')+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertaMaquinaOperacion where nombremaquinaajuste = 'Corte') / (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste where nommaquina = 'Corte') + (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje where nombremaquina= 'Corte') )as total";
            $resultadoxx=$mysqli->query($time3);
            while ($row= mysqli_fetch_array($resultadoxx)){
            $tota=$tota+$row[0];
           
            }
  
          

/*

 $resultado=$mysqli->query($time2);
            while ($row= mysqli_fetch_array($resultado)){
            $totaltx2=$totaltx2+$row['tiempo2'];
            echo $totaltx2;
            }
*/


	
	       $resultado=$mysqli->query($time);
            while ($row= mysqli_fetch_array($resultado)){
            $totaltx=$totaltx+$row[0];
            echo $totaltx;
            }

            $resultado=$mysqli->query($time2);
            while ($row= mysqli_fetch_array($resultado)){
            $totaltx2=$totaltx2+$row['tiempo2'];
            echo $totaltx2;
            }

            $result = $totaltx + $totaltx2;
            echo $result;

             
          
            
       


            $result2 = mysql_query("Select sum(Select sum(HOUR(h.tiempo)) as hora, sum(MINUTE(h.tiempo)) as minutos FROM ajuste h"); 
            
            $row=@mysql_fetch_array($result2); 
            $horas = $row["hora"]; 
            $min = $row["minutos"]; 
            $minutos = $min%60; 
            $h=0; 
            $h=(int)($min/60); 
            $horas+=$h; 
            
            echo "TOTAL: ".$horas."h ".$minutos."m"; 





 $ete = "select ((  ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'Corte')+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte')) / ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW())) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW()))) / 10000 ) )as ete";

     $resultado=$mysqli->query($ete);
            while ($row= mysqli_fetch_array($resultado)){
            $resultete=$resultete+$row[0];
            
            }
           
            



    




?>


<br>

<br>
<input type="text"  value="<?php echo $resultete ?>"  />

<br>

<input type="text"  value="<?php echo $totaltx ?>"  />
+
<input type="text"  value="<?php echo $totaltx2 ?>"  />
=
<input type="text"  value="<?php echo $result ?>"  />

<br>
<input type="text"  value="<?php echo $tota ?>"  />


<br>
<br>











<?php

require('saves/conexion.php');



$hostname="localhost";  
$username="root";  
$password="";  
$db = "sistema";  
$dbh = new PDO("mysql:host=$hostname;dbname=$db", $username, $password);  


foreach($dbh->query('select sec_to_time(sum( extract(hour from tiempo) * 3600 + extract(minute from tiempo) * 60 + extract(second from tiempo) )) AS tiempo from ajuste') as $row1) {  
//select ((select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste)+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje)) as total


//select ((SELECT TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))),'%H:%i' ) from ajuste)+ (SELECT TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))),'%H:%i' ) from tiraje)) as total   
}  



foreach($dbh->query('SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) as tiempo2 FROM tiraje') as $row2) {  
  
} 

foreach($dbh->query('select sec_to_time(sum( extract(hour from tiempoTiraje) * 3600 + extract(minute from tiempoTiraje) * 60 + extract(second from tiempoTiraje) )) AS tiempo3 from tiraje') as $row3) {  
   
} 


echo $row1['tiempo'] +  $row3['tiempo3'];

?> 

<br>
<input type="text"  value="<?php echo $row1['tiempo'] ?>"  />
<input type="text"  value="<?php echo $row2['tiempo2'] ?>"  />
<input type="text"  value="<?php echo $row3['tiempo3'] ?>"  />
<input type="text"  value="<?php echo $row1['tiempo']+ $row3['tiempo3'] ?>"  />

<!--
select ( ((select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste)+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje)) - ((select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertageneralajuste)+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertaMaquinaOperacion)) ) as disponibilidad

select ( ((select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste)+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje)) - ((select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertageneralajuste)+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertaMaquinaOperacion)) / ((select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste)+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje)) ) as disponibilidad

-->