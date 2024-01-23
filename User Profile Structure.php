<?php
    session_start();
    include 'dbConn.php';

    // Check if the user is logged in
    if (!isset($_SESSION['email']) || $_SESSION['email'] === null || !isset($_SESSION['password']) || $_SESSION['password'] === null) { 
        header('Location: loginPPH.php');
        exit;
    }

    //Session variables
    $email = $_SESSION['email'];

    //USER INFO
    // SQL queries
    $query = "SELECT `userID`, `name`, `gender`, `dob`, `contactnum`, `address`,`password` FROM `user` WHERE `email_address` = '$email'";

    // Queries execution
    $result = mysqli_query($connection, $query); 

    // Fetch the results
    if (mysqli_num_rows ($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $userID = $row['userID'];
            $name = $row['name'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $contactnum = $row['contactnum'];
            $address = $row['address'];
            $password = $row['password'];
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

    if (isset($_POST['txtSavechanges'])){
        $name = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $contactnum = $_POST['txtContactnum'];
        $address = $_POST['txtAddress'];

        // Update the database
        $query= "UPDATE `user` 
        SET `name`='$name',`email_address`='$email',`contactnum`='$contactnum',`address`='$address' WHERE `email_address`='$_SESSION[email]'";
        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
        ?>
        <script>
            windows.alert("File is not an image.");
        </script>    
        <?php
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        ?>
        <script>
            windows.alert("Sorry, file already exists.");
        </script>
        <?php
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profileImage"]["size"] > 500000) {
        ?>
        <script>
            windows.alert("Sorry, your file is too large.");
        </script>
        <?php
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        ?>
        <script>
            windows.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        </script>
        <?php
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            ?>
            <script>
                windows.alert("Sorry, your file was not uploaded.");
            </script>
            <?php
        // if everything is ok, try to upload file
        } 
        else {
            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["profileImage"]["name"])). " has been uploaded.";
        } 
        else {
        ?>
        <script>
            windows.alert("Sorry, there was an error uploading your file.");
        </script>
        <?php
        }
        }

        $updateProfile = "INSERT INTO `user_image`(`user_image_link`, `userID`) VALUES ('$target_file','$userID')";

        $profileResult = mysqli_query($connection, $updateProfile);

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
    <link rel="stylesheet" href="Profile Structure.css">
</head>
<body>
    <div class="cross">
        <a href="Main Page.php"><img src="https://static-00.iconduck.com/assets.00/cross-circle-icon-512x512-crxcbljw.png" alt="Back to Home Page" height="40px" width="40px"></a>
    </div>
    <div class="container"> 
        <form action="#" method="POST" enctype="multipart/form-data">
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
        <div class="edit">
                <label for="profileImage"><img src="https://cdn.iconscout.com/icon/free/png-256/free-edit-2653317-2202989.png" alt="Edit" height="30px" width="30px"></label>

                <input type="file" id="profileImage" name="profileImage" accept="image/*" value="" >
                
        </div>

        <div>
            <h1>
                <input type="text" name="txtName" value="<?php
                    echo $name;
                ?>" class="name">
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
                <div>
                    <input type="text" name="txtEmail" value="<?php
                    echo $email;
                    ?>" class="input">
                    
                </div>
            </div>

            <div>
                <h4>Contact Number:</h4>
                <div >
                    <input type="text" name="txtContactnum" value="<?php
                    echo $contactnum;
                    ?>" class="input">
                    
                </div>
            </div>
            <div>
                <h4>Address:</h4>
                <div>
                <textarea name="txtAddress" id="" cols="30" rows="10"><?php echo $address; ?></textarea>
                    
                </div>
            </div><br><br><br>
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
        </div><br><br><br><br><br><br><br><br><br><br><br><br>
       
        <input type="submit" name="txtSavechanges" value="Save changes" class="submit"></form>
    </div>
</body>
</html>
