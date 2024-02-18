<?php
    session_start();
    include 'dbConn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminPetManagement.css">
</head>
<body>
<?php
    include("adminNavBar.php");

    if(isset($_POST["submitNewPetBtn"])){
        $petname = $_POST["pet_name"];
        $petspecies = $_POST["pet_species"];
        $petbreed = $_POST["pet_breed"];
        $petdob = $_POST["pet_bday"];
        $petweight = $_POST["pet_weight"];
        $pet_vac_status = $_POST["pet_vac_status"];
        $pet_nur_status = $_POST["pet_nur_status"];
        $pet_add_info = $_POST["pet_add_info"];
        $add_new_animal_query = "INSERT INTO `animal` (`name`, `species`, `breed`, `birthday`, `weight`, `vaccination_status`, `nurturing_status`, `additional_info`) VALUES ('$petname', '$petspecies', '$petbreed', '$petdob', '$petweight', '$pet_vac_status', '$pet_nur_status', '$pet_add_info')";

        $add_new_animal_result = mysqli_query($connection, $add_new_animal_query);

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

                    $retrieve_new_animal_id = "SELECT * FROM `animal` WHERE name = '$petname' ORDER BY animalID DESC limit 1";
                    $retrieve_animal_id_result = mysqli_query($connection, $retrieve_new_animal_id);

                    while($idrow = mysqli_fetch_assoc($retrieve_animal_id_result)){
                        $animalid = $idrow["animalID"];
                    }

                    $add_new_img_query = "INSERT INTO `animal_image`(`animal_image_link`, `animalID`) VALUES ('$target_file','$animalid')";
                    $add_new_img_result = mysqli_query($connection, $add_new_img_query);
                    ?>
                    <script>
                        window.alert("New animal added successfully!");
                        window.reload();
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        window.alert("Upload failed, an error occured when uploading your file.");
                    </script>
                    <?php
                }
            }
        }

        
    }
?>
    <main>
        <div id="petbar"></div>
        <div id="petbuttongroup">
            <button class="petbutton" id="allfilter">All</button>
            
            <button class="petbutton" id="dogfilter">Dog</button>

            <button class="petbutton" id="catfilter">Cat</button>

            <button class="petbutton" id="otherfilter">Other</button>
        </div>

        <div id="main">
            <?php
                include 'dbConn.php'; 

                    // Step 2: create SQL command - select, insert, update, delete
                    $query = "SELECT * FROM adoption RIGHT JOIN animal ON adoption.animalID = animal.animalID WHERE adoption.approval_status IS NULL OR adoption.approval_status IN ('Pending', 'Reject') OR animal.animalID IS NULL";

                    // Step 3: execute query
                    $results = mysqli_query($connection, $query);

                    // Step 4: read results
                    while ($row = mysqli_fetch_assoc($results)) {
                        $animalid = $row["animalID"];
                        $animalimgquery = "SELECT * FROM animal_image where animalID = '$animalid' ORDER BY animalimageID DESC limit 1";
                        $imgresult = mysqli_query($connection, $animalimgquery);
                        while ($imgrow = mysqli_fetch_assoc($imgresult)) {
                            $animalimg = $imgrow["animal_image_link"];
                        }

                        $animalspecies = $row["species"];

                        if($animalspecies == "dog"){
                            $species = "dog";
                        } else if($animalspecies == "cat"){
                            $species = "cat";
                        } else{
                            $species = "other";
                        }
                        
                        echo '<div class="petframe '.$species.'">';
                            echo '<img src="'. $animalimg .'">';
                            echo '<div class="petinfo">';
                        
                                $birthdate = new DateTime($row['birthday']);
                                $currentDate = new DateTime();
                                $age = $currentDate->diff($birthdate);

                                echo '<p>Name: '.$row['name'].'</p>';
                                if ($age->y > 0) {
                                    echo '<p> Age: ' . $age->y . ' years </p>';
                                } else {
                                    echo '<p> Age: ' . $age->m . ' months </p>';
                                }
                                echo '<br><p><small>Breed: '.$row['breed'].'</small></p>';
                                echo '<p><small>Weight: '.$row['weight'].' Kg</small></p>';
                                ?>
                                <br>
                                <a href = "managePetDetail.php?manage_animalID=<?php echo $animalid; ?>">
                                    <button class="view" id="viewpet"> Manage Pet </button>
                                </a>
                                <?php
                            echo '</div>';
                        echo '</div>'; 
                    }
                    

                // Step 5: close connection
                mysqli_close($connection);
                        ?>
        </div>

        <div id="addNewPetPopUp">
            <div id="blankbackground"></div>
            <div id="addNewPetForm" style="background-image: url(https://img.freepik.com/premium-vector/leaves-green-abstract-light-wet-wash-splash-your-design-hand-painted-watercolor-background_41901-759.jpg);">
            <button type="button" id="closePetForm"><</button><h2>NEW ANIMAL DETAILS</h2><br>
            <form action="" method="post" enctype="multipart/form-data">
                <br><br>
                <p>Animal Name: <input type="text" name="pet_name" class="newPetInput" required></p>
                <p>Species: <input type="text" name="pet_species" class="newPetInput" required></p>
                <p>Breed: <input type="text" name="pet_breed" class="newPetInput" required></p>
                <p>Date Of Birth: <input type="date" name="pet_bday" class="newPetInput" required></p>
                <p>Animal Weight: <input type="text" name="pet_weight" class="newPetInput" required></p>
                <p>Vaccination Status: <select name="pet_vac_status" class="newPetInput" required>
                    <option value="Not vaccinated">Not Vaccinated</option>
                    <option value="Partially vaccinated">Partially Vaccinated</option>
                    <option value="Vaccinated">Vaccinated</option>
                </select>
                <p>Nurturing Status: <select name="pet_nur_status" class="newPetInput" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <p>Additional Info: </p><textarea name="pet_add_info" class="newPetInput" cols="60" rows="5"></textarea>
                <p>Animal Image:</p>
                <input type="file" id="upload_animal_pic" name="upload_animal_pic" required><br>
                <input type="submit" name="submitNewPetBtn" id="submitNewPetBtn" value="Add Pet">
            </form>
            </div>
        </div>

        <div class="bottom-toolbar" id="bottomToolbar">
            <div id="addpetbtn">
                <h5>Add New Animals</h5>
                <img src="https://us.123rf.com/450wm/get4net/get4net2202/get4net220201752/181439163-add-inurance-for-pet-animals-with-foot-print.jpg?ver=6" alt="">
            </div>
        </div>

        <div id="void" style="min-height: 200px;"></div>
        
    </main>

    <script>
    var addPetBtn = document.getElementById("addpetbtn");
    var petPopUp = document.getElementById("addNewPetPopUp");
    addPetBtn.onclick = function(){
        petPopUp.style.display = "block";
    }

    var closebtn = document.getElementById("closePetForm");
    closebtn.onclick = function(){
        petPopUp.style.display = "none";
    }

    var viewbtn = document.getElementById("viewpet");
    viewbtn.onclick = function(){
        window.location.href = "petdetailpage.php?";
    }

    // Setting up variable for buttons
    var allbtn = document.getElementById("allfilter");
    var dogbtn = document.getElementById("dogfilter");
    var catbtn = document.getElementById("catfilter");
    var otherbtn = document.getElementById("otherfilter");

    // Setting up variable for pet frame with species as their id
    var dog = document.getElementsByClassName("dog");
    var cat = document.getElementsByClassName("cat");
    var other = document.getElementsByClassName("other");

    allbtn.onclick = function(){
        allbtn.style.backgroundColor = "rgb(214, 255, 218)";
        dogbtn.style.backgroundColor = "white";
        catbtn.style.backgroundColor = "white";
        otherbtn.style.backgroundColor = "white";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "flex";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "flex";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "flex";
        }
    }
    
    dogbtn.onclick = function(){
        allbtn.style.backgroundColor = "white";
        dogbtn.style.backgroundColor = "rgb(214, 255, 218)";
        catbtn.style.backgroundColor = "white";
        otherbtn.style.backgroundColor = "white";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "flex";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "none";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "none";
        }
    }

    catbtn.onclick = function(){
        allbtn.style.backgroundColor = "white";
        dogbtn.style.backgroundColor = "white";
        catbtn.style.backgroundColor = "rgb(214, 255, 218)";
        otherbtn.style.backgroundColor = "white";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "none";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "flex";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "none";
        }
    }

    otherbtn.onclick = function(){
        allbtn.style.backgroundColor = "white";
        dogbtn.style.backgroundColor = "white";
        catbtn.style.backgroundColor = "white";
        otherbtn.style.backgroundColor = "rgb(214, 255, 218)";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "none";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "none";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "flex";
        }
    }

    
</script>

</body>
</html>
