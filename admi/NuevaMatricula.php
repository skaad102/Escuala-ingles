<?php include '../extends/headerAdmi.php';
/* Tener en cuenta el usuario para su Codigo ID */
$fecha = date("Y");
$SeleProgram = $Con->prepare('SELECT Pro.CodigoPrograma,Pro.categoriaPrograma,Doc.CodigoUser 
FROM programa Pro INNER JOIN grupo Gr INNER JOIN horario Ho INNER JOIN docente Doc 
ON Gr.CodigoPrograma = Pro.CodigoPrograma AND Ho.CodigoGrupo = Gr.CodigoGrupo AND Gr.CodigoGrupo = Doc.CodigoGrupo 
WHERE Ho.CodigoCiudad = :ciudad AND Gr.FechaGrupo = :fecha GROUP BY Pro.CodigoPrograma HAVING COUNT( * )');
$SeleProgram->bindparam(':ciudad', $_SESSION['NoCiudad']);
$SeleProgram->bindparam(':fecha', $fecha);
$SeleProgram->execute();
$ResulPrograma = $SeleProgram->fetchAll();
$fila = $SeleProgram->fetch();
$SeleProgram = null;


?>

<div class='container' style='margin-top: 6%; width: 20rm;'>
    <div class="card">
        <div class="card-body">
            <form action="InserMatricula.php" method="post" autocomplete="off">
                <input type="hidden" value="<?php echo $_SESSION['CodigoUser']?>" name="CodigoUser">
                <input type="hidden" value="<?php echo $_SESSION['NoCiudad']?>" name="NoCiudad">
                <input type="hidden" value="<?php echo $_SESSION['Admi']?>" name="User">
                <div class="card-header">
                    <h2 class="text-center card-title">Matricula</h2>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Identificacion Estudiante</h3>
                        <input required type="number" class="form-control" name="IdentifiacionEstudiate" placeholder="Numero">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Sede</h3>
                        <input type="text" value="<?php echo $_SESSION['Ciudad'] ?>" readonly="" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h3>Programa Asignados</h3>
                        <select required name="programa" id="programa" class="form-control">
                            <option disabled="" value="" selected="">Elejir</option>
                            <?php

                            foreach ($ResulPrograma as $Programa) :
                                ?>
                                <option value="<?php echo $Programa['CodigoPrograma'] ?>"><?php echo $Programa['categoriaPrograma'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Grupo</h3>
                            <select required name="grupo" id="grupo" class="form-control">
                                <option value="0" selected="">Elejir</option>
                            </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6" id="valor">
                    <h3>Valor</h3>
                        <input required type="text" readonly="" placeholder="$"  class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                    <h3>Cuotas</h3>
                        <input required type="number" placeholder="Numero de Cuotas" min="1" max="12" name="cuota" class="form-control">
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
                $.post("../extends/obtenerGrupoAsig.php", {
                    CodigoPrograma: CodigoPrograma
                }, function(data) {
                    $("#grupo").html(data);
                });
            });
        })
    });

    $(document).ready(function() {
        $("#programa").change(function() {
            $("#programa option:selected").each(function() {
                CodigoPrograma = $(this).val();
                console.log(CodigoPrograma)
                $.post("../extends/obtenerValor.php", {
                    CodigoPrograma: CodigoPrograma
                }, function(data) {
                    $("#valor").html(data);
                });
            });
        })
    });
</script>

</body>

</html>