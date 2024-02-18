<?php
// session_start();
include "dbConn.php";

// Calc different animal species num
$query = "SELECT * FROM `animal`";

$result = mysqli_query($connection, $query);

$dog_num = 0;
$cat_num = 0;
$others_num = 0;

$records = array();

if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $species = $row['species'];


        if ($species === 'dog') {
            $dog_num += 1;
        } elseif ($species === 'cat') {
            $cat_num += 1;
        } else {
            $others_num += 1;
        }
        $records[] = $row;
    }
}

// Calc animals adopted
$adoption_query = "SELECT * FROM `adoption` WHERE `approval_status` = 'Approve'";

$adoption_result = mysqli_query($connection, $adoption_query);

$adoption_num = 0;

if (mysqli_num_rows($adoption_result)) {
    while ($row = mysqli_fetch_assoc($adoption_result)) {
        $adoption_num += 1;
    }
}
// Calc animals fostered
$foster_query = "SELECT * FROM `foster` WHERE `approval_status` = 'Approve'";

$foster_result = mysqli_query($connection, $foster_query);

$foster_num = 0;

if (mysqli_num_rows($foster_result)) {
    while ($row = mysqli_fetch_assoc($foster_result)) {
        $foster_num += 1;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="adminHomePage.css">

</head>

<body>
    <?php include 'adminNavBar.php'; ?>

    <main>
        <div id="title">
            <h1>Current Shelter Animal Count: </h1>
        </div>

        <div class="clear">
            <div class="info1">
                <h2>Dog</h2>
            </div>

            <div class="info1">
                <h2>Cat</h2>
            </div>

            <div class="info1">
                <h2>Others</h2>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="clear">
            <div class="info2">
                <a href="adminPetManagement.php">
                <img src="images/dog.png" id="Dog" style="padding: 30px;">
                </a>
            </div>

            <div class="info2">
                <a href="adminPetManagement.php">
                <img src="images/cat.png" id="Cat" style="padding: 30px;">
                </a>
            </div>

            <div class="info2">
                <a href="adminPetManagement.php">
                <img src="images/paw.png" id="Others" style="padding: 30px;">
                </a>
            </div>
        </div>

        <div class="clear">
            <div class="info3">
                <p><?php echo $dog_num; ?></p>
            </div>

            <div class="info3">
                <p><?php echo $cat_num; ?></p>
            </div>

            <div class="info3">
                <p><?php echo $others_num; ?></p>
            </div>
        </div>

        <div id="count">

            <a href="formManagement.php">
            <div id="ahpinfo">
                <h2>Animals Adopted: </h2>
                <p><?php echo $adoption_num; ?></p>
            </div>
            </a>

            <a href="formManagement.php">
            <div id="ahpinfo">
            <h2>Animals Fostered: </h2>
                <p><?php echo $foster_num; ?></p>
            </div>
            </a>

        </div>

        <div id="void" style="min-height: 100px;"></div>
    </main>
</body>

</html>
