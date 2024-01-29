<?php
    session_start();

    include 'dbConn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Volunteering Application</title>

    <link rel="stylesheet" href="Admin Volunteering Application.css">
</head>
<body>
    <div class="header">
        <img id="logo" src="images/logo.png" alt="Logo" height="100px" width="100px">
        <div class="name_motto"> <!--Name and motto-->
            <h2>Paw Print Hub</h2>
            <h4>- Connecting Paws, Connecting Stories -</h4>
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

    <div class="application">
        
        <div class="title">
            <h1><b>Volunteer Application</b></h1>
        </div>
        <?php 
            $query1 = "SELECT * FROM `volunteering` ORDER BY `volunteerID` ASC"; //for fetching volunteer data

            $result = mysqli_query($connection, $query1);

            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $volunteerID = $row['volunteerID'];
                    $userID = $row['userID'];
                    $approval_status = $row['approval_status'];

                    $query2 = "SELECT `name` FROM `user` WHERE `userID` = '$userID'";

                    $result2 = mysqli_query($connection, $query2);

                    if (mysqli_num_rows ($result2) > 0){
                        while ($row = mysqli_fetch_assoc($result2)){
                            $name = $row['name'];
                        }
                    }
             
        ?>
        <form action="#" method="POST">
            <!-- Will display different color for different approval status -->
            <div class="volunteer" style= "background-color: <?php echo ($approval_status == 'Approved') ? '#A1EEBD' : (($approval_status == 'Rejected') ? '#FF6868' : 'azure'); ?>;">
                <div class="content">
                    <div id="volunteerid">Volunteer ID: <?php echo $volunteerID; ?></div>
                    <br><br>
                    <div id="name">Name: <?php echo $name; ?></div>
                </div>

                <div class="button">
                    <a href="approve.php?id=<?php echo $volunteerID; ?>">
                        <div class="button1">
                            <p>Approved</p>
                        </div>
                    </a>
                    <a href="reject.php?id=<?php echo $volunteerID; ?>">
                        <div class="button2">
                            <p>Rejected </p>
                        </div>
                    </a>
                </div>
                <?php
                
                ?>
                
            </div>
    </form>
    
<?php
       }
       
    }
    
?>
</div>
</body>
</html>
