<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="managePetDetailPage.css">
</head>
<?php
    session_start();
    include "dbConn.php";
    $animalid = $_GET["manage_animalID"];

    if(isset($_FILES["upload_animal_pic"]["tmp_name"]) && !empty($_FILES["upload_animal_pic"]["tmp_name"])){
        $target_dir = "petuploads/";
        $target_file = $target_dir . basename($_FILES["upload_animal_pic"]["name"]);
        $upload = True;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        ?>
        <script>
            window.alert("Only JPG, JPEG, PNG & GIF files are allowed, upload failed.");
        </script>
        <?php
            $upload = False;
        } 

        // Check if file already exists
        if (file_exists($target_file)) {
        ?>
        <script>
            window.alert("File already exists, choose a new one.");
        </script>
        <?php
            $upload = False;
        }

        // Check is it okay to upload
        if (!$upload) {
            ?>
            <script>
                window.alert("Sorry, your file was not uploaded.");
            </script>
            <?php
        // if everything is ok, upload the file
        } else {
            if (move_uploaded_file($_FILES["upload_animal_pic"]["tmp_name"], $target_file)) {
                $add_new_img_query = "INSERT INTO `animal_image`(`animal_image_link`, `animalID`) VALUES ('$target_file','$animalid')";
                $add_new_img_result = mysqli_query($connection, $add_new_img_query);
                if($add_new_img_query){
                    ?>
                    <script>
                    window.alert("New image added successfully!");
                    window.location.href = "managePetDetail.php?manage_animalID=<?php echo $animalid; ?>";
                    </script>
                    <?php
                }
            } else {
            ?>
            <script>
                window.alert("Upload failed, an error occured when uploading your file.");
            </script>
            <?php
            }
        }
    }

    if(isset($_POST["save_change_btn"])){ // This part is for saving the changes once the "Save Change" button is clicked

        $new_name = $_POST["new_name"];
        $new_bday = $_POST["new_bday"];
        $new_species = $_POST["new_species"];
        $new_breed = $_POST["new_breed"];
        $new_weight = $_POST["new_weight"];
        $new_vac_status = $_POST["new_vac_status"];
        $new_nur_status = $_POST["new_nur_status"];
        $new_add_info = $_POST["new_add_info"];

        $update_pet_sql = "UPDATE animal SET name = '$new_name', species = '$new_species', breed = '$new_breed', birthday ='$new_bday', weight ='$new_weight', vaccination_status = '$new_vac_status', nurturing_status = '$new_nur_status', additional_info = '$new_add_info' WHERE animalID = '$animalid'";

        $update_pet_result = mysqli_query($connection, $update_pet_sql);
        if($update_pet_result){
?>
            <script>
            window.alert("Pet detail updated successfully.");
            </script>
        <?php
        }
    }

    if(isset($_POST["deleteyes"])){ // This part is for the "Delete Button", carrying out the delete pet function
        $delete_animal_query1 = "DELETE FROM animal_image where animalID = '$animalid'";
        $delete_animal_query2 = "DELETE FROM adoption where animalID = '$animalid'";
        $delete_animal_query3 = "DELETE FROM foster where animalID = '$animalid'";
        $delete_animal_query4 = "DELETE FROM animal where animalID = '$animalid'";

        $delete_animal_result1 = mysqli_query($connection, $delete_animal_query1);
        $delete_animal_result2 = mysqli_query($connection, $delete_animal_query2);
        $delete_animal_result3 = mysqli_query($connection, $delete_animal_query3);
        $delete_animal_result4 = mysqli_query($connection, $delete_animal_query4);

        if($delete_animal_result1 && $delete_animal_result2 && $delete_animal_result3 && $delete_animal_result4){
        ?>
        <script>
            window.alert("Animal Deleted Successfully.");
            window.location.href = "adminPetManagement.php";
        </script>
        <?php
        } else{
            ?>
            <script>
                window.alert("Something went wrong, failed to delete animal :/")
                window.location.href = "adminPetManagement.php";
            </script>
        <?php
        }
    }
    
?>

<body>

<!-- Modal content -->
<a href = "adminPetManagement.php"><button class="back">< Back</button></a>
<div class="modal-content">
    <div class="petprofile">
        <?php
            $allanimalimagequery = "SELECT * FROM animal_image where animalID ='$animalid' ORDER BY animalimageID DESC";
            $allimgresult = mysqli_query($connection, $allanimalimagequery);
            // echo '<form action="" method="post">';
            while($imagesrow = mysqli_fetch_assoc($allimgresult)){
                echo '<div id="imgframe">
                    <img src="'. $imagesrow["animal_image_link"] .'">
                    <form action="" method="post"><button type="submit" id="delimgbtn" name="delimgbtn" class="delimgbtn" value="'.$imagesrow["animalimageID"].'" hidden disabled>X</button></form>
                </div>';
            }
        ?>

        <?php
            $petquery = "SELECT * FROM animal where animalID = '$animalid'";
            $petresult = mysqli_query($connection, $petquery);
            while($row = mysqli_fetch_assoc($petresult)){
                $birthdate = new DateTime($row['birthday']);
                $currentDate = new DateTime();
                $age = $currentDate->diff($birthdate);
        ?>
    </div>
        <div id="uploadpetimgicon" style="display: none;">
            <form action="" method="post" enctype="multipart/form-data">
                <h4>Upload new image:</h4>
                <input type="file" id="upload_animal_pic" name="upload_animal_pic">
        </div>

        <div>
            <?php
            if(isset($_POST["delimgbtn"])){
                $targetimage = $_POST["delimgbtn"];
                ?>
                <script>
                    var delete_result = window.confirm("Are you sure you want to delete this image?");
                    if(delete_result){
                        window.location.href = "managePetDetail.php?manage_animalID=<?php echo $animalid; ?>&delete_result=yes&targetimage=<?php echo $targetimage; ?>" 
                    } else{
                        window.location.href = "managePetDetail.php?manage_animalID=<?php echo $animalid; ?>&delete_result=no";
                    }
                </script>
                <?php
            }
            
            if(isset($_GET["delete_result"])){
                $delete_result = $_GET["delete_result"];
                $target_image = $_GET["targetimage"];
                if($delete_result == "yes"){
                    $delete_animal_img_query = "DELETE FROM animal_image WHERE animalimageID = '$target_image'";
                    $delete_animal_img_result = mysqli_query($connection, $delete_animal_img_query);
                    ?>
                    <script>
                        window.location.href = "managePetDetail.php?manage_animalID=<?php echo $animalid; ?>"
                    </script>
                    <?php
                } else if ($delete_result == "no"){
                    ?>
                    <script>
                        window.location.href = "managePetDetail.php?manage_animalID=<?php echo $animalid; ?>"
                    </script>
                    <?php
                }
            }
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
                if(empty($row['additional_info'])){
                    echo '<p> - </p>';
                } else {
                echo '<p>'.$row['additional_info'].'</p>';
                }
        echo '</div>';
            ?>

        <div class="edit_pet_input_box">
            <!-- <form method="post" action=""> -->
                <b><u>Pet Basic Info</u></b>
                <p>Name: <input type="text" name="new_name" value="<?php echo $row['name'];?>"></p>
                <p>Birthday: <input type="date" name="new_bday" value="<?php echo $row['birthday']; ?>"></p>
                <p>Species: <input type="text" name="new_species" value="<?php echo $row['species'];?>" required></p>
                <p>Breed: <input type="text" name="new_breed" value="<?php echo $row['breed'];?>" required></p>
                <p>Weight (Kg): <input type="text" name="new_weight" value="<?php echo $row['weight'];?>" pattern="\d+(\.\d{1,2})?" required></p><br>
                <b><u>Health Status</u></b>
                <p>Vaccination status: <select name="new_vac_status" required>
                    <option value="Not vaccinated" <?php if($row['vaccination_status'] == 'Not vaccinated'){ echo 'selected'; } ?> > Not Vaccinated </option>
                    <option value="Partially vaccinated" <?php if($row['vaccination_status'] == 'Partially vaccinated'){ echo 'selected'; } ?>> Partially Vaccinated </option>
                    <option value="Vaccinated" <?php if($row['vaccination_status'] == 'Vaccinated'){ echo 'selected'; } ?> > Vaccinated </option>
                </select> </p>
                <p>Nurturing status: <select name="new_nur_status" required>
                    <option value="" disabled selected hidden> <?php echo $row['nurturing_status'];?> </option>
                    <option value="Yes" <?php if($row['nurturing_status'] == "Yes"){ echo "selected"; } ?> >Yes</option>
                    <option value="No" <?php if($row['nurturing_status'] == "No"){ echo "selected"; } ?> >No</option>
                </select></p><br>
                <b><u>Additional Info</u></b>
                <p><textarea name="new_add_info" cols="58" rows="5"> <?php echo $row['additional_info'];?> </textarea></p>
                <div class="buttongroup">
                    <button type="submit" name="save_change_btn" class="button" id="savebtn" style="display: none; font-size: 0.9em;  background-color: #c3fec0; color: rgb(10, 92, 4); line-height: 60px; font-weight: bold;">Save Changes</button>
                    <button type="button" name="discard_change_btn" class="button" id="discardbtn" style="display: none; font-size: 0.9em; background-color: rgb(174, 7, 7); color: white; line-height: 60px; font-weight: bold;">Discard Changes</button>
                </div>
            </form>
        </div>
            <?php
            }
            ?>
    <div class="manage_btn">
        <div> <!-- Edit button -->
            <button type="button" class="button" id="editbtn" style="background-color: #c0eefe;">
                <img src="https://static-00.iconduck.com/assets.00/edit-icon-2048x2048-6svwfwto.png" alt=""><h2>Edit</h2>
            </button>
        </div>

        <div> <!-- Delete button -->
            <button type="button" class="button" id="deletebtn" style="background-color: rgb(174, 7, 7)">
                <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="delete"><h2 style="color: white;">Delete</h2>
            </button>
        </div>
    </div>
</div> 

<div id="popuppage">
    <div id="blank"></div>
    <div id="popup">
        <h2>! DELETE ANIMAL CONFIRMATION !</h2><br>
        <p><small>Are you sure you want to delete this animal?
        <br>
        This process is permanent and cannot be undone.
        <br><br>
        *Note: All pet related data will be deleted as well</small></p>
        <form method="post"action="" id="popupbtngroup">
            <button class="pubtn" name="deleteyes" id="yesbtn" value="YES" style="background-color: #c3fec0; color: rgb(10, 92, 4);">YES</button>
            <button class="pubtn" name="deleteno" id="nobtn" value="NO" style="background-color: rgb(174, 7, 7); color: white;">NO</button>
        </form>
    </div>
</div>

</body>
<script>
    
    editbtn = document.getElementById("editbtn");
    deletebtn = document.getElementById("deletebtn");
    savebtn = document.getElementById("savebtn");
    discardbtn = document.getElementById("discardbtn");
    uploadicon = document.getElementById("uploadpetimgicon");
    delimgbtn = document.getElementsByClassName("delimgbtn");

    editbtn.addEventListener('click', function(){
        document.getElementsByClassName("petdetails")[0].style.display = "none";
        document.getElementsByClassName("edit_pet_input_box")[0].style.display = "block";
        editbtn.style.display = "none";
        deletebtn.style.display = "none";
        savebtn.style.display = "block";
        discardbtn.style.display = "block";
        uploadicon.style.display = "block";
        for(var i=0; i<delimgbtn.length; i++){
            delimgbtn[i].hidden = false;
            delimgbtn[i].disabled = false;
        }

    });

    savebtn.addEventListener('click', function(){
        document.getElementsByClassName("petdetails")[0].style.display = "block";
        document.getElementsByClassName("edit_pet_input_box")[0].style.display = "none";
        editbtn.style.display = "block";
        deletebtn.style.display = "block";
        savebtn.style.display = "none";
        discardbtn.style.display = "none";
        uploadicon.style.display = "none";
        for(var i=0; i<delimgbtn.length; i++){
            delimgbtn[i].hidden = true;
            delimgbtn[i].disabled = true;
        }
    });

    discardbtn.addEventListener('click', function(){
        document.getElementsByClassName("petdetails")[0].style.display = "block";
        document.getElementsByClassName("edit_pet_input_box")[0].style.display = "none";
        editbtn.style.display = "block";
        deletebtn.style.display = "block";
        savebtn.style.display = "none";
        discardbtn.style.display = "none";
        uploadicon.style.display = "none";
        for(var i=0; i<delimgbtn.length; i++){
            delimgbtn[i].hidden = true;
            delimgbtn[i].disabled = true;
        }

        window.alert("Change Discarded.");
    });

    

        yes = document.getElementById("yesbtn");
        no = document.getElementById("nobtn");
        
        deletebtn.addEventListener('click', function(){
            document.getElementById("popuppage").style.display = "block";
        });

        yes.addEventListener('click', function(){
            document.getElementById("popuppage").style.display = "none";
        });

        no.addEventListener('click', function(){
            document.getElementById("popuppage").style.display = "none";
        });



</script>
</html>
