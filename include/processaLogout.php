<?php
include_once('./funcions.php');
session_start();

if (isset($_SESSION['usuari'])) {
    escriureLog($_SESSION['usuari'], "Logout");
}

unset($_SESSION['carret']);
unset($_SESSION['idProducte']);
unset($_SESSION['nomProducte']);
unset($_SESSION['quantitatProducte']);
unset($_SESSION['preu']);
unset($_SESSION['preuTotal']);

$_SESSION = []; 

session_destroy();

header("Location: ../index.php");
exit();
?>
