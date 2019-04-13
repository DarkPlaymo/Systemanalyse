<!DOCTYPE html>
<html lang="en">
<?php include "php/section/head.php" ?>
<body>
<div class="preloader">
    <img src="img/loader.gif" alt="Preloader image">
</div>
<?php
session_start();

    if (isset($_GET["key"])) {
        $sitekey = $_GET["key"];
    }else{
        $sitekey = " ";
    }


    switch ($sitekey) {
        case "login":
                include "php/login.php";
            break;
        case "register":
            include "php/register.php";
            break;
        default:
            include "php/navigation.php";
            include "php/header.php";

    }
?>

<?php include "php/modal.php"; ?>
<!-- Holder for mobile navigation -->
<div class="mobile-nav">
    <ul>
    </ul>
    <a href="#" class="close-link"><i class="arrow_up"></i></a>
</div>
<!-- Scripts -->
<?php include "php/scripts.php"?>
</body>

</html>
