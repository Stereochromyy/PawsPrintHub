<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws Print Hub | Malaysia</title>
    <link rel="stylesheet" href="PPH.css">
</head>

<body>
<?php
    session_start();
    include 'dbConn.php';
    include 'checkaccount.php';
?>

<?php
    if(isset($_POST['volunteersubmitbutton'])) {
        // Storing under variable
        $past_experience = $_POST['comment'];
        $emergency_contact_num = $_POST['emergencyContact'];
        $date = date("Y/m/d");
        $approval_status = "Pending";

        
        // Insert into the database, there is 2 diff query for guest or user

        if($account === "guest"){
        // if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))){
            $name = $_POST["name"];
            $dob = $_POST["dob"];
            $contact_num = $_POST["number"];
            $email = $_POST["email"];

            $guestquery = "INSERT INTO `user`(`name`, `dob`, `contactnum`,`email_address`,`userroleID`) VALUES ('$name','$dob','$contact_num','$email','G3')";
            $guest_result = mysqli_query($connection, $guestquery);
        } else{// } else if($account == "user"){
            $email = $_SESSION['email'];
        }

            
        $retrieveid = "SELECT userID FROM `user` WHERE email_address = '$email' ORDER BY userID DESC limit 1";
        $retrieveidresult = mysqli_query($connection, $retrieveid);
        while($idrow = mysqli_fetch_assoc($retrieveidresult)){
            $userid = $idrow["userID"];
        }


        $volunteerinsertquery = "INSERT INTO `volunteering`(`volunteer_date`, `past_experience`, `emergency_contact_num`,`approval_status`,`userID`) VALUES ('$date','$past_experience','$emergency_contact_num','$approval_status','$userid')";
        $volunteerinsertresult = mysqli_query($connection, $volunteerinsertquery);

        //If there is no account (guest), then check for 2 query
        if ($account == "guest") {
            if ($guest_result && $volunteerinsertresult) {
        ?>
            <script>
                window.alert("Form submitted successfully");
                window.location.href = "mainPage.php";
            </script>
        <?php
            } else {
            ?>
            <script>
                window.alert("Error occured, try again later :/")
            </script>
            <?php
            }
        } else if($account == "user") { //Else, means hes a user, that means runing 1 query is enough
            if ($volunteerinsertresult) {
        ?>
            <script>
                window.alert("Submitted successfully");
                window.location.href = "mainPage.php";
            </script>
        <?php
            } else {
                ?>
                <script>
                    window.alert("Error occured, try again later :/")
                </script>
            <?php
            }
        }

    }
    
    ?>

    <main id="va">
        <h1><b>Volunteer Form</b></h1>
        <br>
        <p>Thank you for your interest in volunteering with Paws Print Hub Animal Shelter! Our dedicated team of volunteers plays a crucial role in helping us 
            provide care and support to animals in need. To join our compassionate community, please complete the following Volunteer Form:
        </p>

        <form action="" method="post" id="vform">
        <?php
        if($account == "guest"){
            ?>
            <label class="vguestdetail">Full Name:</label><input type="text" class="inputbox" name="name" pattern= "/^[a-zA-Z-' ]*$/" required> <br><br>
            <label class="vguestdetail">Date of Birth:</label><input type="date" class="inputbox" name="dob" required> <br><br>
            <label class="vguestdetail">Contact Number:</label><input type="tel" class="inputbox" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="999-999-9999" name="number" required> <br><br>
            <label class="vguestdetail">Email Address:</label><input type="text" class="inputbox"name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="email@mail.com" required> <br><br><br>
            
        <?php
        }
        ?>
        <?php
        // Close connection
        mysqli_close($connection);?>

    

            <h3><u>Question 1:</u></h3><h4>Could you share and describe any previous experience you have with animal volunteering?</h4>
            <textarea name="comment" class="inputbox" form="vform" cols="100" rows="5" required></textarea>
            <br><br><br>

            <h3><u>Question 2:</u></h3><h4>In case of an emergency, please provide the contact number of someone we can reach out to.</h4><br>
            <label for="emergencyContact">Your emergency contact number:</label>
            <input type="tel" class="inputbox" id="emergencyContact" name="emergencyContact" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required><br><br><br>
            
            <br><br>

            <input type="submit" class="inputbox" value="Submit form" id="vsubmitbtn"  name="volunteersubmitbutton">
        </form>
    </main>
</body>
</html>
