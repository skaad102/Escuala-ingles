<?php include '../extends/headerAdmi.php';
$EstudiateTotal = $Con->prepare('SELECT * FROM estudiante WHERE Sede = :Ciudad');
    $EstudiateTotal->bindparam(':Ciudad',$_SESSION['Ciudad']);
$EstudiateTotal->execute();
$Resusltado = $EstudiateTotal->fetchAll();

$Row = $EstudiateTotal->rowCount();
$EstudianteXPagina = 10;

$paginas = $Row / $EstudianteXPagina;
$paginas = ceil($paginas);



if (!$_GET) {
    header('location:ListaEstudiante.php?pagina=1');
    ob_end_flush();
}
if ($_GET['pagina'] > $paginas) {
    header('location:ListaEstudiante.php?pagina=1');
    ob_end_flush();
}


$Inicio = ($_GET['pagina'] - 1) * $EstudianteXPagina;
$SelecEstudiante = $Con->prepare('SELECT * FROM estudiante WHERE Sede = :Ciudad LIMIT :inicio ,:NEstudiantes');
$SelecEstudiante->bindparam(':Ciudad',$_SESSION['Ciudad']);
$SelecEstudiante->bindparam(':inicio', $Inicio, PDO::PARAM_INT);
$SelecEstudiante->bindparam(':NEstudiantes', $EstudianteXPagina, PDO::PARAM_INT);
$SelecEstudiante->execute();

$ResulEstudiante = $SelecEstudiante->fetchAll();
?>
<div class="container " style="margin-top:7%">

    <div class="card mb-5">
        <div class="card-body" id="CardEstudiante">
            <div class="card-header"><h3 class="card-title text-center">LISTA ESTUDIANTES <?php echo $_SESSION['Ciudad']?></h3></div>
            <div class="form-row">
                <div class=" form-group col-md-12 justify-content-center" style="margin-left:10%">
                    <form method="GET" autocomplete="off" action="InfoEstudiante.php" class="form-inline md-form form-sm">
                        <input class="form-control form-control-sm mr-3 w-75" name="cardex" type="number" placeholder="Identificación del Estudiante" aria-label="Search">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </form>
                </div>
            </div>


            <nav class="my-3" aria-label="Page navigation example">
                <ul class="pagination pg-blue justify-content-center">
                    <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="ListaEstudiante.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $paginas; $i++) : 

                    ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href="ListaEstudiante.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="ListaEstudiante.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>

            <div class="row d-flex justify-content-center">
                <?php foreach ($ResulEstudiante as $Est) : ?>
                    <div class="card my-2 col-sm-5 mb-3 mb-md-0 m-3">
                        <div class="view overlay">
                            <img class="card-img-top" src="<?php echo $Est['nombre_foto'] ?>" alt="Imagen estudiante">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Nombre : <?php echo $Est['nombre_estudiante'] ?></h4>
                            <h4 class="card-title">Codigo : <?php echo $Est['cardex'] ?></h4>
                            <hr>
                            <h6>Telefono : </h6>
                            <p class="card-text black-text d-flex justify-content-end"><?php echo $Est['telefono1'] ?></p>
                            <h6>Sede : </h6>
                            <p class="card-text black-text d-flex justify-content-end"><?php echo $Est['Sede'] ?></p>
                            <a href="InfoEstudiante.php?cardex=<?php echo $Est['cardex'] ?>" class="black-text d-flex justify-content-end">
                                <h5>Leer Mas <i class="fas fa-angle-double-right"></i></h5>
                            </a>
                        </div>
                    </div>
                <?php endforeach;
            $EstudiateTotal = null;
            $Con = null;
            ?>
            </div>



            <nav class="my-3" aria-label="Page navigation example">
                <ul class="pagination pg-blue justify-content-center">
                    <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="ListaEstudiante.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $paginas; $i++) : ?>
                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                            <a class="page-link" href="ListaEstudiante.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="ListaEstudiante.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php include '../extends/footer.php'; ?>
</body>

</html>