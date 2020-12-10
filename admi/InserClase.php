<?php include '../extends/headerphp.php';
    include '../extends/alerta.php';


    if($_SERVER['REQUEST_METHOD']== 'POST'){

        $Lunes = htmlentities($_POST['Lunes']);
        $Martes = htmlentities($_POST['Martes']);
        $Miercoles = htmlentities($_POST['Miercoles']);
        $Jueves = htmlentities($_POST['Jueves']);  
        $Viernes = htmlentities($_POST['Viernes']);
        $Sabado = htmlentities($_POST['Sabado']);
        $Domingo = htmlentities($_POST['Domingo']);
    
        $NombreClase = htmlentities($_POST['NombreClase']);
        $NombreClase = strtoupper($NombreClase);
        $ciclo = htmlentities($_POST['ciclo']);
        $fecha = htmlentities($_POST['fecha']);
        $DiasClase = $Lunes.$Martes.$Miercoles.$Jueves.$Viernes.$Sabado.$Domingo;
        $HoraInicio = htmlentities($_POST['HoraInicio']);
        $HoraFin = htmlentities($_POST['HoraFin']);
        $HorarioClase = $HoraInicio.' - '.$HoraFin;
        $SedeClase = htmlentities($_POST['Sede']);
        $GrupoClase = htmlentities($_POST['GrupoClase']);
        $Valor = htmlentities($_POST['valor']);


        $SelecClase = $Con->prepare('SELECT COUNT(*) FROM programa WHERE categoriaPrograma =  ?');
        $SelecClase->execute(array($NombreClase));
        /* Primera registro del programa */
        if($SelecClase->fetchColumn() == 0){
            $SelecClase = null;
                $InserPrograma = $Con->prepare('INSERT INTO programa VALUES(DEFAULT, :NombreClase, :valor)');
                    $InserPrograma->bindparam(':NombreClase',$NombreClase);
                    $InserPrograma->bindparam(':valor',$Valor);
                $InserPrograma->execute();
                $InserPrograma =null;
                $idPrograma = $Con->lastInsertId();

                $InserGrupo = $Con->prepare('INSERT INTO grupo VALUES(DEFAULT, :GrupoClase, :fecha, :ciclo, :idPrograma)');
                    $InserGrupo->bindparam(':GrupoClase',$GrupoClase);
                    $InserGrupo->bindparam(':fecha',$fecha);
                    $InserGrupo->bindparam(':ciclo',$ciclo);
                    $InserGrupo->bindparam(':idPrograma',$idPrograma);
                $InserGrupo->execute();
                $InserGrupo = null;
                $idGrupo = $Con->lastInsertId();

                $InserHorario = $Con->prepare('INSERT INTO horario VALUES(DEFAULT, :DiasClase, :HorarioClase, :SedeClase, :idGrupo)');
                    $InserHorario->bindparam(':DiasClase',$DiasClase);
                    $InserHorario->bindparam(':HorarioClase',$HorarioClase);
                    $InserHorario->bindparam(':SedeClase',$SedeClase);
                    $InserHorario->bindparam(':idGrupo',$idGrupo);
                if($InserHorario->execute()){

                    $InserHorario = null;
                    $Con = null;

                    echo alerta('Primer Registro del Programa','NuevaClase.php');
                }else{
                    echo alerta('Error Insertando Horarios','NuevaClase.php');
                }              
        }else{
            /* si ya hay algun registro de un program */
            $SelecClase = $Con->prepare('SELECT * FROM programa WHERE categoriaPrograma =  ?');
            $SelecClase->execute(array($NombreClase));

            /* si ya esta registrado el programa */
            $FilaClase = $SelecClase->fetch();
            $CodigoPrograma = $FilaClase['CodigoPrograma'];
            echo $CodigoPrograma;
            echo ":C";
            $SelecClase = null;

            /* buscar grupo que ya este asginado */

            $SelecGrupo = $Con->prepare('SELECT COUNT(*) FROM grupo WHERE NombreGrupo = :GrupoClase AND FechaGrupo = :fecha AND CicloGrupo = :ciclo');
                $SelecGrupo->bindparam(':GrupoClase',$GrupoClase);
                $SelecGrupo->bindparam(':fecha',$fecha);
                $SelecGrupo->bindparam(':ciclo',$ciclo);
            if($SelecGrupo->execute()){
                /* si es igual a 0 el grupo es diferente */
                if($SelecGrupo->fetchColumn() == 0){
                    $SelecGrupo= null;

                    $InserGrupo = $Con->prepare('INSERT INTO grupo VALUES(DEFAULT, :GrupoClase, :fecha, :ciclo, :idPrograma)');
                        $InserGrupo->bindparam(':GrupoClase',$GrupoClase);
                        $InserGrupo->bindparam(':fecha',$fecha);
                        $InserGrupo->bindparam(':ciclo',$ciclo);
                        $InserGrupo->bindparam(':idPrograma',$CodigoPrograma);
                    if($InserGrupo->execute()){
                            $idGrupo = $Con->lastInsertId();       
                            $InserGrupo = null;
                            $InserHorario = $Con->prepare('INSERT INTO horario VALUES(DEFAULT, :DiasClase, :HorarioClase, :SedeClase, :idGrupo)');
                                $InserHorario->bindparam(':DiasClase',$DiasClase);
                                $InserHorario->bindparam(':HorarioClase',$HorarioClase);
                                $InserHorario->bindparam(':SedeClase',$SedeClase);
                                $InserHorario->bindparam(':idGrupo',$idGrupo);
                            if($InserHorario->execute()){
                                $InserHorario = null;
                                $Con = null;
                                echo alerta('Registro Completo','NuevaClase.php');
                            }else{
                                echo alerta('Error en HORARIO','NuevaClase.php');
                            }

                    }else{
                        echo alerta('Error insertando grupo','NuevaClase.php');
                    }

                }else{
                   /* si hay un registro de grupo */
                    $SelecGrupo = $Con->prepare('SELECT * FROM grupo WHERE NombreGrupo = :GrupoClase AND FechaGrupo = :fecha AND CicloGrupo = :ciclo');
                        $SelecGrupo->bindparam(':GrupoClase',$GrupoClase);
                        $SelecGrupo->bindparam(':fecha',$fecha);
                        $SelecGrupo->bindparam(':ciclo',$ciclo);

                        if($SelecGrupo->execute()){
                            $FilaGrupo = $SelecGrupo->fetch();
                            $CodigoGrupo = $FilaGrupo['CodigoGrupo'];
                            echo $CodigoGrupo;
                            $SelecGrupo = null;
                                $InserHorario = $Con->prepare('INSERT INTO horario VALUES(DEFAULT, :DiasClase, :HorarioClase, :SedeClase, :idGrupo)');
                                    $InserHorario->bindparam(':DiasClase',$DiasClase);
                                    $InserHorario->bindparam(':HorarioClase',$HorarioClase);
                                    $InserHorario->bindparam(':SedeClase',$SedeClase);
                                    $InserHorario->bindparam(':idGrupo',$CodigoGrupo);
                                if($InserHorario->execute()){
                                    $InserHorario = null;
                                    $Con = null;
                                    echo alerta('Datos Guardados','NuevaClase.php');
                                }else{
                                    echo alerta('Error Guardando Datos','NuevaClase.php');
                                }
                        }else{
                            echo alerta('Error Buscanco GRUPO','NuevaClase.php');
                        }    
                }

            }else{
                echo alerta('Error en busqueda Grupo','NuevaClase.php');
            }
        }

    }else{
        echo alerta('Utiliza el formulario','NuevaClase.php');
    }

?>


<?php include '../extends/footer.php'; ?>

</body>
</html>