<?php
if( !session_id() )
{
    session_start();
}
if(@$_SESSION['logged_in'] == true){
   header('Location:http:'.dirname($_SERVER['PHP_SELF']).'/index2.php');
}else{
    ?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="css/estilos.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="./main.js"></script>
    <script type="text/javascript" src="./llqrcode.js"></script>

    
</head>
<body>
    
    
<style >/*
    select{
        width: 100%;
    background: #fff;
    border-radius: 2px;
    padding: 7px;
    border: none;
    margin-top: 15px;
    text-align: center!important;
    font-size: 30px;
    font-family: "monse-medium";
    }
    */
</style>

   
   

    

    <div class="container">
        <div class="login-box">
        <div class="login-inner">
          <form  action="validar.php" method="post">
        <div class="login-logo">
             <img src="images/logo-blanco.png" >
        </div>
        <!--
        <select name="maquina" required="true">
        <option   disabled="true" selected="true" value="">Selecciona el area</option>
            <option value="5c:f5:da:2f:33:5e">CORTE</option>
            <option value="90:b9:31:ed:0f:6b">SUAJE</option>
            <option value="34:e2:fd:dd:d0:7b">SERIGRAFIA</option>
            <option value="b0:34:95:01:ec:2b">ACABADO</option>
           
        </select> -->
            <input id="usuario" name="usuario" type="text" placeholder="USUARIO" class="login-input" required="" />
            <input id="password" name="pass" type="password" placeholder="CONTRASEÑA" class="login-input" required="" />
            <button id="singlebutton" value="login" name="singlebutton" class="login-button">ENTRAR</button>
            </form>
        </div>
            
        </div>

    </div> 
    <script type="text/javascript">load();</script>
    <script src="./jquery-1.11.2.min.js"></script>
</body>
</html>
<?php } ?>