<?php 
include '../conexion/conexion.php';
 
 $CodigoPrograma = htmlentities($_POST['CodigoPrograma']);

 $SelecGrupo = $Con->prepare('SELECT ValorPrograma FROM programa WHERE CodigoPrograma = :CodigoPrograma');
                     $SelecGrupo->bindparam(':CodigoPrograma',$CodigoPrograma);
 if($SelecGrupo->execute()){
 $ResulGrupo = $SelecGrupo->fetchAll();




    foreach($ResulGrupo as $Grupo ){
    
    $html = '<h3>Valor</h3><input required type="number" name="valor" value="'.$Grupo['ValorPrograma'].'" readonly="" placeholder="$'.$Grupo['ValorPrograma'].'" class="form-control">';

    }     
    echo $html; 
 }
 
 ?>

</body>
</html>