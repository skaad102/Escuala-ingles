<?php 
include '../conexion/conexion.php';
 
 $CodigoPrograma = htmlentities($_POST['CodigoPrograma']);

 $SelecGrupo = $Con->prepare('SELECT Gr.CodigoGrupo,Gr.NombreGrupo FROM grupo Gr INNER JOIN programa Pr ON Gr.CodigoPrograma = Pr.CodigoPrograma 
                     WHERE Pr.CodigoPrograma = :CodigoPrograma');
                     $SelecGrupo->bindparam(':CodigoPrograma',$CodigoPrograma);
 if($SelecGrupo->execute()){
 $ResulGrupo = $SelecGrupo->fetchAll();



    $html = '<option value="0" >Elejir</option>';

    foreach($ResulGrupo as $Grupo ){
    
    $html = "<option value='".$Grupo['CodigoGrupo']."'>".$Grupo['NombreGrupo']."</option>";
    echo $html; 
    }     
 }
 
 ?>

</body>
</html>