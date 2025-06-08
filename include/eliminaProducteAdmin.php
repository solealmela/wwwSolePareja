<?php
if (!isset($_GET['id'])) {
    header("Location: ../index.php?apartat=admin&apartatAdmin=productes&missatge=ID%20no%20proporcionat");
    exit;
}

include_once('entity/CredencialsBD.php');
$conn = new mysqli("localhost", CredencialsBD::USUARI, CredencialsBD::CONTRASENYA, "proyectoPHPSole");

$id = intval($_GET['id']);

if ($conn->connect_error) {
    header("Location: ../index.php?apartat=admin&apartatAdmin=productes&missatge=Error%20de%20connexio");
    exit;
}

$consultaImg = $conn->prepare("SELECT imatge FROM producte WHERE id = ?");
$consultaImg->bind_param("i", $id);
$consultaImg->execute();
$result = $consultaImg->get_result();
$row = $result->fetch_assoc();

if ($row && !empty($row['imatge'])) {
    $rutaImg = "../img/productes/botiga/" . $row['imatge'];
    if (file_exists($rutaImg)) {
        unlink($rutaImg);
    }
}

$consulta = $conn->prepare("DELETE FROM producte WHERE id = ?");
$consulta->bind_param("i", $id);
$consulta->execute();

$conn->close();

header("Location: ../index.php?apartat=admin&apartatAdmin=productes&missatge=Producte%20eliminat%20correctament");
exit;
?>
