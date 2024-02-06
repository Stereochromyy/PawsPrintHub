<?php
    include 'dbConn.php';

    $id = $_GET['id'];

    $rejectstatus = "UPDATE `volunteering` SET `approval_status`='Rejected' WHERE `volunteerID` = '$id'";

    $failstatus = mysqli_query($connection, $rejectstatus);

    header('Location: Admin Volunteering Application.php');
?>
