<?php include '../extends/headerAdmi.php';

?>
<div class='container' id='DivContainer'>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">BUSCAR PAGOS ESTUDIANTE</h2>
        </div>
        <div class="card-body">
            <div class=" form-group col-md-12 justify-content-center" style="margin-left:10%">
                <form method="POST" autocomplete="off" action="Pago.php" class="form-inline md-form form-sm">
                    <input class="form-control form-control-sm mr-3 w-75" name="cardex" type="number" placeholder="Identificación del Estudiante" aria-label="Search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../extends/footer.php'; ?>
</body>

</html>