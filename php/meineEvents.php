<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();
?>
<h2>Meine Events</h2>
<button class="btn btn-blue" id="BtnCreateDeleteGroup">Event erstellen/löschen</button>
<button class="btn btn-blue" id="BtnOrderFood">Essen bestellen</button>
<div id="createDeleteGroup" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span id="closeGroup">&times;</span>

        <form action="php\eventAction.php" method="get">
            <p>Event</p>
            <label for="radioCreate">Erstellen:</label>
            <input type="radio" id="radioCreate" value="create" name="action" checked>
            <label for="radioDelete">Löschen:</label>
            <input  type="radio" id="radioDelete" value="delete" name="action">

            <div id="dataForCreateEvent">

                <label name="eventName">Event:</label>
                <input type="text" name="eventName">
                <label for="eventDate">Datum:</label>
                <input type="date" id="eventDate" name="eventDate"
                       min="2019-01-01">

                <label for="eventGroup">Gruppe:</label>
                <select id='eventGroup' name="eventGroup">
                    <?php

                    $query = "SELECT `name` FROM `gruppen` WHERE owner='".$_SESSION["eveningPitchUsername"]."' ORDER BY `name`";
                    $result = $psDB->doQuery($connection, $query);

                    for($i = 0;$i< sizeof($result);$i++){
                        echo "<option value='".$result[$i]["name"]."'>".$result[$i]["name"]."</option>";

                    }
                    ?>
                </select>

                <label for="filmName">Film:</label>
                <select id='filmName' name="filmName">
                    <option value="Star Trek">Star Trek</option>
                    <option value="Star Treck: Into Darkness">Star Treck: Into Darkness</option>
                    <option value="Shrek">Shrek</option>
                    <option value="SAW">SAW</option>
                </select>
            </div>
            <div id="dataForDeleteEvent" style="display: none">
                <label name="eventToDelete">Event:</label>
                <select id='eventToDelete' name="eventToDelete">
                    <?php

                    $query = "SELECT `eventName` FROM `event` WHERE owner='".$_SESSION["eveningPitchUsername"]."'";
                    $result = $psDB->doQuery($connection, $query);

                    for($i = 0;$i< sizeof($result);$i++){
                        echo "<option value='".$result[$i]["eventName"]."'>".$result[$i]["eventName"]."</option>";

                    }
                    ?>
                </select>
            </div>
            <button type="submit">Ausführen</button>
        </form>
    </div>
</div>

<div id="orderFood" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span id="closeOrder">&times;</span>

        <form action="php/financeAction.php" method="get">
            <p>Essen bestellen</p>
            <input type="text" name="action" value="order" style="display: none">
            <?php
            echo "<input style='display: none' type='text' name='besteller' value='".$_SESSION["eveningPitchUsername"]."'>";
            ?>
            <label for="eventName">Event:</label>
            <select id='eventToOrder' name="eventName">
                <?php
                $query = "SELECT DISTINCT e.eventName
                            FROM event e 
                            LEFT JOIN gruppenmitglieder gm ON e.gruppe = gm.gruppenname 
                            WHERE gm.mitglied='" . $_SESSION["eveningPitchUsername"] . "' 
                            ORDER BY e.eventName";

                $result = $psDB->doQuery($connection, $query);

                for($i = 0;$i< sizeof($result);$i++){
                    echo "<option value='".$result[$i]["eventName"]."'>".$result[$i]["eventName"]."</option>";

                }
                ?>
            </select>
            <select id='foodToOrder' name="gericht">
                <?php

                $query = "SELECT `gerichtName`, `preis` FROM `gericht`";

                $result = $psDB->doQuery($connection, $query);

                for($i = 0;$i< sizeof($result);$i++){
                    echo "<option value='".$result[$i]["gerichtName"]."'>".$result[$i]["gerichtName"]."(".$result[$i]["preis"]."€)</option>";
                }
                ?>
            </select>

            <button type="submit">Ausführen</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal0 = document.getElementById("createDeleteGroup");
    var modalFood = document.getElementById("orderFood");
    // Get the button that opens the modal
    var btn0 = document.getElementById("BtnCreateDeleteGroup");
    var btnFood = document.getElementById("BtnOrderFood");
    // Get the <span> element that closes the modal
    var span0 = document.getElementById("closeGroup");
    var spanFood = document.getElementById("closeOrder");
    // When the user clicks on the button, open the modal
    btn0.onclick = function () {
        modal0.style.display = "block";
    }
    btnFood.onclick = function () {
        modalFood.style.display = "block";
    }
    // When the user clicks on <span> (x), close the modal
    span0.onclick = function () {
        modal0.style.display = "none";
    }
    spanFood.onclick = function () {
        modal0.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal0 ||event.target == modalFood  ) {
            modal0.style.display = "none";
            modalFood.style.display = "none";
        }
    }

    var radioCreate = document.getElementById('radioCreate');
    var radioDelete = document.getElementById('radioDelete');
    var elementCreate = document.getElementById('dataForCreateEvent');
    var elementDelete = document.getElementById('dataForDeleteEvent');
    radioCreate.onclick = function (){
        elementCreate.style.display = "block";
        elementDelete.style.display = "none";
    }
    radioDelete.onclick = function(){
        elementCreate.style.display = "none";
        elementDelete.style.display = "block";
    }
</script>
<?php
$query = "SELECT DISTINCT e.eventName, e.owner, e.gruppe, DATE_FORMAT(e.datum, \"%d.%m.%Y\") AS `datum`,e.film 
          FROM event e 
          LEFT JOIN gruppenmitglieder gm ON e.gruppe = gm.gruppenname 
          WHERE e.owner='" . $_SESSION["eveningPitchUsername"] . "' OR gm.mitglied='" . $_SESSION["eveningPitchUsername"] . "' 
          ORDER BY e.datum";

$result = $psDB->doQuery($connection, $query);
echo "<div style='width: 50%'><table class=\"table\"><thead><tr><th scope=\"col\">Name</th><th scope=\"col\">Owner</th><th scope=\"col\">Gruppe</th><th scope=\"col\">Datum</th><th scope=\"col\">Film</th></tr></thead><tbody>";

for ($i = 0; $i < sizeof($result); $i++) {
    echo "<tr>";
    echo "<td>" . $result[$i]["eventName"] . "</td>";
    echo "<td>" . $result[$i]["owner"] . "</td>";
    echo "<td>" . $result[$i]["gruppe"] . "</td>";
    echo "<td>" . $result[$i]["datum"] . "</td>";
    echo "<td>" . $result[$i]["film"] . "</td>";
    echo "</tr>";
}
echo " </tbody></table></div>";
?>



