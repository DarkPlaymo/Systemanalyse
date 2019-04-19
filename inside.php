<?php
session_start();
include "php/section/head.php";
?>
<body>
<ul >
    <li><a href="php/logout.php" class="">Log Out</a></li>
    <li><a href="inside.php" class="">Dashboard</a></li>
    <li><a href="inside.php?key=meineEvents" class="">Meine Events</a></li>
    <li><a href="inside.php?key=gruppenverwaltung" class="">Meine Gruppen</a></li>
</ul>
<div>
<?php

if (isset($_GET["key"])) {
    $sitekey = $_GET["key"];
}else{
    $sitekey = " ";
}


switch ($sitekey) {
    case "gruppenverwaltung":
        include "php/gruppenVerwaltung.php";
        break;
    case "meineEvents":
        include "php/meineEvents.php";
        break;
    default:
       echo"<div><h2>Eingeloggter Bereich!</h2>";
       echo"<a type='button' href='php/deleteAccount.php' class=\"btn btn-blue\">Account löschen</a>";
        break;
}
?>
</div>


<?php include "php/scripts.php"?>
</body>

