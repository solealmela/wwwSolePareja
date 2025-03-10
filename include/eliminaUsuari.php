<?php

    $email = $_GET["email"];
    $ruta_fichero = "../usuaris/passwd.txt";
    $usuaris_registrats = file($ruta_fichero);

    file_put_contents($ruta_fichero, "");

    foreach ($usuaris_registrats as $usuari) {
        $datos = explode(":",$usuari);
        if ($datos[1] != $email) {
            file_put_contents($ruta_fichero, $usuari, FILE_APPEND);
        }
    }

    header("Location: ../index.php");
    die();
?>