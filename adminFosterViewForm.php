<?php
session_start();
include 'dbConn.php';

//Session variables
$userID = $_GET['id']; //Get the user ID from admin adoption page

//USER PROFILE
$query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID'";

$result2 = mysqli_query($connection, $query2);

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $imglink = $row['user_image_link'];
    }
}

// USER INFO
$user_info = "SELECT * FROM `user` WHERE `userID` = '$userID'";

$user_result = mysqli_query($connection, $user_info);

if (mysqli_num_rows($user_result) > 0) {
    while ($row = mysqli_fetch_assoc($user_result)) {
        $name = $row['name'];
        $dob = $row['dob'];
        $email = $row['email_address'];
        $contact_num = $row['contactnum'];
        $userroleID = $row['userroleID'];
    }
}

//ADOPTION INFO
$foster_info = "SELECT * FROM `foster` WHERE `userID` = '$userID'";

$foster_result = mysqli_query($connection, $foster_info);

if (mysqli_num_rows($foster_result) > 0) {
    while ($row = mysqli_fetch_assoc($foster_result)) {
        $past_experience = $row['experience_with_pets'];
        $living_situation = $row['living_situation'];
        $budget_for_pets = $row['budget_for_pets'];
        $fostering_duration = $row['fostering_duration'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Foster View Form</title>
    <link rel="stylesheet" href="adminViewForm.css">
</head>

<body>
    <div class="back">
        <a href="adminFosterApplication.php"><img src="https://cdn-icons-png.flaticon.com/512/93/93634.png" alt="Back to Home Page" height="40px" width="40px"></a>
    </div>
    <div class="container">
        <div>
            <h1>Foster Form</h1>
        </div>
        <div class="position">
            <div class="profile">
                <?php
                //Check if the profile is empty or exist
                if (empty($imglink)) {
                ?>
                    <img src="https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png" alt="Profile picture">
                <?php
                } else {
                ?>
                    <img src="<?php echo $imglink; ?>" alt="Profile picture">
                <?php
                }
                ?>
            </div>
            <div class="info">
                <p><b>Role:</b>
                    <?php
                    if ($userroleID === 'U1') {
                        echo 'User';
                    } else {
                        echo 'Guest';
                    }
                    ?></p>
                <p><b>Name:</b> <?php echo $name; ?></p>
                <p><b>Email:</b> <?php echo $email; ?></p>
                <p><b>Date of Birth:</b> <?php echo $dob; ?></p>
                <p><b>Contact Number:</b> <?php echo $contact_num; ?></p>
            </div>
        </div>
        <div class="question">
            <div>
                <h2><b>Question 1:</b></h2>
                <p><b>Do you have any previous experience with pets?</b><br><br>
                    <?php echo $past_experience; ?>
                </p>
            </div><br>
            <div>
                <h2><b>Question 2:</b></h2>
                <p><b>How is your living environment? Tell us your property type, may add any description. (if any)</b><br><br>
                    <?php echo $living_situation; ?>
                </p>
            </div><br>
            <div>
                <h2><b>Question 3:</b></h2>
                <p><b>How much is your budget for pets per month? (in RM) *Max 999999</b><br><br>
                    RM <?php echo $budget_for_pets; ?>
                </p>
            </div><br>
            <div>
                <h2><b>Question 4:</b></h2>
                <p><b>How long would you like to foster this pet?</b><br><br>
                    <?php echo $fostering_duration; ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
