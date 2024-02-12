<?php
include 'dbConn.php';

$id = $_GET['id'];

$rejectstatus = "UPDATE `foster` SET `approval_status`='Reject' WHERE `fosterID` = '$id'";

$failstatus = mysqli_query($connection, $rejectstatus);

header('Location: adminFosterApplication.php');
