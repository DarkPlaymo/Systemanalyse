<?php
session_start();
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();


$action = $_GET["action"];
$owner = $_SESSION["eveningPitchUsername"];


switch($action){
    case "create":
        $eventName = $_GET["eventName"];
        $eventGroup = $_GET["eventGroup"];
        $eventDate = $_GET["eventDate"];
        $filmName = $_GET["filmName"];

       $query = "INSERT INTO `event`(`eventName`, `owner`, `gruppe`, `datum`, `film`) VALUES ('".$eventName."','".$owner."','".$eventGroup."','".$eventDate."','".$filmName."')";
        break;
    case "delete":
        $eventToDelete = $_GET["eventToDelete"];
        $query = "DELETE FROM `event` WHERE eventName='".$eventToDelete."' AND owner='".$owner."'";
        break;
}
$result = $psDB->doQuery($connection, $query);

header('location: ../inside.php?key=meineEvents');