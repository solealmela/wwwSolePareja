<?php
    $apartat="inici";
    if(isset($_GET['apartat'])){
        $apartat = $_GET['apartat'];
    }

    include_once ('include/partials/'.$apartat.'.partial.php');
?>