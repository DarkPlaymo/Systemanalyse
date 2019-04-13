<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$username = $_POST["uname"];
$password = $_POST["psw"];

$query = "SELECT `username`, `password` FROM `users` WHERE username='" . $username . "'";

$result = $psDB->doQuery($connection, $query);

if ($_POST["uname"] == $result[0] && $_POST["psw"] == $result[1]) {
    session_start();

    if (!isset($_SESSION['eveningPitchSession'])) {
        $sessionId = rand();
        $_SESSION['eveningPitchSession'] = $sessionId;
    }
    $query ="INSERT INTO `sessions`(`session`, `username`) VALUES (".$sessionId.",'".$username."')";

    header('location: ../index.php');
    //unset($_SESSION['eveningPitchSession']);
} else {
    echo "Failed!";
}