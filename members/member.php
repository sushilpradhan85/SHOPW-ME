<?php
//Inculde for nav bar
include_once("../includes/navbars/member.nav.php");
// Starting the session
session_start();

if (isset($_SESSION['user'])) {
    echo "Welcome ".$_SESSION['user']."!";
}