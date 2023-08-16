<?php
include_once("./gestionEleves/Eleve.php");

function saisirDonneesEleve(): Eleve
{
    $nom = readline("Entrez le nom de l'élève : ");
    $listeNotes = [];

    while (true) {
        $note = readline("Entrez une note (ou 'q' pour quitter) : ");
        if ($note === 'q') {
            break;
        }
        $listeNotes[] = (int) $note;
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