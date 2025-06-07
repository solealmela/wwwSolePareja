<div id= "administracio">
    <h2>Administració</h2>
    <div id="admin">
        <div id= tabla>
            <?php
                include_once("include/funcionsAdmin.php");
                gestionaUsuaris();
            ?>
        </div>
        <div id="log-controls" style="margin-top: 20px;">
            <?php
                $mostrarLog = $_GET['mostrarLog'] ?? 'false';

                if ($mostrarLog === 'true') {
                    echo '<a href="?mostrarLog=false">Oculta Log</a>';
                } else {
                    echo '<a href="?mostrarLog=true">Mostra Log</a>';
                }
            ?>
        </div>

        <div id="log-content" style="margin-top: 10px;">
            <?php
                if ($mostrarLog === 'true') {
                    mostraLog();
                }
            ?>
        </div>
    </div>
</div>