<?php

require_once("Producte.php");

class CarretCompra {

    private string $idUsuari;
    /** @var Producte[] */
    private array $productes = [];

    public function __construct(string $idUsuari) {
        $this->idUsuari = $idUsuari;
    }

    public function getIdUsuari(): string {
        return $this->idUsuari;
    }

    public function getProductes(): array {
        return $this->productes;
    }

    public function setIdUsuari(string $idUsuari): void {
        $this->idUsuari = $idUsuari;
    }

    public function setProductes(array $productes): void {
        $this->productes = $productes;
    }

    public function afegirProducte(Producte $producte): void {
        $id = $producte->getId();
        if (isset($this->productes[$id])) {
            $quantitatActual = $this->productes[$id]->getQuantitat();
            $novaQuantitat = $quantitatActual + $producte->getQuantitat();
            $this->productes[$id]->setQuantitat($novaQuantitat);
        } else {
            $this->productes[$id] = $producte;
        }
    }

    public function eliminarProducte(int $id): void {
        if (isset($this->productes[$id])) {
            unset($this->productes[$id]);
        }
    }

    public function getProducte(int $id): ?Producte {
        return $this->productes[$id] ?? null;
    }

    public function canviarQuantitatProducte(int $id, float $novaQuantitat): void {
        if (isset($this->productes[$id])) {
            $this->productes[$id]->setQuantitat($novaQuantitat);
        }
    }

    public function mostrarCarret(): void {
        if (empty($this->productes)) {
            echo "<p>El carret està buit.</p>";
            return;
        }

        echo "<h3>Productes al carret:</h3>";
        echo "<ul>";
        foreach ($this->productes as $producte) {
            echo "<li>";
            echo htmlspecialchars($producte->getNom()) . " - ";
            echo number_format($producte->getQuantitat(), 2) . " kg - ";
            echo number_format($producte->getPreu(), 2) . " €/kg - ";
            echo "Total: " . number_format($producte->getQuantitat() * $producte->getPreu(), 2) . " €";
            echo "</li>";
        }
        echo "</ul>";
    }

    public function buidarCarret(): void {
        $this->productes = [];
    }
}
?>
