
<html> 
<head> 
<script language="javascript"> 
function opera(){ 
var cantidad = document.all.cantidad.value; 
var buenos = document.all.buenos.value;	

 resta =  (cantidad - buenos) ;
 document.getElementById("resultado2").value = resta;

} 
</script> 




</head> 
<body> 


cantidad recibida<input type="text" id="cantidad" value="200" disabled/> <br>

buenos <input type="text" id="buenos" /> 


 <br>

  defectos <input  id="resultado2" value="0" disabled/> 

  <br>

merma <input type="text" onclick="opera();" value=""> 


</body> 
</html> 
