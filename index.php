<?php
    include 'dbConn.php';

    $email = $_SESSION['email'];

    $verify = "SELECT `userroleID` FROM `user` WHERE `email_address` = '$email'";

    $result = mysqli_query($connection, $verify);

    if ($result){
        $row = mysqli_fetch_assoc($result);
        if ($row && isset($row['userroleID'])) {
            $userroleID = $row['userroleID'];

            if($userroleID === 'A2'){
                include 'adminHomePage.php';
            }
            else{
                include 'mainPage.php';
            }
        }
        else{
            echo "Invalid user data";
        }
    }
    else{
        echo "Error executing query:" . mysqli_error($connection);
    }

?>
