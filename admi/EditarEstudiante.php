<?php
include '../extends/headerAdmi.php';

$CodigoEstudiante = htmlentities($_GET['CodigoEstudiante']);
$SelEstudianteEdit = $Con->prepare('SELECT * FROM estudiante WHERE CodigoEstudiante = ?');
$SelEstudianteEdit->execute(array($CodigoEstudiante));
$SelAcudiente = $Con->prepare('SELECT * FROM titular WHERE CodigoEstudiante = ?');
$SelAcudiente->execute(array($CodigoEstudiante));

$Fila = $SelEstudianteEdit->fetch();
$FilaAcuediente = $SelAcudiente->fetch();

$SelEstudianteEdit = null;
$SelAcudiente = null;
$Con = null;

?>
<div class='container' style='margin-top: 7%; width: 20rm;margin-bottom: 1%'>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <h3 class="card-title text-center">Editar Estudiante</h3>
            </div>
            <form action="ActualizarEstudiante.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="CodigoEstudiante" value="<?php echo $CodigoEstudiante ?>">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Nombre Estudiante</label>
                        <input required type="text" class="form-control" name="NombreEstudiante" id="Nombre" placeholder="Nombre" value="<?php echo $Fila['nombre_estudiante'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <div class="mb-3 text-center">
                            <img src="<?php echo $Fila['nombre_foto'] ?>" class="rounded-circle z-depth-1-half center" width="80" height="80" style="margin-top: 0" alt="imgEstudiante">
                        </div>
                        <div class="DivFile">
                            <label id="texFile">Seleccionar Foto</label>
                            <input type="file" name="FotoEstudiante" id="BtnFoto" lang="es">
                        </div>
                        <input type="hidden" name="FotoEstudianteAnterior" value="<?php echo $Fila['nombre_foto'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Identificación</label>
                        <select required name="Indentifiacion" id="indentifiacion" class="form-control">
                            <option value="<?php echo $Fila['TipoId'] ?>"><?php echo $Fila['TipoId'] ?></option>
                            <option value="T.I">T.I</option>
                            <option value="C.C">C.C</option>
                            <option value="C.E">C.E</option>
                            <option value="C.D">C.D</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Numero</label>
                        <input required type="number" name="Noindentificacion" class="form-control" placeholder="No Identificación" value="<?php echo $Fila['cardex'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fecha Ingreso</label>
                        <input required type="text" class="form-control" name="FIngreso" readonly="" id="datepicker" value="<?php echo $Fila['Fecha_Ingreso'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Telefono Movil</label>
                        <input required type="number" name="MovilEstudiante" class="form-control" placeholder="Telefono Movil" value="<?php echo $Fila['telefono1'] ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Sede</label>
                        <select required name="Sede" id="sede" class="form-control">
                            <option value="<?php echo $Fila['Sede'] ?>"><?php echo $Fila['Sede'] ?></option>
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
                        <label>Nombre Acudiente</label>
                        <input required type="text" class="form-control" name="NombreAcudiente" placeholder="Nombre" value="<?php echo $FilaAcuediente['nombreTitular'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Telefono Acudiente</label>
                        <input required type="number" class="form-control" name="TelefonoAcudiente" placeholder="Telefono Móvil" value="<?php echo $FilaAcuediente['telefonoTitular'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <a href="InfoEstudiante.php?cardex=<?php echo $Fila['cardex'] ?>" class="btn btn-info btn-lg btn-block">Cancelar</a>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include '../extends/footer.php';
?>

<script>
    /* calendario */
    $('#datepicker').datepicker({
        uiLibrary: "none",
        format: "yyyy/mm/dd"
    });
</script>
</body>

</html>