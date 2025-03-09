<?php

    if (isset($_SESSION["usuari"]) && $_SESSION["correo"] == "admin@dam.com") {
        $apartat="admin";
    } else {
        $apartat="inici";
    }

    if(isset($_GET['apartat'])){
        $apartat = $_GET['apartat'];
    }

    include_once ('include/partials/'.$apartat.'.partial.php');
?>