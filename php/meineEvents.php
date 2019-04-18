<h2>Meine Events</h2>
<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$query = "SELECT DISTINCT e.owner, e.gruppe, DATE_FORMAT(e.datum, \"%d.%m.%Y\") AS `datum`,e.film 
          FROM event e 
          LEFT JOIN gruppenmitglieder gm ON e.gruppe = gm.gruppenname 
          WHERE e.owner='".$_SESSION["eveningPitchUsername"]."' OR gm.mitglied='".$_SESSION["eveningPitchUsername"]."'";

$result = $psDB->doQuery($connection, $query);
echo "<div style='width: 50%'><table class=\"table\"><thead><tr><th scope=\"col\">Owner</th><th scope=\"col\">Gruppe</th><th scope=\"col\">Datum</th><th scope=\"col\">Film</th></tr></thead><tbody>";

for ($i = 0; $i < sizeof($result); $i++) {
    echo "<tr>";
    echo "<td>" . $result[$i]["owner"] . "</td>";
    echo "<td>" . $result[$i]["gruppe"] . "</td>";
    echo "<td>" . $result[$i]["datum"] . "</td>";
    echo "<td>" . $result[$i]["film"] . "</td>";
    echo "</tr>";
}
echo " </tbody></table></div>";
?>



