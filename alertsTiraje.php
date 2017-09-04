<?php


switch ($_SESSION['mac']){
    case 'corte':
    include("areas/maquinas/corte/ajustecorte.php");
    //header('Location: home.php');
    //echo $nommaquina;
        break;
  case '5c:f5:da:2f:33:5e':
       $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Faltante de Papel';
       $options[]= 'Papel Incorrecto' ;
       $options[]= 'Papel Impreso mal Registrado' ;
        break;




  case '90:b9:31:ed:0f:6b':



         $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Se Movio el Registro';
       $options[]= 'Es Bolsa' ;
       $options[]= 'Fallo de la Maquina' ;
    //echo $nommaquina;
        break;
  case '2c:f0:ee:3d:53:99':
        $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Se Movio el Registro';
       $options[]= 'Es Bolsa' ;
       $options[]= 'Fallo de la Maquina' ;
       //$options5= 'Falta Matrix' ;
        break;
  case 'f0:db:f8:11:97:bc':
        $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Fallo de Maquina';
       $options[]= 'Se Movio el Registro' ;
       $options[]= 'Tamaño Incorrecto de la Placa' ;
       
    //de aqui para abajo no los llene aun
        break;
  case 'Hot Stamping 2':
        $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Material Incompleto';
       $options[]= 'Falta Placa' ;
       $options[]= 'Falta Albanene' ;
       $options[]= 'Falta Pelicula';
    //echo $nommaquina;
        break;
  case 'b0:34:95:01:ec:2b':
         $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Fallo de Maquina';
       $options[]= 'Mal Ajuste' ;
       $options[]= 'Basura en la Area' ;
       
    //echo $nommaquina;
        break;
    case 'Offset':
        $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Falta Lampara';
       $options[]= 'Falta Tinta' ;
       $options[]= 'Material Incompleto' ;
       $options[]= 'Ajuste de Maquina';
       $options[]= 'Laminas en Mal Estado';
     //echo $nommaquina;
        break;
  case 'Placa':
            
        $options[]='ODT Confusa';
       $options[]='ODT Faltante' ;
       $options[]= 'Falta Albanene';
       $options[]= 'Material Incompleto' ;
            

     //echo $nommaquina;
        break;
    ////// cambio de area
  case '34:e2:fd:dd:d0:7b':
        $options[]='Papel maltratado';
       $options[]='Tirar basura' ;
       $options[]= 'Papel mal registrado';
       
     //echo $nommaquina;
        break;
  case 'Serigrafia 2':
            include("areas/serigrafia/serigrafia2/ajusteserigrafia2.php");
     //echo $nommaquina;
        break;
  case 'Serigrafia 3':
                include("areas/serigrafia/serigrafia3/ajusteserigrafia3.php");
     //echo $nommaquina;
        break;
  case 'Mesa 1':
                include("areas/serigrafia/mesa1/ajustemesa1.php");
     //echo $nommaquina;
        break;
  case 'Mesa 2':
            include("areas/serigrafia/mesa2/ajustemesa2.php");
     //echo $nommaquina;
        break;
}
?>               
                    
                    <?php  
                    $i=0;
                    foreach ($options as $option) { ?>
                    <div class=" radio-menu face">
                       <input type="radio" name="radios" id="radios-<?php echo $i; ?>" value="<?=$option; ?>">
                       <?php echo $option; ?>
                       </div>
                   <?php $i++; } ?>
                    
                    
                    
               