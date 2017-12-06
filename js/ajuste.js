/******************** index2.php ********************/
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('inicioAlerta').value = h + ":" + m + ":" + s;

    
}
function currentSeconds() {
     var today = new Date();
    var h = today.getHours()*3600;
    var m = today.getMinutes()*60;
    var s = today.getSeconds();
      seconds=h+m+s;

    return Math.round(seconds);
    
}
function startEat(){
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    console.log('cambiando hora');
    document.getElementById('inicioAlertaEat').value = h + ":" + m + ":" + s;

    
}
var jQuery214=$.noConflict(true);
var kb=false;
$(document).ready(function(event) {
 $(document).on("click", "#virtualodt", function () {
    getKeys('virtualodt','cosa');
});
 
 $(document).on("click", "#saving", function () {
    createVirtualOdt();
    $('#close-down').click();
});

$(document).on("click", ".radio-menu-small", function () {
   $('.face-osc').find('input').prop('checked', false);
                                              $('.face-osc').removeClass('face-osc');
                                              $(this).addClass('face-osc').find('input').prop('checked', true);

                                              sendOrder();
                                              $('#close-down').click(); 
});

   // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function() {
        $('#loading').show();
        $('#resultaado').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#resultaado').fadeIn('slow');
    });
   // Interceptamos el evento submit
    
    $('#form, #fat').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                //$('#currentOrder').html('ORDEN ACTUAL: '+data);
               
               
                $('.saveloader').hide();
                $('.savesucces').show();
                 setTimeout(function() {   
                   close_box();
                }, 1000);
                
            }
        })        
        return false;
    }); 
/*
    $( "#stop" ).click(function(e) {
      var orderexist=$('#orderID').val();
      if (orderexist!=='') {
        $( "#nuevo_registro" ).submit();
        e.preventDefault();

      } else{
        alert('Debes seleccionar una orden');
      }
                                        

                                            }); */
                                            saveOperstatus();
});




                                             $( "#save-ajuste").click(function() {

                                               var tiro=$('#actual_tiro').val();
                                              $.ajax({
                                                  type: 'POST',
                                                  url: 'init_tiro.php',
                                                  data: {tiraje:tiro,init:'reinit'},
                                                  // Mostramos un mensaje con la respuesta de PHP
                                                  success: function(data) {
                                                    console.log(data);
                                                      $('#horadeldia').val(data.hora);
                                                     $( "#fo4" ).submit();
                                                  }
                                              })
                                                      
                                                     
                                             
                                            });

                                             $('.radio-menu').click(function() {
                                              $('.face-osc').removeClass('face-osc');
                                              $(this).addClass('face-osc').find('input').prop('checked', true)    
                                            });

                                            

                                              $( document ).ajaxStop(function() {

                                             

                                               

                                              });

                                             function selectOrders(id){
                                              
                                             }
                                             
                                             
                                            

                                            $( document ).ajaxStop(function() {

                                              $('.radio-menu-small').click(function() {
                                               
                                            });

                                                 

                                              });
                                            var element = document.getElementById('nommaquina');
    
 element.addEventListener("change", function(){ 
    var maquina = document.getElementById('maquina');
      
     
     maquina.value = this.options[this.selectedIndex].text;
    
     
 });

 $('.backdrop').click(function(){
          close_box();
        });

  function submitEat(suceso){
    
    var actiro=$('#actual_tiro').val();
    $('#act_tiro').val(actiro);
    $('#s-radios').val(suceso);
    if ($('#ontime').val()=='true') {
      timer.start();
    }else{
      deadTimer.start();
    }
    $( "#fo3" ).submit();
  }
  function close_box()
      {
        $('.backdrop, .box, .boxorder').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box, .boxorder').css('display', 'none');
        });
      }
  function showLoad(){
        $('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
          $('.box').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box').css('display', 'block');
      }
      function selectElement(){
        
          $('.setElement').animate({'opacity':'1.00'}, 300, 'linear');
          $('.setElement').css('display', 'block');
      }
      function close_Elements()
      {
        $('.setElement').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.setElement').css('display', 'none');
        });
      }
      function sendOrder(id){
        
       $.ajax({
            type: 'POST',
            url: 'opp.php',
            data: $('#tareas').serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#tareas').html(data);
               var curorder= $('#returning').val();
               var curid= $('#returning2').val();
               var orid= $('#returning3').val();
               $('#orderID').val(orid);
              $('#order').val(orid);
               
               
               $('#currentOrder').html('EN PROCESO: '+curorder+" "+curid);
                $('.saveloader').hide();
                $('.savesucces').show();
                 setTimeout(function() {   
                   close_box();
                }, 1000); 
            }
        })
       
      }

      var timer = new Timer();
 var timerEat = new Timer();
 var timerAlert = new Timer();
 var deadTimer= new Timer();
   
$(document).ready(function(){
  var idmaquina=$('#idmachine').val();
  if (idmaquina==16) {
    //timer.start({countdown: true, startValues: {seconds: 3600}});

    if (localStorage.getItem('segundosincio')) {
      $('#act_tiro').val(localStorage.getItem('tiroactual'));
      var transcursecs=currentSeconds()-localStorage.getItem('segundosincio');
    var start_in=3600-transcursecs;
    timer.start({countdown: true, startValues: {seconds: start_in}});
    }else{
       timer.start({countdown: true, startValues: {seconds: 3600}});
    }
  }else{
    
    if (localStorage.getItem('segundosincio')) {
      $('#act_tiro').val(localStorage.getItem('tiroactual'));
      var transcursecs=currentSeconds()-localStorage.getItem('segundosincio');
      console.log('segundos transcurridos: '+transcursecs);
      console.log('segundos '+currentSeconds());
      console.log('segundos inicio'+localStorage.getItem('segundosincio'));
   if (transcursecs>=1200) {
        var start_in=transcursecs-1200;

        deadTimer.start({startValues: {seconds: start_in}});
        $('#ontime').val('false');
        alerttime();
        console.log('dead startin: '+start_in);
      }else{
        var start_in=1200-transcursecs;
        timer.start({countdown: true, startValues: {seconds: start_in}});
        console.log('startin: '+start_in);
      }

    }else{
       timer.start({countdown: true, startValues: {seconds: 1200}});
    }

   
  }

$('#chronoExample2').hide();
});
       

$('#nuevo_registro').submit(function () {
    if (ontime=='true') {
        timer.pause();
    $('#timee').val(timer.getTimeValues().toString());
  }else{
    deadTimer.pause();
    $('#timee').val(deadTimer.getTimeValues().toString());
  }
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
timer.addEventListener('reset', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
     
  deadTimer.addEventListener('secondsUpdated', function (e) {
    $('#chronoExample .values').html(deadTimer.getTimeValues().toString());
});
  deadTimer.addEventListener('started', function (e) {
      $('#chronoExample .values').html(deadTimer.getTimeValues().toString());
  });    

   $('.goeat').click(function () {
    if ($('#ontime').val()=='true') {
      timer.pause();
    }else{
      deadTimer.pause();
    }
    
    timerEat.start();
    //$('#timee').val(timerEat.getTimeValues().toString());
    timerEat.addEventListener('secondsUpdated', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
    });
    timerEat.addEventListener('started', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
});
});  

   $('#fo3').submit(function () {
     timerEat.pause();
    $('#timeeat').val(timerEat.getTimeValues().toString());
    timerEat.stop();
   });

   $('.stopeat').click(function () {
    if ($('#ontime').val()=='true') {
      timer.start();
    }else{
      deadTimer.start();
    }
    timerEat.stop();
   });
    $('#chronoExample2 .startButton').click(function () {
    deadTimer.start();
    console.log('le picaron');
});

   $('.goalert').click(function () {
   startTime(); 
    if ($('#ontime').val()=='true') {
      timer.pause();
    }else{
      deadTimer.pause();
    }
    timerAlert.start();
    //$('#timee').val(timerAlert.getTimeValues().toString());
    timerAlert.addEventListener('secondsUpdated', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlert.getTimeValues().toString());
    });
    timerAlert.addEventListener('started', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlert.getTimeValues().toString());
});
});  

   $('#fo4').submit(function () {

     timerAlert.pause();
    $('#tiempoalertamaquina').val(timerAlert.getTimeValues().toString());
    timerAlert.stop();
    if ($('#ontime').val()=='true') {
      timer.start();
    }else{
      deadTimer.start();
    }
   });

   $('.stopalert').click(function () {
    if ($('#ontime').val()=='true') {
      timer.start();
    }else{
      deadTimer.start();
    }
    timerAlert.stop();
   });
timer.addEventListener('targetAchieved', function (e) {
    timer.stop();
    deadTimer.start();
    alerttime();
    $('#ontime').val('false');
   $.ajax({      
                     type:"POST",
                     url:"operstatus.php",   
                     data:{section:'outtime'},  
                       
                     success:function(data){ 

                          console.log(data);
                     }  
                });
    
    
    
});  
function alerttime(){
  
  animacion = function(){
  
  document.getElementById('formulario').classList.toggle('fade');
}
setInterval(animacion, 550);

} 
   $(document).ready(function() {

    $("#close-down").click(function () {
      if (kb==true) {
        $("#panelkeyboard2").animate({ bottom: '-=60%' }, 200);     
  kb=false;
      }
   

    });
    
   // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
   // Interceptamos el evento submit
    $('#form, #fat, #fo3, #fo4').submit(function() {
      
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#result').html(data);
                $('.saveloader').hide();
                $('.savesucces').show();
                 setTimeout(function() {   
                   close_box();
                }, 1000);
                 $('#fo4')[0].reset();
                        $('.face-osc').removeClass('face-osc');
                        $('#actual_tiro_alert').remove(); 
                console.log(data);

            }
        })        
        
    }); 
})

   function limpiar() {
           setTimeout('document.fo3.reset()',2);
      return false;
}
 

 function saveAjusteSerigrafia(){
   localStorage.removeItem('horaincio');
  localStorage.removeItem('tiroactual');
  localStorage.removeItem('segundosincio');
  
  var mac=$('#mac').val();
  var ontime=$('#ontime').val();
  console.log(ontime);
    var order=$('#order').val();
    if($('#orderID').val()==''){
      $('#parts').click();
      $('#elementerror').show();
      setTimeout(function() {   
                   $('#elementerror').hide();
                }, 5000);
    }else{
      if (ontime=='true') {
        timer.pause();
    $('#timee').val(timer.getTimeValues().toString());
  }else{
    deadTimer.pause();
    $('#timee').val(deadTimer.getTimeValues().toString());
  }var elem=$('#returning2').val();

     $.ajax({  
                      
                     type:"POST",
                     url:"saves.php",   
                     data:$('#nuevo_registro').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click();
                          var mesa='<br><br><br><br><br><br><p style="font-size:25px;font-weight: bold;">REALIZAR TIRO EN:</p>'+
                          '<div class="maquinamesa" data-maq="1"><img src="images/maquina.png"><p>MAQUINA</p></div>'+
                          '<div class="maquinamesa" data-maq="2"><img src="images/mesa.png"><p>MESA</p></div>';

                          $('#elems-container').html(mesa);
                         
                          selectElement(); 
                          $(document).on("click", ".maquinamesa", function () {
                             var maquinamesa=$(this).data('maq');
                            if ($('#orderID').val()=='virtual') {
                            window.location.replace("index3_5.php?elem="+elem+"&mac="+mac+"&order="+order+"&mm="+maquinamesa);
                          }
                            else{
                               window.location.replace("index3.php?mac="+mac+"&order="+order+"&mm="+maquinamesa);
                            }
});
                          
                         
                          console.log(data);
                     }  
                }); 
    }

     
 }
 
function saveAjuste(){
  localStorage.removeItem('horaincio');
  localStorage.removeItem('tiroactual');
  localStorage.removeItem('segundosincio');
  var mac=$('#mac').val();
  var ontime=$('#ontime').val();
  console.log(ontime);
    var order=$('#order').val();
    if($('#orderID').val()==''){
      $('#parts').click();
      $('#elementerror').show();
      setTimeout(function() {   
                   $('#elementerror').hide();
                }, 5000);
    }else{
      if (ontime=='true') {
        timer.pause();
    $('#timee').val(timer.getTimeValues().toString());
  }else{
    deadTimer.pause();
    $('#timee').val(deadTimer.getTimeValues().toString());
  }var elem=$('#returning2').val();
       
     $.ajax({  
                      
                     type:"POST",
                     url:"saves.php",   
                     data:$('#nuevo_registro').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                          if ($('#orderID').val()=='virtual') {
                            window.location.replace("index3_5.php?elem="+elem+"&mac="+mac+"&order="+order);
                          }
                            else{
                               window.location.replace("index3.php?mac="+mac+"&order="+order);
                            }
                         
                          console.log(data);
                     }  
                }); 
    }

     
 }


 function gatODT(){
    var odt=$('#getodt').val();
     $.ajax({  
                      
                     type:"POST",
                     url:"getODTS.php",   
                     data:{numodt:odt},  
                       
                     success:function(data){ 
                          
                          $('#odtresult').html(data);
                          
                     }  
                });
  }
function sendODT(odt,machine){
  $('#getodt').val(odt);
   $("#panelkeyboard2").animate({ bottom: '-=60%' }, 200);     
  kb=false;
    $.ajax({  
                      
                     type:"POST",
                     url:"opp.php",   
                     data:{entorno:'general',odt:odt,machine:machine},  
                       
                     success:function(data){ 
                       $('#odtresult').html(data);   
                         
                     }  
                });
    
  }  

function getKeys(id,name) {
      $('#'+id).select();
      
      jQuery214('#softk').attr('data-target', 'input[name="'+name+'"]');
        if (kb == false) {
            $("#panelkeyboard2").animate({ bottom: '+=60%' }, 200);
            kb = true;
        }
        var bguardar;
        
        $('#softk').empty();     
         jQuery214('.softkeys').softkeys({
                    target :  $('#'+id),
                    layout : [
                        [
                            
                            ['1','!'],
                            ['2','@'],
                            ['3','#'],
                            ['4','$'],
                            ['5','%'],
                            ['6','^'],
                            ['7','&amp;'],
                            ['8','*'],
                            ['9','('],
                            ['0',')']
                        ],
                    [
                            'q','w','e','r','t','y','u','i','o','p'
                            
                        ],
                        [
                            
                            'a','s','d','f','g','h','j','k','l','ñ'
                            
                            
                            
                        ],[
                            
                            'z','x','c','v','b','n','m','←'],
                            ['__','GUARDAR']
                            ],

                    id:'softkeys'
                });
                /*

                jQuery214('.letras').softkeys({
                    target : jQuery214('.letras').data('target'),
                    layout : [
                       
                        [
                            'q','w','e','r','t','y','u','i','o'
                            
                        ],
                        [
                            
                            'p','a','s','d','f','g','h','j','k'
                            
                            
                            
                        ],
                        [
                            
                            'l','z','x','c','v','b','n','m','BORRAR'
                            
                           
                            
                            
                        ]
                    ],
                    id:'letras'
                }); */ 
                jQuery214('#hidekey').parent('.softkeys__btn').addClass('hidder'); 
    jQuery214('#savekey').parent('.softkeys__btn').addClass('saver').attr('id', 'saver');;            
jQuery214('#borrar-letras').parent('.softkeys__btn').addClass('large');
            jQuery214('#borrar-softkeys').parent('.softkeys__btn').addClass('large');
            if (id=='virtualodt'||id=='virtualelem') { jQuery214('.savebutton').show();}else{$('.savebutton').hide();}
    }

function createVirtualOdt(){

  if ($('#virtualodt').val()=='') {
    $('#podt').show();
  }
  else if ($('#virtualelem').val()=='') {
    $('#pelem').show();
  }
  else{
     $("#panelkeyboard2").animate({ bottom: '-=60%' }, 200);     
  kb=false;
    $.ajax({  
                      
                     type:"POST",
                     url:"opp.php",   
                     data:$('#virtualform').serialize(),  
                       
                     success:function(data){ 
                       $('#odtresult').html(data);
                        var curorder= $('#returning').val();
               var curid= $('#returning2').val();
               var orid= $('#returning3').val();
               var elemid=$('#returning4').val();
               $('#orderID').val(orid);
              $('#order').val(orid);
              $('#elemvirtual').val(curid);
              $('#idelemvirtual').val(elemid);
              $('#odtvirtual').val(curorder);
               $('#orderODT').val(curorder);

               $('#currentOrder').html('EN PROCESO: '+curorder+" "+curid);  
                     }  
                });
  }
}

 function saveOperstatus(){
        
    
         $.ajax({  
                      
                     type:"POST",
                     url:"operstatus.php",   
                     data:{section:'ajuste'},  
                       
                     success:function(data){ 
                          console.log(data);
                     }  
                });
    } 

     function saveoperAlert(){
        
      $('#fo4').append('<input type="hidden" name="actual_tiro" id="actual_tiro_alert" value="'+localStorage.getItem('tiroactual')+'">');
         $.ajax({  
                      
                     type:"POST",
                     url:"operstatus.php",   
                     data:{section:'alerta'},  
                       
                     success:function(data){ 
                          console.log(data);
                     }  
                });
    }
     function saveoperComida(){
        startEat();
    
         $.ajax({  
                      
                     type:"POST",
                     url:"operstatus.php",   
                     data:{section:'comida'},  
                       
                     success:function(data){ 
                          console.log(data);
                     }  
                });
    }