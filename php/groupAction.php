<?php
session_start();
require "psDB.php";
$action = $_GET["action"];
$gruppenname = $_GET["gruppenname"];
$username = $_SESSION["eveningPitchUsername"];

if(isset($_GET["mitglied"])){
    $mitglied = $_GET["mitglied"];
}

$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();


switch ($action){

    case "create":
        $query = "INSERT INTO `gruppen`(`name`, `owner`) VALUES ('".$gruppenname."','".$username."')";
        break;
    case "delete":
        $query = "DELETE FROM `gruppen` WHERE name='".$gruppenname."' AND owner='".$username."'";
        $result = $psDB->doQuery($connection, $query);
        $query = "DELETE FROM `gruppenmitglieder` WHERE gruppenname='".$gruppenname."' AND owner='".$username."'";
        break;
    case "addMember":
        $query = "INSERT INTO `gruppenmitglieder`(`gruppenname`, `owner`, `mitglied`) VALUES ('".$gruppenname."','".$username."','".$mitglied."')";
        break;
    case "deleteMember":
        $query = "DELETE FROM `gruppenmitglieder` WHERE gruppenname='".$gruppenname."' AND owner='".$username."' AND mitglied='".$mitglied."'";
        break;
}


$result = $psDB->doQuery($connection, $query);

header('location: ../inside.php?key=gruppenverwaltung');
?>