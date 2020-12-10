<?php include '../extends/headerAdmi.php';
    include '../extends/alerta.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = htmlentities($_POST['fecha']);
    $ciclo = htmlentities($_POST['ciclo']);
    $NombreClase = htmlentities($_POST['NombreClase']);
    

    if($NombreClase == null || $NombreClase == ''){
        $SeleCHorario = $Con->prepare('SELECT * FROM programa Pro INNER JOIN grupo Gr INNER JOIN horario Ho 
        ON Pro.CodigoPrograma = Gr.CodigoPrograma AND Gr.CodigoGrupo = Ho.CodigoGrupo 
        WHERE Gr.FechaGrupo = :fecha AND Gr.CicloGrupo = :ciclo ORDER BY Gr.NombreGrupo ASC');
        $SeleCHorario->bindparam(':fecha', $fecha);
        $SeleCHorario->bindparam(':ciclo', $ciclo);
    }else{
        $NombreClase = strtoupper($NombreClase); 
        $SeleCHorario = $Con->prepare('SELECT * FROM programa Pro INNER JOIN grupo Gr INNER JOIN horario Ho 
        ON Pro.CodigoPrograma = Gr.CodigoPrograma AND Gr.CodigoGrupo = Ho.CodigoGrupo 
        WHERE Gr.FechaGrupo = :fecha AND Gr.CicloGrupo = :ciclo AND Pro.categoriaPrograma = :NombreClase  ORDER BY Gr.NombreGrupo ASC');
        $SeleCHorario->bindparam(':fecha', $fecha);
        $SeleCHorario->bindparam(':ciclo', $ciclo);
        $SeleCHorario->bindparam(':NombreClase', $NombreClase);
    }

    
    if ($SeleCHorario->execute()) {
        $filas = $SeleCHorario->fetchAll();
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
            <h2 class="card-title text-center">CLASES DEL <?php echo $fecha . ' CICLO ' . $ciclo ?></h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Programa</th>
                    <th>Grupo</th>
                    <th>Dias</th>
                    <th>Hora</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach($filas as $Curso):?>
                    <tr>
                        <td><?php echo $Curso['categoriaPrograma']?></td>
                        <td><?php echo $Curso['NombreGrupo']?></td>
                        <td><?php echo $Curso['dias']?></td>
                        <td><?php echo $Curso['horas']?></td>
                        <td><a href="EditarClase.php?CodigoGrupo=<?php echo $Curso['CodigoGrupo'] ?>&CodigoHorario=<?php echo $Curso['CodigoHorario']?>&CodigoPrograma=<?php echo $Curso['CodigoPrograma']?>" class="btn btn-success px-3"><i class="far fa-edit"></i></a></td>
                                <td><a href="#" class="btn btn-danger px-3" onclick="bootbox.confirm('Seguro que desea realizar esta acción',function(re){if(re == true){
                                        location.href ='EliminarClase.php?CodigoGrupo=<?php echo $Curso['CodigoGrupo'] ?>&CodigoHorario=<?php echo $Curso['CodigoHorario']?>';
                                    }})"><i class="fas fa-trash-alt"></i></a></td>         
                    </tr>
                </tbody>
                    <?php endforeach;
                    $SeleCHorario = null;
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