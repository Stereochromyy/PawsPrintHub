<?php
    session_start();

    include 'dbConn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws Print Hub | Malaysia</title>
    <link rel="stylesheet" href="Main Page.css">
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
                            if (!isset($_SESSION['email']) || $_SESSION['email'] === null || !isset($_SESSION['password']) || $_SESSION['password'] === null){                    
                        ?>
                            <li><a href="loginPPH.php" target="_blank">Log in/Sign Up</a></li>
                        <?php
                            }
                            else{
                        ?>
                            <li><a href="User Profile Structure.php">View profile</a></li>

                            <li><a href="Log Out.php"> Log Out</a></li>
                        <?php        
                            }
                        ?> 
                    </ul>
                </li>
            </ul>
        </nav>
        <?php
            if (isset($_SESSION['email']) || isset($_SESSION['password'])) { 
        ?>
            <div class = "notification-box" style="margin-left:-25px;">
                <img src="images/notification.png" alt="Notification">

                <div class = "notification">

                <?php
                    $query = "SELECT *,
                        `user`.`userID`,
                        `adoption`.`approval_status` AS adoption_approval_status,
                        `foster`.`approval_status` AS foster_approval_status,
                        `volunteering`.`approval_status` AS volunteering_approval_status
                        FROM `user`
                        LEFT JOIN `adoption` ON `user`.`userID` = `adoption`.`userID`
                        LEFT JOIN `foster` ON `user`.`userID` = `foster`.`userID`
                        LEFT JOIN `volunteering` ON `user`.`userID` = `volunteering`.`userID`
                        WHERE `user`.`email_address` = '$_SESSION[email]' AND `user`.`password` = '$_SESSION[password]'";

                        $result = mysqli_query($connection, $query); 
                                
                        if (!$result){
                            die("Error in SQL query:".mysqli_error($connection));
                        }

                        // Fetch the results
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $userID = $row['userID'];
                                $adoption_status = $row['adoption_approval_status'];
                                $foster_status = $row['foster_approval_status'];
                                $volunteering_status = $row['volunteering_approval_status'];

                                // Display approval status for each table if the userID is in the respective table

                                if (!is_null($adoption_status)) {
                                    echo "Adoption Status: $adoption_status<br>";
                                }

                                if (!is_null($foster_status)) {
                                    echo "Foster Status: $foster_status<br>";
                                }

                                if (!is_null($volunteering_status)) {
                                    echo "Volunteering Status: $volunteering_status<br>";
                                }

                                if(is_null($adoption_status) && is_null($foster_status) && is_null($volunteering_status)){
                                    echo "<p>No Notifications Displayed...</p>";
                                }
                                echo "<br>";

                                
                                        
                            }
                        }else {
                            echo "No results found.";
                        }
            }
                ?>
                </div>
            </div>        
        
    </header>

    <main>
        <div id="box">
            <img src="images/random.webp" alt="A dog image" id="imgaboutus">
               
            <div id="aboutustext">
                <h2>About Us</h2>
                <p>Welcome to Paws Print Hub, a revered Non-Profit Organization established in 1997 and located in Subang Jaya, Selangor, 
                    Malaysia. Over the years, our commitment has earned unparalleled trust, recognition, and support from animal enthusiasts 
                    nationwide. At Paws Print Hub, we ensure that every animal receives the care and attention they deserve 
                    to thrive as the happiest and healthiest pets possible.</p>
                
                <h2>Aim</h2>
                <p>Our aim is to provide: </p>
                <ol type="1">
                    <li><b>Rescue and Rehabilitation</b></li>
                        <ul>
                            <li>To rescue animals in need, provide them with necessary medical care, rehabilitation, and create a safe environment for their physical and emotional recovery.</li>
                        </ul>
                    <br>
                    <li><b>Adoption Opportunities</b></li>
                        <ul>
                            <li>Facilitate the adoption process, connecting animals with loving families to ensure a forever home for every rescued pet.</li>
                        </ul>
                    <br>
                    <li><b>Community Engagement</b></li>
                    <ul>
                        <li>Actively engage the community in animal welfare by promoting awareness, education, and participation in various programs.</li>
                    </ul>
                </ol>
            </div>
        </div>

        <div id="box" style="background-color: #f1f3fc;">
            <div class="mvs">
                <h2>Mission & Vision</h2>
                <p style="margin-left: 25px;">We are dedicated to provide service as animal welfare communities with trust and respect at the forefront of our mission. Heightening social consciousness and civic movement.</p>
            
                <div id="mvsbox">
                    <h3>Mission</h3>
                    <ul>
                        <li>Rescue and rehabilitate animals in need</li><br>
                        <li>Ensure the well-being of animals under our care</li><br>
                        <li>Facilitate the adoption and fostering of animals into loving homes</li><br>
                    </ul>
                </div>
    
                <div id="mvsbox">
                    <h3>Vision</h3>
                    <ul>
                        <li>Foster a community actively engaged in animal rescue and care</li><br>
                        <li>Empower users to contribute through fostering, adoption, volunteering, and donations</li><br>
                        <li>Connects animals with caring families</li><br>
                    </ul>
                </div>
            </div>
        </div>

        <div id="box" style="background-color:azure;">
            <div class="ach">
                <h2>Achievement</h2>
                 <div class="achievementcontainer">
                    <div class="achievement">
                        <img src="https://www.aspca.org/sites/default/files/how-you-can-help_adoptions-tips_main-image-dog.jpg" alt="Dog">
                        <p>More than <br><b style="font-size: xx-large; color: rgb(39, 179, 118);">6500</b><br> had found their homes</p>
                    </div>

                    <div class="achievement">
                        <img src="https://www.edgeanimalhospital.com/wp-content/uploads/sites/179/2021/11/spayneuter.jpeg" alt="Cat">
                        <p>More than <br><b style="font-size: xx-large; color: rgb(39, 179, 118);">10,000</b><br> cats and dogs(stray and pets) neutured in Klang Valley since 2000</p>
                    </div>
                    
                    <div class="achievement">
                        <img src="https://pethelpers.org/wp-content/uploads/2020/03/dogcateating.jpg" alt="Dog">
                        <p><br><b style="font-size: xx-large; color: rgb(39, 179, 118);">200</b><br> Fed and cared for every month</p>
                    </div>
                 </div>
            </div>
        </div>
        

        <div id="box" style="background-color:beige;">
            <div class="opthour">
                <h2>Operation Hours</h2>

                <div id="optinfo">
                    <h3>Day/Time</h3>
                    <br>
                    <p><b>Sundays</b> - Closed</p>
                    <p><b>Mon-Sat</b> - 9am - 4pm</p>
                </div>

                <div id="optinfo">
                    <h3>Address</h3>
                    <br>
                    <p>Lot 23A-29, <br>Jalan XYZ Subang Jaya, <br>47100 Subang </p>
                </div>

                <div id="opturgents">
                    <h3>Animal in urgents</h3>
                    <br>
                    <p>If there's any emergency, feel free to contact us at 01-2345 6789 (9am - 4pm, Monday-Saturday) to lodge your 
                        report on animals requiring our help. If the incidents occur outside of the operating hours, here are ways you 
                        could follow:</p>
                    <a href="https://oacu.oir.nih.gov/system/files/media/file/2023-12/b12-PainDistress.pdf" target="_blank">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/002/219/582/small/illustration-of-book-icon-free-vector.jpg" alt="animal distress manual" class="optimg">
                    </a>
                </div>
            </div>
        </div>

    <footer id="box" style="background-color:snow;">
        <a href="Main Page.php">
            <img src="images/logo.png" alt="Paws Print Hub Logo" id="logo2">
        </a>
        
        <div style="padding: 55px 10px 0 20px; margin-left: -45px;">
            <div>
                <a href="https://www.facebook.com/" target="_blank">
                    <img src="images/facebook_logo.png" alt="Facebook" id="footericon">
                </a>
            </div>

            <div>
                <a href="https://www.instagram.com/" target="_blank">
                    <img src="images/instagram_logo.png" alt="Instagram" id="footericon">
                </a>
            </div>

            <div>
                <a href="https://twitter.com/" target="_blank">
                    <img src="images/twitter_logo.png" alt="Twitter" id="footericon">
                </a>
            </div>

            <p style="margin: 60px 0 0 920px; font-size: 15px;">
                Copyright &copy; 2024 Paws Print Hub, Malaysia. All Rights Reserved.
            </p>
        </div>
    </footer>
    
</body>
</html>
