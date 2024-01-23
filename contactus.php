<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="PPH.css">
</head>

<body>
    <header id="header">
        <a href="PawsPrintHub.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <nav id="nav" style="float: left;">
            <ul>
                <li><a href="adoptfoster.php">Adopt/Foster</a></li>
                <li><a href="donation.php">Donation</a></li>
                <li><a href="volunteer.php">Volunteer</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li><img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="Profile photo">
                    <ul>
                        <?php
                            if (!isset($_SESSION['email'])){                    
                        ?>
                            <li><a href="loginPPH.php" target="_blank">Log in/Sign Up</a></li>
                        <?php
                            }
                            else{
                        ?>
                            <li><a href="User Profile Structure.php">View profile</a></li>

                            <li><a href="logout.php"> Log Out</a></li>
                        <?php        
                            }
                        ?> 
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div id="cubox">
            <h1  style="margin: 25px;">Contact Us</h1>
            <div id="cucontainer">
                <table>
                    <tr>
                        <th><h4>Field</h4></th>
                        <th><h4>Details</h4></th>
                    </tr>
                    <tr>
                        <td>Name/Registration No.</td>
                        <td>Paws Print Hub<br>PPH-G29-03-22082024</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Lot 23A-29, Jalan XYZ Subang Jaya,<br>47100 Subang, Selangor, Malaysia</td>
                    </tr>
                    <tr>
                        <td>Operation Hours</td>
                        <td>Sundays - Closed<br>Mon-Sat - 9am - 4pm</td>
                    </tr>
                    <tr>
                      <td>Contact Number</td>
                      <td>(+60)12-345 6789</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>pawsprinthub@gmail.com</td>
                    </tr>
                  </table>
            </div>
    </main>
    
</body>
</html>
