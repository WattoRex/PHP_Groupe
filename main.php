<?php
include_once("./gestionEleves/Eleve.php");

function saisirDonneesEleve(): Eleve
{
    while (true) {
        $nom = readline("Entrez le nom de l'élève : ");

        // Supprimer les espaces éventuels avant et après la saisie
        $nom = trim($nom);

        if (!empty($nom) && preg_match('/^[a-zA-Z]+$/', $nom)) {
            break;
        } else {
            echo "Veuillez entrer un nom valide (contenant uniquement des lettres et non vide)." . PHP_EOL;
        }
    }
    $listeNotes = [];

    while (true) {
        $note = readline("Entrez une note (ou 'q' pour quitter) : ");

        if ($note === 'q') {
            break;
        }

        $note = trim($note); // Supprimer les espaces éventuels avant et après la saisie

        if ($note !== '' && is_numeric($note)) {
            $note = (int) $note;

            if ($note >= 0 && $note <= 20) {
                $listeNotes[] = $note;
            } else {
                echo "La note doit être comprise entre 0 et 20." . PHP_EOL;
            }
        } else {
            echo "Veuillez entrer une note valide (nombre entre 0 et 20)." . PHP_EOL;
        }
    }

    $eleve = new Eleve($nom, $listeNotes, null, 0);
    $eleve->getMoyenne();
    $eleve->setMoyenne(null);
    return $eleve;
}

// Saisir les données pour plusieurs élèves
$eleves = [];

while (true) {
    $eleve = saisirDonneesEleve();
    $eleves[] = $eleve;

    $continuer = readline("Voulez-vous saisir les données d'un autre élève ? (o/n) : ");
    if ($continuer !== 'o') {
        break;
    }
}

// Afficher la moyenne de chaque élève
foreach ($eleves as $eleve) {
    echo "Nom de l'élève : " . $eleve->getNom() . PHP_EOL;
    echo "Moyenne : " . $eleve->getMoyenne() . PHP_EOL;
    echo "-----------------------" . PHP_EOL;
}