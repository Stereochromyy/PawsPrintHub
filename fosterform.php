<?php
    include 'dbConn.php';

    if (isset($_POST['fostersubmitbutton'])) {
        // Storing under variable
        $fostering_date = date("Y/m/d");
        $experience_with_pets = $_POST['level'];
        $living_situation = $_POST['living'];
        $budget_for_pets = $_POST['fosterBudget'];
        $fostering_duration = $_POST['duration'];


        $userID = 251;//example, not complete yet
        $animalID = 'ani1';//example, not complete yet
        $approval_status = 'Pending';
        
        // Insert into the database
        $query = "INSERT INTO `foster`(`fostering_date`, `experience_with_pets`, `living_situation`, `budget_for_pets`, `fostering_duration`, `userID`,`approval_status`, `animalID`) 
        VALUES ('$fostering_date','$experience_with_pets','$living_situation', '$budget_for_pets', '$fostering_duration', '$userID', '$approval_status', '$animalID')";
        
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
        exit();
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
        <h1><b>Fostering Form</b></h1>
        <br>
        <p>Thank you for expressing your interest in fostering for Paws Print Hub Animal Shelter! Our foster families are instrumental in 
            providing temporary homes and care for animals in transition. To become part of our foster community and make a positive impact 
            on the lives of these animals, please complete the following Foster Volunteer Form. Your commitment and compassion are invaluable in ensuring a brighter 
            future for pets in need.
        </p>

        <form action="" method="post" id="vform">
            <h3>Question 1: <br>Do you have any prior experience with owning or caring for pets?</h3>
            <input type="radio" name="level" value = "beginner" required> Beginner <br>
            <input type="radio" name="level" value = "intermediate"> Intermediate  <br>
            <input type="radio" name="level" value = "advanced"> Advanced <br>
            <input type="radio" name="level" value = "none"> None <br>
             
            <br>

            <h3>Question 2: <br>Can you describe your current living environment?</h3>
            <input type="radio" name="living" value = "flat"> Flat <br>
            <input type="radio" name="living" value = "apartment" required> Apartment <br>
            <input type="radio" name="living" value = "condominium"> Condominium <br>
            <input type="radio" name="living" value = "landed property"> Landed Property <br>

            <br>

            <h3>Question 3: <br>Could you please share the budget you have in mind for fostering expenses? (e.g., RM 0365.36)</h3>
            <label for="fosterBudget">RM: </label>
            <input type="budget" id="fosterBudget" name="fosterBudget" pattern="[0-9]{4}.[0-9]{2}" placeholder="9999.99" required><br>

            <br>

            <h3>Question 4: <br>How long would you like to foster the pet?</h3>
            <input type="radio" name="duration" value = "1 month" required> 1 month <br>
            <input type="radio" name="duration" value = "2 months"> 2 months  <br>
            <input type="radio" name="duration" value = "3 months"> 3 months <br>

            <br><br><br>

            <input type="submit" value="Submit" id="fssubmitbtn"  name="fostersubmitbutton">
        </form>
    </main>


</body>
</html>
