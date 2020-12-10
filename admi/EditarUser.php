<?php
include '../extends/headerAdmi.php';
$CodigoUser = htmlentities($_GET['CodigoUser']);


$Selec = $Con->prepare('SELECT COUNT(*) FROM user WHERE CodigoUser = :CodigoUser');
    $Selec->bindparam(':CodigoUser',$CodigoUser);
    $Selec->execute();

    if($Selec->fetchColumn()>0){
        $SelUserEdit = $Con->prepare('SELECT * FROM user WHERE CodigoUser = ?');
        $SelUserEdit->execute(array($CodigoUser));
        $SelCargo = $Con->prepare('SELECT * FROM cargo WHERE CodigoUser = ?');
        $SelCargo->execute(array($CodigoUser));
    
        $FilaUser = $SelUserEdit->fetch();
        $FilaCargo = $SelCargo->fetch();
        
        $Selec = null;
        $SelUserEdit = null;
        $SelCargo = null;
        $Con = null;
    }else{
        $Selec = null;
        $Con = null;
        header('location:ListaUsuarios.php');
    }

?>

<div class='container' style='margin-top: 6%; width: 20rm;'>
    <div class="card">
        <div class="card-body">
            <form action="ActualizarUser.php" method="post" autocomplete="off">
                <input type="hidden" name="CodigoUser" value="<?php echo $FilaUser['CodigoUser'] ?>">
                <input type="hidden" name="CodigoCargo" value="<?php echo $FilaCargo['CodigoCargo'] ?>">
                <div class="card-header">
                    <h2 class="text-center card-title">Datos Funcionario</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nombre Funcionario</label>
                        <input required type="text" class="form-control" name="NombreFuncionario" placeholder="Nombre" value="<?php echo $FilaUser['NombrePersonal'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Identificacion</label>
                        <input required type="number" name="Noindentificacion" class="form-control" placeholder="No Identificación" value="<?php echo $FilaUser['Identificacion'] ?>">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Contraseña</label>
                        <input required type="password" name="pasw1" class="form-control" placeholder="Contraseña" value="<?php echo $FilaUser['pass'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Contraseña</label>
                        <input required type="password" name="pasw2" class="form-control" placeholder="Confirmar Contraseña" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Usuario Funcionario</label>
                        <input required type="text" class="form-control" name="UserFuncionario"  placeholder="Usuario" value="<?php echo $FilaUser['NombreUser'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Sede</label>
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
                        <label>Telefono Móvil</label>
                        <input required type="number" class="form-control" name="MovilFuncionario" placeholder="Telefono Móvil" value="<?php echo $FilaUser['TelefonoPersonal'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Cargo</label>
                        <select required name="Cargo" id="cargo" class="form-control">
                            <option value="" desabled="" selected="">Elejir Cargo</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Secretaria/o">Secretaria/o</option>
                            <option value="Docente">Docente</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <a href="ListaUsuarios.php" class="btn btn-info btn-lg btn-block">Cancelar</a>
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


</body>

</html>