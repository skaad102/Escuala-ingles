<?php include '../extends/headerAdmi.php'; ?>

<div class='container' style='margin-top: 6%; width: 20rm;'>
    <div class="card">
        <div class="card-body">
            <form action="InserEstudiante.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="card-header">
                    <h2 class="text-center card-title">Datos Estudiante</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <h4>Nombre Estudiante</h4>
                        <input required type="text" class="form-control" name="NombreEstudiante" id="Nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group col-md-4">
                        <div class="mb-3 text-center">
                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle z-depth-1-half center" width="50" height="50" alt="avatar">
                        </div>
                        <div class="DivFile">
                            <label id="texFile">Seleccionar Foto</label>
                            <input type="file" name="FotoEstudiante" id="BtnFoto" lang="es">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <h4>Identificación</h4>
                        <select required name="Indentifiacion" id="indentifiacion" class="form-control">
                            <option value="" desabled="" selected="">Elejir</option>
                            <option value="T.I">T.I</option>
                            <option value="C.C">C.C</option>
                            <option value="C.E">C.E</option>
                            <option value="C.D">C.D</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <h4>Número</h4>
                        <input required type="number" name="Noindentificacion" class="form-control" id="Noindentifiacion" placeholder="No Identificación">
                    </div>
                    <div class="form-group col-md-4">
                        <h4>Fecha Ingreso</h4>
                        <input required type="text" class="form-control" name="FIngreso" readonly="" id="datepicker">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <h4>Telefono Movil</h4>
                        <input required type="number" class="form-control" name="MovilEstudiante" placeholder="Telefono Movil">
                    </div>
                    <div class="form-group col-md-5">
                        <h4>Sede</h4>
                        <select required name="Sede" id="sede" class="form-control">
                            <option value="" desabled="" selected="">Elejir</option>
                            <option value="YOPAL">YOPAL</option>
                            <option value="SOGAMOSO">SOGAMOSO</option>
                            <option value="TUNJA">TUNJA</option>
                        </select>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="card-header">
                    <h2 class="text-center card-title">Datos Acudiente</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h4>Nombre Acudiente</h4>
                        <input required type="text" class="form-control" name="NombreAcudiente" placeholder="Nombre">
                    </div>
                    <div class="form-group col-md-6">
                        <h4>Telefono Acudiente</h4>
                        <input required type="number" class="form-control" name="TelefonoAcudiente" placeholder="Telefono Móvil">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Guardar</button>
            </form>
        </div>
    </div>

    <div class="container" style="margin-bottom: 2%;margin-top: 6% ">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ultimo Registro</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        $SelecUltReg = $Con->prepare('SELECT * FROM estudiante  WHERE Sede = :Ciudad ORDER BY CodigoEstudiante DESC LIMIT 1 ');
                        $SelecUltReg->bindparam(':Ciudad', $_SESSION['Ciudad']);
                        $SelecUltReg->execute();
                        while ($Fila = $SelecUltReg->fetch()) {
                            ?>
                            <tr>

                                <td><img src="<?php echo $Fila['nombre_foto'] ?>" width="50" height="50"></td>
                                <td> <?php echo $Fila['nombre_estudiante'] ?></td>
                                <td><?php echo $Fila['cardex'] ?></td>
                                <td><a href="EditarEstudiante.php?CodigoEstudiante=<?php echo $Fila['CodigoEstudiante'] ?>" class="btn btn-success px-3"><i class="far fa-edit"></i></a></td>
                                <td><a href="#" class="btn btn-danger px-3" onclick="bootbox.confirm('Seguro que desea realizar esta acción',function(re){if(re == true){
                                            location.href ='EliminarEstudiante.php?CodigoEstudiante=<?php echo $Fila['CodigoEstudiante'] ?>&FotoEstudiante=<?php echo $Fila['nombre_foto'] ?>';
                                        }})"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php
                    }
                    $SelecUltReg = null;
                    $Con = null;

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>



<?php include '../extends/footer.php'; ?>

<script>
    /* calendario */
    $('#datepicker').datepicker({
        uiLibrary: "materialdesign",
        format: "yyyy/mm/dd",
        showOtherMonths: true,

    });
</script>
</body>

</html>