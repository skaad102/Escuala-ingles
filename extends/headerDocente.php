<?php 
    include_once '../conexion/conexion.php';
    
    session_start();
   
    $UserSesion = $_SESSION['Docente'];
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
    $SelecCuidad->execute(array($_SESSION['Docente']));
    $row = $SelecCuidad->fetch();
    $Ciudad = $row['NombreCiudad'];
    $_SESSION['Ciudad'] = $Ciudad;
    $SelecCuidad = null;
    $Con = null;
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

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    
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
                        <a href="#" class="nav-link dropdown-toggle" id="navDrop" role="buttom" data-toggle="dropdown">Estudiante</a>
                        </a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0"> 
                    <a href="../extends/cerrarSession.php" class="btn btn-danger btn-ron my-2 my-sm-0" >Salir</a>
                </form>
            </div>
        </div>
    </nav>
