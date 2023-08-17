<?php
// Fonction pour lire et afficher les données d'un fichier csv
function readCSVAndDisplay1($csvFileName) {
    echo "Lecture des données à partir du fichier CSV " . PHP_EOL;
    $csvFileName = fopen($csvFileName, "r");
    fgetcsv($csvFileName); 

    while (($ligne = fgetcsv($csvFileName)) !== false) {
        echo "Nom : " . $ligne[0] . PHP_EOL;
        echo "Moyenne : " . $ligne[1] . PHP_EOL;
        echo "-----------------" . PHP_EOL;
    }

    fclose($csvFileName);
    echo "Fin de la lecture" . PHP_EOL;
}
// $csvFileName = "Eleve.csv";
// readCSVAndDisplay1($csvFileName);