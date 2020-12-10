<?php include '../extends/headerAdmi.php';

$UserTotal = $Con->prepare('SELECT * FROM user Us INNER JOIN cargo Car ON Car.CodigoUser = Us.CodigoUser WHERE Car.CodigoCiudad = ?');
$UserTotal->execute(array($_SESSION['NoCiudad']));
$Resusltado = $UserTotal->fetchAll();

$Row = $UserTotal->rowCount();
$UserXPagina = 15;

$paginas = $Row / $UserXPagina;
$paginas = ceil($paginas);

if (!$_GET) {
    header('location:ListaUsuarios.php?pagina=1');
    ob_end_flush();
}
if ($_GET['pagina'] > $paginas) {
    header('location:ListaUsuarios.php?pagina=1');
    ob_end_flush();
}
$Inicio = ($_GET['pagina'] - 1) * $UserXPagina;
$SelecUser = $Con->prepare('SELECT * FROM user Us INNER JOIN cargo Car ON Car.CodigoUser = Us.CodigoUser WHERE Car.CodigoCiudad = :ciudad LIMIT :inicio ,:NUser');
$SelecUser->bindparam(':ciudad', $_SESSION['NoCiudad']);
$SelecUser->bindparam(':inicio', $Inicio, PDO::PARAM_INT);
$SelecUser->bindparam(':NUser', $UserXPagina, PDO::PARAM_INT);
$SelecUser->execute();

$ResulUser = $SelecUser->fetchAll();
?>

<div class="container " style="margin-top:7%">
    <nav class="my-3" aria-label="Page navigation example">
        <ul class="pagination pg-blue justify-content-center">
            <li class="page-item  <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="ListaUsuarios.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
            </li>
            <?php for ($i = 0; $i < $paginas; $i++) : ?>
                <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                    <a class="page-link" href="ListaUsuarios.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                <a class="page-link" href="ListaUsuarios.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
            </li>
        </ul>
    </nav>

    <div class="card mb-3">
        <div class="card-header"><h4 class="card-title">USUARIOS DE <?php echo $_SESSION['Ciudad']?></h4></div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Teléfono</th>
                        <th>Cargo</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach ($ResulUser as $user) :
                                ?>
                                <tr>
                                    <td> <?php echo $user['Identificacion'] ?></td>
                                    <td><?php echo $user['NombrePersonal'] ?></td>
                                    <td><?php echo $user['NombreUser'] ?></td>
                                    <td><?php echo $user['TelefonoPersonal'] ?></td>
                                    <td><?php echo $user['rol'] ?></td>


                                    <td><a href="EditarUser.php?CodigoUser=<?php echo $user['CodigoUser'] ?>" class="btn btn-success px-3"><i class="far fa-edit"></i></a></td>
                                    <td><a href="#" class="btn btn-danger px-3" onclick="bootbox.confirm('Seguro que desea realizar esta acción',function(re){if(re == true){
                                                        location.href ='EliminarUser.php?CodigoUser=<?php echo $user['CodigoUser'] ?>&CodigoCargo=<?php echo $Fila['CodigoCargo'] ?>';
                                                    }})"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php
                            endforeach;
                            $Con = null;
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>

<?php include '../extends/footer.php'; ?>
</body>

</html>