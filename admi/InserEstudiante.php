<?php
    include '../extends/headerphp.php';
    include '../extends/alerta.php';


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $NombreEstudiante = htmlentities($_POST['NombreEstudiante']);
        $Noindentificacion = htmlentities($_POST['Noindentificacion']);
        $FIngreso = htmlentities($_POST['FIngreso']);
        $MovilEstudiante = htmlentities($_POST['MovilEstudiante']);
        $NombreAcudiente = htmlentities($_POST['NombreAcudiente']);
        $TelefonoAcudiente = htmlentities($_POST['TelefonoAcudiente']);
        $SedeInscripcion = htmlentities($_POST['Sede']);
        $TipoIdentificación = htmlentities($_POST['Indentifiacion']);
        $Estado =0;

        /* Redimencionar Imagen */

        $Ruta = $_FILES['FotoEstudiante']['tmp_name'];
        $Imagen = $_FILES['FotoEstudiante']['name'];

        if($Ruta != ''){
            $ancho = 500;
            $alto = 400;
            $info = pathinfo($Imagen);
            $tam = getimagesize($Ruta);
            $width = $tam[0];
            $heigth = $tam[1];

            if($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG'){
                $imgVieja = imagecreatefromjpeg($Ruta);
                $imgNueva = imagecreatetruecolor($ancho,$alto);
                imagecopyresampled($imgNueva,$imgVieja,0,0,0,0,$ancho,$alto,$width,$heigth);
                $Copia = '../FotoEstudiante/'.$Noindentificacion.'.jpg';
                imagejpeg($imgNueva,$Copia);
            }elseif($info['extension'] == 'png' || $info['extension'] == 'PNG'){
                $imgVieja = imagecreatefrompng($Ruta);
                $imgNueva = imagecreatetruecolor($ancho,$alto);
                imagecopyresampled($imgNueva,$imgVieja,0,0,0,0,$ancho,$alto,$width,$heigth);
                $Copia = '../FotoEstudiante/'.$Noindentificacion.'.png';
                imagepng($imgNueva,$Copia);
            }else{
                echo alerta('Error en Formato de Imagen','NuevoEstudiante.php');
            }
        }else{
            /* icono realizado por Prosymbols en www.flaticon.com  */
            $Copia = '../FotoEstudiante/estudiante.png';
        }



        /* Buscar Datos repetidos en la BD */
        $selecBusq = $Con->prepare('SELECT COUNT(*) FROM estudiante WHERE cardex = :Noindentificacion');
            $selecBusq ->bindparam(':Noindentificacion',$Noindentificacion);

            if($selecBusq->execute()){
                /* si es = 0 eso quiere dicir que no encotro un estudiante con esa 
                identificación y procedera a guradar */
                if($selecBusq->fetchColumn() < 1){
                    /* Insertar Datos en las tablas */
                    /* Estudiante */
                    $InserEstudiante = $Con->prepare('INSERT INTO estudiante VALUES (DEFAULT, :Noindentificacion, :NombreEstudiante, :FIngreso, :MovilEstudiante, :MovilEstudiante, :Estado, :Copia, :Tipo, :Sede)');
                        $InserEstudiante ->bindparam(':Noindentificacion',$Noindentificacion);
                        $InserEstudiante ->bindparam(':NombreEstudiante',$NombreEstudiante);
                        $InserEstudiante ->bindparam(':FIngreso',$FIngreso);
                        $InserEstudiante ->bindparam(':MovilEstudiante',$MovilEstudiante);
                        $InserEstudiante ->bindparam(':MovilEstudiante',$MovilEstudiante);
                        $InserEstudiante ->bindparam(':Estado',$Estado);
                        $InserEstudiante ->bindparam(':Copia',$Copia);
                        $InserEstudiante ->bindparam(':Tipo',$TipoIdentificación);
                        $InserEstudiante ->bindparam(':Sede',$SedeInscripcion);
                    if($InserEstudiante->execute()){
                            /* Seleccionar el estuidiante para asignarle el acudiente */
                                $IdCodigoEstudiante = $Con->lastInsertId();

                                    $InserAcudiente = $Con->prepare('INSERT INTO titular VALUES (DEFAULT, :IdCodigoEstudiante, :NombreAcudiente, :TelefonoAcudiente)');
                                    $InserAcudiente ->bindparam(':IdCodigoEstudiante',$IdCodigoEstudiante);
                                    $InserAcudiente ->bindparam(':NombreAcudiente',$NombreAcudiente);
                                    $InserAcudiente ->bindparam(':TelefonoAcudiente',$TelefonoAcudiente);

                                if($InserAcudiente->execute()){
                                    $selecBusq = null;
                                    $InserEstudiante = null;
                                    $InserAcudiente = null;
                                    $Con = null;

                                    echo alerta('Guardado Exitosamente', 'NuevoEstudiante.php');
                                }else{
                                    echo alerta('Error  Registrando Acudiente','NuevoEstudiante.php');
                                }       
                    }else{
                        echo alerta('Error Con Registrando Estudiante','NuevoEstudiante.php');
                    }
                }else{
                    echo alerta('Al parecer ya exixte el estudiante','NuevoEstudiante.php');
                }
            }else{
                echo "Error en la busqueda";
            }
    }else{
        echo alerta('Utilizar Inventario','NuevoEstudiante.php');
    }
?>

</body>
</html>