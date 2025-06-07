<?php
include_once("./funcions.php");
include_once("../include/entity/CarretCompra.php");
include_once("../include/entity/Producte.php");

session_start();

$usuaris_registrats = file("../usuaris/passwd.txt");

$correu = $_POST["correu"] ?? '';
$contrasenya = $_POST["contrasenya"] ?? '';

$correu_correcte = false;
$contrasenya_correcta = false;

foreach ($usuaris_registrats as $usuari) {
    $datos = explode(":", $usuari);

    if (count($datos) >= 3 && strcasecmp($correu, $datos[1]) === 0) {
        $correu_correcte = true;
        $_SESSION["correo"] = $datos[1];

        $hash_guardado = trim($datos[2]);

        if (password_verify($contrasenya, $hash_guardado)) {
            $contrasenya_correcta = true;
            $_SESSION["usuari"] = $datos[0];

            if (isset($_SESSION['carret'])) {
                $carret = unserialize($_SESSION['carret']);
                
                if ($carret instanceof CarretCompra) {
                    $carret->setIdUsuari($datos[1]);
                    $_SESSION['carret'] = serialize($carret);
                    unset($carret);
                }
            }

            break;
        }
    }
}

if (!$correu_correcte) {
    escriureLog("anònim", "Login incorrecte - correu inexistent: $correu");
    $error = "?error=usuari";
} else if (!$contrasenya_correcta) {
    escriureLog($datos[0], "Login incorrecte - contrasenya incorrecta");
    $error = "?error=contrasenya";
} else {
    escriureLog($datos[0], "Login correcte");
    $error = "";
}

header("Location: ../index.php" . $error);
exit;

?>
