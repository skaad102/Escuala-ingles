<?php
include '../extends/headerphp.php';
include '../extends/alerta.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $CodigoEstudiante = htmlentities($_POST['CodigoEstudiante']);
    $NombreEstudiante = htmlentities($_POST['NombreEstudiante']);
    $Noindentificacion = htmlentities($_POST['Noindentificacion']);
    $FIngreso = htmlentities($_POST['FIngreso']);
    $MovilEstudiante = htmlentities($_POST['MovilEstudiante']);
    $NombreAcudiente = htmlentities($_POST['NombreAcudiente']);
    $TelefonoAcudiente = htmlentities($_POST['TelefonoAcudiente']);
    $SedeInscripcion = htmlentities($_POST['Sede']);
    $TipoIdentificación = htmlentities($_POST['Indentifiacion']);
    $Estado = 0;

    /* Redimencionar Imagen */
    $Ruta = $_FILES['FotoEstudiante']['tmp_name'];
    $Imagen = $_FILES['FotoEstudiante']['name'];

    if ($Ruta != '') {
        $ancho = 500;
        $alto = 400;
        $info = pathinfo($Imagen);
        $tam = getimagesize($Ruta);
        $width = $tam[0];
        $heigth = $tam[1];

        if ($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG') {
            $imgVieja = imagecreatefromjpeg($Ruta);
            $imgNueva = imagecreatetruecolor($ancho, $alto);
            imagecopyresampled($imgNueva, $imgVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
            $Copia = '../FotoEstudiante/' . $Noindentificacion . '.jpg';
            imagejpeg($imgNueva, $Copia);
        } elseif ($info['extension'] == 'png' || $info['extension'] == 'PNG') {
            $imgVieja = imagecreatefrompng($Ruta);
            $imgNueva = imagecreatetruecolor($ancho, $alto);
            imagecopyresampled($imgNueva, $imgVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
            /* Imagen redimencionada guadada como copia */
            $Copia = '../FotoEstudiante/' . $Noindentificacion . '.png';
            imagepng($imgNueva, $Copia);
        } else {
            echo alerta('Error en Formato de Imagen', 'NuevoEstudiante.php');
        }
    } else {
        /* icono realizado por Prosymbols en www.flaticon.com  */
        $Copia = htmlentities($_POST['FotoEstudianteAnterior']);
    }


    $ActualizarEstudiante = $Con->prepare('UPDATE estudiante SET 
            cardex = :Noindentificacion, nombre_estudiante = :NombreEstudiante, Fecha_Ingreso = :FIngreso, telefono1 = :MovilEstudiante, telefono2 = :MovilEstudiante,
             estado = :Estado, nombre_foto = :Copia, TipoId = :Tipo, Sede = :Sede WHERE  CodigoEstudiante = :CodigoEstudiante');

        $ActualizarEstudiante->bindparam(':CodigoEstudiante', $CodigoEstudiante);
        $ActualizarEstudiante->bindparam(':Noindentificacion', $Noindentificacion);
        $ActualizarEstudiante->bindparam(':NombreEstudiante', $NombreEstudiante);
        $ActualizarEstudiante->bindparam(':FIngreso', $FIngreso);
        $ActualizarEstudiante->bindparam(':MovilEstudiante', $MovilEstudiante);
        $ActualizarEstudiante->bindparam(':MovilEstudiante', $MovilEstudiante);
        $ActualizarEstudiante->bindparam(':Estado', $Estado);
        $ActualizarEstudiante->bindparam(':Copia', $Copia);
        $ActualizarEstudiante->bindparam(':Tipo', $TipoIdentificación);
        $ActualizarEstudiante->bindparam(':Sede', $SedeInscripcion);
    if ($ActualizarEstudiante->execute()) {

        $ActAcudiente = $Con->prepare('UPDATE titular SET nombreTitular =:NombreAcudiente, telefonoTitular = :TelefonoAcudiente WHERE CodigoEstudiante = :CodigoEstudiante');
            $ActAcudiente->bindparam(':CodigoEstudiante', $CodigoEstudiante);
            $ActAcudiente->bindparam(':NombreAcudiente', $NombreAcudiente);
            $ActAcudiente->bindparam(':TelefonoAcudiente', $TelefonoAcudiente);

        if ($ActAcudiente->execute()) {
            $ActualizarEstudiante = null;
            $ActAcudiente = null;
            $Con = null;

            echo alerta('Actualización Exitosa', 'EditarEstudiante.php?CodigoEstudiante='.$CodigoEstudiante.'');
        } else {
            echo alerta('Error Registrando Acudiente', 'EditarEstudiante.php?CodigoEstudiante='.$CodigoEstudiante.'');
        }
    } else {
        echo alerta('Actualización No Exitosa', 'EditarEstudiante.php?CodigoEstudiante='.$CodigoEstudiante.'');
    }
} else {
    echo alerta('Utilizar Inventario', 'NuevoEstudiante.php');
}
?>

</body>

</html>