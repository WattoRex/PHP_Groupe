<?php
function readCSVAndDisplay($csvFileName)
{
    if (file_exists($csvFileName)) {
        $csvFile = fopen($csvFileName, 'r');

        while (($data = fgetcsv($csvFile)) !== false) {
            echo "Nom : " . $data[0] . PHP_EOL;
            echo "Moyenne : " . $data[1] . PHP_EOL;
            echo "-----------------" . PHP_EOL;
        }

        fclose($csvFile);
    } else {
        echo "Le fichier $csvFileName n'existe pas.";
    }
}