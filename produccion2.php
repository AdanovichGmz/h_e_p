
<?php
     require('saves/conexion.php');
     $query0="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 1' ";
	 $serigrafia1act=$mysqli->query($query0);

     $query01="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'serigrafia 1' ";
	 $serigrafia1sig=$mysqli->query($query01);

     $query02="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'serigrafia 1' ";
	 $serigrafia1prep=$mysqli->query($query02);   


     /////////////
     $query1="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 2' ";
	 $serigrafia2act=$mysqli->query($query1);
   
     $query2="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'serigrafia 2'";
	 $serigrafia2sig=$mysqli->query($query2);
  
     $query3="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'serigrafia 2' ";
	 $serigrafia2prep=$mysqli->query($query3);

      /////////////
     $query4="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'serigrafia 3' ";	
	 $serigrafia3aact=$mysqli->query($query4);
   
     $query5="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'serigrafia 3'";
	 $serigrafia3sig=$mysqli->query($query5);
  
     $query6="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'serigrafia 3' ";
	 $serigrafia3prep=$mysqli->query($query6);


      /////////////
     $query7="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'mesa 1' ";	
	 $mesa1act=$mysqli->query($query7);
   
     $query8="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'mesa 1'";
	 $mesa1sig=$mysqli->query($query8);
  
     $query9="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'mesa 1' ";
	 $mesa1prep=$mysqli->query($query9);

     /////////////
     $query10="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'mesa 2' ";	
	 $mesa2act=$mysqli->query($query10);
   
     $query11="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'mesa 2'";
	 $mesa2sig=$mysqli->query($query11);
  
     $query12="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'mesa 2' ";
	 $mesa2prep=$mysqli->query($query12);

    
     /////////////
     $query13="SELECT * FROM ordenes where status = 'actual' and nommaquina = 'placa' ";	
	 $placaact=$mysqli->query($query13);
   
     $query14="SELECT * FROM ordenes where status = 'siguiente' and nommaquina = 'placa'";
	 $placasig=$mysqli->query($query14);
  
     $query15="SELECT * FROM ordenes where status = 'preparacion' and nommaquina = 'placa' ";
	 $placaprep=$mysqli->query($query15);
/*
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

     */



    
    $eteserigrafia1 = '';
    $eteserigrafia2 = '';
    $eteserigrafia3 = '';
    $etemesa1 = ''; 
    $etemesa2 = '';
    $eteplaca = '';
    


    $etes1 = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'serigrafia 1'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etes1);
     while ($row= mysqli_fetch_array($resultado)){
     $eteserigrafia1=$eteserigrafia1+$row[0];
     }
     /////////
     $etes2 = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'sserigrafia 2uaje' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'serigrafia 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'serigrafia 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'serigrafia 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'serigrafia 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'serigrafia 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'serigrafia 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'serigrafia 2'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etes2);
     while ($row= mysqli_fetch_array($resultado)){
     $eteserigrafia2=$eteserigrafia2+$row[0];
     }
     ///////
     $etes3 = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'serigrafia 3' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'serigrafia 3'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etes3);
     while ($row= mysqli_fetch_array($resultado)){
     $eteserigrafia3=$eteserigrafia3+$row[0];
     }
     ////////
      $etem1 = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'mesa 1' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'mesa 1'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etem1);
     while ($row= mysqli_fetch_array($resultado)){
     $etemesa1=$etemesa1+$row[0];
     }
     ///////
      $etem2 = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'mesa 2' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'mesa 2'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etem2);
     while ($row= mysqli_fetch_array($resultado)){
     $etemesa2=$etemesa2+$row[0];
     }

     ///////
      $etep = "select (( ((select sum( ((select sum(tiempo) from ajuste where nommaquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) - ((select sum(tiempoalertamaquina) from alertageneralajuste where maquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoalertamaquina) from alertaMaquinaOperacion where nombremaquinaajuste= 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) / ((select sum(tiempo) from ajuste where nommaquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)+ (select sum(tiempoTiraje) from tiraje where nombremaquina= 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) ) *.1 / count(*) as disponibilidad) * (SELECT SUM(buenos/entregados*100) / count(*) as calidad FROM tiraje where nombremaquina = 'placa' and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC) * (SELECT SUM(entregados/cantidad*100) / count(*) as desempeno FROM tiraje where nombremaquina = 'placa'and DATE(vdate) = DATE(NOW()) ORDER BY vdate DESC)) *.00001 ) )";

     $resultado=$mysqli->query($etep);
     while ($row= mysqli_fetch_array($resultado)){
     $eteplaca=$eteplaca+$row[0];
     }
    
    


    ?>


    <?php
       require('saves/conexion.php');
      $serigrafia1="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mserigrafia1=$mysqli->query($serigrafia1);

      $serigrafia2="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'serigrafia 2' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC";
	  $mserigrafia2=$mysqli->query($serigrafia2);

      $serigrafia3="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'serigrafia 3' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mserigrafia3=$mysqli->query($serigrafia3);

      $mesa1="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'mesa 1' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mmesa1=$mysqli->query($mesa1);

      $mesa2="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'mesa 2' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mmesa2=$mysqli->query($mesa2);
      
      $placa="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'placa' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
	  $mplaca=$mysqli->query($placa);
      /*
      $laminadora="SELECT * FROM tiraje INNER JOIN login ON login.logged_in = tiraje.logged_in where nombremaquina = 'laminadora' and DATE(vdate) = DATE(NOW()) ";
	  $laminadora=$mysqli->query($laminadora);

      $offset="SELECT * FROM tiraje INNER JOIN login ON login.logged_in = tiraje.logged_in where nombremaquina = 'offset' and DATE(vdate) = DATE(NOW()) ";
	  $offset=$mysqli->query($offset);

      */
     ?>


      <?php
     require('saves/conexion.php');
     $foto="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'serigrafia 1' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
      $mfoto=$mysqli->query($foto);

     $foto="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'serigrafia 2' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
     $mfoto2=$mysqli->query($foto);

     $foto3="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'serigrafia 3' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
     $mfoto3=$mysqli->query($foto3);

     $foto4="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'mesa 1' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC ";
     $mfoto4=$mysqli->query($foto4);

     $foto5="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'mesa 2' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC  ";
     $mfoto5=$mysqli->query($foto5);
     
     $foto6="SELECT * FROM login INNER JOIN asaichi ON login.logged_in = asaichi.logged_in where mac = 'placa' and DATE(vdate) = DATE(NOW()) and rol = 2 ORDER BY vdate DESC  ";
     $mfoto6=$mysqli->query($foto6);
     /*
     $foto7="SELECT * FROM tiraje INNER JOIN login ON login.logged_in = tiraje.logged_in where nombremaquina = 'laminadora' and DATE(vdate) = DATE(NOW())  ";
     $mfoto7=$mysqli->query($foto7);

     $foto8="SELECT * FROM tiraje INNER JOIN login ON login.logged_in = tiraje.logged_in where nombremaquina = 'offset' and DATE(vdate) = DATE(NOW())  ";
     $mfoto8=$mysqli->query($foto8);
     */
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
       function redireccionar(){location.href="produccion.php";} 
       setTimeout ("redireccionar()", 500000);
     </script>


</head>
<body  style="background-color:black;" >

<div class="contegral">

    
   
      
        <div class="banner">
            <div class="imgbanner"></div>
            <div class="usuario" >PROCESO DE PRODUCCION
                 

    
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
                  if ($row = mysqli_fetch_object ($mserigrafia1)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $eteserigrafia1 ?>"  readonly />
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
                                        if ($row = mysqli_fetch_object ($serigrafia1act)) 
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
                                        if ($row = mysqli_fetch_object ($serigrafia1sig)) 
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
                                        if ($row = mysqli_fetch_object ($serigrafia1prep)) 
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
                  if ($row = mysqli_fetch_object ($mserigrafia2)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $eteserigrafia2 ?>"  readonly />
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
                                        if ($row = mysqli_fetch_object ($serigrafia2act)) 
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
                                        if ($row = mysqli_fetch_object ($serigrafia2sig)) 
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
                                        if ($row = mysqli_fetch_object ($serigrafia2prep)) 
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
                  if ($row = mysqli_fetch_object ($mserigrafia3)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $eteserigrafia3 ?>"  readonly />
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
                                        if ($row = mysqli_fetch_object ($serigrafia3aact)) 
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
                                        if ($row = mysqli_fetch_object ($serigrafia3sig)) 
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
                                        if ($row = mysqli_fetch_object ($serigrafia3prep)) 
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
                  if ($row = mysqli_fetch_object ($mmesa1)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etemesa1 ?>"  readonly />
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
                                        if ($row = mysqli_fetch_object ($mesa1act)) 
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
                                        if ($row = mysqli_fetch_object ($mesa1sig)) 
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
                                        if ($row = mysqli_fetch_object ($mesa1prep)) 
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
                  if ($row = mysqli_fetch_object ($mmesa2)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $etemesa2 ?>"  readonly />
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
                                        if ($row = mysqli_fetch_object ($mesa2act)) 
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
                                        if ($row = mysqli_fetch_object ($mesa2sig)) 
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
                                        if ($row = mysqli_fetch_object ($mesa2prep)) 
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
                  if ($row = mysqli_fetch_object ($mplaca)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nommaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $eteplaca ?>"  readonly />
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
                                        if ($row = mysqli_fetch_object ($placaact)) 
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
                                        if ($row = mysqli_fetch_object ($placasig)) 
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
                                        if ($row = mysqli_fetch_object ($placaprep)) 
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

            <!--
            <div class="operador7">
                 <?php
                  if ($row = mysqli_fetch_object ($laminadora)) 
                    { 
                   ?>
                                                                            
                  <input  class="maquina" value="<?=$row->nombremaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $resultete ?>"  readonly />
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
                                                                            
                  <input  class="maquina" value="<?=$row->nombremaquina?>" readonly style=""/>
                   <?
                   } 
                   ?>
                
                    <div class="rowfyp">
                        <div class="porcentaje">
                            
                            <input class="inpuporcentaje " id="actual" value="<?php echo $resultete ?>"  readonly />
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
            -->
        </div>

            
   

</div>



</body>
</html>