<?php
include "dbConn.php";

// Initialize for the total amount(RM) and item quantity received
$total_amount = 0;
$total_item = 0;

// Array to store record for next loop
$records = array();

$query = "SELECT * FROM donation ORDER BY donationID ASC";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $donationID = $row['donationID'];
        $donationtype = $row['donation_type'];
        $donationamount = $row['donation_amount'];
        $donationitem = $row['donation_item'];
        $status = $row['donation_status'];
        $userID = $row['userID'];

        if ($donationtype === 'Monetary') {
            $total_amount += floatval($donationamount);
        } else {
            $total_item += 1;
        }
        $records[] = $row; // store data in array 
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donation Record</title>

    <link rel="stylesheet" href="adminDonationRecord.css">
</head>

<body>
    <?php include 'adminNavBar.php'; ?>

    <div class="info">
        <div class="title">
            <h1>Donation Record</h1>
        </div><br><br>

        <div class="content">
            <h3>Total Item Received</h3>
            <img src="https://cdn-icons-png.flaticon.com/512/1380/1380608.png" alt="boxes">
            <p>
                <?php echo $total_item; ?>
            </p>

            <h3 style="margin-left: 35%;">Total Fund Received:</h3>
            <img src="https://cdn-icons-png.flaticon.com/512/8107/8107512.png" alt="Money" style="margin-left: -380px;">
            <p>
                <?php echo 'RM ' . $total_amount; ?>
            </p>
        </div>
        <?php
        foreach ($records as $record) {
            $donationID = $record['donationID'];
            $donationtype = $record['donation_type'];
            $donationamount = $record['donation_amount'];
            $donationitem = $record['donation_item'];
            $status = $record['donation_status'];
            $userID = $record['userID'];

            $user = "SELECT `name` FROM user WHERE userID = '$userID'";
            $userresult = mysqli_query($connection, $user);

            if (mysqli_num_rows($userresult) > 0) {
                while ($user_row = mysqli_fetch_assoc($userresult)) {
                    $name = $user_row['name'];

                }
            }

            $image = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID'";
            $imageresult = mysqli_query($connection, $image);

            if (mysqli_num_rows($imageresult) > 0) {
                while ($image_row = mysqli_fetch_assoc($imageresult)) {
                    $imglink = $image_row['user_image_link'];
                }
            }
            ?>
            <div class="record">
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
                <div>
                    <p>DonationID:
                        <?php echo $donationID; ?>
                    </p>
                    <p>Name:
                        <?php echo $name; ?>
                    </p>
                </div>
                <div style="margin-left: 25%;">
                    <?php
                    if ($donationtype === 'Monetary') {
                        ?>

                        <img src="https://cdn-icons-png.flaticon.com/512/9956/9956875.png" alt="Monetary" class="option">
                        <?php
                    } else {
                        ?>
                        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/add-item-3593618-3009209.png" alt="Item"
                            class="option">
                        <?php
                    }
                    ?>

                </div>
                <div class="donation">
                    <?php
                    if ($donationtype === 'Monetary') {
                        echo 'RM' . $donationamount;
                    } else {
                        echo $donationitem;
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</body>

</html>
