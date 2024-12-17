<?php
    $diesSetmana = array('Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte');

    $mesos = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny','Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');

    $diaSetmana = date('w'); 
    $diaMes = date('j'); 
    $mesActual = date('n') - 1;
    $anyActual = date('Y'); 

    $dataActual = $diesSetmana[$diaSetmana] . ", " . $diaMes . " de " . $mesos[$mesActual] . " de " . $anyActual;

    echo "<div style='text-align:center; margin: 1% 0% 1% 70%; padding: 10px; font-size:20px; font-weight:bold; background-color: white; border: 2px solid #e7f3a1; border-radius:30px; '>
            $dataActual
        </div>";
?>
