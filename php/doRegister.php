<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$query = "SELECT `username` FROM `users` WHERE username='" . $_POST["uname"] . "'";
$result = $psDB->doQuery($connection, $query);

if (sizeof($result) == 0) {
    $query = "INSERT INTO `users`( `username`, `password`) VALUES ('" . $_POST["uname"] . "','" . $_POST["psw"] . "')";
    $psDB->doQuery($connection, $query);
    header('location: ../index.php');
} else {
    echo "Username bereits vergeben!";
}






