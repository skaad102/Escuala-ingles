<?php
include '../extends/headerphp.php';
include '../extends/alerta.php';


$CodigoGrupo = htmlentities($_GET['CodigoGrupo']);
$CodigoHorario = htmlentities($_GET['CodigoHorario']);


$EliminarHorario = $Con->prepare('DELETE FROM horario WHERE CodigoHorario = :CodigoHorario');
   $EliminarHorario->bindparam(':CodigoHorario', $CodigoHorario);

$EliminarGrupo = $Con->prepare('DELETE FROM grupo WHERE CodigoGrupo = :CodigoGrupo');
   $EliminarGrupo->bindparam(':CodigoGrupo', $CodigoGrupo);

$EliminarDocente = $Con->prepare('DELETE FROM docente WHERE CodigoGrupo = :CodigoGrupo');
   $EliminarDocente->bindparam(':CodigoGrupo', $CodigoGrupo);

   if($EliminarHorario->execute()){
        $EliminarGrupo->execute();
        $EliminarDocente->execute();
        

        $ElimiProgram = null;
        $EliminarHorario = null;
        $EliminarGrupo = null;
        $EliminarDocente = null;
        $Con = null;

        echo alerta('Registro Eliminado','ListaClase.php');
   }else{
       echo alerta('Erro eliminando Program','ListaClase.php');
   }



?>