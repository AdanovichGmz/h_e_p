 <?php
 ini_set("session.gc_maxlifetime","7200");  
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
      if (!isset($_COOKIE['asaichii'])){
    setcookie('asaichii', true,  time()+86400);
    } 
   
     require('saves/conexion.php');
    

/*
    $ip=getenv("REMOTE_ADDR"); 
    $cmd = "arp  $ip | grep $ip | awk '{ print $3 }'"; 
    system($cmd);
    echo "$ip"; 
*/

  
  
     ?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ASA-ICHI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    
    <!-- LOADER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="css/style.css" rel="stylesheet" />



    <!-- reloj -->
    <link href="compiled/flipclock.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="compiled/flipclock.js"></script>
<script src="js/easytimer.min.js"></script>
    <!--kendo-->
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="//kendo.cdn.telerik.com/2016.3.914/styles/kendo.material.mobile.min.css" />
    <!--<script src="//kendo.cdn.telerik.com/2016.3.914/js/jquery.min.js"></script>-->
    <script src="//kendo.cdn.telerik.com/2016.3.914/js/kendo.all.min.js"></script>
    <link href="css/general-styles.css" rel="stylesheet" />

    <link href="css/estiloshome.css" rel="stylesheet" />
    <link href="css/ajuste.css" rel="stylesheet" />

    <script src="js/divdespegable.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



<script>
/*
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    }); */
</script>

<script >
    
    if(history.length>0) {
    //alert('Please use navigational links (Inbox, Cancel) instead of the browser back button.');
    history.go(+1)
    
}
</script>

<!--<script language="javascript" src="jquery-1.3.min.js"></script>-->
<script language="javascript">// <![CDATA[
$(document).ready(function() {
   // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
   // Interceptamos el evento submit
    $('#form, #fat, #fo3').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#result').html(data);
            }
        })        
        return false;
    }); 
})
// ]]></script>

<script language="javascript">
         function limpiar() {
           setTimeout('document.fo3.reset()',2);
      return false;
}
</script>





</head>
<body  >
    

     
    


   

  




    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>
  

         <div class="congral2">               
            <div class="cont2 center-block">

                <form name="nuevo_registro" id="nuevo_registro" method="POST" onsubmit="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="text-center" style="">ASA-ICHI</div>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="">
                            <div class="watch-container">
                               <a href="logout.php" ><div class="boton rojo"><img src="images/salir.png"><span>SALIR&nbsp&nbsp&nbsp&nbsp</span></div></a>
                                <a href="#" id="stop" ><div class="boton azul" onclick="saveAsaichi();"><img src="images/guardar.png" ><span>GUARDAR</span></div> </a> 
            
                               
                                 
                                <input type="hidden" name="section" value="asaichi">
                                    <input  style="display: none;" width="150" type="image" name="eviar" value="Registrar" src="images/save.png" class=" "  />


                                    
                                </div>
                                
                                <div class="timer-container">
                                    <div id="chronoExample">
                                    <div id="timer"><span class="values">00:00:00</span></div>
                                    
                                    <input type="hidden" id="timee" name="tiempo">
                                    
                                    
                                </div>
                                </div>
                                
                            </div>

                          
                        </div>

                        
                        <input hidden type="text" name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                        <input hidden name="tiempo" id="tiempo" />
                        <input hidden type="text" name="horadeldia" id="horadeldia" value="<?php echo date("H:i:s",time()-25200); ?>" />
                        <input hidden type="text" name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />

                       



                        <div class="modal-footer">
                            <div class="row ">
                            <div class="center-input">

<input type="text" name="mac"  id="mac" value="<?=$_SESSION['mac'] ?>"/>
                               <!--  
                            <input type="text" name="mac"  id="mac" value="<?=$_SESSION['nommaquina'] ?>"/>
                                <div class="col-lg-5 col-sm-offset-3 col-sm-5  ">
                               <label class="col-lg-10 col-sm-offset-1 ">SELECCIONA TU ÁREA </label>
                                   <select name="nommaquina" class="form-control" id="nommaquina">
                                      <optgroup label="Maquina">
                                        <option value="Corte">Corte</option>
                                        <option value="Suaje">Suaje</option>
                                        <option value="Suaje Grande">Suaje Grande</option>
                                        <option value="Timbradora">Timbradora</option>
                                        <option value="Hot Stamping">Hot Stamping</option>
                                        <option value="Hot Stamping 2">Hot Stamping 2</option>
                                        <option value="Laminadora">Laminadora</option>
                                        <option value="Offset">Offset</option>
                                        <option value="Placa">Placa</option>
                                    </optgroup>
                                    <optgroup label="Serigrafia">
                                        <option value="Serigrafia 1">Serigrafia 1</option>
                                        <option value="Serigrafia 2">Serigrafia 2</option>
                                        <option value="Serigrafia 3">Serigrafia 3</option>
                                        <option value="Mesa 1">Mesa 1</option>
                                        <option value="Mesa 2">Mesa 2</option>
                                    </optgroup> 
                                        
                                    </select>
                                </div>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    



<script type="text/javascript">
 var timer = new Timer();
$(document).ready(function(){
timer.start();
});
       

$('#nuevo_registro').submit(function () {
    timer.pause();
    $('#tiempo').val(timer.getTimeValues().toString());
    //$('#timee').val(timer.getTimeValues().toString());
});
/*$('#chronoExample .stopButton').click(function () {
    timer.stop();

});*/
timer.addEventListener('secondsUpdated', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
timer.addEventListener('started', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
     
     
    function saveAsaichi(){
        timer.pause();
    $('#tiempo').val(timer.getTimeValues().toString());
         var mac=$('#mac').val();
         $.ajax({  
                      
                     type:"POST",
                     url:"saves.php",   
                     data:$('#nuevo_registro').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                          window.location.replace("index2.php?mac="+mac);
                          console.log(data);
                     }  
                });
    }   
    </script>
     
    
   


</body>
</html>


