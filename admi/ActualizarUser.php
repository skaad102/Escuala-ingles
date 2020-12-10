<?php include '../extends/headerphp.php';
    include '../extends/alerta.php';

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $CodigoUser = htmlentities($_POST['CodigoUser']);
        $CodigoCargo = htmlentities($_POST['CodigoCargo']);
        $NombreFuncionario = htmlentities($_POST['NombreFuncionario']);
        $Noindentificacion = htmlentities($_POST['Noindentificacion']);
        $pasw1 = htmlentities($_POST['pasw1']);
        $pasw2 = htmlentities($_POST['pasw2']);
        $UserFuncionario = htmlentities($_POST['UserFuncionario']);
        $Sede = htmlentities($_POST['Sede']);
        $MovilFuncionario = htmlentities($_POST['MovilFuncionario']);
        $Cargo = htmlentities($_POST['Cargo']);

        if($pasw1 == $pasw2){
            $ActuUser = $Con->prepare('UPDATE user SET Identificacion = :Noindentificacion, NombreUser = :UserFuncionario, pass = :pasw1, NombrePersonal = :NombreFuncionario,
                        TelefonoPersonal = :MovilFuncionario WHERE CodigoUser = :CodigoUser');
                $ActuUser->bindparam(':CodigoUser',$CodigoUser);
                $ActuUser->bindparam(':Noindentificacion',$Noindentificacion);
                $ActuUser->bindparam(':UserFuncionario',$UserFuncionario);
                $ActuUser->bindparam(':pasw1',$pasw1);
                $ActuUser->bindparam(':NombreFuncionario',$NombreFuncionario);
                $ActuUser->bindparam(':MovilFuncionario',$MovilFuncionario);
            if($ActuUser->execute()){
                $ActuCargo = $Con->prepare('UPDATE cargo SET rol = :Cargo WHERE CodigoUser = :CodigoUser AND CodigoCargo =:CodigoCargo');
                    $ActuCargo->bindparam(':CodigoUser',$CodigoUser);
                    $ActuCargo->bindparam(':CodigoCargo',$CodigoCargo);
                    $ActuCargo->bindparam(':Cargo',$Cargo);
                $ActuCargo->execute();

                $ActuUser = null;
                $ActuCargo = null;
                $Con = null;      

                echo alerta('Actualizacion Completa','ListaUsuarios.php');
            }else{
                $ActuUser = null;
                $Con = null;
                echo alerta('No se pudo Actualizar el usuario','EditarUser.php?CodigoUser='.$CodigoUser.'');
            }
        }else{
            echo alerta('Contraseñas no coinciden','EditarUser.php?CodigoUser='.$CodigoUser.'');
        }

    }else{
        echo alerta('Utilizar el Formulario','ListaUsuarios.php');
    }
?>

</body>
</html>