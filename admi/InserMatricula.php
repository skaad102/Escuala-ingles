<?php
/* Tener en cuenta el usuario para su Codigo ID */

include '../extends/headerphp.php';
include '../extends/alerta.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdentifiacionEstudiate = htmlentities($_POST['IdentifiacionEstudiate']);
    $NoCiudad = htmlentities($_POST['NoCiudad']);
    $CodigoUser = htmlentities($_POST['CodigoUser']);
    $Grupo = htmlentities($_POST['grupo']);
    $CodigoPrograma = htmlentities($_POST['programa']);
    $Fechafactura = date('Y') . '-' . date('m') . '-' . date('d');
    /* dinero */
    $Valor = htmlentities($_POST['valor']);
    $Cuota = htmlentities($_POST['cuota']);

    $Valor = (float)$Valor;
    $Cuota = (float)$Cuota;

    $Pago = $Valor / $Cuota;
    $Debe = $Valor - $Pago;
    $Pago = ceil($Pago);
    $Debe = ceil($Debe);

    /* buscar estudiante
            para obtener su codigo */
    /* Buscar el docente medianre el codigo del grupo */
    /* si sxite insetarlo en a tabla matricula 
                si no regresarlo porque aun no exixte el estudiante */
    $SelecEstu = $Con->prepare('SELECT COUNT(*) FROM estudiante WHERE cardex  =  ?');
    $SelecEstu->execute(array($IdentifiacionEstudiate));
    if ($SelecEstu->fetchColumn() > 0) {
        $SelecEstu = $Con->prepare('SELECT * FROM estudiante WHERE cardex  =  ?');
        $SelecEstu->execute(array($IdentifiacionEstudiate));
        $FilaEst = $SelecEstu->fetch();

        $CodigoEstudiante = $FilaEst['CodigoEstudiante'];
        $SelecEstu = null;

        $SelecDocente = $Con->prepare('SELECT * FROM docente WHERE CodigoGrupo = ?');
        $SelecDocente->execute(array($Grupo));
        $FilaDoc = $SelecDocente->fetch();

        $CodigoDocente = $FilaDoc['CodigoDocente'];
        $SelecDocente = null;

        /* Buscar si el estudiante no esta registrado dos veces */

        $MatriculaEstudiante = $Con->prepare('SELECT COUNT(*) FROM matricula Mat INNER JOIN docente Doc 
                ON Mat.CodigoDocente = Doc.CodigoDocente AND Doc.CodigoGrupo = :CodigoGrupo
                 WHERE Mat.CodigoEstudiante = :CodigoEstudiante');
        $MatriculaEstudiante->bindparam(':CodigoEstudiante', $CodigoEstudiante);
        $MatriculaEstudiante->bindparam(':CodigoGrupo', $Grupo);
        $MatriculaEstudiante->execute();
        /* no debe existir mas de un regitro de un estudianre en la misma clase */
        if ($MatriculaEstudiante->fetchColumn() == 0) {
            $MatriculaEstudiante = null;
            $InserMatricula = $Con->prepare('INSERT INTO matricula VALUES(DEFAULT, :CodigoEstudiante, :CodigoUser, :CodigoDocente, :NoCiudad)');
            $InserMatricula->bindparam(':CodigoEstudiante', $CodigoEstudiante);
            $InserMatricula->bindparam(':CodigoUser', $CodigoUser);
            $InserMatricula->bindparam(':CodigoDocente', $CodigoDocente);
            $InserMatricula->bindparam(':NoCiudad', $NoCiudad);

            if ($InserMatricula->execute()) {
                $CodigoMatricula = $Con->lastInsertId();
                /* Crear el concepto de la factura */
                $SelecPrograma = $Con->prepare('SELECT * FROM programa WHERE CodigoPrograma  =  ?');
                $SelecPrograma->execute(array($CodigoPrograma));
                $FilaP = $SelecPrograma->fetch();
                $Concepto = $FilaP['categoriaPrograma'];
                $SelecGrupo = $Con->prepare('SELECT * FROM grupo WHERE CodigoGrupo =  ?');
                $SelecGrupo->execute(array($Grupo));
                $FilaG = $SelecGrupo->fetch();
                $GrupoAsig = $FilaG['NombreGrupo'];
                $Concepto = $Concepto . ' Grupo ' . $GrupoAsig;


                $NumeroRecibo = "num";
                $InserPago = $Con->prepare('INSERT INTO pago VALUES(DEFAULT, :Concepto, :Pago, :NumeroRecibo)');
                $InserPago->bindparam(':Concepto', $Concepto);
                $InserPago->bindparam(':Pago', $Pago);
                $InserPago->bindparam(':NumeroRecibo', $NumeroRecibo);
                $InserPago->execute();

                $CodigoPago = $Con->lastInsertId();

                /* si es una cuota o mas */
                if ($Debe <= 0) {
                    $Concepto = "PAGADO";
                    $Cuota = 0;
                } else {
                    $Concepto = "NO PAGO";
                    $Cuota = $Cuota - 1;
                }

                $EstadoCuenta = $Con->prepare('INSERT INTO estado VALUES(DEFAULT, :CodigoMatricula, :NombreEstado, :Debe, :Cuota, :CodigoEstudiante )');
                $EstadoCuenta->bindparam(':CodigoMatricula', $CodigoMatricula);
                $EstadoCuenta->bindparam(':NombreEstado', $Concepto);
                $EstadoCuenta->bindparam(':Debe', $Debe);
                $EstadoCuenta->bindparam(':Cuota', $Cuota);
                $EstadoCuenta->bindparam(':CodigoEstudiante', $CodigoEstudiante);

                /* Generar facturas */
                if ($EstadoCuenta->execute()) {


                    $InserFactura = $Con->prepare('INSERT INTO factura VALUES(DEFAULT, :CodigoMatricula, :CodigoPago, :CodigoUser, :Fechafactura, :Debe, :Pago)');
                    $InserFactura->bindparam(':CodigoMatricula', $CodigoMatricula);
                    $InserFactura->bindparam(':CodigoPago', $CodigoPago);
                    $InserFactura->bindparam(':CodigoUser', $CodigoUser);
                    $InserFactura->bindparam(':Fechafactura', $Fechafactura);
                    $InserFactura->bindparam(':Debe', $Debe);
                    $InserFactura->bindparam(':Pago', $Pago);

                    if ($InserFactura->execute()) {
                        $SelecGrupo = null;
                        $InserMatricula = null;
                        $SelecPrograma = null;
                        $InserPago = null;
                        $InserFactura = null;
                        $Con = null;

                        echo alerta('Registro Completo', 'NuevaMatricula.php');
                    } else {
                        echo alerta('Error En Factura', 'NuevaMatricula.php');
                    }
                } else {
                    echo alerta('Error generando Estado', 'NuevaMatricula.php');
                }
            } else {
                echo alerta('Error Insertando Datos', 'NuevaMatricula.php');
            }
        } else {
            echo alerta('El estudiante ya esta registrado en esta clase', 'NuevaMatricula.php');
        }
    } else {
        echo alerta('No se encontro al estudiante, verifica', 'NuevaMatricula.php');
    }
} else {
    echo alerta('Utiliza el formulario', 'NuevaMatricula.php');
}

include '../extends/footer.php'; ?>


</body>

</html>