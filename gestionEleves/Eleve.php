<?php
class Eleve
{
    private string $nom;
    private array $listeNotes;
    private ?float $moyenne;
    private int $note;
    public function __construct(string $nom, $listeNotes, $moyenne, $note)
    {
        $this->nom = $nom;
        $this->listeNotes = $listeNotes;
        $this->moyenne = $moyenne;
        $this->note = $note;
    }

    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of listeNotes
     *
     * @return array
     */
    public function getListeNotes(): array
    {
        return $this->listeNotes;
    }

    /**
     * Set the value of listeNotes
     *
     * @param array $listeNotes
     *
     * @return self
     */
    public function setListeNotes(array $listeNotes): self
    {
        $this->listeNotes = $listeNotes;

        return $this;
    }

    /**
     * Get the value of moyenne
     *
     * @return ?float
     */
    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    /**
     * Set the value of moyenne
     *
     * @param ?float $moyenne
     *
     * @return self
     */
    public function setMoyenne(?float $moyenne): self
    {
        $sum = array_sum($this->listeNotes);
        $count = count($this->listeNotes);
        $moyenne = $sum / $count;
        $this->moyenne = $moyenne;

        return $this;
    }
    public function __toString()
    {
        return ($this->nom . " (" . number_format($this->moyenne, 2) . ")" . PHP_EOL);
    }

    /**
     * Get the value of note
     *
     * @return int
     */
    public function getNote(): int
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @param int $note
     *
     * @return self
     */
    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }
}


// Test moyenne
// // Créer une instance de la classe Eleve
// $eleve = new Eleve("John Doe", [20, 10], null, 1);
// $eleve->setMoyenne(null);

// // Calculer et définir la moyenne
// // Obtenir la moyenne calculée
// $moyenneCalculee = $eleve->getMoyenne();
// echo "La moyenne calculée est : " . $moyenneCalculee . PHP_EOL;