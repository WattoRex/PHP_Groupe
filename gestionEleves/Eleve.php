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

function saisirDonneesEleve(): Eleve
{
    while (true) {
        $nom = readline("Entrez le nom de l'élève : ");

        // Supprimer les espaces éventuels avant et après la saisie
        $nom = trim($nom);

        if (!empty($nom) && preg_match('/^[a-zA-Z]+$/', $nom)) {
            break; // Sortir de la boucle si le nom est valide
        } else {
            echo "Veuillez entrer un nom valide (contenant uniquement des lettres et non vide)." . PHP_EOL;
        }
    }
    $listeNotes = [];

    while (true) {
        $note = readline("Entrez une note (ou 'q' pour quitter) : ");

        if ($note === 'q') {
            break; // Sortir de la boucle si l'utilisateur entre 'q'
        }

        $note = trim($note); // Supprimer les espaces éventuels avant et après la saisie

        if ($note !== '' && is_numeric($note)) {
            $note = (int) $note;

            if ($note >= 0 && $note <= 20) {
                $listeNotes[] = $note; // Ajouter la note à la liste si elle est valide
            } else {
                echo "La note doit être comprise entre 0 et 20." . PHP_EOL;
            }
        } else {
            echo "Veuillez entrer une note valide (nombre entre 0 et 20)." . PHP_EOL;
        }
    }

    $eleve = new Eleve($nom, $listeNotes, null, 0); // Créer un objet Eleve avec les données saisies
    $eleve->getMoyenne(); // Calculer la moyenne de l'élève 
    $eleve->setMoyenne(null); // Définir la moyenne 
    return $eleve; // Retourner l'objet Eleve créé
}