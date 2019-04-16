<?php
session_start();
include "php/section/head.php";
?>
<body>
<ul >
    <li><a href="inside.php?key=gruppenverwaltung" class="">Meine Gruppen</a></li>
    <li><a href="php/logout.php" class="">Log Out</a></li>
    <li><a href="php/deleteAccount.php" class="">Account löschen</a></li>
    <li><a href="inside.php" class="">Dashboard</a></li>
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
    default:
       echo"<div><h2>Eingeloggter Bereich!</h2>";
        break;
}
?>
</div>


<?php include "php/scripts.php"?>
</body>

