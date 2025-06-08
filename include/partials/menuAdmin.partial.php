<nav id="menu-admin">
    <ul>
        <?php
        $apartatAdmin = $_GET['apartatAdmin'] ?? 'usuaris';

        $opcionsAdmin = [
            'usuaris' => 'Usuaris',
            'comandes' => 'Comandes',
            'productes' => 'Productes'
        ];

        foreach ($opcionsAdmin as $clau => $nom) {
            echo '<li class="' . ($apartatAdmin === $clau ? 'actiu' : '') . '">';
            if ($apartatAdmin === $clau) {
                echo "<span>$nom</span>";
            } else {
                echo '<a href="index.php?apartat=admin&apartatAdmin=' . $clau . '">' . $nom . '</a>';
            }
            echo '</li>';
        }
        ?>
    </ul>
</nav>
