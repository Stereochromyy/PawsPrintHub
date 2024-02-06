<?php
    include 'dbConn.php';

    echo $id = $_GET['id'];

    $updatestatus = "UPDATE `volunteering` SET `approval_status`='Approved' WHERE `volunteerID` = '$id' ";

    $approvestatus = mysqli_query($connection, $updatestatus);

    header('Location: Admin Volunteering Application.php');
?>
