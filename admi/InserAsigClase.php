<?php include '../extends/headerphp.php';
        include '../extends/alerta.php';

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $grupo = htmlentities($_POST['grupo']);
        $NoDocente = htmlentities($_POST['NoDocente']);
        /* busqueda de usuarios y de tabla docente */
        $SelecDocente = $Con->prepare('SELECT COUNT(*) FROM user WHERE identificacion =  ?');
            $SelecDocente->execute(array($NoDocente));
        if($SelecDocente->fetchColumn() > 0){
            $SelecDocente = null;

            $ClaseDisponible = $Con->prepare('SELECT COUNT(*) FROM docente WHERE CodigoGrupo =  ?');
                $ClaseDisponible->execute(array($grupo));

            if($ClaseDisponible->fetchColumn() == 0 ){
                $ClaseDisponible = null;

                $SelecDocente = $Con->prepare('SELECT CodigoUser FROM user WHERE Identificacion =  ?');
                    $SelecDocente->execute(array($NoDocente));
                    $Fila = $SelecDocente->fetch();
                $SelecDocente = null;

                $CodigoUser = $Fila['CodigoUser'];

                $InserAsigClase = $Con->prepare('INSERT INTO docente VALUES(DEFAULT, :CodigoUser, :grupo)');
                    $InserAsigClase->bindparam(':CodigoUser',$CodigoUser);
                    $InserAsigClase->bindparam(':grupo',$grupo);
                if($InserAsigClase->execute()){
                    $InserAsigClase = null;
                    $Con = null;
                    echo alerta('Asignacion EXITOSA','AsignarClase.php');
                }else{
                    echo alerta('Error Asignado DOCENTE','AsignarClase.php');
                }
            }else{
                echo alerta('Clase YA AGIGNADA, por favor verificar','AsignarClase.php');
            }
            
        }else{
            echo alerta('Al parecer el numero ingresado NO EXISTE REGISTRADO','AsignarClase.php');
        }
    }else{
        echo alerta('Utiliza el formulario','AsignarClase.php');
    }
?>
<?php include '../extends/footer.php'; ?>

</body>
</html>