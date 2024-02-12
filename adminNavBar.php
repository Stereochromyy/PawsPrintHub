<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navigation Bar</title>
    <link rel="stylesheet" href="adminNavBar.css">
</head>

<body>
    <div class="header">
        <a href="adminHomePage.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <div id="nav" style="float: left;"> <!--Navigation bar-->
            <ul>
                <li><a href="adminDonationRecord.php">Donation Record</a></li>
                <li><a href="formManagement.php">Form Management</a></li>
                <li><a href="adminUserManagement.php"> User Management</a></li>
                <li><a href="adminPetManagement.php">Pet Management</a></li>
                <li id="clear"><img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="Profile photo" height="40px" width="40px" style="float: left; margin-left: 20%;">
                    <ul>
                        <li><a href="userProfileStructure.php">View profile</a></li>

                        <li><a href="logOut.php"> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
