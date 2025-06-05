<nav id="menu">
    <ul>
        <?php
            $apartatActual = $_GET['apartat'] ?? 'inici';

            if (isset($_SESSION["usuari"]) && $_SESSION["correo"] == "admin@dam.com") {
                echo '';
            } elseif (isset($_SESSION["usuari"])) {
                $opcions = ['inici' => 'Inici', 'contacte' => 'Contacte', 'botiga' => 'Botiga'];
            } else {
                $opcions = ['inici' => 'Inici', 'registre' => 'Registre', 'contacte' => 'Contacte', 'botiga' => 'Botiga'];
            }

            if (!empty($opcions)) {
                foreach ($opcions as $clau => $nom) {
                    echo '<li class="' . ($apartatActual === $clau ? 'actiu' : '') . '">';
                    if ($apartatActual === $clau) {
                        echo "<span>$nom</span>";
                    } else {
                        echo '<a href="' . $base . 'index.php?apartat=' . $clau . '">' . $nom . '</a>';
                    }
                    echo '</li>';
                }
            }
        ?>
    </ul>
</nav>
