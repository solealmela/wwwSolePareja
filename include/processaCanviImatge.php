<?php
session_start();

if (!isset($_SESSION['usuari'])) {
    header("Location: ../index.php?apartat=inici&error=no_sessio");
    exit();
}

if (!isset($_FILES['imatge']) || $_FILES['imatge']['error'] !== UPLOAD_ERR_OK) {
    header("Location: ../index.php?apartat=inici&perfil=canvi&error=pujada");
    exit();
}

$fitxer = $_FILES['imatge'];
$tipusPermesos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
$midaMaxima = 400 * 1024;

if (!in_array($fitxer['type'], $tipusPermesos)) {
    header("Location: ../index.php?apartat=inici&perfil=canvi&error=tipus");
    exit();
}

if ($fitxer['size'] > $midaMaxima) {
    header("Location: ../index.php?apartat=inici&perfil=canvi&error=mida");
    exit();
}

$extensio = pathinfo($fitxer['name'], PATHINFO_EXTENSION);
$correu = $_SESSION['correo'];
$nomNou = $correu . "." . $extensio;
$destinacio = "../img/usuaris/" . $nomNou;

$extensions = ['png', 'jpg', 'jpeg', 'gif'];
foreach ($extensions as $ext) {
    $fitxerAnterior = "../img/usuaris/" . $correu . "." . $ext;
    if (file_exists($fitxerAnterior)) {
        unlink($fitxerAnterior);
    }
}

if (!move_uploaded_file($fitxer['tmp_name'], $destinacio)) {
    header("Location: ../index.php?apartat=inici&perfil=canvi&error=guardar");
    exit();
}

header("Location: ../index.php?apartat=inici&ok=imatge");
exit();
?>
