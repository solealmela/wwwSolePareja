<?php
    session_start();

    $usuaris_registrats = file("../usuaris/passwd.txt");

    $correu = $_POST["correu"];
    $contrasenya = $_POST["contrasenya"];

    $correu_correcte = false;
    $contrasenya_correcta = false;

    foreach ($usuaris_registrats as $usuari) {
        $datos = explode(":", $usuari);

        if (strcasecmp($correu, $datos[1]) === 0) {
            $correu_correcte = true;
            $_SESSION["correo"] = $datos[1];
            if ($contrasenya == $datos[2]) {
                $contrasenya_correcta = true;
                $_SESSION["usuari"] = $datos[0];
            }
        }
    }
    
    if (!$correu_correcte) {
        $error = "?error=usuari";
    } else if (!$contrasenya_correcta) {
        $error = "?error=contrasenya";
    }
    
    header("Location: ../index.php".$error);
    die();
?>