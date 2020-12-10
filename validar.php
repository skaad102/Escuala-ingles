<?php
    include 'conexion/conexion.php';
    include 'extends/headerphpLog.php';
    include 'extends/alerta.php';
 

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $Usuario = htmlentities($_POST['usuario']);
        $Pass = htmlentities($_POST['pass']);
        $Cargo = htmlentities($_POST['Cargo']);

        /* Buscar Datos que coincidan */
        $selec = $Con->prepare('SELECT COUNT(*) FROM user U INNER JOIN cargo C ON U.CodigoUser = C.CodigoUser WHERE 
                                U.NombreUser = :usuario AND U.pass = :pass AND C.rol = :rol');
            $selec->bindparam(':usuario',$Usuario);
            $selec->bindparam(':pass',$Pass);
            $selec->bindparam(':rol',$Cargo);

            $selec->execute();
                if($selec->fetchColumn() > 0){
                    $selec = null;
                    $Con = null;
                    switch ($Cargo) {
                        case 'Administrador':
                        session_start();
                        $_SESSION['Admi'] = $Usuario;
                            header("location:admi/index.php");
                            break;
                        case 'Secretaria':
                        session_start();
                        $_SESSION['Secretaria'] = $Usuario;
                            header("location:Secr/index.php");
                            break;
                        case 'Docente':
                        session_start();
                        $_SESSION['Docente'] = $Usuario;
                            header("location:Doce/index.php");
                            break;
                    }
                    
                }elseif ($Usuario == null || $Pass == null) {
                    echo alerta('Datos Incompletos','index.php');                    
                } else{
                    echo alerta('Datos Incorrectos','index.php');
                }
            $selec = null;
            $Con = null;
    }else{
        echo alerta('Utiliza el Loging','index.php');
    }
    
?>

</body>
</html>