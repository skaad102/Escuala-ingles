<?php include '../extends/headerAdmi.php';
$fecha = date("Y");
$SeleProgram = $Con->prepare('SELECT Pro.CodigoPrograma,Pro.categoriaPrograma FROM programa Pro INNER JOIN grupo Gr INNER JOIN horario Ho
ON Gr.CodigoPrograma = Pro.CodigoPrograma AND Ho.CodigoGrupo = Gr.CodigoGrupo 
WHERE Ho.CodigoCiudad = :ciudad AND Gr.FechaGrupo = :fecha GROUP BY Pro.CodigoPrograma HAVING COUNT( * )');
$SeleProgram->bindparam(':ciudad', $_SESSION['NoCiudad']);
$SeleProgram->bindparam(':fecha', $fecha);
$SeleProgram->execute();
$ResulPrograma = $SeleProgram->fetchAll();
$SeleProgram = null;

?>
<div class='container' id="DivContainer">

    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Asignar Clases</h2>
        </div>
        <div class="card-body">
            <form action="InserAsigClase.php" method="post" autocomplete="off">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h4>Sede</h4>
                        <input type="text" value="<?php echo $_SESSION['Ciudad'] ?>" readonly="" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h4>Programa</h4>
                        <select required name="programa" id="programa" class="form-control">
                            <option disabled="" value="0" selected="">Elejir</option>
                            <?php

                            foreach ($ResulPrograma as $Programa) :
                                ?>
                                <option value="<?php echo $Programa['CodigoPrograma'] ?>"><?php echo $Programa['categoriaPrograma'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <h4>Grupo</h4>
                            <select required name="grupo" id="grupo" class="form-control">
                                <option value="0" selected="">Elejir</option>
                            </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h4>Docente</h4>
                        <input type="number" name="NoDocente" placeholder="Numero Identificación" class="form-control">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-lg btn-block">Guardar</button>
            </form>
        </div>
    </div>

</div>
<?php include '../extends/footer.php'; ?>
<script>
    $(document).ready(function() {
        $("#programa").change(function() {
            $("#programa option:selected").each(function() {
                CodigoPrograma = $(this).val();
                console.log(CodigoPrograma)
                $.post("../extends/obtenerGrupo.php", {
                    CodigoPrograma: CodigoPrograma
                }, function(data) {
                    $("#grupo").html(data);
                });
            });
        })
    });
</script>
</body>
</html>