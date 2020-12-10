<?php include '../extends/headerAdmi.php';
include '../extends/footer.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cardex = htmlentities($_POST['cardex']);


        /* buscar estudiante */
        $Selec = $Con->prepare('SELECT COUNT(*) FROM estudiante WHERE cardex =  ?');
        $Selec->execute(array($cardex));

        if($Selec->fetchColumn() > 0){
            $Selec = null;
           
            $BuscarEstudiante = $Con->prepare('SELECT Es.CodigoEstudiante, Es.nombre_estudiante, Es.telefono1, Est.CodigoEstado, Est.Deuda, Est.Cuotas 
                    FROM estudiante Es INNER JOIN estado Est 
                    ON Es.CodigoEstudiante = Est.CodigoEstudiante 
                    WHERE Es.cardex =  ? AND Est.NombreEstado = "NO PAGO" ');
            $BuscarEstudiante->execute(array($cardex));
            $EstudianteNoPago = $BuscarEstudiante->fetchAll();
            
            $BuscarEstudianteNom = $Con->prepare('SELECT nombre_estudiante FROM estudiante WHERE cardex =  ?');
            $BuscarEstudianteNom->execute(array($cardex));
            $Estudiante = $BuscarEstudianteNom->fetch();
            $BuscarEstudianteNom = null;
            
            $BuscarEstudiante2 = $Con->prepare('SELECT Pro.categoriaPrograma, Gr.NombreGrupo 
            FROM estudiante Es INNER JOIN estado Est INNER JOIN matricula Mat INNER JOIN docente Doc INNER JOIN grupo Gr INNER JOIN programa Pro 
            ON Est.CodigoEstudiante = Es.CodigoEstudiante AND Est.CodigoMattricula = Mat.CodigoMatricula AND Es.CodigoEstudiante = Mat.CodigoEstudiante AND Mat.CodigoDocente = Doc.CodigoDocente AND Doc.CodigoGrupo = Gr.CodigoGrupo AND Gr.CodigoPrograma = Pro.CodigoPrograma 
            WHERE Es.cardex = ? AND Est.Cuotas = "0" AND Est.NombreEstado = "PAGADO"');
            $BuscarEstudiante2->execute(array($cardex));
            $EstudiantePago = $BuscarEstudiante2->fetchAll();
        }else {
            echo alerta('El usuario no exixte','PagoEstudiante.php');
            die();
        }
    }else{
        echo alerta('utiliza el formulario','PagoEstudiante.php');
        die();
    }
?>
<div class='container' id='DivContainer'>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center"> PAGOS DE <?php echo strtoupper($Estudiante['nombre_estudiante']) ?></h2>
        </div>
        <div class="card-body">
        <table class="table">
            <h3>Deudas:</h3>
                    <thead>
                        <th>Telefono</th>
                        <th>Deuda</th>
                        <th>Cuota</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($EstudianteNoPago as $NoPago) {
                            ?>
                            <tr>

                                <td><?php echo $NoPago['telefono1'] ?></td>
                                <td> <?php echo $NoPago['Deuda'] ?></td>
                                <td><?php echo $NoPago['Cuotas'] ?></td>
                                <td><a href="#" class="btn btn-danger px-3" onclick="bootbox.confirm('Seguro que desea realizar esta acción',function(re){if(re == true){
                                            location.href ='EliminarEstudiante.php?CodigoEstudiante=<?php echo $Fila['CodigoEstudiante'] ?>&FotoEstudiante=<?php echo $Fila['nombre_foto'] ?>';
                                        }})"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php
                    }
                    $BuscarEstudiante = null;

                    ?>
                    </tbody>
            </table>
            <table class="table">
            <h3>Pagos:</h3>
                    <thead>
                        <th>Programa</th>
                        <th>Grupo</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($EstudiantePago as $Pago) {
                            ?>
                            <tr>

                                <td><?php echo $Pago['categoriaPrograma'] ?></td>
                                <td> <?php echo $Pago['NombreGrupo'] ?></td>
                            </tr>
                        <?php
                    }
                    $BuscarEstudiante2 = null;
                    $Con = null;

                    ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>