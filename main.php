<?php
include_once("./gestionEleves/Eleve.php"); // Inclure la classe Eleve depuis le chemin spécifié

// Fonction pour saisir les données d'un élève
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

$eleves = []; // Tableau pour stocker les objets Eleve saisis

while (true) {
    $eleve = saisirDonneesEleve(); // Appeler la fonction pour saisir les données de l'élève
    $eleves[] = $eleve; // Ajouter l'objet Eleve au tableau

    $continuer = readline("Voulez-vous saisir les données d'un autre élève ? (o/n) : ");
    if ($continuer !== 'o') {
        break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
    }
}

// Afficher la moyenne de chaque élève
foreach ($eleves as $eleve) {
    echo "Nom de l'élève : " . $eleve->getNom() . PHP_EOL;
    echo "Moyenne : " . $eleve->getMoyenne() . PHP_EOL;
    echo "-----------------------" . PHP_EOL;
}
?>