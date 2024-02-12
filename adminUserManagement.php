<?php

include 'dbConn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management</title>

    <link rel="stylesheet" href="adminUserManagement.css">
</head>

<body>
    <?php include 'adminNavBar.php'; ?>

    <div class="info">
        <?php
        //User details
        $query = "SELECT `userID`, `name`, `email_address` FROM `user` WHERE `userroleID`= 'U1'  ORDER BY `userID` ASC";

        // Queries execution
        $result = mysqli_query($connection, $query);

        // Fetch the results
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row['userID'];
                $name = $row['name'];
                $email = $row['email_address'];

                //USER PROFILE
                $query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID'";

                $result2 = mysqli_query($connection, $query2);

                if (mysqli_num_rows($result2) > 0) {
                    $row2 = mysqli_fetch_assoc($result2);
                    $imglink = $row2['user_image_link'];

                } else {
                    // Set a default image link if no profile image is found
                    $imglink = "https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png";
                }   
                ?>

                <div class="userinfo">
                    <a href="adminViewProfileStructure.php?userID=<?php echo $userID; ?>">
                        <!--Pass the userID to admin view profile structure-->
                        <div class="profile">   
                            <img src="<?php echo $imglink; ?>" alt="Profile picture">         
                        </div>
                        <div class="name">
                            <?php echo $name; ?>
                        </div>
                        <div class="details">
                            <h4>User ID: </h4>
                            <div class="output">
                                <?php echo $userID; ?>
                            </div> <br>

                            <h4>Email Address: </h4>
                            <div class="output" style="min-width: 300px;">
                                <?php echo $email; ?>
                            </div> <br>

                        </div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>
</body>

</html>
