<?php

require __DIR__ . '/vendor/autoload.php';

class CsvToArray
{

    public function convert(string $fichier) : array
    {
        try {
            $objPHPExcel = \PHPExcel_IOFactory::load($fichier);
            $feuille = $objPHPExcel->getActiveSheet()->toArray(null, true, true, false);
            return $feuille;
        } catch (PHPExcel_Exception $e) {
            throw new \InvalidArgumentException('Fichier introuvable !');
        }
    }

    public function organnigramme(array $tableau, string $nom) : array
    {
        if (is_array($tableau)) {
            $array = array();
            foreach ($tableau as $person) {
                if ($person[4] === "Owner") {
                    $employes = array();
                    foreach ($tableau as $employe) {
                        if ($employe[3] === $person[3] && ("$employe[0] $employe[1]" !== "$person[0] $person[1]")) {
                            array_push($employes,"$employe[0] $employe[1]");
                        }
                    }
                    $array[($person[3])] = array("Owner" => "$person[0] $person[1]", "Employes" => $employes);
                }
            }

            return [$nom =>$array];
        } else {
            throw new \InvalidArgumentException("Il faut donner un tableau !");
        }
    }
}