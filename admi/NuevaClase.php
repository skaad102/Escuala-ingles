<?php include '../extends/headerAdmi.php'; ?>
<div class="container" style="margin-top:7%">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Clase</h2>
        </div>
        <form action="InserClase.php" method="post" autocomplete="off">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h4>Año</h4>
                        <input required type="number" maxlength="4" name="fecha" value="<?php echo date("Y");?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <h4>Ciclo</h4>
                        <select required name="ciclo" class="form-control" >
                            <option value="" disabled selected>Elejir</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                    <h4>Valor</h4>
                        <input required type="number" class="form-control" name="valor" placeholder="Valor $">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h4>Nombre de a Clase</h4>
                        <input required type="text" class="form-control" name="NombreClase" placeholder="Nombre">
                    </div>
                    <div class="form-group col-md-3">
                        <h4>Grupo de a Clase</h4>
                        <input required type="number" class="form-control" name="GrupoClase" placeholder="Grupo">
                    </div>
                    <div class="form-group col-md-3">
                        <h4>Sede</h4>
                        <select required name="Sede" id="sede" class="form-control">
                            <option value="<?php echo $_SESSION['NoCiudad']?>" selected=""><?php echo $_SESSION['Ciudad']?></option>
                            <option value="1">YOPAL</option>
                            <option value="2">SOGAMOSO</option>
                            <option value="3">TUNJA</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <h4>Días de la Semana</h4>
                    <div class="form-row" style="margin-left:10%">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Lunes" value="Lunes -" id="lunes">
                            <label class="custom-control-label" for="lunes">Lunes</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Martes" value=" Martes -" id="martes">
                            <label class="custom-control-label" for="martes">Martes</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Miercoles" value=" Miercoles -" id="miercoles">
                            <label class="custom-control-label" for="miercoles">Miercoles</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Jueves" value=" Jueves -" id="jueves">
                            <label class="custom-control-label" for="jueves">Jueves</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Viernes" value=" Viernes -" id="viernes">
                            <label class="custom-control-label" for="viernes">Viernes</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Sabado" value=" Sabado -" id="sabado">
                            <label class="custom-control-label" for="sabado">Sabado</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="Domingo" value=" Domingo" id="domingo">
                            <label class="custom-control-label" for="domingo">Domingo</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h4>Horario de la Clase: </h4>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="md-form mt-0">
                            <input required type="time" class="timepicker" name="HoraInicio">\ a /<input required type="time" class="timepicker" name="HoraFin">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?php include '../extends/footer.php'; ?>
</body>

</html>