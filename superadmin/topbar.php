
    <header>
    <div class="menu_bar">
      <a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
    </div>
  <nav>
      <ul>
      <li class="nohover" style=""><span class="button-labels"><div class="logo-ul"><img  src="../images/white-logo.png"></div></span>

      <!-- <li class="nohover"><span class="labels">Bienvenido: <?=$_SESSION['logged_in']; ?></span></li> -->
      </li><li><a href="reporteindex.php">Inicio</a>
      </li><li><a href="production.php"><span class="icon-stats-bars"></span>Producción</a>
        </li><li><a href="repordenes.php"><span class="icon-clipboard"></span>Ordenes</a>
        </li><li class="submenu">
          <a href="#"><span class="icon-cog"></span>Maquinas<span class="caret icon-arrow-down6"></span></a>
          <ul class="children">
          <li><a href="repajustemaquina.php">Ajuste <span class="icon-cogs"></span></a></li>
            <li><a href="RepAlertAjuste.php">Alerta Ajuste<span class="icon-warning"></span></a></li>
                        <li><a href="reptirajemaquina.php">Tiraje<span class="icon-hammer"></span></a></li>
                        <li><a href="repalertmaquina.php"> Alerta Maquina <span class="icon-warning"></span></a></li>
            <li><a href="repencuesta.php">Encuesta<span class="icon-question"></span></a></li>
                        
          </ul>
        
                
        
        
        <!--
        <li class="submenu" hidden>
          <a href="#"><span class="icon-droplet"></span>Serigrafía<span class="caret icon-arrow-down6"></span></a>
          <ul class="children">
            <li><a href="#">Ajuste <span class="icon-cogs"></span></a></li>
            <li><a href="#">Alerta Seriegrafía <span class="icon-warning"></span></a></li>
            <li><a href="#">Tiraje<span class="icon-hammer"></span></a></li>
                        <li><a href="#">Encuesta<span class="icon-question"></span></a></li>
          </ul></li>
        <li class="lefting nohover">
          <span class="labels"><?php $fecha = strftime( "%Y-%m-%d", time() ); echo $fecha; ?></span>
        </li>

        <li class="lefting nohover">
          <span class="labels"><div id="hora" ></div></span>
        </li> -->
        
        <!--<li><a href="#"><span class="icon-earth"></span>Servicios</a></li>-->
        <!--<li><a href="#"><span class="icon-mail"></span>Contacto</a></li> -->
       </li><li><a href="estandares.php">Estandares</a>
       </li><li><a href="programacion.php">Programacion</a></li>
       <li class="lefting ">

         <a class="" href="logoutadmin.php" style="color:#fff;"><span class="icon-exit"></span> Salir</a>
        </li>  
      </ul>
    </nav>
     
  </header>
   
 
