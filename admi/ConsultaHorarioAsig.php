<?php include '../extends/headerAdmi.php';
    include '../extends/alerta.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = htmlentities($_POST['fecha']);
    $ciclo = htmlentities($_POST['ciclo']);

    $SelecDocAsig = $Con->prepare('SELECT Doc.CodigoDocente,Pro.categoriaPrograma,Gr.NombreGrupo,Usr.NombrePersonal 
    FROM docente Doc INNER JOIN grupo Gr INNER JOIN user Usr INNER JOIN programa Pro 
    ON Doc.CodigoGrupo = Gr.CodigoGrupo AND doc.CodigoUser = Usr.CodigoUser AND Gr.CodigoPrograma = Pro.CodigoPrograma 
    WHERE Gr.FechaGrupo = :fecha AND Gr.CicloGrupo = :ciclo ORDER BY Gr.NombreGrupo ASC');
    $SelecDocAsig->bindparam(':fecha', $fecha);
    $SelecDocAsig->bindparam(':ciclo', $ciclo);
    if ($SelecDocAsig->execute()) {
        $filas = $SelecDocAsig->fetchAll();
    } else {
        echo alerta('Error en la buqueda', 'ListaClase.php');
        die();
    }
} else {
    echo alerta('Utilizar el Formulario', 'ListaClase.php');
    die();
} ?>

<div class="container" id="DivContainer">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">CLASES ASIGNADAS DEL <?php echo $fecha . ' CICLO ' . $ciclo ?></h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Programa</th>
                    <th>Grupo</th>
                    <th>Docente</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($filas as $Curso):?>
                    <tr>
                        <td><?php echo $Curso['categoriaPrograma']?></td>
                        <td><?php echo $Curso['NombreGrupo']?></td>
                        <td><?php echo $Curso['NombrePersonal']?></td>
                        <td><a href="#" class="btn btn-danger px-3" onclick="bootbox.confirm('Seguro que desea realizar esta acción',function(re){if(re == true){
                                        location.href ='EliminarAsigClase.php?CodigoDocente=<?php echo $Curso['CodigoDocente'] ?>';
                                    }})"><i class="fas fa-trash-alt"></i></a></td>         
                    </tr>
                </tbody>
                    <?php endforeach;
                    $SelecDocAsig = null;
                    $Con = null;
                ;?>
            </table>
            <a href="ListaClase.php" class="btn btn-info btn-lg btn-block">Volver</a>
        </div>
    </div>
</div>

<?php include '../extends/footer.php'; ?>
</body>

</html>