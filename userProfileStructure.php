<?php
session_start();
include 'dbConn.php';

//Session variables
$email = $_SESSION['email'];

//USER INFO
// SQL queries
$query = "SELECT `userID`, `name`, `gender`, `dob`, `contactnum`, `address`,`userroleID` FROM `user` WHERE `email_address` = '$email'";

// Queries execution
$result = mysqli_query($connection, $query);

// Fetch the results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userID = $row['userID'];
        $name = $row['name'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $contactnum = $row['contactnum'];
        $address = $row['address'];
        $userroleID = $row['userroleID'];
    }
}

//USER PROFILE
$query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID' ORDER BY `userimageID` DESC LIMIT 1";

$result2 = mysqli_query($connection, $query2);

$imglink = "";
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $imglink = $row['user_image_link'];
    }
}

//ADOPTED PETS
$ani_imglinks = array();


//SELECT UNIQUE IMAGE FROM THE ADOPTED PETS (Since join with 2, so need 2 ON)
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

//UPLOAD PROFILE PHOTO
$tempImageURL = null;
$target_file = "default_value";
if (isset($_FILES["profileImage"]["tmp_name"]) && !empty($_FILES["profileImage"]["tmp_name"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    //Check file size
    if ($_FILES["profileImage"]["size"] > 500000) {
        ?>
        <script>
            window.alert("Sorry, your file is too large.");
        </script>
        <?php
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "avif"
    ) {
        ?>
        <script>
            window.alert("Sorry, only JPG, JPEG, AVIF, PNG & GIF files are allowed.");
        </script>
        <?php
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        ?>
        <script>
            window.alert("Sorry, file already exists.");
        </script>
        <?php
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            // Use the path to create the URL
            $tempImageURL = $target_file;
            $updateProfile = "INSERT INTO `user_image`(`user_image_link`, `userID`) VALUES ('$target_file','$userID')";

            $profileResult = mysqli_query($connection, $updateProfile);
        }
    } else {
        ?>
        <script>
            window.alert("Sorry, there was an error uploading your file.");
        </script>
        <?php
    }

}

if (isset($_POST['txtSavechanges'])) {
    $name = $_POST['txtName'];
    $contactnum = $_POST['txtContactnum'];
    $address = $_POST['txtAddress'];

    // Update the database
    $query = "UPDATE `user` 
        SET `name`='$name',`contactnum`='$contactnum',`address`='$address' WHERE `email_address`='$_SESSION[email]' LIMIT 1";

    // Show message whether the update successful/failure
    if (mysqli_query($connection, $query)) {
        ?>
        <script>window.alert("Changes saved")</script>
        <?php

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
            <?php // Validate whether the cross will direct back to admin main page or user main page
            if ($userroleID === 'A2') {
                ?>
                <a href="adminHomePage.php"><img
                        src="https://static-00.iconduck.com/assets.00/cross-circle-icon-512x512-crxcbljw.png"
                        alt="Back to Home Page" height="40px" width="40px"></a>

                <?php
            } else {
                ?>
                <a href="mainPage.php"><img
                        src="https://static-00.iconduck.com/assets.00/cross-circle-icon-512x512-crxcbljw.png"
                        alt="Back to Home Page" height="40px" width="40px"></a>
                <?php
            }
            ?>

        </div>
        <form action="#" method="POST" enctype="multipart/form-data">

            <div class="profile">
                <?php
                if ($tempImageURL) {
                    ?>
                    <img src="<?php echo $tempImageURL; ?>" alt="Profile picture" id="profile-pic">
                    <?php
                } elseif ($imglink) {
                    ?>
                    <img src="<?php echo $imglink; ?>" alt="Profile picture" id="profile-pic">
                    <?php
                } else {
                    ?>
                    <img src="https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png"
                        alt="Profile picture" id="profile-pic">
                    <?php
                }
                ?>

            </div>
            <div class="edit">
                <label for="profileImage"><img
                        src="https://cdn.iconscout.com/icon/free/png-256/free-edit-2653317-2202989.png" alt="Edit"
                        height="30px" width="30px"></label>

                <input type="file" id="profileImage" name="profileImage" accept="image/*" value="" class="show">

            </div>
            <script>
                let profilePic = document.getElementById("profile-pic");
                let inputProfile = document.getElementById("profileImage");

                inputProfile.onchange = function () {
                    profilePic.src = URL.createObjectURL(inputProfile.files[0]);
                }

            </script>

            <div>
                <h1>
                    <input type="text" name="txtName" value="<?php
                    echo $name;
                    ?>" id="name" pattern="/^[a-zA-Z-' ]*$/" class="show" required>
                </h1>
            </div>

            <div class="info">
                <div>
                    <h4>Gender:</h4>
                    <div class="input" style="color: grey; border: 1px solid grey;">
                        <?php echo $gender; ?>
                    </div>
                </div>
                <div>
                    <h4>Date of Birth:</h4>
                    <div class="input" style="color: grey; border: 1px solid grey;">
                        <?php echo $dob; ?>

                    </div>
                </div>
                <div>
                    <h4>Email Address:</h4>
                    <div class="input" style="color: grey; border: 1px solid grey;">
                        <?php echo $email; ?>

                    </div>
                </div>

                <div>
                    <h4>Contact Number:</h4>
                    <div>
                        <input type="text" name="txtContactnum" value="<?php
                        echo $contactnum;
                        ?>" class="input show" pattern="\d{3}-\d{3}-\d{4}" required>

                    </div>
                </div>
                <div>
                    <h4>Address:</h4>
                    <div>
                        <textarea name="txtAddress" id="" cols="30" rows="10" class="show"
                            required><?php echo $address; ?></textarea>

                    </div>
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
                    ?>

                </div>
            </div><br><br>

            <input type="submit" name="txtSavechanges" value="Save changes" class="submit" id="submit">
        </form>
    </div>
    <script>
        var show = document.getElementsByClassName('show');
        var submit = document.getElementById('submit');

        for (var i = 0; i < show.length; i++) {
            show[i].onclick = function () {
                submit.style.display = 'block';
            }
        }

        // Hide while they click outside these input area
        window.onclick = function (event) {
            if (event.target != show[0] && event.target != show[1] && event.target != show[2] && event.target != show[3] && event.target != submit) {
                submit.style.display = 'none';
            }
        }
    </script>
</body>

</html>
