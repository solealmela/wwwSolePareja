<?php
include_once('./funcions.php');
session_start();

if (isset($_SESSION['usuari'])) {
    escriureLog($_SESSION['usuari'], "Logout");
}

$_SESSION = []; 

session_destroy();

header("Location: ../index.php");
exit();
?>
