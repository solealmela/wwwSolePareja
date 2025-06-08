<?php
session_start();

require_once("entity/Producte.php");
require_once("entity/CarretCompra.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idProducte = intval($_GET['id']);

    if (isset($_SESSION['carret'])) {

        $carret = unserialize($_SESSION['carret']);
        $carret->eliminarProducte($idProducte);

        if (isset($_SESSION['idProducte']) && $_SESSION['idProducte'] == $idProducte) {
            unset($_SESSION['idProducte'], $_SESSION['nomProducte'], $_SESSION['quantitatProducte'], $_SESSION['preu'], $_SESSION['preuTotal']);
        }

        $_SESSION['carret'] = serialize($carret);
    }
}

header("Location: ../index.php?apartat=botiga&mostrar=carret");
exit();
?>
