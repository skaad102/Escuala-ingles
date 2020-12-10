<?php
include '../extends/headerphp.php';
include '../extends/alerta.php';


$CodigoDocente = htmlentities($_GET['CodigoDocente']);


$EliminarDocente = $Con->prepare('DELETE FROM docente WHERE CodigoDocente = :CodigoDocente');
   $EliminarDocente->bindparam(':CodigoDocente', $CodigoDocente);

   if($EliminarDocente->execute()){
        
        $EliminarDocente = null;
        $Con = null;

        echo alerta('Registro Eliminado','ListaClase.php');
   }else{
       echo alerta('Erro eliminando Program','ListaClase.php');
   }



?>