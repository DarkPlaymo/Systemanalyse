<?php
require "psDB.php";
session_start();
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();
$sessionId = $_SESSION['eveningPitchSession'];
$query = "DELETE FROM `users` WHERE username=(SELECT `username` FROM `sessions` WHERE session='".$sessionId."')";
unset($_SESSION['eveningPitchSession']);

$psDB->doQuery($connection,$query);


$query ="DELETE FROM `session` WHERE session='".$sessionId."'";
$psDB->doQuery($connection,$query);

header('location: ../index.php');