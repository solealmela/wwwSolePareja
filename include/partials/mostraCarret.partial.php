<?php
if (!isset($_SESSION['carret'])) {
    echo '<p class="missatge-buit">El carret està buit.</p>';
    exit;
}

$carret = unserialize($_SESSION['carret']);

$productes = $carret->getProductes();
usort($productes, function($a, $b) {
    return $a->getId() > $b->getId();
});

echo "<h2>Detall del carret</h2>";

echo "<table>";
echo "<tr><th>Nom</th><th>Quantitat</th><th>Preu unitari</th><th>Total</th><th>Accions</th></tr>";

foreach ($productes as $producte) {
    $id = $producte->getId();
    $nom = htmlspecialchars($producte->getNom());
    $quantitat = $producte->getQuantitat();
    $preu = $producte->getPreu();
    $total = $quantitat * $preu;

    echo "<tr>";
    echo "<td>$nom</td>";
    echo "<td>
            <form method='post' action='canviaQuantitatProducte.php'>
                <input type='hidden' name='idProducte' value='$id'>
                <input type='number' step='0.01' name='quantitatProducte' value='$quantitat' min='0'>
                <button type='submit'>Modificar</button>
            </form>
          </td>";
    echo "<td>" . number_format($preu, 2) . " €</td>";
    echo "<td>" . number_format($total, 2) . " €</td>";
    echo "<td><a href='eliminaProducteCarret.php?id=$id'>Eliminar</a></td>";
    echo "</tr>";
}

echo "</table>";
echo '<a id="boto-retorn" href="index.php?apartat=botiga">Tornar a productes</a>';
?>
