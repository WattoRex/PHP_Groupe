<?php
include_once("./gestionEleves/Eleve.php"); // Inclure la classe Eleve depuis le chemin spécifié
include_once("./lib/index.php");

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
writeDataToCSV($csvFileName, $elevesData);

readCSVAndDisplay($csvFileName);