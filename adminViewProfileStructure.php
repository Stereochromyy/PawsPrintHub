<?php
include 'dbConn.php';

$userID = $_GET['userID']; //Get the user ID from user management page

//USER INFO
// SQL queries
$query = "SELECT `name`, `gender`, `dob`, `contactnum`, `address`, `email_address` FROM `user` WHERE `userID` = '$userID'";

// Queries execution
$result = mysqli_query($connection, $query);

// Fetch the results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $contactnum = $row['contactnum'];
        $address = $row['address'];
        $email = $row['email_address'];
    }
}

//USER PROFILE
$query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID' ORDER BY `userimageID` DESC LIMIT 1";

$result2 = mysqli_query($connection, $query2);

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $imglink = $row['user_image_link'];
    }
}

//ADOPTED PETS
$ani_imglinks = array();

$query3 = "SELECT animal_image.animal_image_link
            FROM animal_image
            JOIN (
                SELECT animal_image.animalID, MAX(animal_image.animalimageID) AS max_animalimageID
                FROM animal_image
                JOIN adoption ON animal_image.animalID = adoption.animalID
                WHERE adoption.userID = '$userID' AND adoption.approval_status = 'Approve'
                GROUP BY animal_image.animalID
            ) adoption_ids ON animal_image.animalID = adoption_ids.animalID AND animal_image.animalimageID = adoption_ids.max_animalimageID;";

$result3 = mysqli_query($connection, $query3);

if (mysqli_num_rows($result3) > 0) {
    while ($row = mysqli_fetch_assoc($result3)) {
        if (!empty($row['animal_image_link'])) {
            $ani_imglinks[] = $row['animal_image_link'];
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Structure</title>
    <link rel="stylesheet" href="profileStructure.css">
</head>

<body>
    <div class="container">
        <div class="cross">
            <a href="adminUserManagement.php"><img
                    src="https://static-00.iconduck.com/assets.00/cross-circle-icon-512x512-crxcbljw.png"
                    alt="Back to Home Page" height="40px" width="40px"></a>
        </div>
        <div class="profile">
            <?php
            //Check if the profile is empty or exist
            if (empty($imglink)) {
                ?>
                <img src="https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png"
                    alt="Profile picture">
                <?php
            } else {
                ?>
                <img src="<?php echo $imglink; ?>" alt="Profile picture">
                <?php
            }
            ?>
        </div>

        <div id="name" style="background-color:white;">
            <h1>
                <?php
                echo $name;
                ?>
            </h1>
        </div>

        <div class="info">
            <div>
                <h4>User ID:</h4>
                <div class="input">
                    <?php
                    echo $userID;
                    ?>
                </div>
            </div>
            <div>
                <h4>Gender:</h4>
                <div class="input">
                    <?php
                    echo $gender;
                    ?>
                </div>
            </div>
            <div>
                <h4>Date of Birth:</h4>
                <div class="input">
                    <?php
                    echo $dob;
                    ?>
                </div>
            </div>
            <div>
                <h4>Email Address:</h4>
                <div class="input">
                    <?php
                    echo $email;
                    ?>
                </div>
            </div>
            <div>
                <h4>Contact Number:</h4>
                <div class="input">
                    <?php
                    echo $contactnum;
                    ?>
                </div>
            </div>
            <div>
                <h4>Address:</h4>
                <div>
                    <textarea name="txtAddress" id="" cols="30" rows="10" readonly><?php echo $address; ?></textarea>
                </div><br><br><br><br>

                <div>
                    <?php
                    $num_colums = count($ani_imglinks);
                    if ($num_colums > 0) {
                        echo "  <h4>Adopted Pet:</h4>
                            <div class='petframe'>";
                        for ($i = 0; $i < $num_colums; $i++) {
                            $imglink = $ani_imglinks[$i];
                            echo "<div class='petimage'>";
                            if ($imglink) {
                                echo "<img src='" . $imglink . "' alt= 'Pet Image'>";
                            } else {
                                echo "No image for the pets.";
                            }
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    ?><br>
                </div>
            </div>
        </div>
    </div>


    </div>
</body>

</html>
