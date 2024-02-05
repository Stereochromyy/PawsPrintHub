<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer</title>
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
        <div id="box" class= "volunteer" style="display:flow-root;">
            <img src="https://humaneheroes.org/wp-content/uploads/2021/11/Volunteer1.jpg" alt="" id="leftimg">
            <h2><b>Why Volunteer?</b></h2>
            <br>
            <p style="margin-right: 25px;"><b>Helping Animals: </b>
                You'll directly contribute to the well-being of animals in need. Your assistance can involve feeding, cleaning, walking, and 
                socializing with the animals, providing them with care and attention they might not otherwise receive.
            </p>

            <p style="margin-right: 25px;"><b>Community Engagement: </b>
                Volunteering brings you closer to your community. You'll meet like-minded individuals who share a passion for animals and 
                contribute to a cause that's important to you.</p>
            
            <div class="clear"></div>

            <img src="https://img.freepik.com/free-photo/smiley-woman-playing-shelter-with-dog-waiting-be-adopted_23-2148682992.jpg" alt="" id="rightimg">
            <h2><b>What Do We Do?</b></h2>
            <br>
            <p><b>Cleaning Shelters: </b>
                This involves tasks such as cleaning cages, feeding animals, and maintaining a clean and safe environment for the pets.
            </p>

            <p><b>Playing with Pets: </b>
                You can also spend quality time socializing with the animals, helping them become more adoptable by providing human interaction and positive experiences.
            </p>

            <div class="clear"></div>

            <img src="https://img.freepik.com/premium-photo/cute-friendly-dog-shelter-is-waiting-friend-home_283617-3933.jpg" alt="" id="leftimg">
            <h2><b>How to Do?</b></h2>
            <br>
            <p style="margin-right: 25px;">If you are interested, please feel free to contact us through our social media channels or fill out the application form below. 
                Our team will get back to you as soon as possible.
            </p>
                
            <div class="clear"></div>
            
            <img src="https://apicms.thestar.com.my/uploads/images/2021/09/04/1281150.jpg" alt="" id="rightimg">
            <h2><b>Where to Do?</b></h2>
            <br>
            <p><b>Paws Print Hub: </b>
                This is our main location for volunteering. If you are a newbie, don't worry; our team will guide you on where and how you can contribute. 
                Remember, volunteering is a two-way street. While you're contributing your time and skills, you're also gaining valuable experiences and making a positive impact. Enjoy your volunteering journey at Paws Print Hub!
            </p>
            
            <div class="clear"></div>
        </div>
        
        <div id="endsection">
            <div id="signupbtnholder">
                <a href="volunteerform.php" target="_blank">
                <button id="signupbtn">
                    <h1><i class="fa-solid fa-arrow-right-to-bracket" id="icon"></i></h1>
                    <h2>Sign Up</h2>
                </button>
                </a>
            </div>
        </div>
    </main>
</body>
</html>
