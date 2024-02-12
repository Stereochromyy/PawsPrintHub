<?php

include 'dbConn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Volunteering Application</title>

    <link rel="stylesheet" href="adminVolunteeringApplication.css">
</head>

<body>
    <?php include 'adminNavBar.php'; ?>

    <div class="application">

        <div class="title">
            <h1><b>Volunteer Application</b></h1>
        </div>
        <?php
        $query1 = "SELECT * FROM `volunteering` ORDER BY `volunteerID` DESC"; //for fetching volunteer data
        
        $result = mysqli_query($connection, $query1);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $volunteerID = $row['volunteerID'];
                $userID = $row['userID'];
                $approval_status = $row['approval_status'];

                $query2 = "SELECT `name` FROM `user` WHERE `userID` = '$userID'";

                $result2 = mysqli_query($connection, $query2);

                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $name = $row['name'];
                    }
                }

                ?>
                <form action="#" method="POST">
                    <!-- Will display different color for different approval status -->
                    <a href="adminVolunteeringViewForm.php?id=<?php echo $userID; ?>">
                        <div class="volunteer"
                            style="background-color: <?php echo ($approval_status == 'Approve') ? '#A1EEBD' : (($approval_status == 'Reject') ? '#FF6868' : 'azure'); ?>;">
                            <div class="content">
                                <div id="volunteerid">Volunteer ID:
                                    <?php echo $volunteerID; ?>
                                </div>
                                <br><br>
                                <div id="name">Name:
                                    <?php echo $name; ?>
                                </div>
                            </div>

                            <div class="button">
                                <a href="approve.php?id=<?php echo $volunteerID; ?>">
                                    <div class="button1">
                                        <p>Approve</p>
                                    </div>
                                </a>
                                <a href="reject.php?id=<?php echo $volunteerID; ?>">
                                    <div class="button2">
                                        <p>Reject </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </a>
                </form>

                <?php
            }
        }
        ?>
    </div>
</body>

</html>
