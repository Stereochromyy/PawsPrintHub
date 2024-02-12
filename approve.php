<?php
    include 'dbConn.php';

    $id = $_GET['id'];

    $updatestatus = "UPDATE `volunteering` SET `approval_status`='Approve' WHERE `volunteerID` = '$id' ";

    $approvestatus = mysqli_query($connection, $updatestatus);

    header('Location: adminVolunteeringApplication.php');
?>
