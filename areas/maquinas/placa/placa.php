 <?php
if( !session_id() )
{
    session_start();
    

}
if(@$_SESSION['logged_in'] != true){
    echo '
    <script>
        alert("tu no estas autorizado para entrar a esta pagina");
        self.location.replace("index.php");
    </script>';
}else{
    echo '';
}
    ?>


<?php
       require('saves/conexion.php');
      $query0="SELECT * FROM ordenes where status = 'actual' and maquina = 14 ";
	
	 $resultado0=$mysqli->query($query0);

     $query01="SELECT * FROM ordenes where status = 'actual' and maquina = 14 ";
	
	 $resultado01=$mysqli->query($query01);


     $query02="SELECT * FROM ordenes where status = 'actual' and maquina = 14 ";
	
	 $resultado02=$mysqli->query($query02);   



     $query1="SELECT * FROM ordenes where status = 'actual' and maquina = 14 ";
	
	 $resultado1=$mysqli->query($query1);
   

    $query2="SELECT * FROM ordenes where status = 'siguiente' and maquina = 14";
	
	 $resultado2=$mysqli->query($query2);
  
    $query3="SELECT * FROM ordenes where status = 'preparacion' and maquina = 14 ";
	
	 $resultado3=$mysqli->query($query3);

    $resultete = '';
    $ete = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'placa'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($ete);
            while ($row= mysqli_fetch_array($resultado)){
            $resultete=$resultete+$row[0];
            
            }
    



    ?>


