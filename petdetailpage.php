<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="petdetailpage.css">
</head>
<?php
    session_start();
    include "dbConn.php";
    $animalid = $_GET["adopt_animalID"];
?>

<body>

<!-- Modal content -->
<a href = "Adopt@Foster.php"><button class="back">< Back</button></a>
<div class="modal-content">
    <div class="petprofile">
        <?php
            $allanimalimagequery = "SELECT * FROM animal_image where animalID ='$animalid' ORDER BY animalimageID DESC";
            $allimgresult = mysqli_query($connection, $allanimalimagequery);
            while($imagesrow = mysqli_fetch_assoc($allimgresult)){
                echo '<img src="'. $imagesrow["animal_image_link"] .'" class="petprofile1" id="'.$animalid.'">';
            }

            $petquery = "SELECT * FROM animal where animalID = '$animalid'";
            $petresult = mysqli_query($connection, $petquery);
            while($row = mysqli_fetch_assoc($petresult)){
                $birthdate = new DateTime($row['birthday']);
                $currentDate = new DateTime();
                $age = $currentDate->diff($birthdate);
        ?>


    </div>
        <div class="petdetails">
            <?php
                echo '<b><u>Pet Basic Info</u></b>';
                echo '<p>'.'Name: '. $row['name'].'</p>';
                if ($age->y > 0) {
                    echo 'Age: ' . $age->y . ' years</p>';
                } else {
                    echo 'Age: ' . $age->m . ' months</p>';
                }
                echo '<p>'.'Species: '. $row['species'].'</p>';
                echo '<p>'.'Breed: '. $row['breed'].'</p>';
                echo '<p>'.'Weight: '. $row['weight'].' kg </p><br>';
                echo '<b><u>Health Status</u></b>';
                echo '<p>'.'Vaccination status: '. $row['vaccination_status'].'</p>';
                echo '<p>'.'Nurturing status: '. $row['nurturing_status'].'</p><br>';
                echo '<b><u>Additional Info</u></b>';
                echo '<p> -'.$row['additional_info'].'</p>';
                }
            ?>
        </div>
    <div class="position">
        <a href="adoptionform.php?type=adopt&adopt_animalID=<?php echo $animalid; ?>">
        <button class="button" id="adoptbtn" style="background-color: #98E4FF;">
            <img src="https://cdn-icons-png.flaticon.com/512/1883/1883829.png" alt="Adopt"><h2>ADOPT</h2>
        </button>
        </a>
        <a href="adoptionform.php?type=foster&adopt_animalID=<?php echo $animalid; ?>">
        <button class="button" id="fosterbtn" style="margin-left:-80px; background-color: #A1EEBD">
            <img src="https://cdn-icons-png.flaticon.com/512/3769/3769065.png" alt="Foster"><h2>FOSTER</h2>
        </button>
        </a>
    </div>
</div>

    
</body>
</html>
