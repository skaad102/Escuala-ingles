<?php include '../extends/headerAdmi.php'; ?>
<div class='container' id='DivContainer'>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Horario de Clases</h2>
        </div>
        <div class="card-body">
            <form action="ConsultaHorario.php" method="post" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Año</h3>
                        <input required type="number" min="1" max="<?php echo date('Y') + 1 ?>" value="<?php echo date('Y') ?>" class="form-control" name="fecha" placeholder="Año ">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Ciclo</h3>
                        <select required name="ciclo" class="form-control">
                            <option value="" disabled selected>Elejir</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <br>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" placeholder="Nombre Clase (Opcional)" name="NombreClase">
                        </div>
                    </div>
                <button type="submit" class="btn btn-info btn-lg btn-block">Consultar</button>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title text-center">Horario de Clases Asignadas</h2>
        </div>
        <div class="card-body">
            <form action="ConsultaHorarioAsig.php" method="post" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Año</h3>
                        <input required type="number" min="1" max="<?php echo date('Y') + 1 ?>" value="<?php echo date('Y') ?>" class="form-control" name="fecha" placeholder="Año ">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Ciclo</h3>
                        <select required name="ciclo" class="form-control">
                            <option value="" disabled selected>Elejir</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info btn-lg btn-block">Consultar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../extends/footer.php'; ?>
</body>

</html>