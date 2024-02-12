<?php
include 'dbConn.php';

$id = $_GET['id'];

$updatestatus = "UPDATE `adoption` SET `approval_status`='Approve' WHERE `adoptionID` = '$id'";

$approvestatus = mysqli_query($connection, $updatestatus);

header('Location: adminAdoptionApplication.php');
