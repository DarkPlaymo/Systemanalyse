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
            if(isset($_SESSION['eveningPitchSession'])){

            }
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
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/typewriter.js"></script>
<script src="js/jquery.onepagenav.js"></script>
<script src="js/main.js"></script>
</body>

</html>
