<?php
declare(strict_types=1);

function guardarUsuari(string $nom, string $email, string $contrasenya, string $fitxer): bool {
    $nom = strtolower($nom);
    $email = strtolower($email);

    if (!file_exists($fitxer)) {
        file_put_contents($fitxer, "");
    }

    $usuaris = file($fitxer, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($usuaris as $usuari) {
        $dades = explode(":", $usuari);
        if ($dades[1] === $email) {
            return false;
        }
    }

    $nova_linia = "$nom:$email:$contrasenya:\n";
    file_put_contents($fitxer, $nova_linia, FILE_APPEND | LOCK_EX);
    return true;
}

function missatge(bool $registreExit, string $email): void {
    if ($registreExit) {
        echo "<p id='correcte'>Usuari registrat correctament: $email</p>";
    } else {
        echo "<p id='error'>Error: El correu $email ja està registrat.</p>";
    }
}

function missatgeErrorLogin(string $error) {
    if (isset($error)) {
        echo '<div id="error_login">';
            echo '<span>Error ' . $error . '</span>';
        echo '</div>';
    }
}
?>
