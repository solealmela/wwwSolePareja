<?php
include_once("include/entity/CarretCompra.php");
include_once("include/entity/Producte.php");

echo "<div class='info-carret'>";
echo "<h3>Informació del carret</h3>";
echo "<ul>";

if (isset($_SESSION['carret'])) {
    $carret = unserialize($_SESSION['carret']);
    $productes = $carret->getProductes();
    $numProductes = count($productes);

    if (!empty($productes)) {
        $ultimID = array_key_last($productes); 
        $ultimProducte = $productes[$ultimID];

        echo "<li><strong>ID del producte:</strong> " . $ultimProducte->getId() . "</li>";
        echo "<li><strong>Nom:</strong> " . htmlspecialchars($ultimProducte->getNom()) . "</li>";
        echo "<li><strong>Preu unitari:</strong> " . number_format($ultimProducte->getPreu(), 2) . " €</li>";
        echo "<li><strong>Quantitat total:</strong> " . $ultimProducte->getQuantitat() . " kg</li>";
        echo "<li><strong>Total:</strong> " . number_format($ultimProducte->getPreu() * $ultimProducte->getQuantitat(), 2) . " €</li>";
    } else {
        echo "";
    }

    echo "<br><hr><br>";
    echo "<h3>Usuari: " . ($_SESSION['usuari'] ?? "no registrat") . "</h3>";
    echo "<li><strong>Productes:</strong> $numProductes</li>";
} else {
    echo "";
    echo "<br><hr><br>";
    echo "<h3>Usuari: " . ($_SESSION['usuari'] ?? "no registrat") . "</h3>";
    echo "<li><strong>Productes:</strong> 0</li>";
}

echo "</ul>";
echo '<a class="boto_enllaç" href="index.php?apartat=botiga&mostrar=carret">Ves al carret</a><br>';
echo '<a class="boto_enllaç" href="index.php?apartat=botiga&mostrar=compra">Compra</a>';
echo "</div>";
?>
