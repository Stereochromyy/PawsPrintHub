<?php
    session_start(); //log out and unset with destroy the session
    session_unset();
    session_destroy();
    header("Location: loginPPH.php"); // go back to login page
    exit();
?>
