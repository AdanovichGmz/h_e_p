 var jQuery214=$.noConflict(true);
 var r = false;
 var k=false;
 var b = false;
 var sec=parseInt($('#iniciotiro').val());
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
function startEat() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('inicioAlertaEat').value = h + ":" + m + ":" + s;

    
}
function currentSeconds() {
     var today = new Date();
    var h = today.getHours()*3600;
    var m = today.getMinutes()*60;
    var s = today.getSeconds();
      seconds=h+m+s;

    return Math.round(seconds);
    
}

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
                            mermaent=parseInt(buenos)-parseInt(pedido);
                             if (mermaent<0) {
                              mermaent =0;
                            }
                            entregados=(parseInt(ajuste)+parseInt(mermaent))+parseInt(buenos);
                           
                            document.getElementById("defectos").value = defectos;
                            document.getElementById("merma-entregada").value = mermaent;
                            
                           
                           }
                           function GetDefectos(){
                            var defect;
                            var ajuste= $('#piezas-ajuste').val();
                            if (parseInt(ajuste)>2) {
                               defect=parseInt(ajuste)-2;
                              $('#defectos').val(defect);
                            }
                           }

 /*function opera(){ 
                           var cantidad = document.all.cantidad.value; 
                           var buenos = document.all.buenos.value;  
                            var ajuste = document.getElementById('piezas-ajuste').value;
                            var pedido= document.getElementById('pedido').value;
                            if (ajuste>2) {
                              defectos =(parseInt(ajuste)-2);
                            }else{
                              defectos =0;
                            }
                            mermaent=((parseInt(cantidad)-parseInt(buenos))-parseInt(ajuste))-parseInt(defectos);
                             if (mermaent<0) {
                              mermaent =0;
                            }
                            entregados=(parseInt(ajuste)+parseInt(mermaent))+parseInt(buenos);
                           
                            document.getElementById("defectos").value = defectos;
                            document.getElementById("merma-entregada").value = mermaent;
                            document.getElementById("entregados").value = entregados;
                           } */
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
  if (localStorage.getItem('myTime')) {
    if (localStorage.getItem('alertTime')) {
      $("#panelder2").animate({ left: '+=40%' }, 200);
      $("#panelder").animate({ right: '+=75%' }, 200);
      b = true;
      alertsecs=currentSeconds()-localStorage.getItem('alertTime');
       timerAlertm.start({startValues: {seconds: alertsecs}});
       timerAlertm.addEventListener('secondsUpdated', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlertm.getTimeValues().toString());
    });
    timerAlertm.addEventListener('started', function (e) {
    $('#alertajuste .valuesAlert').html(timerAlertm.getTimeValues().toString());
});
      console.log('horaalerta: '+alertsecs);
     
    }else{
    var lastsecs=currentSeconds()-sec;
    console.log();

    timer.start({startValues: {seconds: lastsecs}});
    localStorage.setItem('myTime', lastsecs); 
    }  
  }else{
    timer.start();
    localStorage.setItem('myTime', sec); 


  }
  

saveOperstatus();
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
    timer.pause();
    timerEat.start();
    startEat();
    //$('#timee').val(timerEat.getTimeValues().toString());
    timerEat.addEventListener('secondsUpdated', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
    });
    timerEat.addEventListener('started', function (e) {
    $('#horacomida .valuesEat').html(timerEat.getTimeValues().toString());
});
});  

   

   $('.stopeat').click(function () {
    timer.start();
    timerEat.stop();
   });

   $('.goalert').click(function () {
     timer.pause();
    timerAlertm.start();
    startTime(); 
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
    localStorage.removeItem('alertTime');
    timer.start();
    timerAlertm.stop();
   });

   
   /* lightbox */


      $(document).ready(function(){
  timer.addEventListener('secondsUpdated', function (e) {
    $('#realtime').val(timer.getTimeValues().toString());
});
        setInterval(function() { 
          var tiem=$('#realtime').val();
          var mach=$('#mach').val();
          var elem=$('#el').val();
          var tm=$('#table-machine').val();
                   $.ajax({  
                      
                     type:"POST",
                     url:"avance.php",   
                     data:{tiempo:tiem,maquina:mach,elemento:elem,tabm:tm},  
                       
                     success:function(data){ 
                       
                          $('#avancerealtime').html(data);
                     }  
                });
                }, 6000);
 
        $('.backdrop').click(function(){
          close_box();
        });



        //teclado virtual
        
 
                
        
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
    timer.start();
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
                   console.log(data);
                             }  
                        });
   
  }
$('.radio-menu').click(function() {
                      $('.face-osc').removeClass('face-osc');
                      $(this).addClass('face-osc').find('input').prop('checked', true)    
                    });
 function saveAlert(){
  
  if (localStorage.getItem('alertTime')) {
    var lastsecs=currentSeconds()-sec;
    var t_alert=currentSeconds()-localStorage.getItem('alertTime');
    var continueTimer=lastsecs-t_alert;
    console.log('Tiempo-alerta: '+continueTimer);

    timer.start({startValues: {seconds: continueTimer}});
    localStorage.removeItem('alertTime');
  }else{
    timer.start();
  }
  
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
                        $('#alerta-tiro')[0].reset();
                        $('.face-osc').removeClass('face-osc');
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


                                   function createChart() {
                                       $("#graficajs").kendoChart({
                                           title: {
                                               position: "bottom",
                                               text: ""
                                           },
                                           legend: {
                                               visible: false
                                           },
                                           chartArea: {
                                               background: ""
                                           },
                                           seriesDefaults: {
                                               labels: {
                                                   visible: false,
                                                   background: "transparent",
                                                   template: "#= category #: \n #= value#%"
                                               }
                                           },
                                           series: [{
                                               type: "pie",
                                               startAngle: 150,
                                               data: [{
                                                   category: "",
                                                   value: 53.8,
                                                   color: "#00B050"
                                               },{
                                                   category: "",
                                                   value: 16.1,
                                                   color: "#FF2626"
                                               }]
                                           }],
                                           tooltip: {
                                               visible: true,
                                               format: "{0}%"
                                           }
                                           //,
                                           //seriesClick: onSeriesClick
                                       });
                                   }

$(document).ready(createChart);
$(document).bind("kendo:skinChange", createChart);
function createChart() {
    $("#_GraficaInter").kendoChart({
        theme: "metro",
        chartArea: { background: "transparent" },
        title: {
            text: ""
        },
        legend: {
            position: "bottom"
        },
        seriesDefaults: {
            type: "column"
        },
        series: [{
            name: "Disponiblidad",
            data: [75],
            color: "#265CFF"
        }, {
            name: "Calidad",
            data: [25],
            color: "#00BFFF"
        }, {
            name: "Desempeño",
            data: [89],
            color: "#00D900"
        }],
        valueAxis: {
            labels: {
                format: "{0}%"
            },
            line: {
                visible: false
            },
            axisCrossingValue: 0
        },
        categoryAxis: {
            categories: [],
            line: {
                visible: false
            },
            labels: {
                padding: { top: 135 }
            }
        },
        tooltip: {
            visible: true,
            format: "{0}%",
            template: "#= series.name #: #= value #"
        }
    });
}

$(document).ready(createChart);
$(document).bind("kendo:skinChange", createChart);


$(document).ready(function () {

    var p = false;
    $(".abajo").click(function () {
        if (p == false) {

            $("#panelbottom2").animate({ top: '+=3%' }, 200);
            $("#panelbottom").animate({ bottom: '+=97%' }, 200);
            p = true;
        }
        else {
            $("#panelbottom2").animate({ top: '-=3%' }, 200);
            $("#panelbottom").animate({ bottom: '-=97%' }, 200);
            p = false;
        }



    });



    
    $(".derecha").click(function () {
     
        if (b == false) {

            $("#panelder2").animate({ left: '+=40%' }, 200);
            $("#panelder").animate({ right: '+=75%' }, 200);
            b = true;
        }
        else {
            $("#panelder2").animate({ left: '-=40%' }, 200);
            $("#panelder").animate({ right: '-=75%' }, 200);
            b = false;
        }      



    });




    
    
    $(".eatpanel").click(function () {
      
        if (r == false) {

            $("#panelbrake2").animate({ right: '+=40%' }, 200);
            $("#panelbrake").animate({ left: '+=60%' }, 200);
            r = true;
        }
        else {
            $("#panelbrake2").animate({ right: '-=40%' }, 200);
            $("#panelbrake").animate({ left: '-=60%' }, 200);
            r = false;
        }      



    });

    

    

     var nob = false;
    $(".nobien").click(function () {
        if (nob == false) {

            
            $("#nobien").animate({ right: '+=108%' }, 200);
            nob = true;
        }
        else {
            
            $("#nobien").animate({ right: '-=108%' }, 200);
            nob = false;
        }      



    });

    $(".no-first").click(function () {
        if (nob == true) {

            $("#nobien").animate({ right: '-=108%' }, 200);
            nob = false;
        }
}); 
    

    var len = false;
    $(".lento").click(function () {
        if (len == false) {

            $("#lento").animate({ left: '+=108%' }, 200);
            len = true;
        }
        else {
            
            $("#lento").animate({ left: '-=108%' }, 200);
            len = false;
        }      



    });
    $(".no-slow").click(function () {
        if (len == true) {

            $("#lento").animate({ left: '-=108%' }, 200);
            len = false;
        }
}); 


$("#close-down").click(function () {
   $("#panelkeyboard").animate({ left: '-=60%' }, 200);     
  r=false;

    });
    // panel capas 

    var a = false;
    $("#izquierda1").click(function () {
        if (a == false) {

            $("#btniz").animate({ left: '+=60%' }, 200);
            $("#panelizqui").animate({ left: '+=60%' }, 200);
            a = true;
        }
        else {
            $("#btniz").animate({ left: '-=60%' }, 200);
            $("#panelizqui").animate({ left: '-=60%' }, 200);
            a = false;
        }



    });




});
       
      
function getKeys(id,name) {
      $('#'+id).focus();
      jQuery214('#softk').attr('data-target', 'input[name="'+name+'"]');
        if (r == false) {

            
            $("#panelkeyboard").animate({ left: '+=60%' }, 200);
            r = true;
        }
        else {
            
            
            r = true;
        } 
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
                            ['0',')'],
                           
                            
                            '←',
                            'GUARDAR'
                        ]
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
    jQuery214('#savekey').parent('.softkeys__btn').addClass('saver');            
jQuery214('#borrar-letras').parent('.softkeys__btn').addClass('large');
            jQuery214('#borrar-softkeys').parent('.softkeys__btn').addClass('large');
    }

  function saveOperstatus(){
        
    
         $.ajax({  
                      
                     type:"POST",
                     url:"operstatus.php",   
                     data:{section:'tiro'},  
                       
                     success:function(data){ 
                          console.log(data);
                     }  
                });
    } 

    function saveoperAlert(){
        
    localStorage.setItem('alertTime', currentSeconds());
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
        
    
         $.ajax({  
                      
                     type:"POST",
                     url:"operstatus.php",   
                     data:{section:'comida'},  
                       
                     success:function(data){ 
                          console.log(data);
                     }  
                });
    }