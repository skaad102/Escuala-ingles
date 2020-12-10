<?php 
include '../conexion/conexion.php';
 
 $CodigoPrograma = htmlentities($_POST['CodigoPrograma']);

 $SelecGrupo = $Con->prepare('SELECT Gr.CodigoGrupo,Gr.NombreGrupo 
                  FROM docente Doc INNER JOIN grupo Gr INNER JOIN user Usr INNER JOIN programa Pro  
                  ON Doc.CodigoGrupo = Gr.CodigoGrupo AND doc.CodigoUser = Usr.CodigoUser AND Gr.CodigoPrograma = Pro.CodigoPrograma
                     WHERE Pro.CodigoPrograma = :CodigoPrograma');
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