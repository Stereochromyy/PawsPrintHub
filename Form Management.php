<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Management</title>
    <link rel="stylesheet" href="Form Management.css">
</head>

<body>
    <header id="header">
        <a href="AdminHomePage.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <nav id="nav" style="float: left;">
            <ul>
                <li><a href="Admin Donation Record.php">Donation Record</a></li> 
                <li><a href="Form Management.php">Form Management</a></li>
                <li><a href="Admin user management.php"> User Management</a></li>
                <li><a href="Pet Management.php">Pet Management</a></li>
                <li id="clear"><img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="Profile photo" height="40px" width="40px" style="float: left; margin-left: 20%;">
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

                            <li><a href="Log Out.php"> Log Out</a></li>
                        <?php        
                            }
                        ?>  
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>
       <div class="fmbox">
            <a href="Admin Adoption Application.php">
                <h2>View Adoption Application</h2>
            </a>
        </div>
        <div class="fmbox">
            <a href="#">
                <h2>View Fostering Application</h2>
            </a>
        </div>
        <div class="fmbox">
            <a href="Admin Volunteering Application.php">
                <h2>View Volunteer Application</h2>
            </a>
        </div>
    </main>
</body>
</html>
