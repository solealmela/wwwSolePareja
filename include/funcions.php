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

    $contrasenya_encriptada = password_hash($contrasenya, PASSWORD_DEFAULT);

    $nova_linia = "$nom:$email:$contrasenya_encriptada:\n";
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
        echo '<div class="missatgeError">';
            echo '<span>Error ' . $error . '</span>';
        echo '</div>';
    }
}

function missatgeErrorContrasenya(string $error) {
    if (isset($error)) {
        echo '<div class="missatgeError">';
            echo '<span>Les contrasenyes no coincideixen</span>';
        echo '</div>';
    }
}

function mostraProductes($rutaFitxer) {
    include($rutaFitxer);

    if (!isset($productes) || !is_array($productes)) {
        echo "<p>No hi ha productes per mostrar.</p>";
        return;
    }

    echo '<div class="llista-productes">';

    foreach ($productes as $id => $dades) {
        echo '<div class="producte">';
        echo '<h3>' . htmlspecialchars($dades["nom"]) . '</h3>';
        echo '<img src="img/productes/botiga/' . htmlspecialchars($dades["imatge"]) . '" alt="' . htmlspecialchars($dades["nom"]) . '">';
        echo '<p id="descripcio">' . htmlspecialchars($dades["descripcio"]) . '</p>';
        echo '<p id="preu"><strong>Preu: </strong>' . number_format($dades["preu"], 2) . ' €</p>';
        echo '</div>';
    }

    echo '</div>';
}
?>
