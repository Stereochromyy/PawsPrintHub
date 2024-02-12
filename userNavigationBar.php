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
                <li><img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png"
                        alt="Profile photo">
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
                <img src="images/notification.png" alt="Notification">

                <div class="notification">

                    <?php
                    $query = "SELECT *,
                        `user`.`userID`,
                        `adoption`.`approval_status` AS adoption_approval_status,
                        `foster`.`approval_status` AS foster_approval_status,
                        `volunteering`.`approval_status` AS volunteering_approval_status
                        FROM `user`
                        LEFT JOIN `adoption` ON `user`.`userID` = `adoption`.`userID`
                        LEFT JOIN `foster` ON `user`.`userID` = `foster`.`userID`
                        LEFT JOIN `volunteering` ON `user`.`userID` = `volunteering`.`userID` 
                        WHERE `user`.`email_address` = '$_SESSION[email]' AND `user`.`password` = '$_SESSION[password]'";

                    $result = mysqli_query($connection, $query);

                    // Fetch the results
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userID = $row['userID'];
                            $adoption_status = $row['adoption_approval_status'];
                            $foster_status = $row['foster_approval_status'];
                            $volunteering_status = $row['volunteering_approval_status'];

                            // Display approval status for each table if the userID is in the respective table
                
                            if (!is_null($adoption_status)) {
                                echo "Adoption Status: $adoption_status<br>";
                            }

                            if (!is_null($foster_status)) {
                                echo "Foster Status: $foster_status<br>";
                            }

                            if (!is_null($volunteering_status)) {
                                echo "Volunteering Status: $volunteering_status<br>";
                            }

                            if (is_null($adoption_status) && is_null($foster_status) && is_null($volunteering_status)) {
                                echo "<p>No Notifications Displayed...</p>";
                            }
                            echo "<br>";
                        }
                    } else {
                        echo "No results found.";
                    }
        }
        ?>
            </div>
        </div>
    </header>
</body>

</html>
