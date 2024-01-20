<?php
    include 'dbConn.php';

    if (isset($_POST['volunteersubmitbutton'])) {
        // Storing under variable
        $past_experience = $_POST['level'];
        $emergency_contact_num = $_POST['emergencyContact'];
        $date = date("Y/m/d");

        $userID = 100;// example, not complete yet
        
        // Insert into the database
        $query = "INSERT INTO `volunteering`(`volunteer_date`, `past_experience`, `emergency_contact_num`, `userID`) VALUES ('$date','$past_experience','$emergency_contact_num', '$userID')";
        $result = mysqli_query($connection, $query);

        // Check for success
        if ($result) {
?>
        <script>
            window.alert("Submitted successfully");
            window.location.href = "PawsPrintHub.php";

        </script>
<?php
        // Close connection
        mysqli_close($connection);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws Print Hub | Malaysia</title>
    <link rel="stylesheet" href="PPH.css">
</head>

<body>
    <main id="va">
        <h1><b>Volunteer Form</b></h1>
        <br>
        <p>Thank you for your interest in volunteering with Paws Print Hub Animal Shelter! Our dedicated team of volunteers plays a crucial role in helping us 
            provide care and support to animals in need. To join our compassionate community, please complete the following Volunteer Form:
        </p>

        <form action="" method="post" id="vform">
            <h3>Question 1: <br>Have you had any previous experience with animal volunteering?</h3>
            <input type="radio" name="level" value = "beginner" required> Beginner <br>
            <input type="radio" name="level" value = "intermediate"> Intermediate <br>
            <input type="radio" name="level" value = "advanced"> Advanced <br>
            <input type="radio" name="level" value = "none"> None<br>
            
            <br>

            <h3>Question 2: <br>In case of an emergency, please provide the contact number of someone we can reach out to.</h3>
            <label for="emergencyContact">Emergency Contact Number:</label>
            <input type="tel" id="emergencyContact" name="emergencyContact" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required><br>
            
            <br><br><br>

            <input type="submit" value="Submit" id="vsubmitbtn"  name="volunteersubmitbutton">
        </form>
    </main>
</body>
</html>
