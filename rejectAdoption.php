<?php
include 'dbConn.php';

$id = $_GET['id'];

$rejectstatus = "UPDATE `adoption` SET `approval_status`='Reject' WHERE `adoptionID` = '$id'";

$failstatus = mysqli_query($connection, $rejectstatus);

header('Location: adminAdoptionApplication.php');
