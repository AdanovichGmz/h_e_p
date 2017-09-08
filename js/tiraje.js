 function opera(){ 
                           var cantidad = document.all.cantidad.value; 
                           var buenos = document.all.buenos.value;  
                            var ajuste = document.getElementById('piezas-ajuste').value;
                            var pedido= document.getElementById('pedido').value;
                            if (ajuste>2) {
                              defectos =(parseInt(ajuste)-2);
                            }else{
                              defectos =0;
                            }
                            mermaent=((parseInt(buenos)-parseInt(pedido))-parseInt(ajuste))-parseInt(defectos);
                            entregados=(parseInt(ajuste)+parseInt(mermaent))+parseInt(buenos);
                            document.getElementById("defectos").value = defectos;
                            document.getElementById("merma-entregada").value = mermaent;
                            document.getElementById("entregados").value = entregados;
                           } 
                            function operaPaused(){ 
                           var cantidad = document.getElementById('cantidad').value; 
                           var buen = document.getElementById('buenos').value;  
                            var ajuste = document.getElementById('piezas-ajuste').value;
                            var pedido= document.getElementById('pedido').value;
                            var avance=document.getElementById('avance').value;
                            var buenos=parseInt(buen)+parseInt(avance);
                            
                            var  defectos =document.getElementById('defectos').value;
                           
                            mermaent=((parseInt(buenos)-parseInt(pedido))-parseInt(ajuste))-parseInt(defectos);
                            entregados=(parseInt(ajuste)+parseInt(mermaent))+parseInt(buenos);
                            
                            document.getElementById("merma-entregada").value = mermaent;
                            document.getElementById("entregados").value = entregados;
                           }
 function operaMulti(id){
  var cantidad =$('#recibidos-'+id).val();
  var pedidos =$('#pedidos-'+id).val();
  var buenos =$('#buenos-'+id).val();
  var defectos =$('#defectos-'+id).val();
  var ajuste =$('#ajuste-'+id).val();
  var mermasrecib =$('#mermasrecib-'+id).val();
  console.log(mermasrecib);
  var mermaent=parseInt(mermasrecib)-(parseInt(ajuste)+parseInt(defectos));
  $('#mermasent-'+id).val(mermaent);

  }

                        
var timer = new Timer();
 var timerEat = new Timer();
 var timerAlertm = new Timer();
$(document).ready(function(){
  timer.start();

  $(document).keypress(function(e) {
    if(e.which == 13) {
      event.preventDefault();
      $('#saving').click();
}
});
/*
var timepause=$('#pausedorder').val();
if (timepause=='false') {
  timer.start();
  
}else{
  var intpause=parseInt(timepause);
  timer.start({precision: 'seconds', startValues: {seconds:intpause }});
  
} */

});
       

$('#fvalida').submit(function () {
    timer.pause();
    $('#tiempoTiraje').val(timer.getTimeValues().toString());

    //$('#timee').val(timer.getTimeValues().toString());
});
/*$('#chronoExample .stopButton').click(function () {
    timer.stop();

});*/
timer.addEventListener('secondsUpdated', function (e) {
    $('#tirajeTime .valuesTiraje').html(timer.getTimeValues().toString());
});
timer.addEventListener('started', function (e) {
    $('#tirajeTime .valuesTiraje').html(timer.getTimeValues().toString());
});
     
     $( "#stop" ).click(function() {
                                              $( "#nuevo_registro" ).submit();
                                            });

   $('.goeat').click(function () {
    timerEat.start();
    //$('#timee').val(timerEat.getTimeValues().toString());
    timerEat.addEventListener('secondsUpdated', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
    });
    timerEat.addEventListener('started', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
});
});  

   

   $('.stopeat').click(function () {
    
    timerEat.stop();
   });

   $('.goalert').click(function () {
    timerAlertm.start();
    //$('#timee').val(timerAlert.getTimeValues().toString());
    timerAlertm.addEventListener('secondsUpdated', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlertm.getTimeValues().toString());
    });
    timerAlertm.addEventListener('started', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlertm.getTimeValues().toString());
});
});  

   $('#fo3').submit(function () {
    console.log('se envio');
     timerAlertm.pause();
    $('#timealerta').val(timerAlertm.getTimeValues().toString());
    console.log(timerAlertm.getTimeValues().toString());
    timerAlertm.stop();
   });

   $('.stopalert').click(function () {
    
    timerAlertm.stop();
   });

   
   /* lightbox */


      $(document).ready(function(){
 
        
 
        $('.backdrop').click(function(){
          close_box();
        });
 
        
       });
      function close_box()
      {
        $('.backdrop, .box, .boxPause, .boxmulti').animate({'opacity':'0'}, 300, 'linear', function(){
          $('.backdrop, .box, .boxPause, .boxmulti').css('display', 'none');
        });
      }
      function showLoad(){
        $('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
          $('.box').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .box').css('display', 'block');
      }

      function multiOrders(){
        $('.backdrop').animate({'opacity':'.50'}, 300, 'linear');
          $('.boxmulti').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .boxmulti').css('display', 'block');
      }
    
  function submitEat(){
    timerEat.pause();
              $('#timeeat').val(timerEat.getTimeValues().toString());
              timerEat.stop();
    setTimeout(function() {   
                   $.ajax({  
                      
                     type:"POST",
                     url:"saveeat.php",   
                     data:$('#fo4').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                          $('.saveloader').hide();
                          $('.savesucces').show();
                          setTimeout(function() {   
                   close_box();
                }, 1000);
                          console.log(data);
                     }  
                });
                }, 1000);
                

                       
                    }
  function pauseConfirm(){
          $('.backdrop, .boxPause').animate({'opacity':'.50'}, 300, 'linear');
          $('.boxPause').animate({'opacity':'1.00'}, 300, 'linear');
          $('.backdrop, .boxPause').css('display', 'block');

  }

   function endSesion(){
    var idord=$('#numodt').val();
    var proceso=$('#numproceso').val();
    $.ajax({  
                             type:"POST",
                             url:"pauseOrder.php",   
                             data:{id_orden:idord,proceso:proceso,action:'exit'},  
                               
                             success:function(data){
                   location.href = 'logout.php';
                             }  
                        });
   
  }
$('.radio-menu').click(function() {
                      $('.face-osc').removeClass('face-osc');
                      $(this).addClass('face-osc').find('input').prop('checked', true)    
                    });
 function saveAlert(){
         event.preventDefault();
         //var mac=$('#mac').val();
         timerAlertm.pause();
    $('#timealerta').val(timerAlertm.getTimeValues().toString());
    console.log(timerAlertm.getTimeValues().toString());
    timerAlertm.stop();
         $.ajax({  
                      
                     type:"POST",
                     url:"savealertamaquina.php",   
                     data:$('#alerta-tiro').serialize(),  
                       
                     success:function(data){ 
                        
                        $('.saveloader').hide();
                        $('.savesucces').show();
                        setTimeout(function() {   
                   close_box();
                }, 600);
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                          //window.location.replace("index2.php?mac="+mac);
                          console.log(data);
                     }  
                });
    } 
 function saveTiro(){
         event.preventDefault();
         var id=$('#numodt').val();
          var odt=$('#odt').val();
          var qty=$('#qty').val();
         $.ajax({  
                      
                     type:"POST",
                     url:"saves.php",   
                     data:$('#fvalida').serialize(),  
                       
                     success:function(data){ 
                        
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                         window.location.replace("encuesta.php?order="+id+"&odt="+odt+"&qty="+qty);
                          console.log(data);
                     }  
                });
    } 