<?php
session_start();
include 'dbConn.php';

//GET variables
$userID = $_GET['id']; //Get the user ID from admin donation page

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

//UPDATE DONATION STATUS
$success_message='';
if(isset($_POST['txtSubmit'])){
    $update = $_POST['txtStatus'];
    $update_status = "UPDATE `donation` SET `donation_status`='$update' WHERE `userID` = '$userID'";

    $update_result = mysqli_query($connection, $update_status);
    if ($update_result) {
        $success_message = "Done";
    }
}

//DONATION INFO
$donation_info = "SELECT * FROM `donation` WHERE `userID` = '$userID'";

$donation_result = mysqli_query($connection, $donation_info);

if (mysqli_num_rows($donation_result) > 0) {
    while ($row = mysqli_fetch_assoc($donation_result)) {
        $donationID = $row['donationID'];
        $donationtype = $row['donation_type'];
        $donationamount = $row['donation_amount'];
        $donationitem = $row['donation_item'];
        $donation_quantity = $row['donation_quantity'];
        $donation_date = $row['donation_date'];
        $status = $row['donation_status'];
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Donation View Form</title>
    <link rel="stylesheet" href="adminDonationViewForm.css">
</head>
<style>
    

</style>

<body>
    <form action="#" method="POST">
    <div class="container">
        <div class="back">
            <a href="adminDonationRecord.php"><img src="https://cdn-icons-png.flaticon.com/512/93/93634.png"
                alt="Back to Home Page" height="40px" width="40px"></a>
        </div>
        <div>
            <h1>Donation Record</h1>
        </div>
        <div class="position">
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
            <div class="info">
                <p><b>Role:</b>
                    <?php
                    if ($userroleID === 'U1') {
                        echo 'User';
                    } else if ($userroleID === 'A2') {
                        echo 'Admin';
                    } else {
                        echo 'Guest';
                    }
                    ?>
                </p>
                <p><b>Name:</b>
                    <?php echo $name; ?>
                </p>
                <p><b>Email:</b>
                    <?php echo $email; ?>
                </p>
                <p><b>Date of Birth:</b>
                    <?php echo $dob; ?>
                </p>
                <p><b>Contact Number:</b>
                    <?php echo $contact_num; ?>
                </p>
            </div>
        </div>
        <div class="question"><br>
            <div>
                <p><b>Donation Date: </b>
                    <?php echo $donation_date; ?>
                </p>
            </div><br>
            <div>
                <p><b>Donation Type: </b>
                    <?php echo $donationtype; ?>
                </p>
            </div><br>
            <?php if ($donationtype === 'Item') {
                ?>
                <div>
                    <p><b>Donation Item: </b>
                        <?php echo $donationitem; ?>
                    </p>
                </div><br>
                <div>
                    <p><b>Donation Quantity: </b>
                        <?php echo $donation_quantity . ' pax'; ?>
                    </p>
                </div><br>
                <div>
                    <p><b>Donation Status: </b>
                        <input type="text" name="txtStatus" id="" value="<?php echo $status; ?>">
                        <label for="image-button">
                            <img src="https://i.pinimg.com/originals/b8/cc/30/b8cc30277d4134cebca1105ac86be61c.png"
                                alt="Tick button" style='height: 20px; width: 20px; padding-top: 7px;'>
                        </label>
                        <input type="submit" value="" name="txtSubmit" id="image-button">
                        <?php
                            if($success_message !='') {
                                echo '<div id="message">'.$success_message. '</div>';
                            }
                        ?>
                    </p>
                </div><br>
                <?php
            } else {
                ?>
                <div>
                    <p><b>Donation Amount: </b>RM
                        <?php echo $donationamount; ?>
                    </p>
                </div><br>
                <div>
                    <p><b>Donation Status: </b>
                        <?php echo $status; ?>
                    </p>
                </div>
                <?php
            } ?>
        </div>
    </div>
    </form>
</body>

</html>
