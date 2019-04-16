<h2>Gruppenverwaltung</h2>
<button id="BtnCreateDeleteGroup">Gruppe erstellen/löschen</button>
<button id="BtnAddDeleteMember">Mitglied hinzufügen/entfernen</button>
<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

/*if(isset($_GET["gruppenname"])){
   $query = "SELECT * FROM `gruppen` WHERE name='".$_GET["gruppenname"]."' AND owner='".$_SESSION["eveningPitchUsername"]."'";
}else{
    $query = "SELECT * FROM `gruppen`";
}*/
$query = "SELECT * FROM `gruppen`";
$result = $psDB->doQuery($connection, $query);

echo "<div style='width: 50%'><table class=\"table\"><thead><tr><th scope=\"col\">Name</th><th scope=\"col\">Owner</th><th scope=\"col\">Member</th></tr></thead><tbody>";

for ($i = 0; $i < sizeof($result); $i++) {
    echo "<tr>";
    echo "<th scope=\"row\">" . $result[$i]["name"] . "</th>";
    echo "<td>" . $result[$i]["owner"] . "</td>";

    $memberQuery = "SELECT gm.mitglied FROM `gruppen` g JOIN gruppenmitglieder gm ON g.name = gm.gruppenname WHERE g.name='" . $result[$i]["name"] . "' AND gm.owner='" . $result[$i]["owner"] . "'";
    $members = $psDB->doQuery($connection, $memberQuery);
    $memberString = " ";
    for ($j = 0; $j < sizeof($members); $j++) {
        $memberString .= $members[$j]["mitglied"] . "; ";
    }

    echo "<td>" . $memberString . "</td>";


    echo "</tr>";
}
echo "</tbody></table></div>";
?>


<div id="addDeleteGroupMember" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span id="closeMember">&times;</span>

        <form action="php/groupAction.php" method="get">
            <p>Mitglied hinzufügen/entfernen:</p>
            <label name="gruppenname">Gruppenname:</label>
            <input type="text" name="gruppenname">
            <label name="mitglied">Betreffendes Mitglied:</label>
            <input type="text" name="mitglied">
            <label for="radioCreate">Hinzufügen:</label>
            <input type="radio" id="radioCreate" value="addMember" name="action">
            <label for="radioDelete">Löschen:</label>
            <input type="radio" id="radioDelete" value="deleteMember" name="action">
            <button type="submit">Ausführen</button>
        </form>
    </div>
</div>


<div id="createDeleteGroup" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span id="closeGroup">&times;</span>

        <form action="php/groupAction.php" method="get">
            <p>Gruppe erstellen:</p>
            <label name="gruppenname">Gruppenname</label>
            <input type="text" name="gruppenname">
            <label for="radioCreate">Erstellen:</label>
            <input type="radio" id="radioCreate" value="create" name="action">
            <label for="radioDelete">Löschen:</label>
            <input type="radio" id="radioDelete" value="delete" name="action">
            <button type="submit">Erstellen</button>
        </form>
    </div>
</div>
<script>
    // Get the modal
    var modal0 = document.getElementById("createDeleteGroup");
    // Get the button that opens the modal
    var btn0 = document.getElementById("BtnCreateDeleteGroup");
    // Get the <span> element that closes the modal
    var span0 = document.getElementById("closeGroup");
    // When the user clicks on the button, open the modal
    btn0.onclick = function () {
        modal0.style.display = "block";
    }
    // When the user clicks on <span> (x), close the modal
    span0.onclick = function () {
        modal0.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    /*window.onclick = function (event) {
        if (event.target == modal0) {
            modal0.style.display = "none";
        }
    }*/
    var modal1 = document.getElementById("addDeleteGroupMember");
    var btn1 = document.getElementById("BtnAddDeleteMember");
    // var span1 = document.getElementsByClassName("close")[1];
    var span1 = document.getElementById("closeMember");
    btn1.onclick = function () {
        modal1.style.display = "block";
    }
    span1.onclick = function () {
        modal1.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == modal1 || event.target == modal0) {
            modal1.style.display = "none";
            modal0.style.display = "none";
        }
    }


</script>
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>