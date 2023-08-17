<?php
function readCSVAndDisplay($csvFileName)
{
    if (file_exists($csvFileName)) {
        $csvFile = fopen($csvFileName, 'r');

        while (($data = fgetcsv($csvFile)) !== false) {
            foreach ($data as $value) {
                echo $value . ' ';
            }
            echo PHP_EOL;
        }

        fclose($csvFile);
    } else {
        echo "Le fichier $csvFileName n'existe pas.";
    }
}