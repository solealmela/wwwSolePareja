<div id="administracio">
    <h2>Administració</h2>

    <?php include_once("include/partials/menuAdmin.partial.php"); ?>

    <div id="admin">
        <div id="tabla">
            <?php
                include_once("include/funcionsAdmin.php");

                $apartat = $_GET['apartatAdmin'] ?? 'usuaris';
                if ($apartat === 'usuaris') {
                    gestionaUsuaris();
                } elseif ($apartat === 'comandes') {
                    gestionaComandes();
                } elseif ($apartat === 'productes') {
                    gestionaProductes();
                }
            ?>
        </div>
    </div>
</div>
