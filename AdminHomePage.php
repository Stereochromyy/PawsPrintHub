<?php
    // session_start();
    include "dbConn.php";

    // Calc different animal species num
    $query = "SELECT * FROM `animal`";

    $result = mysqli_query($connection, $query);

    $dog_num = 0;
    $cat_num = 0;
    $others_num = 0;

    $records = array();

    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result)){
            $species = $row['species'];
        

            if ($species === 'dog'){
                $dog_num +=1;
            }
            elseif($species ==='cat'){
                $cat_num +=1;
            }
            else{
                $others_num +=1;
            }
            $records[] = $row;
        }
    }

    // Calc animals adopted
    $adoption_query = "SELECT * FROM `adoption`";

    $adoption_result = mysqli_query($connection, $adoption_query);

    $adoption_num = 0;

    if(mysqli_num_rows($adoption_result)){
        while($row = mysqli_fetch_assoc($adoption_result)){
            $adoption_num +=1;
        }
    }
    // Calc animals fostered
    $foster_query = "SELECT * FROM `foster`";

    $foster_result = mysqli_query($connection, $foster_query);

    $foster_num = 0;

    if(mysqli_num_rows($foster_result)){
        while($row = mysqli_fetch_assoc($foster_result)){
            $foster_num +=1;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="Admin Home Page.css">

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
                        <li><a href="User Profile Structure.php">View profile</a></li>

                        <li><a href="Log Out.php"> Log Out</a></li>
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
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="clear">
            <div class="info2">
                <img src="images/dog.jpg" alt="Dog">
            </div>

            <div class="info2">
                <img src="images/cat.jpg" alt="Cat">
            </div>

            <div class="info2">
                <img src="images/paw.jpg" alt="Others">
            </div>
        </div>

        <div class="clear">
            <div class="info3">
                <p><?php echo $dog_num; ?></p>
            </div>
            
            <div class="info3">
                <p><?php echo $cat_num; ?></p>
            </div>

            <div class="info3">
                <p><?php echo $others_num; ?></p>
            </div>
        </div>
        
        <div id="ahpinfo">
            <h2>Animals Adopted: </h2> 
            <h2>Animals Fostered: </h2>
        </div>

        <div id="count">
            <p><?php echo $adoption_num; ?></p>
            <p><?php echo $foster_num; ?></p>
        </div>
        
    </main>
</body>
</html>
