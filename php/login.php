<?php
require "psDB.php";

$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

if (isset($_SESSION['eveningPitchSession'])) {

    $query = "SELECT `session` FROM `sessions` WHERE session='".$_SESSION['eveningPitchSession']."'";

    $result = $psDB->doQuery($connection,$query);

    if ($result[0] == $_SESSION['eveningPitchSession']){
        header('location: inside.php');
    }
}
?>


<h2>Login</h2>
<form action="php/checkLogin.php" method="post">
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
    </div>
</form>