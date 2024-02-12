<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer</title>
</head>
<style>
    #box {
        height: auto;
        width: auto;
        margin: 120px 0 -120px 0;
        background-color: #F7FBFC;
        position: relative;
        display: flex;
    }

    .volunteer h2 {
    margin-top: 25px;
    font-size: 28px;
    margin-left: 25px;
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
        margin: 25px;
        float: left;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    #rightimg {
        height: 280px;
        width: 280px;
        margin: 25px;
        float: right;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    #endsection {
        height: 130px;
        width: auto;
        border: solid 1px;
        background-color: snow;
        position: relative;
        bottom: 0px;
        margin-top: 120px;
    }

    #signupbtnholder {
        height: 175px;
        width: 175px;
        border-radius: 50%;
        background-color: white;
        position: absolute;
        bottom: 0px;
        margin-left: 675px;
        text-align: center;
    }

    #signupbtn {
        height: 175px;
        width: 175px;
        border-radius: 50%;
        cursor: pointer;
        text-align: center;
    }

    #signupbtn:hover {
        background-color: lightgrey;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }


</style>
<body>
    <?php include 'userNavigationBar.php'; ?>

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
            
            <div class="clear"></div><br><br><br><br>

            <img src="https://img.freepik.com/free-photo/smiley-woman-playing-shelter-with-dog-waiting-be-adopted_23-2148682992.jpg" alt="" id="rightimg">
            <h2><b>What Do We Do?</b></h2>
            <br>
            <p><b>Cleaning Shelters: </b>
                This involves tasks such as cleaning cages, feeding animals, and maintaining a clean and safe environment for the pets.
            </p>

            <p><b>Playing with Pets: </b>
                You can also spend quality time socializing with the animals, helping them become more adoptable by providing human interaction and positive experiences.
            </p>

            <div class="clear"></div><br><br><br><br>

            <img src="https://img.freepik.com/premium-photo/cute-friendly-dog-shelter-is-waiting-friend-home_283617-3933.jpg" alt="" id="leftimg">
            <h2><b>How to Do?</b></h2>
            <br>
            <p style="margin-right: 25px;">If you are interested, please feel free to contact us through our social media channels or fill out the application form below. 
                Our team will get back to you as soon as possible.
            </p>
                
            <div class="clear"></div><br><br><br><br><br><br>
            
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
