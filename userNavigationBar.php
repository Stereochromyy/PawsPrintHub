<?php
// Bypass the session activation if it has activated
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dbConn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="userNavigationBar.css">
</head>

<body>
    <header id="header">
        <a href="mainPage.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <nav id="nav" style="float: left;">
            <ul>
                <li><a href="adopt@Foster.php">Adopt/Foster</a></li>
                <li><a href="donationPortal.php">Donation</a></li>
                <li><a href="volunteer.php">Volunteer</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
                <li><img src="images/usericon.png" alt="Profile photo">
                    <ul>
                        <?php
                        if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
                            ?>
                            <li><a href="loginPPH.php" target="_blank">Log in/Sign Up</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="userProfileStructure.php">View profile</a></li>

                            <li><a href="logOut.php"> Log Out</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <?php
        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
            ?>
            <div class="notification-box" style="margin-left:-320px;">
                <img src="images/notification.png" alt="Notification" id="notification_icon">

                <div class="notification" id="notification">

                    <?php

                    $notif1 = 0;
                    $notif2 = 0;
                    $notif3 = 0;

                    $query1 = "SELECT *, adoption.approval_status AS adoption_approval_status, animal.name AS animal_name FROM adoption LEFT JOIN animal ON animal.animalID = adoption.animalID WHERE `adoption`.`userID` = '$_SESSION[userID]' ORDER BY adoption.adoptionID DESC LIMIT 1";
                    $result1 = mysqli_query($connection, $query1);

                    if ($result1) {
                        while ($row = mysqli_fetch_assoc($result1)) {
                            $adoption_status = $row['adoption_approval_status'];
                            $animal_name = $row['animal_name'];
                            $notif1 = 1;
                            if (!is_null($adoption_status)) {
                                echo "<b>Animal Name:</b>
                                $animal_name <br>";
                                echo "<b>Adoption Status:</b> $adoption_status<br><br>";
                            }
                        }
                    }

                    $query2 = "SELECT *, foster.approval_status AS foster_approval_status, animal.name AS animal_name FROM foster LEFT JOIN animal ON animal.animalID = foster.animalID WHERE `foster`.`userID` = '$_SESSION[userID]' ORDER BY foster.fosterID DESC LIMIT 1";
                    $result2 = mysqli_query($connection, $query2);

                    if ($result2) {
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $foster_status = $row['foster_approval_status'];
                            $animal_name = $row['animal_name'];
                            $notif2 = 1;
                            if (!is_null($foster_status)) {
                                echo "<b>Animal Name:</b>
                                $animal_name <br>";
                                echo "<b>Foster Status:</b> $foster_status<br><br>";
                            }
                        }
                    }

                    $query3 = "SELECT *, volunteering.approval_status AS volunteering_approval_status FROM volunteering WHERE `volunteering`.`userID` = '$_SESSION[userID]' ORDER BY volunteering.volunteerID DESC LIMIT 1";
                    $result3 = mysqli_query($connection, $query3);

                    if ($result3) {
                        while ($row = mysqli_fetch_assoc($result3)) {
                            $volunteering_status = $row['volunteering_approval_status'];
                            $notif3 = 1;
                            if (!is_null($volunteering_status)) {
                                echo "<b>Volunteering Status:</b> $volunteering_status<br>";
                            }
                        }
                    }

                    if ($notif1 == 0 && $notif2 == 0 && $notif3 == 0) {
                        echo "<div style='text-align: center;'><a href= 'adopt@Foster.php'>Let's adopt/foster a pet </a> <br> OR <br> <a href= 'volunteer.php'>Volunteering</a> </div>";
                    }
                }
        ?>
            </div>
        </div>
    </header>
    <script>
        var notification_icon = document.getElementById('notification_icon');
        var notification = document.getElementById('notification');

        notification_icon.onclick = function () {
            notification.style.display = "block";
        }

        // Hide while they click outside the notification
        window.onclick = function (event) {
            if (event.target != notification && event.target != notification_icon) {
                notification.style.display = 'none';
            }
        }
    </script>
</body>

</html>
