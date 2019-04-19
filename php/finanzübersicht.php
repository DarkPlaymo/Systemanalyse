<h1>Finanzübersicht</h1>
<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();


$query = "SELECT bp.eventName, DATE_FORMAT(bp.date, \"%d.%m.%Y\") AS `date`,bp.besteller,bp.gericht,bp.preis FROM `bestellPosition` bp";
$result = $psDB->doQuery($connection, $query);

echo "<table class=\"table\" style=\"width: 50%\"><thead><tr><th scope=\"col\">EventName</th><th scope=\"col\">Datum</th><th scope=\"col\">Besteller</th><th scope=\"col\">Gericht</th><th scope=\"col\">Preis</th></tr></thead><tbody>";
for ($i = 0; $i < sizeof($result); $i++) {
    echo "<tr>";
    echo "<th>" . $result[$i]["eventName"] . "</th>";
    echo "<td>" . $result[$i]["date"] . "</td>";
    echo "<td>" . $result[$i]["besteller"] . "</td>";
    echo "<td>" . $result[$i]["gericht"] . "</td>";
    echo "<td>" . $result[$i]["preis"] . " €</td>";
    echo "</tr>";
}
echo "</tbody></table>";
?>