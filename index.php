<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <title>Escuela Ingles</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: rgba(233, 36, 36, 0.76);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>

        <nav class="navbar navbar-expand-lg navbar-dark gris">
            <a href="#">
                <img src="img/lingo.png" alt="logoyes" >
            </a>
        </nav>
    <div class="container" style="margin-top: 15%; width: 40rm;">
        <div class="well">
            <h1 class="text-white">Inicio de Seción</h1>
            <form action="validar.php" method="post">
                <div class="form-group">
                
                    <input required type="text" name="usuario" class="form-control form-control-lg" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <input required type="password" name="pass" class="form-control form-control-lg" placeholder="Contraseña">
                </div>
                <select required name="Cargo" class="browser-default custom-select">
                    <option value="" disabled>Elije</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Secretaria">Secretaria</option>
                    <option value="Docente">Docente</option>
                </select>
                <button type="submit" class="btn btn-success">ENTRAR</button>
            </form>
        </div>
    </div>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/js/mdb.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
</body>

</html>