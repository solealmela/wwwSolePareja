<?php
    $diesSetmana = array('Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte');

    $mesos = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny','Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');

    $diaSetmana = date('w'); 
    $diaMes = date('j'); 
    $mesActual = date('n') - 1;
    $anyActual = date('Y');

    if (isset($_SESSION["usuari"])) {
        $dataActual = "<span id='missatgeBenvinguda'>Hola " . ucfirst($_SESSION["usuari"]) . "!</span> :: " . $diesSetmana[$diaSetmana] . ", " . $diaMes . " de " . $mesos[$mesActual] . " de " . $anyActual . " :: <a href='include/processaLogout.php'> Logout</a>";
    } else {
        $dataActual = $diesSetmana[$diaSetmana] . ", " . $diaMes . " de " . $mesos[$mesActual] . " de " . $anyActual;
    }

    

    echo "<div class='fecha_estilos'>
            $dataActual
        </div>";
?>