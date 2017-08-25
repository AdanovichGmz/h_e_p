
<?php
       require('saves/conexion.php');
      $query0="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='Corte' HAVING status='actual'";
  
   $resultado0=$mysqli->query($query0);

     $query01="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='Corte' HAVING status='actual'";
  
   $resultado01=$mysqli->query($query01);


     $query02="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='Corte' HAVING status='actual' ";
  
   $resultado02=$mysqli->query($query02);   



     $query1="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='Corte' HAVING status='actual'";
  
   $resultado1=$mysqli->query($query1);
   

    $query2="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='Corte' HAVING status='siguiente' ";
  
   $resultado2=$mysqli->query($query2);
  
    $query3="SELECT o.*,p.id_proceso,(SELECT orden_display FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS orden_display,(SELECT status FROM orden_estatus WHERE id_orden=o.idorden AND id_proceso=p.id_proceso) AS status FROM ordenes o INNER JOIN procesos p ON p.id_orden=o.idorden WHERE nombre_proceso='Corte' HAVING status='preparacion'";
  
   $resultado3=$mysqli->query($query3);

   $disponibilidad=0.74;
   $desempenio=0.97;
   $calidad=0.40;
   $ete=($disponibilidad*$desempenio*$calidad)*100;








   /*
    
    $resultete = '';
    $ete = "select (( ((select sum( ((select sum(tiempo_ajuste) from ete where idmaquina = 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from ete where idmaquina= 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where id_maquina = 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where id_maquina= 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo_ajuste) from ete where idmaquina = 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from ete where idmaquina= 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM ete where idmaquina = 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM ete where idmaquina = 1 and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($ete);
            while ($row= mysqli_fetch_array($resultado)){ // ahce un barrido a la base de datos 

            $resultete=$resultete+$row[0];// trayendo un registro
            
            }*/
    



    ?>



