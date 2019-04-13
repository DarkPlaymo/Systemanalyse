<?php
session_start();
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();
echo $_SESSION["eveningPitchSession"];

$query = "DELETE FROM `sessions` WHERE session='".$_SESSION['eveningPitchSession']."'";

$result = $psDB->doQuery($connection,$query);
unset($_SESSION['eveningPitchSession']);
echo "Succesfully Logged Out!";
