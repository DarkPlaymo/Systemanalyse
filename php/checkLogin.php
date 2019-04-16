<?php
require "psDB.php";
session_start();
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$username = $_POST["uname"];
$password = $_POST["psw"];

$query = "SELECT `username`, `password` FROM `users` WHERE username='" . $username . "'";

$result = $psDB->doQuery($connection, $query);


if ($_POST["uname"] == $result[0]["username"] && $_POST["psw"] == $result[0]["password"]) {

    $sessionId = rand();
    $_SESSION['eveningPitchSession'] = $sessionId;
    $_SESSION['eveningPitchUsername'] = $username;

    $query = "INSERT INTO `sessions`(`session`, `username`) VALUES (" . $sessionId . ",'" . $username . "')";
    $psDB ->doQuery($connection, $query);

   header('location: ../inside.php');

} else {
    echo "Failed!";
}