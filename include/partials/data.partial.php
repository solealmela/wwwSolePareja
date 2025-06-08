<?php
$diesSetmana = array('Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte');
$mesos = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny','Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');

$diaSetmana = date('w'); 
$diaMes = date('j'); 
$mesActual = date('n') - 1;
$anyActual = date('Y');

if (isset($_SESSION["usuari"]) && isset($_SESSION["correo"])) {
    $correu = $_SESSION["correo"];
    $usuari = $_SESSION["usuari"];

    $extensions = ['png', 'jpg', 'jpeg', 'gif'];
    $imatgeUsuari = "img/usuaris/defecte.png";

    foreach ($extensions as $ext) {
        $ruta = "img/usuaris/" . $correu . "." . $ext;
        if (file_exists($ruta)) {
            $imatgeUsuari = $ruta;
            break;
        }
    }

    $dataActual = "
        <div class='usuari-benvinguda'>
            <img src='$imatgeUsuari' alt='Imatge de perfil' class='foto-perfil'>
            <span id='missatgeBenvinguda'>Hola " . ucfirst($usuari) . "!</span> :: " . 
            $diesSetmana[$diaSetmana] . ", " . $diaMes . " de " . $mesos[$mesActual] . " de " . $anyActual . 
            " :: <a href='index.php?apartat=canviaImatge'>Canviar imatge</a> :: <a href='include/processaLogout.php'>Logout</a>
        </div>
    ";
} else {
    $dataActual = $diesSetmana[$diaSetmana] . ", " . $diaMes . " de " . $mesos[$mesActual] . " de " . $anyActual;
}

echo "<div class='fecha_estilos'>
        $dataActual
    </div>";
?>
