<?php include '../extends/headerAdmi.php';
include '../extends/alerta.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $cardex = htmlentities($_GET['cardex']);
    /* bisqueda de estudiante por tipo de indentificacion para ver si existe */
    $BusqEstudiante = $Con->prepare('SELECT * FROM estudiante WHERE cardex =  :cardex');
    $BusqEstudiante->bindparam(':cardex', $cardex);
    if ($BusqEstudiante->execute()) {
        if ($BusqEstudiante->fetchColumn() > 0) {
            $BusqEstudiante = null;
        } else {
            header('location:ListaEstudiante.php');
        }
    } else {
        echo alerta('Error en la busqueda', 'ListaEstudiante.php');
    }
    echo alerta('No se encontro el estudiante', 'ListaEstudiante.php');
} else {
    echo alerta('Utiliza el buscador', 'ListaEstudiante.php');
}

?>

<div class="container" style="margin-bottom: 2%;margin-top: 6% ">
    <!-- tabla con todos los datos del estudiante -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Estudiante</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Tipo Identificación</th>
                    <th>Identificación</th>
                    <th>Fecha Ingreso</th>
                    <th>Telefono</th>
                    <th>Sede</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $Estudiante = $Con->prepare('SELECT * FROM estudiante WHERE cardex =  :cardex');
                    $Estudiante->bindparam(':cardex', $cardex);
                    $Estudiante->execute();
                    $Resultado = $Estudiante->fetchAll();
                    foreach ($Resultado as $Fila) {
                        ?>
                        <tr>
                            <td><img src="<?php echo $Fila['nombre_foto'] ?>" width="50" height="50"></td>
                            <td> <?php echo $Fila['nombre_estudiante'] ?></td>
                            <td><?php echo $Fila['TipoId'] ?></td>
                            <td><?php echo $Fila['cardex'] ?></td>
                            <td><?php echo $Fila['Fecha_Ingreso'] ?></td>
                            <td><?php echo $Fila['telefono1'] ?></td>
                            <td><?php echo $Fila['Sede'] ?></td>
                            <td><a href="EditarEstudiante.php?CodigoEstudiante=<?php echo $Fila['CodigoEstudiante'] ?>" class="btn btn-success px-3"><i class="far fa-edit"></i></a></td>
                            <td><a href="#" class="btn btn-danger px-3" onclick="bootbox.confirm('Seguro que desea realizar esta acción',function(re){if(re == true){
                                            location.href ='EliminarEstudiante.php?CodigoEstudiante=<?php echo $Fila['CodigoEstudiante'] ?>&FotoEstudiante=<?php echo $Fila['nombre_foto'] ?>';
                                        }})"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    <?php
                }
                   $Estudiante = null; 

                ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="card mt-2">
        <div class="card-header">
            <h4 class="card-title">Acudiente</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Nombre</th>
                    <th>Telefono</th>
                </thead>
                <tbody>
                    <?php
                    $Acudiente = $Con->prepare('SELECT * FROM titular WHERE CodigoEstudiante =  :cardex');
                    $Acudiente->bindparam(':cardex', $Fila['CodigoEstudiante']);
                    $Acudiente->execute();
                    $Resultado = $Acudiente->fetchAll();
                    foreach ($Resultado as $FilaAcu) {
                        ?>
                        <tr>
                            <td> <?php echo $FilaAcu['nombreTitular'] ?></td>
                            <td> <?php echo $FilaAcu['telefonoTitular'] ?></td>
                        <?php
                    }
                        $Acudiente = null;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- mostrar matricula -->
    <?php
    $SelecMatricula = $Con->prepare('SELECT COUNT(*) FROM estudiante Est INNER JOIN matricula Mat 
    ON Est.CodigoEstudiante = Mat.CodigoEstudiante WHERE Est.cardex = ?');
    $SelecMatricula->execute(array($cardex));
    /* si hay una matricula */
    if ($SelecMatricula->fetchColumn() > 0) :
        $SelecMatricula = null;
        $SelecPrograma = $Con->prepare('SELECT Pro.categoriaPrograma,Gr.NombreGrupo,Gr.FechaGrupo,Us.NombrePersonal 
        FROM estudiante Est INNER JOIN matricula Mat INNER JOIN programa Pro INNER JOIN grupo Gr INNER JOIN user Us INNER JOIN docente Doc 
        ON Mat.CodigoEstudiante = Est.CodigoEstudiante AND Mat.CodigoDocente = Doc.CodigoDocente AND Doc.CodigoGrupo = Gr.CodigoGrupo AND Doc.CodigoUser = Us.CodigoUser AND Gr.CodigoPrograma = Pro.CodigoPrograma 
        WHERE Est.cardex = ?');
        $SelecPrograma->execute(array($cardex));
        $Clase = $SelecPrograma->fetchAll();
        ?>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title">Matricula</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Programa</th>
                        <th>Grupo</th>
                        <th>Profesor</th>
                        <th>Año</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Clase as $Cla) :
                            ?>
                            <th><?php echo $Cla['categoriaPrograma'] ?></th>
                            <th><?php echo $Cla['NombreGrupo'] ?></th>
                            <th><?php echo $Cla['NombrePersonal'] ?></th>
                            <th><?php echo $Cla['FechaGrupo'] ?></th>

                        </tbody>
                    <?php endforeach; 
                        $SelecPrograma = null;
                        $Con = null;
                    ?>
                </table>
            </div>
        </div>

    <?php endif;
                        $Con = null;
?>
</div>

<?php include '../extends/footer.php'; ?>
</body>

</html>