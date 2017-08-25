


select( (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste where nommaquina = 'Corte') + (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje where nombremaquina= 'Corte') -  

(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertageneralajuste where maquina = 'Corte')+(select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoalertamaquina))) from alertaMaquinaOperacion where nombremaquinaajuste = 'Corte') /


 (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) from ajuste where nommaquina = 'Corte') + (select SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoTiraje))) from tiraje where nombremaquina= 'Corte') )as total



select sum( ((select sum(tiempo) from ajuste  where nommaquina = 'Corte')+
         (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) -

        ((select sum(tiempoalertamaquina) from alertageneralajuste  where maquina = 'Corte')+
         (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte')) / 
         
         
         
         ((select sum(tiempo) from ajuste  where nommaquina = 'Corte')+
         (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte'))
         
          ) *.001 / count(*) as total




SELECT SUM((tiempoajuste+tiempotiro)/tiempoalerta*.01) / count(*) as disponibilidad  FROM visitors where nommaquina = 'corte'




mega consulta los 3 multiplicados
select (( 100 - ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'Corte')+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte')) / ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW())) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW()))) / 10000 ) )as ete





l



select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'Corte')+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte')) / ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW())) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW()))) *.00001 ) )








//////////////////pai
select ( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'Corte')+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte')) / ((select sum(tiempo) from ajuste where nommaquina = 'Corte')+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte')) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW())) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW()))) *.00001 )as ete union (SELECT total   from ordenes where nommaquina= 'Corte')




//////multiplicacion de las 3 tablas

select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'Corte'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )



select sum( ((select sum(tiempo) from ajuste  where nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC )+
         (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) -

        ((select sum(tiempoalertamaquina) from alertageneralajuste  where maquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+
         (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / 
         
         
         
         ((select sum(tiempo) from ajuste  where nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+
         (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC))
         
          ) *.01 / count(*) as disponibilidad





SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where nommaquina = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC          

SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in inner JOIN tiraje on tiraje.logged_in where nommaquina = 'placa'


SELECT * FROM maquina INNER JOIN asaichi ON maquina.mac = asaichi.mac WHERE nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC                         