<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt/Foster</title>
    <link rel="stylesheet" href="Adopt@Foster.css">
</head>

<body>
    <header id="header">
        <a href="Main Page.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <nav id="nav" style="float: left;">
            <ul>
                <li><a href="Adopt@Foster.php">Adopt/Foster</a></li>
                <li><a href="Donation Portal.php">Donation</a></li>
                <li><a href="volunteer.php">Volunteer</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li><img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="Profile photo">
                    <ul>
                        <?php
                            if (!isset($_SESSION['email'])){                    
                        ?>
                            <li><a href="loginPPH.php" target="_blank">Log in/Sign Up</a></li>
                        <?php
                            }
                            else{
                        ?>
                            <li><a href="User Profile Structure.php">View profile</a></li>

                            <li><a href="logout.php"> Log Out</a></li>
                        <?php        
                            }
                        ?> 
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div id="petbar">
            <div id="petbuttongroup">
                <button class="petbutton">All</button>
                
                <button class="petbutton">Dog</button>

                <button class="petbutton">Cat</button>

                <button class="petbutton">Others</button>

            </div>
        </div>

        <div id="main2">
            <?php
                include 'dbConn.php'; 

                // Step 2: create SQL command - select, insert, update, delete
                $query = "SELECT * FROM animal_image INNER JOIN animal ON animal.animalID = animal_image.animalID ORDER BY animal.name ASC";

                // Step 3: execute query
                $results = mysqli_query($connection, $query);

                // Step 4: read results
                while ($row = mysqli_fetch_assoc($results)) {
                    echo '<div class="petframe">';
                    echo '<img src="' . $row['animal_image_link'] . '" alt="' . $row['animalimageID'] . '" class="petbox" id="'.$row['animalID'].'">';
                    echo '<div class="petinfo">';
                
                    $birthdate = new DateTime($row['birthday']);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthdate);
                
                    if ($age->y > 0) {
                        echo '<p>Name: ' . $row['name'] . '<br> Age: ' . $age->y . ' years</p>';
                    } else {
                        echo '<p>Name: ' . $row['name'] . '<br> Age: ' . $age->m . ' months</p>';
                    }
                    ?>
                        </br>
                        <p class="view" data-animalid="<?php echo $row['animalID']; ?>"> View More ￫ </p>
                        <!-- The Modal -->
                        <div id="myModal_<?php echo $row['animalID']; ?>" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="close">&times;</div>
                                <div class="petprofile">
                                    <div class="petprofile1">
                                        <img src="<?php echo $row['animal_image_link'] ?>" alt="Animal Image">
                                    </div>
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
                                    ?>
                                </div>
                                <div class="position">
                                    <div class="button" style="background-color: #98E4FF;">
                                        <img src="https://cdn-icons-png.flaticon.com/512/1883/1883829.png" alt="Adopt"><h2>ADOPT</h2>
                                    </div>
                                    <div class="button" style="margin-left:-80px; background-color: #A1EEBD">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3769/3769065.png" alt="Foster"><h2>FOSTER</h2>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    <?php
                    echo '</div>';
                    echo '</div>'; 
                }

                // Step 5: close connection
                mysqli_close($connection);
            ?>
        </div>
        <script>
            // Get all the buttons with class "view"
            var buttons = document.querySelectorAll('.view');

            // Function to open the modal
            function openModal(animalID) {
                var modal = document.getElementById("myModal_" + animalID);
                modal.style.display = "block";
            }

            // Function to close the modal
            function closeModal(animalID) {
                var modal = document.getElementById("myModal_" + animalID);
                modal.style.display = "none";
            }

            buttons.forEach(function (button) {
                var animalID = button.getAttribute('data-animalid');
                var modal = document.querySelector("#myModal_" + animalID);

                button.addEventListener('click', function () {
                    openModal(animalID);
                });

                var close = modal.querySelector(".close");

                close.addEventListener('click', function () {
                    closeModal(animalID);
                });

                window.addEventListener('click', function (event) {
                    if (event.target == modal) {
                        closeModal(animalID);
                    }
                });
            });

        </script>
    </main>
</body>
</html>
