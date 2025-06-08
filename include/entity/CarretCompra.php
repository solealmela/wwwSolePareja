<?php

require_once("Producte.php");

class CarretCompra
{

    private string $idUsuari;
    /** @var Producte[] */
    private array $productes = [];

    public function __construct(string $idUsuari)
    {
        $this->idUsuari = $idUsuari;
    }

    public function getIdUsuari(): string
    {
        return $this->idUsuari;
    }

    public function getProductes(): array
    {
        return $this->productes;
    }

    public function setIdUsuari(string $idUsuari): void
    {
        $this->idUsuari = $idUsuari;
    }

    public function setProductes(array $productes): void
    {
        $this->productes = $productes;
    }

    public function afegirProducte(Producte $producte): void
    {
        $id = $producte->getId();
        if (isset($this->productes[$id])) {
            $quantitatActual = $this->productes[$id]->getQuantitat();
            $novaQuantitat = $quantitatActual + $producte->getQuantitat();
            $this->productes[$id]->setQuantitat($novaQuantitat);
        } else {
            $this->productes[$id] = $producte;
        }

        $this->ordenarProductesPerId();
    }

    private function ordenarProductesPerId(): void
    {
        uksort($this->productes, function ($a, $b) {
            return $a <=> $b;
        });
    }

    public function eliminarProducte(int $id): void
    {
        if (isset($this->productes[$id])) {
            unset($this->productes[$id]);
        }
    }

    public function getProducte(int $id): ?Producte
    {
        return $this->productes[$id] ?? null;
    }

    public function canviarQuantitatProducte(int $idProducte, float $novaQuantitat): void {
        foreach ($this->productes as $producte) {
            if ($producte->getId() === $idProducte) {
                $producte->setQuantitat($novaQuantitat);
                break;
            }
        }
    }

    public function mostrarCarret(): void {
        if (empty($this->productes)) {
            echo "<p class='missatge-buit'>El carret està buit.</p>";
            return;
        }

        echo "<h3>Productes al carret:</h3>";

        foreach ($this->productes as $producte) {
            $id = htmlspecialchars($producte->getId());
            $nom = htmlspecialchars($producte->getNom());
            $quantitat = number_format($producte->getQuantitat(), 2);
            $preu = number_format($producte->getPreu(), 2);
            $total = number_format($producte->getQuantitat() * $producte->getPreu(), 2);

            echo "<table class='fitxa-carret'>";
            echo "<tr>
                    <th>ID:</th>
                    <td>
                        $id
                        <a class='boto-eliminar' href='include/eliminaProducteCarret.php?id=$id'>🗑</a>
                    </td>
                </tr>";
            echo "<tr><th>Producte:</th><td>$nom</td></tr>";
            echo "<tr><th>Quantitat (kg):</th><td>
                    <form action='include/canviaQuantitatProducte.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='number' step='0.01' min='0' name='quantitat' value='$quantitat' required>
                        <input type='submit' value='Canviar'>
                    </form>
                </td></tr>";
            echo "<tr><th>Preu €/kg:</th><td>$preu €</td></tr>";
            echo "<tr><th>Total:</th><td>$total €</td></tr>";
            echo "</table><br>";
        }
    }

    public function buidarCarret(): void {
        $this->productes = [];
    }

    public function mostrarCarretCompra(): void {
        if (empty($this->productes)) {
            echo "<p>El carret està buit.</p>";
            return;
        }

        echo "<h3>Resum de la compra:</h3>";
        echo "<table class='fitxa-carret'>";
        echo "<tr><th>Producte</th><th>Quantitat (kg)</th><th>Preu €/kg</th><th>Total</th></tr>";

        $preuTotal = 0;

        foreach ($this->productes as $producte) {
            $nom = htmlspecialchars($producte->getNom());
            $quantitat = number_format($producte->getQuantitat(), 2);
            $preu = number_format($producte->getPreu(), 2);
            $total = $producte->getQuantitat() * $producte->getPreu();
            $preuTotal += $total;

            echo "<tr>";
            echo "<td>$nom</td>";
            echo "<td>$quantitat</td>";
            echo "<td>$preu €</td>";
            echo "<td>" . number_format($total, 2) . " €</td>";
            echo "</tr>";
        }

        echo "</table>";

        $numProductes = count($this->productes);
        echo "<p class='resum_compra'><strong>Quantitat de productes:</strong> $numProductes</p>";
        echo "<p class='resum_compra'><strong>Total de la compra:</strong> " . number_format($preuTotal, 2) . " €</p>";
    }
}
?>