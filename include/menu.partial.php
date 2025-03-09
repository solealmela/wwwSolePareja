<nav id="menu">
    <ul>
        <?php
            if (isset($_SESSION["usuari"]) && $_SESSION["correo"] == "admin@dam.com") {
                echo '
                    <li><a href="'.$base.'index.php?apartat=admin">Inici</a></li>
                    <li><a href="'.$base.'index.php?apartat=admin">Registre</a></li>
                    <li><a href="'.$base.'index.php?apartat=admin">Contacte</a></li>
                    <li><a href="'.$base.'index.php?apartat=admin">Botiga</a></li>
                    ';
            } else {
                echo '
                    <li><a href="'.$base.'index.php?apartat=inici">Inici</a></li>
                    <li><a href="'.$base.'index.php?apartat=registre">Registre</a></li>
                    <li><a href="'.$base.'index.php?apartat=contacte">Contacte</a></li>
                    <li><a href="'.$base.'index.php?apartat=botiga">Botiga</a></li>
                ';
            }
        ?>
    </ul>
</nav>
