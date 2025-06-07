<?php
class Producte {

    private int $id;
    private string $nom;
    private float $quantitat;
    private float $preu;
    private string $descripcio;
    
    public function __construct(int $id, string $nom, float $quantitat, float $preu, string $descripcio) {
        $this->id = $id;
        $this->nom = $nom;
        $this->quantitat = $quantitat;
        $this->preu = $preu;
        $this->descripcio = $descripcio;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getQuantitat(): float {
        return $this->quantitat;
    }

    public function getPreu(): float {
        return $this->preu;
    }

    public function getDescripcio(): string {
        return $this->descripcio;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setQuantitat(float $quantitat): void {
        $this->quantitat = $quantitat;
    }

    public function setPreu(float $preu): void {
        $this->preu = $preu;
    }

    public function setDescripcio(string $descripcio): void {
        $this->descripcio = $descripcio;
    }

}
?>