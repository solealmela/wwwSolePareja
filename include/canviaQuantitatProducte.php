<?php
session_start();

require_once("entity/CarretCompra.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['quantitat']) && is_numeric($_POST['quantitat'])) {
        $idProducte = intval($_POST['id']);
        $novaQuantitat = floatval($_POST['quantitat']);

        if (isset($_SESSION['carret'])) {
            $carret = unserialize($_SESSION['carret']);

            $carret->canviarQuantitatProducte($idProducte, $novaQuantitat);

            $_SESSION['carret'] = serialize($carret);
        }
    }
}

header("Location: ../index.php?apartat=botiga&mostrar=carret");
exit();
