<?php 
    include_once '../conexion/conexion.php';
    include 'alerta.php';
    ob_start();
    session_start();
   
    $UserSesion = $_SESSION['Admi'];
    if($UserSesion == null || $UserSesion = ''){
        header('location:../index.php');
        /* echo alerta('No tienes permisos','../index.php'); */
        die();
    }elseif(!isset($UserSesion)){
        session_destroy();
        header('location:index.php'); 
        die();
    }
    $SelecCuidad = $Con->prepare('SELECT * FROM ciudad Ci INNER JOIN cargo Ca INNER JOIN user Us 
                ON Ci.CodigoCiudad = Ca.CodigoCiudad AND Ca.CodigoUser = Us.CodigoUser WHERE Us.NombreUser = ?');
    $SelecCuidad->execute(array($_SESSION['Admi']));
    $row = $SelecCuidad->fetch();
    $Ciudad = $row['NombreCiudad'];
    $NoCiudad = $row['CodigoCiudad'];
    $CodigoUser = $row['CodigoUser'];
    
    $_SESSION['NoCiudad'] = $NoCiudad;
    $_SESSION['Ciudad'] = $Ciudad;
    $_SESSION['CodigoUser'] = $CodigoUser;
    $SelecCuidad = null;
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    
    <link rel="stylesheet" href="../css/app.css">
    <title>Lingoyes</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark gris scrolling-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img img src="../img/lingo.png" alt="logoyes" width="200" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navDrop" role="buttom" data-toggle="dropdown">Usuarios</a>
                            <div class="dropdown-menu" aria-labelledby="navDrop" aria-haspopup="true" aria-expanded="false">
                            <a class="nav-link text-dark" href="NuevoUsuario.php">Nuevo Usuario</a>
                            <a class="nav-link text-dark" href="ListaUsuarios.php">Lista Usuarios</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navDrop" role="buttom" data-toggle="dropdown">Estudiante</a>
                            <div class="dropdown-menu" aria-labelledby="navDrop" aria-haspopup="true" aria-expanded="false">
                                <a class="nav-link text-dark" href="NuevoEstudiante.php">Nuevo Estudiante</a>
                                <a class="nav-link text-dark" href="ListaEstudiante.php">Lista Estudiantes</a>
                                <a class="nav-link text-dark" href="PagoEstudiante.php">Pagos </a>
                                <a class="nav-link text-dark" href="LlamadaEstudiante.php">Llamadas </a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navDrop" role="buttom" data-toggle="dropdown">Clases</a>
                            <div class="dropdown-menu" aria-labelledby="navDrop" aria-haspopup="true" aria-expanded="false">
                                <a class="nav-link text-dark" href="NuevaClase.php">Nueva Clase</a>
                                <a class="nav-link text-dark" href="AsignarClase.php">Asignar Clase</a>
                                <a class="nav-link text-dark" href="ListaClase.php">Lista de Clase</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navDrop" role="buttom" data-toggle="dropdown">Matricula</a>
                            <div class="dropdown-menu" aria-labelledby="navDrop" aria-haspopup="true" aria-expanded="false">
                                <a class="nav-link text-dark" href="NuevaMatricula.php">Nueva Matricula</a>
                            </div>
                        </a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0"> 
                    <a href="../extends/cerrarSession.php" class="btn btn-danger btn-ron my-2 my-sm-0" >Salir</a>
                </form>
            </div>
        </div>
    </nav>
