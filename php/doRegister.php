<?php
require "psDB.php";
$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

$query = "INSERT INTO `users`( `username`, `password`) VALUES ('".$_POST["uname"]."','".$_POST["psw"]."')";
$psDB->doQuery($connection,$query);

if($psDB == false){
    echo "Fehler beim Registrieren.";
}else {
    header('location: ../index.php');
}
