<?php
    session_start();
    include 'dbConn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google font link: Itim font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Lobster&family=Roboto:wght@100&display=swap" rel="stylesheet">

    <title>User Management</title>

    <link rel="stylesheet" href="Admin user management.css">
</head>
<body>
    <div class="header">
        <img id="logo" src="logo.jpg" alt="Logo" height="100px" width="100px">
        <div class="name_motto"> <!--Name and motto-->
            <h2>Paw Print Hub</h2>
            <h4>- Connecting Paws, Connecting Stories -</h4>
        </div>

        <div id="nav" style="float: left;"> <!--Navigation bar-->
            <ul>
                <li>Donation Record</li> 
                <li>Form Management</li>
                <li><a href="Admin user management.php"> User Management</a></li>
                <li>Pet Management</li>
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
    <div class="info">
        <?php
        //User details
        $query = "SELECT `userID`, `name`, `email_address` FROM `user` WHERE `userroleID`='U1'  ORDER BY `userID` ASC";

        // Queries execution
        $result = mysqli_query($connection, $query); 

        // Fetch the results
        if (mysqli_num_rows ($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $userID = $row['userID'];
                $name = $row['name'];
                $email = $row['email_address'];

            //USER PROFILE
            $query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID'";

            $result2 = mysqli_query($connection, $query2); 

            if (mysqli_num_rows ($result2) > 0){
                while ($row = mysqli_fetch_assoc($result2)){
                    $imglink = $row['user_image_link'];
                }
            }
        
        ?>
        <div class="userinfo">
            <div class="profile">
                <?php
                //Check if the profile is empty or exist
                    if(empty($imglink)){
                ?>
                    <img src="https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png" alt="Profile picture">
                <?php
                    }
                    else{
                ?>
                    <img src="<?php echo $imglink; ?>" alt="Profile picture">
                <?php
                    }
                ?>
            </div>
            <div class="name">
                <?php echo $name;?>
            </div>
            <div class="details">
                <h4>User ID: </h4>
                <div class="output">
                    <?php echo $userID; ?>
                </div>
        
                <h4>Email Address: </h4> 
                <!-- style="width: 350px" -->
                <div >
                <textarea name="" id="" cols="30" rows="10" class="output" readonly><?php echo $email; ?></textarea> 
                <!-- readonly: not allow admin to modify the email -->
                    
                </div>
            </div>
        </div>
    <?php
        }
    }
    else{
        echo "No users found.";
    }
    ?>
    </div>
</body>
</html>
