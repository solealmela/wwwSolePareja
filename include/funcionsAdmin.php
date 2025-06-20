<?php
function gestionaUsuaris() {
    $usuaris_registrats = file("./usuaris/passwd.txt");
    $columnas = ["N", "Nom", "Correu/Login", "Contrasenya", "Acció"];

    echo "<div id='tabla'>";
    echo "<table border='1'>";

    echo "<tr>";
    foreach ($columnas as $columna) {
        echo "<th>" . htmlspecialchars($columna) . "</th>";
    }
    echo "</tr>";

    $contador = 0;

    foreach ($usuaris_registrats as $usuari) {
        $datos = explode(":", trim($usuari));
        $datos = array_filter($datos, function($value) { return $value !== ""; });
        $email = $datos[1];

        if (count($datos) < 3) continue;

        echo "<tr>";

        if ($contador == 0) {
            echo "<td class='estilo_admin'>$contador</td>";
        } else {
            echo "<td>$contador</td>";
        }

        foreach ($datos as $infousuari) {
            if ($email == "admin@dam.com") {
                echo "<td class='estilo_admin'>" . htmlspecialchars($infousuari) . "</td>";
            } else {
                echo "<td>" . htmlspecialchars($infousuari) . "</td>";
            }
        }

        echo "<td>";
        
        if ($email == "admin@dam.com") {
            echo "<button class='estilo_admin'><img style='width: 30px;' src='./img/engranaje.png'></button>";
        } else {
            echo "<a href='include/eliminaUsuari.php?email=" . $email . "'><img style='width: 30px;' src='./img/papelera.png' alt='elimina'/></a>";
        }

        echo "</td>";

        echo "</tr>";

        $contador++;
    }

    echo "</table>";
    echo "</div>";
}

function gestionaComandes() {
    echo "gestionacomandes";
}

function gestionaProductes() {
    include_once('entity/CredencialsBD.php');
    
    $conn = new mysqli("localhost", CredencialsBD::USUARI, CredencialsBD::CONTRASENYA, "proyectoPHPSole");

    if ($conn->connect_error) {
        echo "<p>Error de connexió: " . $conn->connect_error . "</p>";
        return;
    }

    $sql = "SELECT id, nom, preu, stock, imatge FROM producte";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        echo "<p>No hi ha productes.</p>";
        return;
    }

    if (isset($_GET['missatge'])) {
        echo "<p class='missatge-buit'>" . htmlspecialchars($_GET['missatge']) . "</p>";
    }

    echo "<table class='taula-admin'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Preu (€)</th><th>Stock</th><th>Imatge</th><th>Accions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $img = $row["imatge"] ?: "producteDefecte.png";
        $imgPath = "./img/productes/botiga/$img";

        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nom']}</td>";
        echo "<td>" . number_format($row['preu'], 2) . "</td>";
        echo "<td>{$row['stock']}</td>";
        echo "<td><img src='$imgPath' alt='Imatge' class='miniatura'></td>";
        echo "<td>
                <a href='./include/eliminaProducteAdmin.php?id={$row['id']}'>
                    <img src='./img/papelera.png' alt='elimina' class='icona' />
                </a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";

    $conn->close();
}

function mostraLog() {
    $ruta_log = dirname(__FILE__, 2) . "/log/registre.log";

    if (!file_exists($ruta_log) || filesize($ruta_log) == 0) {
        echo "<p>No hi ha registres per mostrar.</p>";
        return;
    }

    $linies = file($ruta_log);

    foreach ($linies as $linia) {
        if (stripos($linia, "Login correcte") !== false) {
            echo "<div class='log log-correcte'>" . htmlspecialchars($linia) . "</div>";
        } elseif (stripos($linia, "Login incorrecte") !== false) {
            echo "<div class='log log-error'>" . htmlspecialchars($linia) . "</div>";
        } elseif (stripos($linia, "Registre") !== false) {
            echo "<div class='log log-registre'>" . htmlspecialchars($linia) . "</div>";
        } elseif (stripos($linia, "Logout") !== false) {
            echo "<div class='log log-logout'>" . htmlspecialchars($linia) . "</div>";
        } elseif (stripos($linia, "Eliminació") !== false) {
            echo "<div class='log log-eliminacio'>" . htmlspecialchars($linia) . "</div>";
        } else {
            echo "<div class='log'>" . htmlspecialchars($linia) . "</div>";
        }
    }
}

?>
