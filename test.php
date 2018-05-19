<?php
require_once __DIR__ . '/CsvToArray.php';

$file = __DIR__ . '/fichiers/Connections.csv';
$file1 = __DIR__ . '/fichiers/Connections1.csv';
$csv = new CsvToArray();
$tableau = $csv->convert($file);
$tableau1 = $csv->convert($file1);
$org1 = $csv->organnigramme($tableau, "Ghada Souguir");
$org2 = $csv->organnigramme($tableau1, "Anouare Friaa");
$result = array_merge($org1, $org2);
$result2 = array_merge($org1["Ghada Souguir"], $org2["Anouare Friaa"]);
$result2 = array("Ghada et Anouare" => $result2);

function cmp($a1, $a2){
    return strcasecmp(serialize($a1) , serialize($a2));
}

$result3 = array_uintersect($tableau, $tableau1,'cmp');
$result4 = $csv->organnigramme($result3, "Ghada et Anouare");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
    <title>Organigramme avec CSS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

</head>
<body>
<h1>Organigramme Linkedin</h1>
        <?php
        foreach ($result as $key => $value) {
            echo "<ul>
                    <li>
                      <span> $key</span>
                      <ul>";
            foreach ($value as $cle => $val) {
                  echo "<li>
                            <span>$cle</span> 
                            <ul>
                            <li>
                                <span>" . $val['Owner'] . "</span>
                                <ul>";
                    foreach ($val['Employes'] as $k => $v) {
                                echo "<li>$v</li>";
                    }
                            echo "</ul>";
                echo "</li>
                            </ul>
                            </li>";
            }

            echo "</ul></li> </ul>";
        }
        ?>
<h1>Merge des deux organigrammes</h1>
        <?php
        foreach ($result2 as $key => $value) {
            echo "<ul>
                    <li>
                      <span> $key</span>
                      <ul>";
            foreach ($value as $cle => $val) {
                  echo "<li>
                            <span>$cle</span> 
                            <ul>
                            <li>
                                <span>" . $val['Owner'] . "</span>
                                <ul>";
                    foreach ($val['Employes'] as $k => $v) {
                                echo "<li>$v</li>";
                    }
                            echo "</ul>";
                echo "</li>
                            </ul>
                            </li>";
            }

            echo "</ul></li> </ul>";
        }
        ?>
<h1>Intersection des deux organigrammes</h1>
        <?php
        foreach ($result4 as $key => $value) {
            echo "<ul>
                    <li>
                      <span> $key</span>
                      <ul>";
            foreach ($value as $cle => $val) {
                  echo "<li>
                            <span>$cle</span> 
                            <ul>
                            <li>
                                <span>" . $val['Owner'] . "</span>
                                <ul>";
                    foreach ($val['Employes'] as $k => $v) {
                                echo "<li>$v</li>";
                    }
                            echo "</ul>";
                echo "</li>
                            </ul>
                            </li>";
            }

            echo "</ul></li> </ul>";
        }
        ?>

</body>
</html>
