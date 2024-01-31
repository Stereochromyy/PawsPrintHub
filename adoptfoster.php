<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt/Foster</title>
    <link rel="stylesheet" href="PPH.css">
</head>

<body>
    <header id="header">
        <a href="PawsPrintHub.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>

        <nav id="nav" style="float: left;">
            <ul>
                <li><a href="adoptfoster.php">Adopt/Foster</a></li>
                <li><a href="donation.php">Donation</a></li>
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
                        echo '<p>Name: ' . $row['name'] . '<br> Age: ' . $age->y . ' years';
                    } else {
                        echo '<p>Name: ' . $row['name'] . '<br> Age: ' . $age->m . ' months</p>';
                    }
                
                    echo '</div>';
                    echo '</div>';
                }
                
                // Step 5: close connection
                mysqli_close($connection);
            ?>
        </div>     
    </main>
</body>
</html>
