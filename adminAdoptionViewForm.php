<?php
session_start();
include 'dbConn.php';

//Session variables
$userID = $_GET['id']; //Get the user ID from admin adoption page

//USER PROFILE
$query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID' ORDER BY `userimageID` DESC LIMIT 1";

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
$adoption_info = "SELECT * FROM `adoption` WHERE `userID` = '$userID'";

$adoption_result = mysqli_query($connection, $adoption_info);

if (mysqli_num_rows($adoption_result) > 0) {
    while ($row = mysqli_fetch_assoc($adoption_result)) {
        $past_experience = $row['experience_with_pets'];
        $living_environment = $row['living_environment'];
        $budget_for_pets = $row['budget_for_pets'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Adoption View Form</title>
    <link rel="stylesheet" href="adminViewForm.css">
</head>

<body>
    <div class="back">
        <a href="adminAdoptionApplication.php"><img src="https://cdn-icons-png.flaticon.com/512/93/93634.png" alt="Back to Home Page" height="40px" width="40px"></a>
    </div>
    <div class="container">
        <div>
            <h1>Adoption Form</h1>
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
                    <?php echo $living_environment; ?>
                </p>
            </div><br>
            <div>
                <h2><b>Question 3:</b></h2>
                <p><b>How much is your budget for pets per month? (in RM) *Max 999999</b><br><br>
                    <?php echo 'RM ' . $budget_for_pets; ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
