<?php
include_once("./gestionEleves/Eleve.php"); // Inclure la classe Eleve depuis le chemin spécifié

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
$csvFile = fopen($csvFileName, 'a');

// Vérifier si le fichier est vide (nouveau fichier)
$fileIsEmpty = filesize($csvFileName) === 0;
if ($fileIsEmpty) {
    fputcsv($csvFile, array_keys($elevesData[0])); // Écrire l'en-tête du CSV
}

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