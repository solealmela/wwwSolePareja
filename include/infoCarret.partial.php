<?php
include_once("include/entity/CarretCompra.php");
include_once("include/entity/Producte.php");

if (isset($_SESSION['carret'])) {
    $carret = unserialize($_SESSION['carret']);
    $productes = $carret->getProductes();

    if (!empty($productes)) {
        $ultimID = array_key_last($productes); 
        $ultimProducte = $productes[$ultimID];

        echo "<div class='info-carret'>";
        echo "<h3>Informació del carret</h3>";
        echo "<ul>";
        echo "<li><strong>ID del producte:</strong> " . $ultimProducte->getId() . "</li>";
        echo "<li><strong>Nom:</strong> " . htmlspecialchars($ultimProducte->getNom()) . "</li>";
        echo "<li><strong>Preu unitari:</strong> " . number_format($ultimProducte->getPreu(), 2) . " €</li>";
        echo "<li><strong>Quantitat total:</strong> " . $ultimProducte->getQuantitat() . " kg</li>";
        echo "<li><strong>Total:</strong> " . number_format($ultimProducte->getPreu() * $ultimProducte->getQuantitat(), 2) . " €</li>";
        echo "<br>";
        echo "<hr>";
        echo "<br>";
        echo "<h3>Usuari: " . ($_SESSION['usuari'] ?? "no registrat") . "</h3>";
        echo "<li><strong>Productes: </strong> " . count($productes) . "</li>";
        echo "</ul>";
        echo "</div>";
    } else {
        echo "<div class='info-carret'><p>El carret està buit.</p></div>";
    }
} else {
    echo "<div class='info-carret'><p>No has afegit cap producte al carret.</p></div>";
}
?>
