<?php
require "psDB.php";
session_start();
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$username = $_POST["uname"];
$password = $_POST["psw"];

$query = "SELECT `username`, `password` FROM `users` WHERE username='" . $username . "'";

$result = $psDB->doQuery($connection, $query);


if ($_POST["uname"] == $result[0] && $_POST["psw"] == $result[1]) {

    $sessionId = rand();
    $_SESSION['eveningPitchSession'] = $sessionId;

    $query = "INSERT INTO `sessions`(`session`, `username`) VALUES (" . $sessionId . ",'" . $username . "')";
    $psDB ->doQuery($connection, $query);
    echo "Login erfolgreich. Neues Session ID: " . $sessionId;
    header('location: inside.php');
    //unset($_SESSION['eveningPitchSession']);
} else {
    echo "Failed!";
}