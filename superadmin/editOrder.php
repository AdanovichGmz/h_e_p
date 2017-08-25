<div class="big-box-large2"><div class="close2">x</div>
  <div class="modal-form-large">
  <p id="order" style="text-align: center; font-weight: bold;"></p>
    <form id="update-order" method="post" onsubmit="editOrder();">
    <input type="hidden" name="action" value="update">
    <input type="text" id="odt" name="odt" placeholder="ODT" required="true">
    
    
   
    <input type="text" id="product" name="product" placeholder="Producto" required="true">
    <input type="text" id="recibido" name="recibido" placeholder="Cantidad Recibida" required="true">
    <input type="text" id="pedido" name="pedido" placeholder="Cantidad de Pedido" required="true">
    <input type="text" class="tree" id="fc" name="prioridad" placeholder="Orden de Prioridad" >
    <input type="text" class="tree" id="datepicker" name="inicio" placeholder="Fecha Inicio" required="true">
     <input type="text" class="tree" id="datepicker2" name="fin" placeholder="Fecha Fin" required="true">
     <br>
     <br>
     <p style="text-align: center; font-weight: bold;">----- Procesos ------</p>
     <br>
     <div class="inputs">
       <div id="Original" class="checgroup">
         <div class="checkicon"   onclick="checking('Original');">
         </div>
         <div class="checktext">Ori</div>
         <input type="checkbox" value="Original" name="procesos[]">
         <div id="iteration-Original" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Original')"></div>
         <div   class="more" onclick="moreProcess('Original')"></div>
       </div>
       </div>
       <div id="Positivo" class="checgroup">
         <div class="checkicon"   onclick="checking('Positivo');">
         </div>
         <div class="checktext">Pos</div>
         <input type="checkbox" value="Positivo" name="procesos[]">
         <div id="iteration-Positivo" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Positivo')"></div>
         <div   class="more" onclick="moreProcess('Positivo')"></div>
       </div>
       </div>
       <div id="Placa" class="checgroup">
         <div class="checkicon"   onclick="checking('Placa');">
         </div>
         <div class="checktext">Pla</div>
         <input type="checkbox" value="Placa" name="procesos[]">
         <div id="iteration-Placa" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Placa')"></div>
         <div   class="more" onclick="moreProcess('Placa')"></div>
       </div>
       </div>
       <div id="Placa_HS" class="checgroup">
         <div class="checkicon"   onclick="checking('Placa_HS');">
         </div>
         <div class="checktext">PHS</div>
         <input type="checkbox" value="Placa_HS" name="procesos[]">
         <div id="iteration-Placa_HS" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Placa_HS')"></div>
         <div   class="more" onclick="moreProcess('Placa_HS')"></div>
       </div>
       </div>
       <div id="LaminaOff" class="checgroup">
         <div class="checkicon"   onclick="checking('LaminaOff');">
         </div>
         <div class="checktext">Loff</div>
         <input type="checkbox" value="LaminaOff" name="procesos[]">
         <div id="iteration-LaminaOff" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('LaminaOff')"></div>
         <div   class="more" onclick="moreProcess('LaminaOff')"></div>
       </div>
       </div>
       <div id="Corte" class="checgroup">
         <div class="checkicon"   onclick="checking('Corte');">
         </div>
         <div class="checktext">Cor</div>
         <input type="checkbox" value="Corte" name="procesos[]">
         <div id="iteration-Corte" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Corte')"></div>
         <div   class="more" onclick="moreProcess('Corte')"></div>
       </div>
       </div>
       <div id="Revelado" class="checgroup">
         <div class="checkicon"   onclick="checking('Revelado');">
         </div>
         <div class="checktext">Rev</div>
         <input type="checkbox" value="Revelado" name="procesos[]">
         <div id="iteration-Revelado" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Revelado')"></div>
         <div   class="more" onclick="moreProcess('Revelado')"></div>
       </div>
       </div>
       <div id="Laser" class="checgroup">
         <div class="checkicon"   onclick="checking('Laser');">
         </div>
         <div class="checktext">Las</div>
         <input type="checkbox" value="Laser" name="procesos[]">
         <div id="iteration-Laser" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Laser')"></div>
         <div   class="more" onclick="moreProcess('Laser')"></div>
       </div>
       </div>
       <div id="Suaje" class="checgroup">
         <div class="checkicon"   onclick="checking('Suaje');">
         </div>
         <div class="checktext">Suaj</div>
         <input type="checkbox" value="Suaje" name="procesos[]">
         <div id="iteration-Suaje" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Suaje')"></div>
         <div   class="more" onclick="moreProcess('Suaje')"></div>
       </div>
       </div>
       <div id="Serigrafia" class="checgroup">
         <div class="checkicon"   onclick="checking('Serigrafia');">
         </div>
         <div class="checktext">Serig</div>
         <input type="checkbox" value="Serigrafia" name="procesos[]">
         <div id="iteration-Serigrafia" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Serigrafia')"></div>
         <div   class="more" onclick="moreProcess('Serigrafia')"></div>
       </div>
       </div>
       <div id="Offset" class="checgroup">
         <div class="checkicon"   onclick="checking('Offset');">
         </div>
         <div class="checktext">Off</div>
         <input type="checkbox" value="Offset" name="procesos[]">
         <div id="iteration-Offset" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Offset')"></div>
         <div   class="more" onclick="moreProcess('Offset')"></div>
       </div>
       </div>
       <div id="Digital" class="checgroup">
         <div class="checkicon"   onclick="checking('Digital');">
         </div>
         <div class="checktext">Dig</div>
         <input type="checkbox" value="Digital" name="procesos[]">
         <div id="iteration-Digital" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Digital')"></div>
         <div   class="more" onclick="moreProcess('Digital')"></div>
       </div>
       </div>
       <div id="LetterPres" class="checgroup">
         <div class="checkicon"   onclick="checking('LetterPres');">
         </div>
         <div class="checktext">Lpr</div>
         <input type="checkbox" value="LetterPres" name="procesos[]">
         <div id="iteration-LetterPres" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('LetterPres')"></div>
         <div   class="more" onclick="moreProcess('LetterPres')"></div>
       </div>
       </div>
       <div id="Plastificado" class="checgroup">
         <div class="checkicon"   onclick="checking('Plastificado');">
         </div>
         <div class="checktext">Plas</div>
         <input type="checkbox" value="Plastificado" name="procesos[]">
         <div id="iteration-Plastificado" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Plastificado')"></div>
         <div   class="more" onclick="moreProcess('Plastificado')"></div>
       </div>
       </div>
       <div id="Encuaderna" class="checgroup">
         <div class="checkicon"   onclick="checking('Encuaderna');">
         </div>
         <div class="checktext">Enc</div>
         <input type="checkbox" value="Encuaderna" name="procesos[]">
         <div id="iteration-Encuaderna" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Encuaderna')"></div>
         <div   class="more" onclick="moreProcess('Encuaderna')"></div>
       </div>
       </div>
       <div id="HotStamping" class="checgroup">
         <div class="checkicon"   onclick="checking('HotStamping');">
         </div>
         <div class="checktext">HS</div>
         <input type="checkbox" value="HotStamping" name="procesos[]">
         <div id="iteration-HotStamping" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('HotStamping')"></div>
         <div   class="more" onclick="moreProcess('HotStamping')"></div>
       </div>
       </div>
       <div id="Grabado" class="checgroup">
         <div class="checkicon"   onclick="checking('Grabado');">
         </div>
         <div class="checktext">Grab</div>
         <input type="checkbox" value="Grabado" name="procesos[]">
         <div id="iteration-Grabado" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Grabado')"></div>
         <div   class="more" onclick="moreProcess('Grabado')"></div>
       </div>
       </div>
       <div id="Pleca" class="checgroup">
         <div class="checkicon"   onclick="checking('Pleca');">
         </div>
         <div class="checktext">Ple</div>
         <input type="checkbox" value="Pleca" name="procesos[]">
         <div id="iteration-Pleca" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Pleca')"></div>
         <div   class="more" onclick="moreProcess('Pleca')"></div>
       </div>
       </div>
       <div id="Acabado" class="checgroup">
         <div class="checkicon"   onclick="checking('Acabado');">
         </div>
         <div class="checktext">Acab</div>
         <input type="checkbox" value="Acabado" name="procesos[]">
         <div id="iteration-Acabado" class="iteration" style="display: none;">1</div>
          <div class="controls">
                  <div   class="less" onclick="lessProcess('Acabado')"></div>
         <div   class="more" onclick="moreProcess('Acabado')"></div>
       </div>
       </div>
       
      


     </div>
     
  <br>
    <br> 
    <input type="submit" value="Guardar">
  </form>
  <div id="saveload2" style="display: none;"><img src="../images/loader.gif"></div>
  </div>
  </div>