<?php include '../extends/headerAdmi.php'; ?>

<div class='container' style='margin-top: 6%; width: 20rm;'>
    <div class="card">
        <div class="card-body">
            <form action="InserUser.php" method="post" autocomplete="off">
                <div class="card-header">
                    <h2 class="text-center card-title">Datos Funcionario</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Nombre Funcionario</h3>
                        <input required type="text" class="form-control" name="NombreFuncionario" placeholder="Nombre">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Identificacion</h3>
                        <input required type="number" name="Noindentificacion" class="form-control" placeholder="No Identificación">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label style="font-size: 1.7rem" class="mr-2">Contraseña</label><i class="fa fa-eye" id="showCon1"></i>
                        <input required type="password" name="pasw1" id="pasw1" class="form-control" placeholder="Contraseña">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 1.7rem" class="mr-2">Contraseña</label><i class="fa fa-eye" id="showCon2"></i>
                        <input required type="password" name="pasw2" id="pasw2" class="form-control" placeholder="Confirmar Contraseña">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Usuario Funcionario</h3>
                        <input required type="text" class="form-control" name="UserFuncionario"  placeholder="Usuario">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Sede</h3>
                        <select required name="Sede" id="sede" class="form-control">
                            <option value="" desabled="" selected="">Elejir Lugar</option>
                            <option value="1">YOPAL</option>
                            <option value="2">SOGAMOSO</option>
                            <option value="3">TUNJA</option>
                        </select>
                    </div>
                </div>
                    
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Telefono Móvil</h3>
                        <input required type="number" class="form-control" name="MovilFuncionario" placeholder="Telefono Móvil">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Cargo</h3>
                        <select required name="Cargo" id="cargo" class="form-control">
                            <option value="" desabled="" selected="">Elejir Cargo</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Secretaria/o">Secretaria/o</option>
                            <option value="Docente">Docente</option>
                        </select>
                    </div>
                </div>
                <br>
                
                <button type="submit" class="btn btn-success btn-lg btn-block">Guardar</button>
            </form>
        </div>
    </div>
</div>


<?php include '../extends/footer.php'; ?>
</body>
</html>