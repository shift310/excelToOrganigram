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
//$resultjs = json_encode($org1);
//$resultjs = json_encode($org2);
$resultjs = json_encode($result);
$result2 = array_merge($org1["Ghada Souguir"], $org2["Anouare Friaa"]);
$result2 = array("Ghada et Anouare" => $result2);

function cmp($a1, $a2)
{
    return strcasecmp(serialize($a1), serialize($a2));
}

$result3 = array_uintersect($tableau, $tableau1, 'cmp');
$result4 = $csv->organnigramme($result3, "Ghada et Anouare");
//$resultjs = json_encode($result4);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
    <title>Organigramme avec CSS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

</head>
<body onload="goIntro()">

<div id="myDiagramDiv" style="border: solid 1px blue; width: 800px; height: 600px">
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/1.8.17/go.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>

<script>
    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }

    function goIntro() {

        connexions = <?php echo $resultjs;?>;
        var my_go = go.GraphObject.make;
        var diagram = new go.Diagram("myDiagramDiv");
        diagram.initialContentAlignment = go.Spot.Center;
        diagram.nodeTemplate =
            my_go(go.Node, go.Panel.Auto,
                my_go(go.Shape,
                    {figure: "RoundedRectangle"},
                    new go.Binding("fill", "color")
                ),
                my_go(go.TextBlock,
                    {margin: 3},
                    new go.Binding("text", "key")
                )
            );
        var nodeDataArray = [];
        var linkDataArray = [];
        var owner = [];
        var society = [];
        var employ = [];
        var links = [];
        $.each(connexions, function (key0, value0) {
            var c = '#' + Math.floor(Math.random() * 16777215).toString(16);
            nodeDataArray.push({
                key: key0,
                color: c
            });
            $.each(value0, function (key, value) {
                var c = '#' + Math.floor(Math.random() * 16777215).toString(16);
                if (!isInArray(value.Owner, owner)) {
                    nodeDataArray.push({
                        key: value.Owner,
                        color: c
                    });
                    owner.push(value.Owner);
                }
                if (!isInArray(key0 + "to" + value.Owner, links)) {
                    linkDataArray.push({
                        from: key0,
                        to: value.Owner
                    });
                    links.push(key0 + "to" + value.Owner);
                }

                if (!isInArray(key, society)) {
                    nodeDataArray.push({
                        key: key,
                        color: c
                    });
                    society.push(key);
                }
                if (!isInArray(value.Owner + "to" + key, links)) {
                    linkDataArray.push({
                        from: value.Owner,
                        to: key
                    });
                    links.push(value.Owner + "to" + key);
                }

                var employes = value['Employes'];
                var c = '#' + Math.floor(Math.random() * 16777215).toString(16);
                $.each(employes, function (key1, value1) {
                    if (!isInArray(value1, employ)) {
                        nodeDataArray.push({
                            key: value1,
                            color: c
                        });
                        employ.push(value1);
                    }
                    if (!isInArray(key + "to" + value1, links)) {
                        linkDataArray.push({
                            from: key,
                            to: value1
                        });
                        links.push(key + "to" + value1);
                    }

                });
            });
        });
        diagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
    }
</script>
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
