<?php
session_start();
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();


$action = $_GET["action"];
$eventName = $_GET["eventName"];
$gericht = $_GET["gericht"];
$besteller = $_GET["besteller"];


switch ($action) {
    case "pay":
        $query = "UPDATE `bestellposition` SET `bezahlt`=1 WHERE eventName='".$eventName."' AND gericht='".$gericht."' AND besteller='".$besteller."'";
        break;
    case "order":
        $query = "SELECT preis FROM gericht WHERE gerichtName='".$gericht."'";
        $preis = $psDB->doQuery($connection, $query);
        $query = "SELECT owner, datum  FROM event WHERE eventName='".$eventName."'";
        $eventData = $psDB->doQuery($connection, $query);

        $query = "INSERT INTO `bestellposition`(`eventName`, `date`, `besteller`, `gericht`, `preis`, `bezahlt`)
                  VALUES ('".$eventName."','".$eventData[0]['datum']."','".$besteller."','".$gericht."','".$preis[0]["preis"]."',0)";

        break;
}
$result = $psDB->doQuery($connection, $query);

header('location: ../inside.php?key=finance');