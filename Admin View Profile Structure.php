<?php
    session_start();
    include 'dbConn.php';

    //Session variables
    $userID = $_GET['userID']; //Get the user ID from user management page

    //USER INFO
    // SQL queries
    $query = "SELECT `name`, `gender`, `dob`, `contactnum`, `address`, `email_address` FROM `user` WHERE `userID` = '$userID'";

    // Queries execution
    $result = mysqli_query($connection, $query); 

    // Fetch the results
    if (mysqli_num_rows ($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $contactnum = $row['contactnum'];
            $address = $row['address'];
            $email = $row['email_address'];
        }
    }

    //USER PROFILE
    $query2 = "SELECT `user_image_link` FROM `user_image` WHERE `userID`= '$userID'";

    $result2 = mysqli_query($connection, $query2); 

    if (mysqli_num_rows ($result2) > 0){
        while ($row = mysqli_fetch_assoc($result2)){
            $imglink = $row['user_image_link'];
        }
    }

    //ADOPTED PETS
    $animalquery = "SELECT `animalID` FROM `adoption` WHERE `userID`='$userID'";

    $resultanimalID = mysqli_query($connection,$animalquery);

    if($resultanimalID){ //if TRUE
        $row = mysqli_fetch_assoc($resultanimalID); //fetch the animalID
            
            if($row !==null && isset($row['animalID'])){
                $animalID = $row['animalID']; //Check whether the row is null or does it have animalID
                
                $query3 = "SELECT `animal_image_link` FROM `animal_image` WHERE `animalID` = '$animalID' LIMIT 2"; //Limit to 2 pictures only

                
                $result3 = mysqli_query($connection,$query3);

                $ani_imglinks = array(); // Initialize the array to store image links

                if (mysqli_num_rows ($result3) > 0){
                    while ($row = mysqli_fetch_assoc($result3)){
                        //check if the field is not empty
                        if (!empty($row['animal_image_link'])){
                        $ani_imglinks[] = $row['animal_image_link'];
                        }
                    }
    
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
    <link rel="stylesheet" href="Profile Structure.css">
</head>
<body>
    <div class="cross">
        <a href="Admin user management.php"><img src="https://static-00.iconduck.com/assets.00/cross-circle-icon-512x512-crxcbljw.png" alt="Back to Home Page" height="40px" width="40px"></a>
    </div>
    <div class="container">
        <div class="profile">
            <?php
            //Check if the profile is empty or exist
                if(empty($imglink)){
            ?>
                <img src="https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png" alt="Profile picture">
            <?php
                }
                else{
            ?>
                <img src="<?php echo $imglink; ?>" alt="Profile picture">
            <?php
                }
            ?>
        </div>

        <div class="name">
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
                <h4>Adopted Pet:</h4>
                <div class="petimage">
                    <div class="petimage1">
                        <?php
                            if (empty($ani_imglinks)){ //Check if animal image links is exist or not
                        ?>
                        
                        <p>NULL</p>
                                
                        <?php
                            }
                            else{
                        ?>

                        <img src="<?php echo $ani_imglinks[0]; ?>" alt="Pet Image 1">

                        <?php
                            }
                        ?>
                        
                    </div>
                    <div class="petimage2">
                        <?php
                            if (empty($ani_imglinks)){
                        ?>
                            <p>NULL</p>

                        <?php
                            }
                            else{
                        ?>
                            <img src="<?php echo $ani_imglinks[1]; ?>" alt="Pet Image 2">
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</body>
</html>
