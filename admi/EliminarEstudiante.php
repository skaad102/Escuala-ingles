<?php
include '../extends/headerphp.php';
include '../extends/alerta.php';



    $CodigoEstudiante = htmlentities($_GET['CodigoEstudiante']);
    $FotoEstudiante = htmlentities($_GET['FotoEstudiante']);


    /* eliminar llave foraneas */
    $EliminarPadre = $Con->prepare('DELETE FROM titular WHERE CodigoEstudiante =  :CodigoEstudiante');
       $EliminarPadre->bindparam(':CodigoEstudiante', $CodigoEstudiante);
    if($EliminarPadre->execute()){
        $EliminarEstudiante = $Con->prepare('DELETE FROM estudiante WHERE CodigoEstudiante = :CodigoEstudiante ');
        $EliminarEstudiante->bindparam(':CodigoEstudiante', $CodigoEstudiante);
        if($EliminarEstudiante->execute()){
           if($FotoEstudiante != '../FotoEstudiante/estudiante.png'){
                /* eliminar foto para no saturar la BD */
                 unlink($FotoEstudiante); 
            }  
            $EliminarPadre = null;
            $EliminarEstudiante = null;
            $Con = null;
            echo alerta('Registro Eliminado','NuevoEstudiante.php');

        }else{
            echo alerta('El estudiante no pudo eliminarse','NuevoEstudiante.php');
    }
    }else{
        echo alerta('Error eliminando padre','NuevoEstudiante.php');    
    }
    

?>

</body>
</html>