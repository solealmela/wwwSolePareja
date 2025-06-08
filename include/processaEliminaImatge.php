<?php
session_start();

if (!isset($_SESSION['usuari']) || !isset($_SESSION['correo'])) {
    header("Location: ../index.php?apartat=inici&error=no_sessio");
    exit();
}

$correu = $_SESSION['correo'];
$extensions = ['png', 'jpg', 'jpeg', 'gif'];

foreach ($extensions as $ext) {
    $fitxer = "../img/usuaris/" . $correu . "." . $ext;
    if (file_exists($fitxer)) {
        unlink($fitxer);
    }
}

header("Location: ../index.php?apartat=inici&perfil=canvi&ok=eliminada");
exit();
?>
