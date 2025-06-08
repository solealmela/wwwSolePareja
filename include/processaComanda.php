<?php
session_start();
include_once("entity/CarretCompra.php");
include_once("entity/Producte.php");
include_once("entity/CredencialsBD.php");

$usuari = $_SESSION['usuari'];
$carret = unserialize($_SESSION['carret']);
$productes = $carret->getProductes();

if (empty($productes)) {
    $_SESSION['missatge_compra'] = "No hi ha productes al carret.";
    header("Location: ../index.php?apartat=botiga");
    exit();
}

$cadenaProductes = "";
foreach ($productes as $producte) {
    $cadenaProductes .= $producte->getId() . ":" . $producte->getQuantitat() . ":" . $producte->getPreu() . ":";
}

$conn = new mysqli("localhost", CredencialsBD::USUARI, CredencialsBD::CONTRASENYA, "proyectoPHPSole");

if ($conn->connect_error) {
    $_SESSION['missatge_compra'] = "Error de connexió: " . $conn->connect_error;
    header("Location: ../index.php?apartat=botiga");
    exit();
}

$stmt = $conn->prepare("INSERT INTO comanda (usuari, productes) VALUES (?, ?)");
$stmt->bind_param("ss", $usuari, $cadenaProductes);

if ($stmt->execute()) {
    $_SESSION['missatge_compra'] = "La comanda s'ha realitzat correctament.";
    unset($_SESSION['carret']);
} else {
    $_SESSION['missatge_compra'] = "Error en registrar la comanda";
}

$stmt->close();
$conn->close();

header("Location: ../index.php?apartat=botiga");
exit();
?>
