<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google font link: Itim font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Lobster&family=Roboto:wght@100&display=swap" rel="stylesheet">

    <title>Main Page</title>
    <link rel="stylesheet" href="Main Page.css"> <!--CSS for Main Page-->
</head>

<body>
    <div class="header">
        
        <img id="logo" src="logo.jpg" alt="Logo" height="100px" width="100px">
        <div class="name_motto"> <!--Name and motto-->
            <h2>Paw Print Hub</h2>
            <h4>- Connecting Paws, Connecting Stories -</h4>
        </div>

        <div id="nav" style="float: left;"> <!--Navigation bar-->
            <ul><!--Add the id here for linking to other pages-->
                <li>Adopt/Foster</li> 
                <li><a href="Donation Portal.html" target="_blank"> Donation</a></li>
                <li>Volunteer</li>
                <li><a href="#contactus">Contact us</a></li>
                <li id="clear"><img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="Profile photo" height="40px" width="40px" style="float: left; margin-left: 20%;">
                    <ul>
                        
                        <?php
                            if(!isset($_SESSION['email']) || $_SESSION['email'] === null || !isset($_SESSION['password']) || $_SESSION['password'] === null){                    
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
        </div>

    </div>
    <div class="mainpage">
        <div class="aboutus" id="clear">
            <div> <!--About us section-->
            <h1 style="padding: 10px 0 0 10px;">About us</h1>
            <img src="https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-cute-cat-animal-png-image_10149335.png" alt="cat image" id="imgaboutus">
            </div>
            <div id="aboutustext">
            <h2>Paw Print Hub</h2>
            <h3>Champion Animal Welfare</h3>
            <p> Founded in 1997. Paw Print Hub is a well-respected and trusted animal welfare Non-Profit Organisation based in Subjang Jaya, Selangor(Malaysia). Over the years, we have gained tremendous good-will, recognition and support from animal lovers all over Malaysia. With Paw Print Hub, we ensure that all animals are capable to assess to the what they need as happiest and healthiest pets. </p>

            <h3>Aim</h3>
            <ol type="1">
                <li>Rescue and Rehabilitation</li>
                    <ul><li>To rescue animals in need, provide them with necessary medical care, rehabilitation, and create a safe environment for their physical and emotional recovery.</li></ul><br>
            
                <li>Adoption Opportunities</li>
                    <ul><li>Facilitate the adoption process, connecting animals with loving families to ensure a forever home for every rescued pet.</ul><br>

                <li>Community Engagement</li></li>
                <ul><li>Actively engage the community in animal welfare by promoting awareness, education, and participation in various programs.</li></ul>
            </ol>
            </div>
            
        </div>
        <div class="mvs-container"> <!--Mission and vision-->
            <div style="padding-left: 10px;"><h1>Mission and Vission</h1>
            <p style="font-size: large;">We are dedicated to provide service as animal welfare communities with trust and respect at the forefront of our mission. Heightening socaial consciousness and civic movement.</p></div>
            <div class="mvs" id="mvsbox">
                <h1>Mission</h1>
            <ul>
                <li>Rescue and rehabilitate animals in need.</li><br>
                <li>Ensure the well-being of animals under our care.</li><br>
                <li>Facilitate the adoption and fostering of animals into loving homes.</li><br>
            </ul>
            </div>

            <div class="mvs" id="mvsbox">
                <h1>Vision</h1>
                <ul>
                    <li>Foster a community actively engaged in animal rescue and care.</li><br>
                    <li>Empower users to contribute through fostering, adoption, volunteering, and donations.</li><br>
                    <li>Connects animals with caring families</li><br>
                </ul>
            </div>
        </div>
        <div class="achievements"> <!--Achievements section-->
            <h1 style="text-align: center;">Achievement</h1>
            <div class="achievementcontainer">
            <div class="achievement">
                <img src="https://images.unsplash.com/photo-1611003228941-98852ba62227?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmFieSUyMGRvZ3xlbnwwfHwwfHx8MA%3D%3D"
                    alt="Dog">
                <p>More than <br><b style="font-size: xx-large; color: rgb(39, 179, 118);">6500</b><br> had found their homes
                </p>
            </div>
            <div class="achievement">
                <img src="https://img.freepik.com/free-photo/cute-domestic-kitten-sits-window-staring-outside-generative-ai_188544-12519.jpg?size=626&ext=jpg&ga=GA1.1.1546980028.1703548800&semt=ais"
                    alt="Cat">
                <p>More than <br><b style="font-size: xx-large; color: rgb(39, 179, 118);">10,000</b><br> cats and dogs (stray
                    and pets) neutered in Klang Valley since 2000</p>
            </div>
            <div class="achievement">
                <img src="https://www.iams.com/cdn-cgi/image/height=617,f=auto,quality=90/sites/g/files/fnmzdf3396/files/2023-02/german-sheperd-pink-collar-1360_0.jpg"
                    alt="Dog">
                <p><br><b style="font-size: xx-large; color: rgb(39, 179, 118);">200</b><br> Fed and cared for every month
                </p>
            </div>
        </div>
        </a><div class="opthour" id="contactus"> <!--Operation hours section -->
            <h1 style="padding: 20px 0 0 10px;">Operation hours</h1>
            <div class="optcontainer">
            <div id="optinfo">
                <h2>Sunday - Closed</h2>
                <h2>Monday-Saturday: <br> 9am - 4pm</h2>
            </div>
            <div id="optinfo">
                <h2>Address</h2>
                <p style="font-size:x-large;">Jalan XYZ <br> Subang Jaya, <br>47100 Subang </p>
            </div>
            <div id="opturgents">
                <h2 style="text-align: center;">Animal in urgents</h2><br>
                <p>If there's any emergency, feel free to contact us at 01-2345 6789 (9am - 4pm, Monday-Saturday) to lodge your report on animals requiring our help. If the incidents occurs outside of the operating hours, here are ways you could follow:</p>

                <a href="https://oacu.oir.nih.gov/system/files/media/file/2023-12/b12-PainDistress.pdf" target="_blank"><img src="https://static.vecteezy.com/system/resources/thumbnails/002/219/582/small/illustration-of-book-icon-free-vector.jpg" alt="animal distress manual" class="optimg" ></a>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="footer"> <!--Footer-->
        <img id="logo" src="logo.jpg" alt="Logo" height="100px" width="100px">
        <div class="footer-icons">
            <div><a href="https://www.facebook.com/" target="_blank"><img src="https://png.pngtree.com/element_our/sm/20180515/sm_5afaf0c36298b.jpg" alt="Facebook" class="footer-icons"></a></div>
            <div><a href="https://www.instagram.com/" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg" alt="Instagram" class="footer-icons"></a></div>
            <div><a href="https://twitter.com/" target="_blank"><img src="https://store-images.s-microsoft.com/image/apps.60673.9007199266244427.4d45042b-d7a5-4a83-be66-97779553b24d.5d82b7eb-9734-4b51-b65d-a0383348ab1b?h=307" alt="Twitter" class="footer-icons"></a></div>
        </div>
        <p class="copyright">Copyright &copy; 2024 Paw Print Hub Selangor. All Right Reserved.</p>
    </div>
    </div>
</body>
</html>
