<!DOCTYPE html>
<?php ini_set("session.gc_maxlifetime","7200");   ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Encuesta</title>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/divdespegable.js"></script>
    <link href="css/general-styles.css" rel="stylesheet" />
    <link href="css/estiloshome.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
   <script>
   
   $(function() {
    $('input[name=desempeno]').on('click init-post-format', 
    function() {
        $('#problema').toggle($('#mostrar').prop('checked'));
    }).trigger('init-post-format');
});
   
   </script>

   <script>
   
   $(function() {
    $('input[name=calidad]').on('click init-post-format', 
    function() {
        $('#problema2').toggle($('#mostrar2').prop('checked'));
    }).trigger('init-post-format');
});
   
   </script>

</head>
<body >
    <style type="text/css">
        
         .txt__tit{
          color: white;
          font-size: 20pt;
     }

        .cont{
            background-image: url('images/dots.png');
            width: 95%;
            height: 95%;
            position: absolute;
            top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
            border-radius: 8px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;

        }

        .congral{
            width: 100%;
            height: 100%;

        }

        
@media only screen and (min-width:481px) and (max-width:768px) and (orientation: portrait) {
    .contegral{
        display:none;
    }
        body {
             background-image:none;
        }
    .msj {
    display:block;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    top: 40%;
    left: 10%;
    position: absolute;
    z-index:122;
    }

}

@media screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation: landscape) {
 .msj {
 display: none;
 }
}
    </style>

     <?php
     require('saves/conexion.php');
    
  
     ?>
    


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

  




    <div class="msj">
        <img src="images/msj.fw.png" />
    </div>
    
         

    <div class="congral">               
        <div class="cont center-block">
                       <form id="encuesta-form" class="form-horizontal" onsubmit="saveEncuesta()" method="post">
                       <input type="hidden" name="section" value="encuesta">
                           <input hidden type="text" name="logged_in" id="logged_in" value="<?php echo "". $_SESSION['logged_in'] ?>" />
                           
                           <input hidden type="text" name="ciclo" value="restart"  />
                           <?php if ($_GET['qty']=='single') { ?>
                          
                           <input hidden type="text" name="odt" value="<?=$_GET['odt'] ?>"  />
                            <input hidden type="text" name="idorden" value="<?=$_GET['order'] ?>"  />
                            <input hidden type="text" name="qty" value="single"  />
                           
                           <?php }else{ ?>
                      <input hidden type="text" name="odt" value="<?=$_GET['odt'] ?>"  />
                      <input hidden type="text" name="idorden" value="<?=$_GET['order']; ?>"  />
                      
                      <input hidden type="text" name="qty" value="multi"  />
                           <?php } ?>
                          
                           
                            <input hidden type="text" name="horadeldia" id="horadeldia" value="<?php echo date("H:i:s",time()-21600); ?>" />
                            <input hidden type="text" name="fechadeldia" id="fechadeldia" value="<?php echo date("d-m-Y"); ?>" />
                       
                        <fieldset>

                        <!-- Form Name -->
                        <legend class="txt__tit" style="color:black; font-weight: bold;">ENCUESTA</legend>
                          <div class="form-group">
                  <div class="button-panel-small">
                       <P>1. LO HICE MAS LENTO?</P>
                        <div class="square-button-text red lento stopalert start reset ">
                        <input type="radio" name="desempeno" value="SI" checked>
                          SI
                        </div>
                        <div class="square-button-text red next no-slow">
                        <input type="radio" name="desempeno" value="NO" id="mostrar">
                          NO
                        </div>
                        
                        <input type="submit" style="display: none;" id="send-encuesta">
                          
                </div>
                </div>
                <div class="form-group">
                  <div class="button-panel-small" id="quesion2" style="display: none;">
                       <P>2. LO HICE BIEN A LA PRIMERA?</P>
                        <div class="square-button-text2 red  stopalert start reset finish no-first">
                        <input type="radio" name="calidad" value="SI" checked/>
                          SI
                        </div>
                        <div class="square-button-text2 nobien red ">
                        <input type="radio" name="calidad" value="NO" id="mostrar2"/>
                          NO
                        </div>
                        

                          
                        </div>
                </div>

                        <!-- Multiple Radios (inline) 
                        <div class="form-group">
                        <label class="col-md-6 control-label txt__tit" for="radios">¿Lo hice mas lento?</label>
                        <div class="col-md-4"> 
                            <label class="radio-inline txt__tit" for="radios-0">
                                <label>
                                 <input type="radio" name="desempeno" value="NO" checked>No
                                </label>
                             </label>   
                             <label class="radio-inline txt__tit" for="radios-1">   
                                <label >
                                 <input type="radio" name="desempeno" value="si" id="mostrar" >Si
                                </label>
                           
                            </label> 
                            
                        </div>
                        </div>
                         

                       
                                <div class="form-group">
                                <label class="col-md-6 control-label" for="selectbasic"></label>
                                <div class="col-md-4">
                                    
                                    <select id="problema" name="problema" class="form-control"/>
                                    <option value="ok" selected="selected"> </option>
                                    <option value="Papel Grande">Papel Grande</option>
                                    <option value="Detalles Finos">Detalles Finos</option>
                                    <option value="Es a Registro">Es a Registro</option>
                                    </select>
                                </div>
                                </div>
                       

                       -->
                        

                         <!-- Multiple Radios (inline) 
                        <div class="form-group">
                        <label class="col-md-6 control-label txt__tit" for="radios">¿Lo hice bien a la primera?</label>
                        <div class="col-md-4"> 
                            <label class="radio-inline txt__tit" for="radios-0">
                            <input type="radio" name="calidad" value="SI" checked/>
                            Si
                            </label> 
                            <label class="radio-inline txt__tit" for="radios-1">
                            <input type="radio" name="calidad" value="NO" id="mostrar2"/>
                            No
                            </label>
                        </div>
                        </div>

                         
                                <div class="form-group">
                                <label class="col-md-6 control-label" for="selectbasic"></label>
                                <div class="col-md-4">
                                    
                                    <select id="problema2" name="problema2" class="form-control"/>
                                    <option value="ok" selected="selected"> </option>
                                    <option value="Se Movio la Escuadra">Se Movio la Escuadra</option>
                                    <option value="Mal Ajuste">Mal Ajuste</option>
                                    <option value="Se Movio el Cuadratin">Se Movio el Cuadratin</option>
                                    <option value="Se Afloja la Tabla">Se Afloja la Tabla</option>
                                    </select>
                                </div>
                                </div>

-->


                        <!-- Textarea 
                        <div class="form-group">
                        <label class="col-md-6 control-label txt__tit" for="textarea">Observaciones</label>
                        <div class="col-md-4">                     
                            <textarea class="form-control" id="observaciones" name="observaciones" ></textarea>
                        </div>
                        </div>-->
                        <div id="finish" style="display: none;">
                         <div class="form-group" style="text-align: center; color:black;">
                    <textarea placeholder="Observaciones.." class="comments-small" id="observaciones" name="observaciones"></textarea>
                
                </div>

                        <!-- Button -->
                        <div class="form-group">
                          <div id="submit-form" class="button-panel-small">
                               
                                
                                <div class="square-button-small blue">
                                  <img src="images/saving.png">
                                </div>
                                
                                  
                                </div>
                                <?php //print_r($_POST); ?>
                        </div>
                        </div>
                                    

                        

                        </fieldset>
                        <!-- ***************************************************************** -->
 



   <div id="lento">
   <p>¿Porque razon?</p>
    <div class="form-group" style="width:100%;margin:0 auto;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
                <br> 
              <div class="lento radio-menu face quest next">
                <input type="radio" class="" name="problema" id="radios-0" value="Papel Grande"  >
                   PAPEL GRANDE</div>
               <div class="lento radio-menu face quest next">
               <input type="radio" name="problema" id="radios-1" value="Detalles Finos">
                   DETALLES FINOS</div>
                   <div class="lento radio-menu face quest next">
               <input type="radio" name="problema" id="radios-1" value="Es a Registro">
                   ES A REGISTRO</div>
                
                </div>
 </div>

<!-- ****************************************** -->




 <div id="nobien">
  <p>¿Porque razon?</p>
            <div class="form-group" style="width:100% ;margin:0 auto; z-index: 701;">
                <label class="col-md-4 control-label" for="radios" style="display: none;"></label>
               
              <div class="nobien radio-menu face2 quest finish">
                <input type="radio" class="" name="problema2" id="radios-0" value="Se Movio la Escuadra" >
                    SE MOVIO LA ESCUADRA</div>
               <div class="nobien radio-menu face2 quest finish">
               <input type="radio" name="problema2" id="radios-1" value="Mal Ajuste">
                   MAL AJUSTE</div>
                   <div class="nobien radio-menu face2 quest finish">
               <input type="radio" name="problema2" id="radios-1" value="Se Movio el Cuadratin">
                   SE MOVIO EL CUADRATIN</div>
                <div class="nobien radio-menu face2 quest  finish">
               <input type="radio" name="problema2" id="radios-1" value="Se Afloja la Tabla">
                   SE AFLOJA LA TABLA</div>
                </div>


     </div>
                        </form>

                       


                       </div>
        </div>
    </div>


      
   
                                    <script>
                                            var breaktime;
                                            var ftimebreak;

                                            $(document).ready(function () {


                                                breaktime = $('.breaktime').FlipClock(0, {
                                                    language: "spanish",
                                                    clockFace: 'hourCounter',
                                                    countdown: false,
                                                    autoStart: false,
                                                    callbacks: {
                                                        start: function () {
                                                            $('.message').html('aa');
                                                        }

                                                    }

                                                });

                                                $('.goeat').click(function () {
                                                    breaktime.start();

                                                    
                                                });
                                                

                                                 /* $('.onrest').click(function () {
                                                    relojajuste.onReset();
                                                });*/

                                                

                                                $('.reseteat').click(function () {
                                                    breaktime.reset();
                                                });

                                                $('.stopeat').click(function () {   
                                                    breaktime.stop(function () {

                                                        var timebreak = breaktime.getTime() - 1; //Sin el menos 1 al parecer aparece 1 segundo de desface.
                                                      
                                                        var hours3 = Math.floor(timebreak / 7200); // para pasar de minutos  a horas
                                                        var minutes3 = Math.floor(timebreak / 60); // para pasar de segundos a minutos
                                                        var seconds3 = timebreak - minutes3 * 60; // para sacar unicamente los minutos
                                                        ftimebreak = hours3 + ":" + minutes3 + ":" + seconds3; //el resultado se guarda en la variable ftime
                                                        valor3 = "" + ftimebreak + "";
                                                        document.getElementById("breaktime").value = valor3;
                                                        
                                                       

                                                    });


                                                });





                                              });  


                        $('.square-button-text ').click(function() {
                      $('.red-osc').removeClass('red-osc');
                      $(this).addClass('red-osc').find('input').prop('checked', true)    
                    });

                        $('.square-button-text2 ').click(function() {
                      $('.square-button-text2').removeClass('red-osc');
                      $(this).addClass('red-osc').find('input').prop('checked', true)    
                    });

                         $('.face ').click(function() {
                      $('.face-osc').removeClass('face-osc');
                      $(this).addClass('face-osc').find('input').prop('checked', true)    
                    });

                           $('.face2 ').click(function() {
                      $('.face-osc2').removeClass('face-osc2');
                      $(this).addClass('face-osc2').find('input').prop('checked', true)    
                    });


                          $( "#submit-form" ).click(function() {
                                              $( "#send-encuesta" ).click();
                                            });

                                    </script>

       
   
      </div>

<script>
    $("input[name='desempeno']").click(function () {
    $('#show-me').css('display', ($(this).val() === 'a') ? 'block':'none');
});

$(".next").click(function () {
    $('#quesion2').show();
});
$(".finish").click(function () {
    $('#finish').show();
});

 function saveEncuesta(){
         event.preventDefault();
         //var mac=$('#mac').val();
        localStorage.removeItem('myTime');
         $.ajax({  
                      
                     type:"POST",
                     url:"saves.php",   
                     data:$('#encuesta-form').serialize(),  
                       
                     success:function(data){ 
                        
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                          window.location.replace("index2.php");
                          console.log(data);
                     }  
                });
    } 

</script>
</body>
</html>
