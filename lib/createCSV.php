<?php
function writeDataToCSV($csvFileName, $data, $writeHeader = true)
{
    $csvFile = fopen($csvFileName, 'a');

    // Vérifier si le fichier est vide (nouveau fichier)
    $fileIsEmpty = filesize($csvFileName) === 0;
    if ($fileIsEmpty && $writeHeader) {
        fputcsv($csvFile, array_keys($data[0])); // Écrire l'en-tête du CSV
    }

    foreach ($data as $row) {
        fputcsv($csvFile, $row); // Écrire les données de chaque ligne dans le CSV
    }

    fclose($csvFile);

    echo "Les données des élèves ont été sauvegardées dans le fichier $csvFileName." . PHP_EOL;
}