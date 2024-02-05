<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="Admin Home Page.css">
    <link rel="stylesheet" href="PPH.css">

</head>
<body>
    <div class="header">
        <a href="AdminHomePage.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <div id="nav" style="float: left;"> <!--Navigation bar-->
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
        </div>
    </div>

    <main>
        <div id="title">
            <h1>Current Shelter Animal Count: </h1> 
        </div>

        <div class="clear">
            <div class="info1">
                <h2>Dog</h2>
            </div>

            <div class="info1">
                <h2>Cat</h2>
            </div>

            <div class="info1">
                <h2>Others</h2>
            </div>
        </div>
        
        <div class="clear">
            <div class="info2">
                <img src="" alt="Dog">
            </div>

            <div class="info2">
                <img src="" alt="Cat">
            </div>

            <div class="info2">
                <img src="" alt="Others">
            </div>
        </div>

        <div class="clear">
            <div class="info3">
                <p>2</p>
            </div>
            
            <div class="info3">
                <p>2</p>
            </div>

            <div class="info3">
                <p>4</p>
            </div>
        </div>
        
        <div id="ahpinfo">
            <h2>Animals Adopted: </h2> 
            <h2>Animals Fostered: </h2>
        </div>

        <div id="count">
            <p>0</p>
            <p>0</p>
        </div>
        
    </main>
</body>
</html>
