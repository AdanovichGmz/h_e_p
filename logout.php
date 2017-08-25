<?php 

if( !session_id() )
{
    session_start();
}

session_destroy();

?>

<script>
   //alert("la session se ha cerrado correctamente");
   //self.location.replace("index.php");

    setTimeout(function() {   
 	self.location.replace("index.php");
                                                  }, 1000);
   
</script>

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
    <?php
if( !session_id() )
{
    session_start();
}
if(@$_SESSION['logged_in'] == true){
   // header("Location: index.php");
}
    ?>
    

    

    <div class="container">
        <div id="loader"><br><br><br><br><br><br><br>
        <p>CERRANDO SESIÓN</p>
        <div id="loader-inner"><img src="images/loader.gif"></div>
        	
        </div>

    </div> 
    <script type="text/javascript">load();</script>
    <script src="./jquery-1.11.2.min.js"></script>
</body>
</html>
