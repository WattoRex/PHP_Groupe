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

$elevesData = []; // Tableau pour stocker les objets Eleve saisis

while (true) {
    $eleve = saisirDonneesEleve(); // Appeler la fonction pour saisir les données de l'élève
    $eleves[] = $eleve; // Ajouter l'objet Eleve au tableau

    $elevesData[] = [
        'Nom' => $eleve->getNom(),
        'Moyenne' => $eleve->getMoyenne()
    ];

    $continuer = readline("Voulez-vous saisir les données d'un autre élève ? (o/n) : ");
    if ($continuer !== 'o') {
        break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
    }
}

// Écrire les données des élèves dans un fichier CSV
$csvFileName = "Eleve.csv";
$csvFile = fopen($csvFileName, 'w');
fputcsv($csvFile, array_keys($elevesData[0])); // Écrire l'en-tête du CSV

foreach ($elevesData as $eleveData) {
    fputcsv($csvFile, $eleveData); // Écrire les données de chaque élève dans le CSV
}

fclose($csvFile);

echo "Les données des élèves ont été sauvegardées dans le fichier $csvFileName." . PHP_EOL;

// Vérifier si le fichier existe avant de l'ouvrir
if (file_exists($csvFileName)) {
    $csvFile = fopen($csvFileName, 'r');

    // Lire et afficher chaque ligne du fichier CSV
    while (($data = fgetcsv($csvFile)) !== false) {
        // Afficher les données de chaque ligne
        foreach ($data as $value) {
            echo $value . ' ';
        }
        echo PHP_EOL;
    }

    fclose($csvFile);
} else {
    echo "Le fichier $csvFileName n'existe pas." . PHP_EOL;
}