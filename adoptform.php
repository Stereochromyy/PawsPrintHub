<?php
    include 'dbConn.php';

    if (isset($_POST['fostersubmitbutton'])) {
        // Storing under variable
        $adoption_date = date("Y/m/d");
        $experience_with_pets = $_POST['level'];
        $living_environment = $_POST['living'];
        $budget_for_pets = $_POST['fosterBudget'];


        $userID = 251;//example, not complete yet
        $animalID = 'ani1';//example, not complete yet
        $approval_status = 'Pending';
        
        // Insert into the database
        $query = "INSERT INTO `adoption`(`adoption_date`, `experience_with_pets`, `living_environment`, `budget_for_pets`, `userID`,`approval_status`, `animalID`) 
        VALUES ('$adoption_date','$experience_with_pets','$living_environment', '$budget_for_pets', '$userID', '$approval_status', '$animalID')";
        
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
        <h1><b>Adoption Form</b></h1>
        <br>
        <p>Thank you for considering adoption from Paws Print Hub Animal Shelter! Your decision to provide a loving home to one of our animals 
            is a meaningful contribution to their well-being. To initiate the adoption process and welcome a furry friend into your life, kindly 
            complete the following Adoption Form. Your thoughtful choice to adopt can make a lasting difference in the life of a deserving pet. We 
            look forward to helping you find your perfect match!
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

            <br><br><br>

            <input type="submit" value="Submit" id="fssubmitbtn"  name="fostersubmitbutton">
        </form>
    </main>
</body>
</html>
