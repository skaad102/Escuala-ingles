<?php
    include '../extends/headerphp.php';
    include '../extends/alerta.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $NombreFuncionario = htmlentities($_POST['NombreFuncionario']);
        $Noindentificacion = htmlentities($_POST['Noindentificacion']);
        $pasw1 = htmlentities($_POST['pasw1']);
        $pasw2 = htmlentities($_POST['pasw2']);
        $UserFuncionario = htmlentities($_POST['UserFuncionario']);
        $Sede = htmlentities($_POST['Sede']);
        $MovilFuncionario = htmlentities($_POST['MovilFuncionario']);
        $Cargo = htmlentities($_POST['Cargo']);

        if($pasw1 == $pasw2){
            /* Buscar Datos repetidos en la BD */
            $BuscUser = $Con->prepare('SELECT COUNT(*) FROM user WHERE Identificacion = :Iduser || NombreUser = :UserFuncionario');
                $BuscUser->bindparam(':Iduser',$Noindentificacion);
                $BuscUser->bindparam(':UserFuncionario',$UserFuncionario);
                    if($BuscUser->execute()){
                        if($BuscUser->fetchColumn() < 1){
                            /* Insertar BD user */
                            $InsetUser = $Con->prepare('INSERT INTO user VALUES(DEFAULT, :Noindentificacion, :UserFuncionario, :pasw1, :NombreFuncionario, :MovilFuncionario )');
                                $InsetUser->bindparam(':Noindentificacion',$Noindentificacion);
                                $InsetUser->bindparam(':UserFuncionario',$UserFuncionario);
                                $InsetUser->bindparam(':pasw1',$pasw1);
                                $InsetUser->bindparam(':NombreFuncionario',$NombreFuncionario);
                                $InsetUser->bindparam(':MovilFuncionario',$MovilFuncionario);
                                if($InsetUser->execute()){
                                    $IdCodigoUSer = $Con->lastInsertId();

                                    $InserCargo = $Con->prepare('INSERT INTO cargo VALUES(DEFAULT, :CodigoUser, :CodigoCiudad, :rol )');
                                        $InserCargo->bindparam(':CodigoUser',$IdCodigoUSer);
                                        $InserCargo->bindparam(':CodigoCiudad',$Sede);
                                        $InserCargo->bindparam(':rol',$Cargo);
                                        
                                        if($InserCargo->execute()){
                                            $BuscUser= null;
                                            $InsetUser= null;
                                            $InserCargo= null;
                                            $Con = null;
                                            echo alerta('Guardado Exitosamente', 'NuevoUsuario.php');
                                        }else{
                                            echo alerta('Error cargo','NuevoUsuario.php');
                                        }                                               
                                }else{
                                    echo alerta('Error Guardado user','NuevoUsuario.php');
                                }
                        }else{
                            echo alerta('Al parecer ya exixte el usuario o Usuername Repetido','NuevoUsuario.php');
                        }
                    }else{
                        echo alerta('Error en la busqueda','NuevoUsuario.php');           
                    }
        }else{
            echo alerta('Contraseñas no Coinciden','NuevoUsuario.php');
        }

    }else{
        echo alerta('Utilizar el Formulario','NuevoUsuario.php');
    }
?>

</body>
</html>