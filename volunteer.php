<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        width: 100%;
        min-height: 100vh;
        background: url(images/background.jpg) no-repeat;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-size: 17px;
    }

    #box {
        height: auto;
        width: auto;
        margin: 120px 0 -120px 0;
        background-color: #F7FBFC;
        position: relative;
        display: flex;
    }

    .content{
        background-color: rgb(233, 249, 255);
        border-radius:40px;
        padding: 20px;
        margin: 20px auto;
        height: auto;
        width: 1300px;
        display: flex;
    }

    #right-content{
        margin-right: 30px;
    }

    #left-content{
        margin-left: 30px;
    }


    .volunteer h2 {
    margin-top: 25px;
    font-size: 2em;
    margin-left: 25px;
    color: rgb(113, 186, 255);
    }


    .volunteer p {
        margin-left: 25px;
        line-height: 1.8;
        margin-bottom: 10px;
        font-size: 18px;
        margin-right: 10px;
        text-align: justify
    }


    #leftimg {
        height: 280px;
        width: 280px;
        left:0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        margin: 10px;
    }

    #rightimg {
        height: 280px;
        width: 280px;
        right: 0px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        margin: 10px;
    }

    #endsection {
        height: 130px;
        width: auto;
        background-color: rgb(224, 246, 255);
        position: relative;
        bottom: 0px;
        margin-top: 120px;
        border-radius: 50% 50% 0 0;
    }

    #signupbtnholder {
        height: 175px;
        width: 175px;
        border-radius: 50%;
        background-color: rgb(224, 246, 255);
        position: absolute;
        bottom: 0px;
        margin-left: 675px;
        text-align: center;
        margin-top: -20px;
    }

    #signupbtn {
        height: 175px;
        width: 175px;
        background-color: white;
        border: solid 1px rgb(93, 193, 255);
        border-radius: 50%;
        cursor: pointer;
        text-align: center;
        margin-top: -20px;
        transition: 0.5s;
    }

    #signupbtn:hover {
        transform: translateY(-15px);
        border: solid 1px rgb(34, 102, 249);
    }


</style>
<body>
    <?php
    include("userNavigationBar.php");
    ?>

    <main>
        <div id="box" class= "volunteer" style="display:flow-root;">
            <div class="content" id="left-content">
                <img src="https://humaneheroes.org/wp-content/uploads/2021/11/Volunteer1.jpg" alt="" id="leftimg">
                <div class="info">
                    <h2><b>Why Volunteer?</b></h2>
                    <br>
                    <p style="margin-right: 25px;"><b>Helping Animals: </b>
                        You'll directly contribute to the well-being of animals in need. Your assistance can involve feeding, cleaning, walking, and 
                        socializing with the animals, providing them with care and attention they might not otherwise receive.
                    </p>

                    <p style="margin-right: 25px;"><b>Community Engagement: </b>
                        Volunteering brings you closer to your community. You'll meet like-minded individuals who share a passion for animals and 
                        contribute to a cause that's important to you.</p>
                </div>
            </div>
                

            <div class="content" id="right-content">
                <div class="info">
                    <h2><b>What Do We Do?</b></h2>
                    <br>
                    <p><b>Cleaning Shelters: </b>
                        This involves tasks such as cleaning cages, feeding animals, and maintaining a clean and safe environment for the pets.
                    </p>

                    <p><b>Playing with Pets: </b>
                        You can also spend quality time socializing with the animals, helping them become more adoptable by providing human interaction and positive experiences.
                    </p>
                </div>
                <img src="https://img.freepik.com/free-photo/smiley-woman-playing-shelter-with-dog-waiting-be-adopted_23-2148682992.jpg" alt="" id="rightimg">
            </div>

            <div class="content" id="left-content">
                <img src="https://img.freepik.com/premium-photo/cute-friendly-dog-shelter-is-waiting-friend-home_283617-3933.jpg" alt="" id="leftimg">
                <div class="info">
                    <h2><b>How to Do?</b></h2>
                    <br>
                    <p style="margin-right: 25px;">If you are interested, please feel free to contact us through our social media channels or fill out the application form below. 
                        Our team will get back to you as soon as possible.
                    </p>
                </div>
            </div>
                    


            <div class="content" id="right-content">
                <div class="info">
                    <h2><b>Where to Do?</b></h2>
                    <br>
                    <p><b>Paws Print Hub: </b>
                        This is our main location for volunteering. If you are a newbie, don't worry; our team will guide you on where and how you can contribute. 
                        Remember, volunteering is a two-way street. While you're contributing your time and skills, you're also gaining valuable experiences and making a positive impact. Enjoy your volunteering journey at Paws Print Hub!
                    </p>
                </div>
                <img src="https://apicms.thestar.com.my/uploads/images/2021/09/04/1281150.jpg" alt="" id="rightimg">
            </div>

                <br><br><br>    

            </div>
            
            <div id="endsection">
                <div id="signupbtnholder">
                    <a href="volunteerform.php" target="_blank">
                    <button id="signupbtn">
                        <img src="https://icon-library.com/images/signed-icon/signed-icon-14.jpg" alt="sign up icon" height="90px">
                        <h2>Sign Up</h2>
                    </button>
                    </a>
            </div>
        </div>
    </main>
</body>
</html>
