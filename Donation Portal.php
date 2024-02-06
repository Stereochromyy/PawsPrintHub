<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws Print Hub | Malaysia</title>
    <link rel="stylesheet" href="Main Page.css">
    <link rel="stylesheet" href="Donation Portal.css">
</head>

<body>
    <header id="header">
        <a href="Main Page.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <nav id="nav" style="float: left;">
            <ul>
                <li><a href="Adopt@Foster.php">Adopt/Foster</a></li>
                <li><a href="Donation Portal.php">Donation</a></li>
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

    <!-- Rectangle for design purpose -->
    <div class="rectangle"> </div>

    <!-- Donation info -->
    <div class="donation">
        <div class="donationinfo" id="text">
            <h1 class="infotext"><b>DONATE ONLINE</b></h1>
            <h2>Your support matters!!!</h2>
            <p style="font-size: large; line-height: 30px; color: rgb(136, 115, 115);"><b>Make a One-Time Payment</b> <br> via Online Banking/ QR Payment<p><br>
            <p>Welcome to Paw Print Hub's Donation Portal! Your support transforms lives by providing shelter, medical care, and basic necessities for pets in need. Choose your donation options, and rest assured, our platform secure the confidentiality of your contribution. Every penny makes changes, let's join us in connecting paws and creating lasting stories. Click the donation options to make a difference today!</p>
        </div>
        <!-- Donation option linked to form -->
        <div class="container">
            <div class="donationoption1" style="background-color: #dafade;">
                <img src="https://static-00.iconduck.com/assets.00/money-send-icon-2048x2046-yh64gys6.png" alt="Monetary" height="50px" width="50px" id="icon">
                <h2 style="display: flex; margin-top: 20px;">Monetary</h2>
            </div>

            <div class="donationoption2" style="background-color: #c4e0ed;">
                <img src="https://static-00.iconduck.com/assets.00/box-icon-512x511-cu40u9gv.png" alt="Item" id="icon" height="50px" width="50px">
                <h2>Item supplies</h2>
            </div>
        </div>

    </div>

    <!-- Footer for additional info -->
    <div id="footer">
        <p style="margin-left: 30px; padding-top:10px;">If you have any enquiries, feel free to drop us a message at 01-2345 6789 or email us at pawprinthub@gmail.com. <br><br> *All donations are tax-exempted. You will be mailed a tax-exempt receipt within 2-3 weeks.</p>

        <footer>Copyright &copy; 2024 Paw Print Hub Selangor. All Right Reserved.</footer>

    </div>
</body>
</html>
