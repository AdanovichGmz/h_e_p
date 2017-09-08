 <?php
if( !session_id() )
{
    session_start();
    

}
if(@$_SESSION['logged_in'] != true){
    echo '
     <script>
        alert("No has iniciado sesion");
        self.location.replace("../index.php");
    </script>';
}else{
    echo '';
}
    ?>


     <?php
     require('../saves/conexion.php');
        function getProcess($id){
         require('../saves/conexion.php');
        $maq_query="SELECT nommaquina FROM maquina WHERE idmaquina=$id";
        
        $getmaq=mysqli_fetch_assoc($mysqli->query($maq_query));
        $maq=$getmaq['nommaquina'];
        echo $maq;
      }
      function getElement($id){
         require('../saves/conexion.php');
        $elem_query="SELECT nombre_elemento FROM elementos WHERE id_elemento=$id";
        
        $getelem=mysqli_fetch_assoc($mysqli->query($elem_query));
        $elem=$getelem['nombre_elemento'];
        return $elem;
      }
      function getMinutes($seconds){

      } 
  
     $maquinas="SELECT nommaquina, idmaquina FROM maquina";
    $n_maquinas=$mysqli->query($maquinas);
    $usuarios="SELECT * FROM elementos";
      $n_usuarios=$mysqli->query($usuarios);


    $elem_filter="SELECT id_elemento FROM estandares GROUP BY id_elemento";
    $filter=$mysqli->query($elem_filter);

    $maq_filter="SELECT idmaquina, nommaquina FROM maquina ORDER BY nommaquina ASC";
    $filter2=$mysqli->query($maq_filter);

    ?>



  
<!DOCTYPE html>

<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>

    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>ESTANDARES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  

    <link href="../css/estilosadmin.css" rel="stylesheet" />

   
      <link rel="stylesheet" href="../fonts/style.css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="../js/main.js"></script>




<script type="text/javascript">
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
</script>



<style type="text/css">
  body {
  font: normal medium/1.4 sans-serif;
}
      table {
  border-collapse: collapse;
  text-align: center;
  margin: auto;
  background-color: #fff;
}
thead td{
  color: #545A8E;
}

th, td {
  padding: 0.25rem;
  border: 1px solid #E6E8E7!important;
 /* border: 1px solid black; */
}
tbody tr:nth-child(odd) {
  background: #F9F9F9;
}
tr input{
  color:#545A8E;
  text-align: center;
  border:none;
  border-radius: 3px;
  padding: 3px;
  background: #EFEFEF ;
border: 1px solid #CACACA; 
}

#buscar{
  width: 300px;
  font-size: 18px;
  color:black;
  background: #383838 ;
  padding-left: 20px ;
  text-align: center;
  border-radius: 5px;
  padding: 10px;
  margin:10px; 
}
td{
  vertical-align: middle !important;
}
.conttabla2{
      width: 98%; 
    height: 80%; 
    position: absolute; 
    overflow: auto; 
    
    left: 1%;
    color: #00927B;
}
.left-form2{
  width: 20%!important;
}
.left-form{
 width: 30%!important; 
}
.tDnD_whileDrag{
  background: #2980B9!important;
 
  -webkit-box-shadow: 3px 4px 18px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 3px 4px 18px 0px rgba(0,0,0,0.75);
box-shadow: 3px 4px 18px 0px rgba(0,0,0,0.75);
}
.tDnD_whileDrag td{
   border-bottom:1px solid #fff!important;
   border-top:1px solid #fff!important;
   color: #fff;
}
.remark{
  background: #2980B9!important;
  -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
    color: #fff;
}
.remark td{
   border-bottom:1px solid #fff!important;
   border-top:1px solid #fff!important;
}
#noresults{
  color: #FF4945; position: absolute;
}
.timer-container{
  width: 100%;
  height: 80px;
  line-height: 80px;
  font-size: 20px;
  color: #00927B
}

  </style>
  
</head>
<body style=";">

<?php include("topbar.php");  ?>


<form id="sort-form" method="post" onsubmit="saveSort()">
 <div class="top-form">

  <div class="left-form2">
 <div class="timer-container">
                                    <div id="chronoExample">
                                    <div id="timer"><span class="values">00:00:00</span></div>
                                    
                                   
                                </div>
                                </div>
 
 </div>
 
  <div class="left-form2">
 
   <p style="margin-bottom: 2px!important;">Filtrar por Proceso</p>
   <input type="hidden" name="activef" value="ok">
   <div class=""><select id="filterProces" name="dateFilter">
   <option disabled="true" selected="true">Elige el proceso</option>
     <?php while($rowf2=mysqli_fetch_assoc($filter2)){ ?>
     <option value="<?=getProcess($rowf2['idmaquina']); ?>"><?=$rowf2['nommaquina']; ?></option>
     <?php } ?>
   </select>
<input hidden  name="datepicker" id="fechadeldia" value="<?php echo date("d/m/Y"); ?>" />
   </div>
  
 
 </div>
 <div  class="left-form2"><button style="margin-top: 25px;" type="submit" id="newstandar" onclick="" class="btn btn-primary  disabled" disabled>GUARDAR</button></div>
 <div class="left-form"><div><input  id="goto" placeholder="Busqueda" >
 <p id="noresults" style="display: none;">No hay resultados</p>

 </div>
    
 </div>

</div>
   
<div class="div-tabla">
<?php include("tableProgram.php");  ?>
</div>

</div>







 
  <div class="backdrop"></div>
  <div class="box"><div class="close">x</div>
  <div class="modal-form">
  
  </div>



  </div>


   <div class="box2"><div class="close2">x</div>
  <div class="modal-form">
  
    
  </div>
  </div>
</form>
<script src="../js/easytimer.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>
  var timer = new Timer();
                        /* function startTime() {
                            today = new Date();
                            h = today.getHours();
                            m = today.getMinutes();
                            s = today.getSeconds();
                            m = checkTime(m);
                            s = checkTime(s);
                            document.getElementById('hora').innerHTML = h + ":" + m + ":" + s;
                            t = setTimeout('startTime()', 500);
                        } */
                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }
                        /*
                        window.onload = function() {
                            startTime();
                        } */
                        function edit(id){

                          var aid=$("#i-"+id).val();
                          var rad=$("#r-"+id).val();
                          var obs=$("#o-"+id).val();
                          var tim=$("#t-"+id).val();
                          var maq=$("#n-"+id).val();
                          $('#form').val('edit');

                          $("#order").html('Estandar: '+aid);
                          $("#fi").val(aid);
                          $("#fu").val(tim);
                          //$("#fm").val(maq);
                           $('#fp').val(rad);
                          $("#fo").val(obs);
                          $('#fm').val(maq);
                          
                        }
                        function delet(id){
                          var aid=$("#i-"+id).val();
                         
                          $("#orderdelete").html('Desea eliminar el Estandar: '+aid+' ?');
                          $("#dfi").val(aid);
                          
                        }
                     
      function saveSort(){
        event.preventDefault();
        var isValid=true;
$(".sort").each(function() {
   var element = $(this);
   if (element.val() == "") {
       isValid = false;
   }
});
       
       if (isValid==true) {
        $('.div-tabla').hide().fadeIn('slow');
         $.ajax({  
                      
                     type:"POST",
                     url:"saveSort.php",   
                     data:$('#sort-form').serialize(),  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close').click(); 
                          $('#newstandar').prop("disabled", true).addClass('disabled'); 
                          $('.div-tabla').html(data).show().fadeIn(3000);  
                          
                     }  
                }); 

       }
       else{
        alert('algun dato esta vacio');
        return false;
       }
        
        
      }


       

    

        $( "#filterProces" ).change(function() {
          timer.stop();
        var emlem_id= $( "#filterProces" ).val();
        $.ajax({  
                      
                     type:"POST",
                     url:"tableProgram.php",   
                     data:{proceso:emlem_id},  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close2').click();  
                          $('.div-tabla').html(data); 
                          reload(emlem_id); 
                     }  
                });
       


 
});
        
        function reload(emlem_id){
          timer.start({countdown: true, startValues: {seconds: 60}});

            timer.addEventListener('secondsUpdated', function (e) {
                $('#chronoExample .values').html(timer.getTimeValues().toString());
            });
            timer.addEventListener('started', function (e) {
                $('#chronoExample .values').html(timer.getTimeValues().toString());
            });  
           setInterval(function() {
            timer.start({countdown: true, startValues: {seconds: 60}});
              $('.div-tabla').hide().fadeIn('slow'); 
                  $.ajax({  
                      
                     type:"POST",
                     url:"tableProgram.php",   
                     data:{proceso:emlem_id},  
                       
                     success:function(data){ 
                       
                          //$('#update-form')[0].reset();  
                          //$('.close2').click();  
                          $('.div-tabla').html(data);
                          $('.div-tabla').html(data).show().fadeIn(3000);    
                     }  
                });
                }, 61000);

        }

        $('#goto').keypress(function(e) {
    if(e.which == 13) {
      event.preventDefault();
      $('.remark').removeClass('remark').fadeIn(3000);
      var odt=$('#goto').val();
      
      // New selector
      if (odt!=='') {
    jQuery.expr[':'].Contains = function(a, i, m) {
     return jQuery(a).text().toUpperCase()
         .indexOf(m[3].toUpperCase()) >= 0;
    };

    // Overwrites old selecor
    jQuery.expr[':'].contains = function(a, i, m) {
     return jQuery(a).text().toUpperCase()
         .indexOf(m[3].toUpperCase()) >= 0;
    };
      //$("#11").get(0).scrollIntoView();
      //$("#11").addClass('remark');
      var contain= $("tr:contains("+odt+")");
      console.log(contain.length);
      if (contain.length>0) {
        contain.addClass('remark').get(0).scrollIntoView();
      }else{
        $('#noresults').show();
        
        setTimeout(function() {   
                   $('#noresults').hide();
                }, 1000);
      }
     
      }
        //alert('You pressed enter!');
    }
});


                    </script>



 




<script type="text/javascript" src="../js/jquery.tablednd.js"></script>
<script> /*
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
                        */
                    </script>




</body>
</html>
