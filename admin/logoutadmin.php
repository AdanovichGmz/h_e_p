<?php

if( !session_id() )
{
    session_start();
}

session_destroy();

?>

<script>
    alert("la session se ha cerrado correctamente");
    self.location.replace("../index.php");
</script>
