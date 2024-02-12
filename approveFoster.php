<?php
include 'dbConn.php';

$id = $_GET['id'];

$updatestatus = "UPDATE `foster` SET `approval_status`='Approve' WHERE `fosterID` = '$id'";

$approvestatus = mysqli_query($connection, $updatestatus);

header('Location: adminFosterApplication.php');
