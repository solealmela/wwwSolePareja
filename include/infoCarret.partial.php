<?php
    if (isset($_SESSION['idProducte']) && isset($_SESSION['nomProducte']) && isset($_SESSION['quantitatProducte']) && isset($_SESSION['preuTotal'])) {

        echo "<div class='info-carret'>";
        echo "<h3>Informació del carret</h3>";
        echo "<ul>";
        echo "<li><strong>id</strong> " . htmlspecialchars($_SESSION['idProducte']) . "</li>";
        echo "<li><strong>Producte</strong> " . htmlspecialchars($_SESSION['nomProducte']) . "</li>";
        echo "<li><strong>Preu</strong> " . htmlspecialchars($_SESSION['preu']) . " €</li>";
        echo "<li><strong>Quantitat</strong> " . htmlspecialchars($_SESSION['quantitatProducte']) . " kg</li>";
        echo "<li><strong>Total</strong> " . number_format($_SESSION['preuTotal'], 2) . " €</li>";
        echo "</ul>";
        echo "</div>";
    } else {
        echo "<div class='info-carret'>";
        echo "<p>No has afegit cap producte al carret.</p>";
        echo "</div>";
    }
?>
