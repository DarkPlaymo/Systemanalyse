<h1>Finanzübersicht</h1>
<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$query = "SELECT  bp.eventName, DATE_FORMAT(bp.date, \"%d.%m.%Y\") AS `date`,bp.besteller,bp.gericht,bp.preis, bp.bezahlt
FROM `bestellposition`bp 
LEFT JOIN `event` e ON bp.eventName = e.eventName 
WHERE e.owner ='".$_SESSION["eveningPitchUsername"]."' AND bp.bezahlt=0";

$result = $psDB->doQuery($connection, $query);

echo "<table class=\"table\" style=\"width: 50%\"><thead><tr><th scope=\"col\">EventName</th><th scope=\"col\">Datum</th><th scope=\"col\">Besteller</th><th scope=\"col\">Gericht</th><th scope=\"col\">Preis</th><th scope=\"col\">Bezahlt?</th></tr></thead><tbody>";
for ($i = 0; $i < sizeof($result); $i++) {
    echo "<tr>";
    echo "<th>" . $result[$i]["eventName"] . "</th>";
    echo "<td>" . $result[$i]["date"] . "</td>";
    echo "<td>" . $result[$i]["besteller"] . "</td>";
    echo "<td>" . $result[$i]["gericht"] . "</td>";
    echo "<td>" . $result[$i]["preis"] . " €</td>";

    if($result[$i]["bezahlt"] == 0){
        echo "<td>Nein</td>";
        echo "<td><a href='php/financeAction.php?action=pay&eventName=".$result[$i]["eventName"]."&besteller=".$result[$i]["besteller"]."&gericht=".$result[$i]["gericht"]."'>Abschließen</a></td>";
    }


    echo "</tr>";
}
echo "</tbody></table>";
?>