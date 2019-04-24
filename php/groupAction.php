<?php
session_start();
require "psDB.php";
$action = $_GET["action"];
$gruppenname = $_GET["gruppenname"];

if (isset($_GET["groupOwner"])) {
    $groupOwner = $_GET["groupOwner"];
} else {
    $groupOwner = $_SESSION["eveningPitchUsername"];
}


if (isset($_GET["mitglied"])) {
    $mitglied = $_GET["mitglied"];
}

$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();


switch ($action) {

    case "create":
        $query = "INSERT INTO `gruppen`(`name`, `owner`) VALUES ('" . $gruppenname . "','" . $groupOwner . "')";
        break;
    case "delete":
        $query = "DELETE FROM `gruppen` WHERE name='" . $gruppenname . "' AND owner='" . $groupOwner . "'";
        $result = $psDB->doQuery($connection, $query);
        $query = "DELETE FROM `gruppenmitglieder` WHERE gruppenname='" . $gruppenname . "' AND owner='" . $groupOwner . "'";
        $result = $psDB->doQuery($connection, $query);
        break;
    case "addMember":
        $query = "INSERT INTO `gruppenmitglieder`(`gruppenname`, `owner`, `mitglied`) VALUES ('" . $gruppenname . "','" . $groupOwner . "','" . $mitglied . "')";
        break;
    case "deleteMember":
        $query = "DELETE FROM `gruppenmitglieder` WHERE gruppenname='" . $gruppenname . "' AND owner='" . $groupOwner . "' AND mitglied='" . $mitglied . "'";
        break;
}


$result = $psDB->doQuery($connection, $query);

header('location: ../inside.php?key=gruppenverwaltung');
?>