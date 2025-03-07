<?php
    $diesSetmana = array('Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte');

    $mesos = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny','Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');

    $diaSetmana = date('w'); 
    $diaMes = date('j'); 
    $mesActual = date('n') - 1;
    $anyActual = date('Y'); 

    $dataActual = $diesSetmana[$diaSetmana] . ", " . $diaMes . " de " . $mesos[$mesActual] . " de " . $anyActual;

    echo "<div class='fecha_estilos'>
            $dataActual
        </div>";
?>