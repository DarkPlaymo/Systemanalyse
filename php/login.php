<?php
require "psDB.php";

$psDB = new psDB();
$connection = $psDB->getDatabaseConnection();

if (isset($_SESSION['eveningPitchSession'])) {

    $query = "SELECT `session` FROM `sessions` WHERE session='".$_SESSION['eveningPitchSession']."'";

    $result = $psDB->doQuery($connection,$query);

    if ($result[0]["session"] == $_SESSION['eveningPitchSession']){
        header('location: inside.php');
    }
}
?>


<h2>Login</h2>
<form action="php/checkLogin.php" method="post">
    <div class="container">
        <label for="uname"><b>E-Mail-Adresse</b></label>
        <input type="email" placeholder="E-Mail-Addresse" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Password" name="psw" required>

        <button type="submit">Login</button>
    </div>
</form>