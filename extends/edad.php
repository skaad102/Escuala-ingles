<?php

    function calcularTiempo($fechaInicio,$fechaFin){
        $tiempo1 = date_create($fechaInicio);
        $tiempo2 = date_create($fechaFin);
        $intervalo = date_diff($tiempo1,$tiempo2);

        $tiempo=array();

        foreach($intervalo as $val){
            $tiempo[]=$val;
        
        }
        return $tiempo;
    }

?>