<?php

declare(strict_types=1);

function guardarUsuari(string $nom, string $email, string $contrasenya, string $fitxer): bool
{
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

function missatge(bool $registreExit, string $email): void
{
    if ($registreExit) {
        echo "<p id='correcte'>Usuari registrat correctament: $email</p>";
    } else {
        echo "<p id='error'>Error: El correu $email ja està registrat.</p>";
    }
}

function missatgeErrorLogin(string $error)
{
    if (isset($error)) {
        echo '<div class="missatgeError">';
        echo '<span>Error ' . $error . '</span>';
        echo '</div>';
    }
}

function missatgeErrorContrasenya(string $error)
{
    if (isset($error)) {
        echo '<div class="missatgeError">';
        echo '<span>Les contrasenyes no coincideixen</span>';
        echo '</div>';
    }
}

function mostraProductes($rutaFitxer)
{
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
        echo '<div id="formulari">';
        mostraFormulariProducte($id);
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
}

function mostraFormulariProducte($id)
{
    echo '
            <form id="formProducte' . $id . '" name="formProducte' . $id . '" action="index.php?apartat=botiga" method="POST">
            <input type="hidden" id="idProducte' . $id . '" name="idProducte" value="' . $id . '" />
            <div id="quantitat">
            <span><label for="quantitat">Quantitat:</label></span>
            <span>
            <input id="quantitatProducte' . $id . '" name="quantitatProducte" type="number" min="0" step="0.05" />
            <span><label for="kg">kg</label></span>
            </span>
            </div>
            <div>
            <span>
            <input class="botonFormulario" id="afegir_carret' . $id . '" name="envia" type="submit" value="Afegeix al carret"/>
            </span>
            </div>
            </form>
        ';
}

function escriureLog($nomUsuari, $accio)
{
    $rutaBase = dirname(__FILE__, 2);
    $fitxerLog = $rutaBase . '/log/registre.log';

    $dataHora = date("Y-m-d H:i:s");

    $missatge = "[$dataHora] Usuari: $nomUsuari - Acció: $accio" . PHP_EOL;

    file_put_contents($fitxerLog, $missatge, FILE_APPEND);
}

function mostraProductesBD()
{
    include_once('entity/CredencialsBD.php');

    $servidor = "localhost";
    $usuari = CredencialsBD::USUARI;
    $contrasenya = CredencialsBD::CONTRASENYA;
    $basedades = "proyectoPHPSole";

    $connexio = new mysqli($servidor, $usuari, $contrasenya, $basedades);

    if ($connexio->connect_error) {
        echo "<p>No s'ha pogut connectar a la base de dades.</p>";
        return;
    }

    $productesPerPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($paginaActual < 1) $paginaActual = 1;
    $offset = ($paginaActual - 1) * $productesPerPagina;

    $sqlTotal = "SELECT COUNT(*) AS total FROM producte";
    $resultatTotal = $connexio->query($sqlTotal);
    $totalProductes = $resultatTotal->fetch_assoc()['total'];
    $totalPagines = ceil($totalProductes / $productesPerPagina);

    $sql = "SELECT * FROM producte LIMIT $offset, $productesPerPagina";
    $resultat = $connexio->query($sql);

    if (!$resultat || $resultat->num_rows === 0) {
        echo "<p>No hi ha productes per mostrar.</p>";
        return;
    }

    echo '<div class="llista-productes">';

    while ($fila = $resultat->fetch_assoc()) {
        $id = htmlspecialchars($fila['id']);
        $nom = htmlspecialchars($fila['nom']);
        $imatge = htmlspecialchars($fila['imatge']);
        $descripcio = htmlspecialchars($fila['descripcio']);
        $preu = number_format((float)$fila['preu'], 2);

        echo '<div class="producte">';
        echo '<h3>' . $nom . '</h3>';
        echo '<img src="img/productes/botiga/' . $imatge . '" alt="' . $nom . '">';
        echo '<p id="descripcio">' . $descripcio . '</p>';
        echo '<p id="preu"><strong>Preu: </strong>' . $preu . ' €</p>';
        echo '<div id="formulari">';
        mostraFormulariProducte($id);
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

    echo '<div class="paginacio">';

    if ($paginaActual > 1) {
        echo '<a href="index.php?apartat=botiga&pagina=1">&laquo; Inici</a> ';
        echo '<a href="index.php?apartat=botiga&pagina=' . ($paginaActual - 1) . '">&lsaquo; Anterior</a> ';
    }

    for ($i = 1; $i <= $totalPagines; $i++) {
        if ($i == $paginaActual) {
            echo '<strong>' . $i . '</strong> ';
        } else {
            echo '<a href="index.php?apartat=botiga&pagina=' . $i . '">' . $i . '</a> ';
        }
    }

    if ($paginaActual < $totalPagines) {
        echo '<a href="index.php?apartat=botiga&pagina=' . ($paginaActual + 1) . '">Següent &rsaquo;</a> ';
        echo '<a href="index.php?apartat=botiga&pagina=' . $totalPagines . '">Final &raquo;</a>';
    }

    echo '</div>';

    $connexio->close();
}
