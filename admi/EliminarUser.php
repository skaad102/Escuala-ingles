<?php
include '../extends/headerphp.php';
include '../extends/alerta.php';

$CodigoUser = htmlentities($_GET['CodigoUser']);
$CodigoCargo = htmlentities($_GET['CodigoCargo']);


/* eliminar llave foraneas */
$EliminarCargo = $Con->prepare('DELETE FROM cargo WHERE CodigoCargo =  :CodigoCargo');
   $EliminarCargo->bindparam(':CodigoCargo', $CodigoCargo);
if($EliminarCargo->execute()){
    $EliminarUser = $Con->prepare('DELETE FROM user WHERE CodigoUser = :CodigoUser ');
    $EliminarUser->bindparam(':CodigoUser', $CodigoUser);
    if($EliminarUser->execute()){

        $EliminarCargo = null;
        $EliminarUser = null;
        $Con = null;
        echo alerta('Registro Eliminado','ListaUsuarios.php');

    }else{
        echo alerta('El usuario no pudo eliminarse','ListaUsuarios.php');
}
}else{
    echo alerta('Error eliminando cargo','ListaUsuarios.php');    
}

?>

</body>
</html>