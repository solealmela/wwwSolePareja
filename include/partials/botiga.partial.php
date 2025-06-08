<div id="botiga">
    <h2>Botiga</h2>
    <div id="productes">
        <h3 id="titulo">Productes disponibles</h3>
        <?php
        if (isset($_SESSION['missatge_compra'])) {
            echo "<div class='missatge-compra'>" . $_SESSION['missatge_compra'] . "</div>";
            unset($_SESSION['missatge_compra']);
        }
        if (isset($_GET['mostrar']) && $_GET['mostrar'] === 'carret') {
            if (isset($_SESSION['carret'])) {
                $carret = unserialize($_SESSION['carret']);
                $carret->mostrarCarret();
            } else {
                echo "<p>El carret està buit.</p>";
            }
            echo '<a id="boto-retorn" href="index.php?apartat=botiga">Tornar a productes</a>';
        } elseif (isset($_GET['mostrar']) && $_GET['mostrar'] === 'compra') {
            include_once('./include/partials/mostraCompra.partial.php');
            echo '<a id="boto-retorn" href="index.php?apartat=botiga">Tornar a productes</a>';
        } else {
            include_once('include/funcions.php');
            mostraProductesBD('include/productes.php');
        }
        ?>
    </div>
</div>