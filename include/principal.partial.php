<?php

    if (isset($_SESSION["usuari"]) && $_SESSION["correo"] == "admin@dam.com") {
        $apartat="admin";
    } else {
        $apartat="inici";
    }

    if(isset($_GET['apartat'])){
        $apartat = $_GET['apartat'];
    }

    if (isset($_SESSION['usuari']) && $apartat == 'registre') {
        $apartat = 'inici';
    }

    include_once ('include/partials/'.$apartat.'.partial.php');
?>