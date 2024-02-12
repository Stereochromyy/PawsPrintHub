<?php
include 'dbConn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Adoption Application</title>
    <link rel="stylesheet" href="adminAdoptionFosterApplication.css">
</head>

<body>
    <header>
        <?php include 'adminNavBar.php'; ?>
    </header>

    <main>
        <div class="application">

            <div class="title">
                <h1><b>Adoption Application</b></h1>
            </div>

            <?php
            $query1 = "SELECT * FROM `adoption` INNER JOIN `animal` ON `animal`.`animalID` = `adoption`.`animalID` ORDER BY `adoption`.`adoptionID` ASC"; //for fetching adoption data
            $result = mysqli_query($connection, $query1);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $adoptionID = $row[`adoption` . 'adoptionID'];
                    $petname = $row[`animal` . 'name'];
                    $approval_status = $row[`adoption` . 'approval_status'];
                    $animalID = $row[`adoption` . 'animalID'];
                    $userID = $row[`adoption` . 'userID'];


                    $query2 = "SELECT `name` FROM `user` WHERE `userID` = '$userID'";
                    $result2 = mysqli_query($connection, $query2);

                    if (mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $username = $row[`user` . 'name'];


                            $query3 = "SELECT * FROM `animal` INNER JOIN `animal_image` ON `animal_image`.`animalID` = `animal`.`animalID` WHERE `animal`.`animalID` = $animalID";
                            $result3 = mysqli_query($connection, $query3);

                            if (mysqli_num_rows($result3) > 0) {
                                while ($row = mysqli_fetch_assoc($result3)) {
                                    $petimage = $row[`animal_image` . 'animal_image_link'];


                                    $query4 = "SELECT * FROM `user` LEFT JOIN `user_image` ON `user_image`.`userID` = `user`.`userID` LEFT JOIN `adoption` ON `adoption`.`userID` = `user`.`userID` WHERE `user`.`userID` = $userID";
                                    $result4 = mysqli_query($connection, $query4);

                                    if (mysqli_num_rows($result4) > 0) {
                                        while ($row = mysqli_fetch_assoc($result4)) {
                                            $userprofile = $row[`user_image` . 'user_image_link'];
                                        }
                                    }
            ?>

                                    <form action="#" method="POST">
                                        <!-- Will display different color for different approval status -->
                                        <a href="adminAdoptionViewForm.php?id=<?php echo $userID; ?>">
                                        <div id="adoption" style="background-color: 
                                        <?php echo ($approval_status == 'Approved') ? '#A1EEBD' : (($approval_status == 'Rejected') ? '#FF817E' : 'lightyellow'); ?>;">


                                            <div class="content">
                                                <div>
                                                    <img src="<?php echo $petimage; ?>" alt="" id="adoptimg">
                                                </div>

                                                <div id="adoptionid">
                                                    Adoption ID: <?php echo $adoptionID; ?>
                                                </div>

                                                <br><br>

                                                <div id="name">
                                                    Pet's Name: <?php echo $petname; ?>
                                                </div>

                                                <div id="profile">
                                                    <img src="<?php echo $userprofile; ?>" alt="">
                                                </div>

                                                <div id="username">
                                                    <?php echo $username ?>
                                                </div>
                                            </div>

                                            <div class="button">
                                                <a href="approveAdoption.php?id=<?php echo $adoptionID; ?>">
                                                    <div class="button1">
                                                        <p>Approve</p>
                                                    </div>
                                                </a>

                                                <a href="rejectAdoption.php?id=<?php echo $adoptionID; ?>">
                                                    <div class="button2">
                                                        <p>Reject</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </form>

            <?php
                                }
                            }
                        }
                    }
                }
            }

            ?>

        </div>
    </main>
</body>

</html>
