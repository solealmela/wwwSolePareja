<?php
if (isset($_SESSION['carret'])) {
    $carret = unserialize($_SESSION['carret']);
    $productes = $carret->getProductes();

    if (!empty($productes)) {
        $carret->mostrarCarretCompra(); 

        if (!isset($_SESSION['usuari'])) {
            echo "<p class='missatge-autenticacio'>T'has d'autenticar per poder efectuar la compra. <a href='index.php?apartat=login'>Inicia sessió</a></p>";
        } else {
            echo '<form action="include/processaComanda.php" method="post">';
            echo '<button type="submit" class="boto_enllaç">Confirmar compra</button>';
            echo '</form>';
        }
    } else {
        echo "<p class='missatge-buit'>El carret està buit. Afegeix productes per a fer una compra.</p>";
    }

} else {
    echo "<p class='missatge-buit'>El carret està buit.</p>";
}
?>