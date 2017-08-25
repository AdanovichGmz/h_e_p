
<?php
       require('saves/conexion.php');
     $query0="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'corte' ";
	 $corteact=$mysqli->query($query0);

     $query01="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'corte' ";
	 $cortesig=$mysqli->query($query01);

     $query02="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'corte' ";
	 $corteprep=$mysqli->query($query02);   


     /////////////
     $query1="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'suaje' ";
	 $suajeact=$mysqli->query($query1);
   
     $query2="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'suaje'";
	 $suajesig=$mysqli->query($query2);
  
     $query3="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'suaje' ";
	 $suajeprep=$mysqli->query($query3);

      /////////////
     $query4="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'suaje grande' ";	
	 $suajegraact=$mysqli->query($query4);
   
     $query5="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'suaje grande'";
	 $suajegrasig=$mysqli->query($query5);
  
     $query6="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'suaje grande' ";
	 $suajegraprep=$mysqli->query($query6);


      /////////////
     $query7="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'timbradora' ";	
	 $timbradoraact=$mysqli->query($query7);
   
     $query8="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'timbradora'";
	 $timbradorasig=$mysqli->query($query8);
  
     $query9="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'timbradora' ";
	 $timbradoraprep=$mysqli->query($query9);

     /////////////
     $query10="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'hot stamping' ";	
	 $hotstampingact=$mysqli->query($query10);
   
     $query11="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'hot stamping'";
	 $hotstampingsig=$mysqli->query($query11);
  
     $query12="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'hot stamping' ";
	 $hotstampingprep=$mysqli->query($query12);


     /////////////
     $query13="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'hot stamping 2' ";	
	 $hotstampingact2=$mysqli->query($query13);
   
     $query14="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'hot stamping 2'";
	 $hotstampingsig2=$mysqli->query($query14);
  
     $query15="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'hot stamping 2' ";
	 $hotstampingprep2=$mysqli->query($query15);

      /////////////
     $query16="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'laminadora' ";	
	 $laminadoraact=$mysqli->query($query16);
   
     $query17="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'laminadora'";
	 $laminadorasig=$mysqli->query($query17);
  
     $query18="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'laminadora' ";
	 $laminadoraprep=$mysqli->query($query18);

     /////////////
     $query19="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'offset' ";	
	 $offsetact=$mysqli->query($query19);
   
     $query20="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'offset'";
	 $offsetsig=$mysqli->query($query20);
  
     $query21="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'offset' ";
	 $offsetprep=$mysqli->query($query21);



    
    $etecorte = '';
    $etesuaje = '';
    $etesuajegra = '';
    $etetimbradora = ''; 
    $etehotstamping = '';
    $etehotstamping2 = '';
    $etelamiandora = '';
    $eteoffset = '';


    $etec = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'Corte' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'Corte'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etec);
     while ($row= mysqli_fetch_array($resultado)){
     $etecorte=$etecorte+$row[0];
     }
     /////////
     $etes = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'suaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'suaje'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etes);
     while ($row= mysqli_fetch_array($resultado)){
     $etesuaje=$etesuaje+$row[0];
     }
     ///////
     $etesg = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'suaje grande' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'suaje grande'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etesg);
     while ($row= mysqli_fetch_array($resultado)){
     $etesuajegra=$etesuajegra+$row[0];
     }
     ////////
      $etet = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'timbradora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'timbradora'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etet);
     while ($row= mysqli_fetch_array($resultado)){
     $etetimbradora=$etetimbradora+$row[0];
     }
     ///////
      $eteh = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'hot stamping' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'hot stamping'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($eteh);
     while ($row= mysqli_fetch_array($resultado)){
     $etehotstamping=$etehotstamping+$row[0];
     }
    //////
    $eteh2 = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'hot stamping 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'hot stamping 2'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($eteh2);
     while ($row= mysqli_fetch_array($resultado)){
     $etehotstamping2=$etehotstamping2+$row[0];
     }
     //////
    $etel = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'lamiandora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'lamiandora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = '' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'lamiandora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'lamiandora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'lamiandora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'lamiandora' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'lamiandora'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etel);
     while ($row= mysqli_fetch_array($resultado)){
     $etelamiandora=$etelamiandora+$row[0];
     }
     //////
    $eteo = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'offset' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'offset' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = '' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'offset' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'offset' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'offset' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'offset' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'offset'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($eteo);
     while ($row= mysqli_fetch_array($resultado)){
     $eteoffset=$eteoffset+$row[0];
     }





    ?>


    <?php
       require('saves/conexion.php');
      $corte="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'corte' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC";
	  $mcorte=$mysqli->query($corte);

      $suaje="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'suaje' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC";
	  $msuaje=$mysqli->query($suaje);

      $suajegra="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'suaje grande' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $msuajegra=$mysqli->query($suajegra);

      $timbradora="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'timbradora' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mtimbradora=$mysqli->query($timbradora);

      $hotstamping="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'hot stamping' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mhotstamping=$mysqli->query($hotstamping);

      $hotstamping2="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'hot stamping 2' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mhotstamping2=$mysqli->query($hotstamping2);

      $laminadora="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'laminadora' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $laminadora=$mysqli->query($laminadora);

      $offset="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'offset' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $offset=$mysqli->query($offset);
     ?>


      <?php
     require('saves/conexion.php');
     $foto="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = '34:e2:fd:dd:d0:7b' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
      $mfoto=$mysqli->query($foto);

     $foto="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'suaje' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
     $mfoto2=$mysqli->query($foto);

     $foto3="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'suaje grande' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
     $mfoto3=$mysqli->query($foto3);

     $foto4="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'timbradora' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
     $mfoto4=$mysqli->query($foto4);

     $foto5="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'hot stamping' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC  ";
     $mfoto5=$mysqli->query($foto5);

     $foto6="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'hot stamping 2' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC  ";
     $mfoto6=$mysqli->query($foto6);

     $foto7="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'laminadora' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC  ";
     $mfoto7=$mysqli->query($foto7);

     $foto8="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'offset' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC  ";
     $mfoto8=$mysqli->query($foto8);

     ?>


<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Produccion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

     <link href="css/styleprod.css" rel="stylesheet" />

     <script>
       function redireccionar(){location.href="produccion2.php";} 
       setTimeout ("redireccionar()", 500000);
     </script>


</head>
<body  style="background-color:black;" >

<div class="contegral">

    
   
      
        <div class="banner">
            <div class="imgbanner"></div>
            <div class="usuario" > PROCESO DE PRODUCCION
                 

    
            </div>
            <div class="fechayhora">
               
               <?php $fecha = strftime( "%Y-%m-%d", time() );
             
               echo $fecha
               ?>
                    <script>
                        function startTime() {
                            today = new Date();
                            h = today.getHours();
                            m = today.getMinutes();
                            s = today.getSeconds();
                            m = checkTime(m);
                            s = checkTime(s);
                            document.getElementById('hora').innerHTML = h + ":" + m + ":" + s;
                            t = setTimeout('startTime()', 500);
                        }
                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }
                        window.onload = function() {
                            startTime();
                        }
                    </script>
                    <div id="hora" ></div>
 
              </div>
            
        </div>
        <div class="row2">
            <div class="operador">
                 <?php
                  if ($row = mysqli_fetch_object ($mcorte)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etecorte ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto"/>
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($corteact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($cortesig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($corteprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>

            <div class="operador2">
                 <?php
                  if ($row = mysqli_fetch_object ($msuaje)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etesuaje ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto2)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto"/>
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($suajeact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($suajesig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($suajeprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>


            <div class="operador3">
                 <?php
                  if ($row = mysqli_fetch_object ($msuajegra)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etesuajegra ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto3)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto"/>
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($suajegraact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($suajegrasig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($suajegraprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>

            <div class="operador4">
                 <?php
                  if ($row = mysqli_fetch_object ($mtimbradora)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etetimbradora ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto4)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto" />
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($timbradoraact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($timbradorasig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($timbradoraprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>
        </div>
        <div class="row3">
            <div class="operador5">
                 <?php
                  if ($row = mysqli_fetch_object ($mhotstamping)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etehotstamping ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto5)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto"/>
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($hotstampingact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($hotstampingsig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($hotstampingprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>

            <div class="operador6">
                 <?php
                  if ($row = mysqli_fetch_object ($mhotstamping2)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etehotstamping2 ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto6)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto"/>
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($hotstampingact2)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($hotstampingsig2)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($hotstampingprep2)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>


            <div class="operador7">
                 <?php
                  if ($row = mysqli_fetch_object ($laminadora)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etelamiandora ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto7)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto"/>
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($laminadoraact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($laminadorasig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($laminadoraprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>

            <div class="operador8">
                 <?php
                  if ($row = mysqli_fetch_object ($offset)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            <!--<img src="images/porcentaje.fw.png" class="img-responsive" style="margin:15px;" />-->
                            <input class="inpuporcentaje " id="actual" value="<?php echo $eteoffset ?>"  readonly />
                            <div class="signo">%</div>
                        </div>
                        <div class="imagen">
                            <?php
                  if ($row = mysqli_fetch_object ($mfoto8)) 
                    { 
                   ?>
                                                                            
                  <img   src="<?=$row->foto?>" class="foto" />
                   <?
                   } 
                   ?>
                            
                        </div>

                    </div>
                    <div class="rowprox">
                       
                                   
                         

                        <div class="fila1">
                            <div class="tarea1">
                              
                               <?php
                                        if ($row = mysqli_fetch_object ($offsetact)) 
                                        { 
                                          ?>
                                                                       
                                          <input  class="txt" value="<?=$row->numodt?>" readonly style=""/>
                                           
                      
                                           <?
                                        } 
                                        ?>
                                       
                                        </div>
                                        <div class="divnegro">
                                            <div class="tareas">ACTUAL</div>
                                        </div>
            
                                    </div>
                                    <div class="fila2">
                                        <div class="tarea1">
                                         <?php
                                        if ($row = mysqli_fetch_object ($offsetsig)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div  class="tareas">SIGUIENTE</div>
                            </div>

                        </div>
                        <div class="fila3">
                            <div class="tarea1">
                             <?php
                                        if ($row = mysqli_fetch_object ($offsetprep)) 
                                        { 
                                          ?>
                                                                       
                                          <input type="text"  class=" txt" value="<?=$row->numodt?>" readonly />
                                         
                                           <?
                                        } 
                                        ?>
                                </div>
                            <div class="divnegro">
                                <div class="tareas">PREPARACIÓN</div>
                            </div>

                        </div>
                    </div>


               
            </div>
        </div>

            
   

</div>



</body>
</html>