<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        width: 100%;
        min-height: 100vh;
        background: url(images/background.jpg) no-repeat;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-size: 17px;
    }

    #header {
        position: fixed;
        height: 120px;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #EEF5FF;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1;
    }

    #logo {
        border-radius: 50%;
        height: 100px;
        width: 100px;
        display:inline-block;
    }

    /* Slogan, Motto*/
    #info {
        display: inline-block;
        margin-left: 110px;
        position: fixed;
    }

    /* Navigation bar */
    #nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #nav ul {
        text-align: center;
        display: inline;
        margin: 0;
        color: #fff;
        font-weight: 500;
        font-size: 20px;
        cursor: pointer;
    }

    #nav ul li {
        display: inline-block;
        margin-right: -4px;
        position: relative;
        padding: 15px 20px;
        width: 180px;
    }

    #nav ul li img {
        margin-right: 60px;
        height: 40px;
        width: 40px;
        margin-bottom: -10px;
    }

    #nav a {
        text-decoration: none;
        color: #555;
        font-weight: 500;
        font-size: 20px;
    }

    #nav a:hover{
        color: blueviolet;
    }

    #nav ul li ul {
        padding: 0;
        position: absolute;
        top: 100%;
        left: 0;
        width: 200px;
        display: none;
        opacity: 0;
        visibility: hidden;
    }

    #nav ul li ul li {
        background-color: azure;
        display: block;
    }

    #nav ul li ul li:hover {
        color:#EEF5FF;
        background:white;
    }

    #nav ul li:hover ul {
        display: block;
        opacity: 1;
        visibility: visible;
    }

    #cubox {
    height: 100vh;
    width: auto;
    margin: 120px 0 -120px 0;
    background-color: #F7FBFC;
    position: relative;
    }

    #cucontainer {
        width: 60%;
        margin: 20px auto;
        padding: 0 40px;
        border-radius: 5px;
        line-height: 3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: seashell;
        text-align: center;
    }
</style>

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
