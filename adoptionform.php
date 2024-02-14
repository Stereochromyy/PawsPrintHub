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
?>

<?php
    $userid = $_SESSION["userID"];
    $animalid = $_GET["adopt_animalID"];
    $animal_adoption = $_GET['type'];

    if(isset($_POST['adoptionsubmitbutton'])) {
        // Storing needed attribute under variable
        $pet_experience = $_POST['petExp'];
        $living_environment = $_POST['livingEnv'];
        $pet_budget = $_POST['petBudget'];
        $date = date("Y/m/d");
        $approval_status = "Pending";

        if($$animal_adoption == "adopt"){ // If the user is adopting the pet
            $adoptioninsertquery = "INSERT INTO `adoption`(`adoption_date`, `experience_with_pets`, `living_environment`,`budget_for_pets`,`approval_status`,`animalID`,`userID`) VALUES ('$date','$pet_experience','$living_environment','$pet_budget','$approval_status','$animalid','$userid')";
            $adoptioninsertresult = mysqli_query($connection, $adoptioninsertquery);

            if ($adoptioninsertresult) {
            ?>
                <script>
                    window.alert("Form submitted successfully");
                    window.location.href = "Main Page.php";
                </script>
            <?php
            } else {
            ?>
                <script>
                    window.alert("Error occured, try again later :/")
                </script>
                <?php
            }
        } else { // Else the user is fostering the pet
            $foster_duration = $_POST['Fduration'];

            $fosterinsertquery = "INSERT INTO `foster`(`fostering_date`, `experience_with_pets`, `living_situation`,`budget_for_pets`,`fostering_duration`,`approval_status`,`animalID`,`userID`) VALUES ('$date','$pet_experience','$living_environment','$pet_budget','$foster_duration','$approval_status','$animalid','$userid')";
            $fosterinsertresult = mysqli_query($connection, $fosterinsertquery);

            if ($fosterinsertresult) {
            ?>
                <script>
                    window.alert("Form submitted successfully");
                    window.location.href = "Main Page.php";
                </script>
            <?php
            } else{
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
        <?php
        if($animal_adoption == "adopt"){
            echo '<h1><b>Adoption Form</b></h1>
            <br>
            <p>Thank you for considering adoption! Our adoption form is designed to help us ensure that each pet finds the perfect forever home. Please take a moment to fill out the following information:
            </p>';
        }
        else if($animal_adoption == "foster"){
            echo '<h1><b>Fostering Form</b></h1>
            <br>
            <p>Thank you for considering fostering our pets! Our fostering form is designed to help us ensure that each pet finds the right home. Please take a moment to fill out the following information:
            </p>';
        } else{
            echo '<h1>Something went wrong :/</h1>';
        }
        ?>
        

        <form action="" method="post" id="vform">
        <?php
        // Close connection
        mysqli_close($connection);
        ?>

            <h3><u>Question 1:</u><br><h4>Do you have any previous experience with pets?</h4>
            <textarea class="inputbox" name="petExp" form="vform" cols="100" rows="5" placeholder = " Have you owned pets before? Describe your experience." required></textarea>
            <br><br><br>

            <h3><u>Question 2:</u><br><h4>How is your living environment? Tell us your property type, may add any description.</h4>
            <textarea class="inputbox" name="livingEnv" form="vform" cols="100" rows="5" 
            placeholder = "Provide relavent info such as:
                Type of residence (e.g., house, apartment)
                Do you own or rent your home?
                Is your home pet-friendly?
                Do you have a yard or outdoor space?" required></textarea>
            <br><br><br>
            
            <h3><u>Question 3:</u><br><h4>How much is your budget for pets per month? (in RM) *Max 999999</h4>
            <input type="text" class="inputbox" name="petBudget" pattern="[0-9]{1,6}" placeholder="Enter an amount(RM)" required>
            <br><br><br>

            <?php
                if($animal_adoption == "foster"){ // if the user is fostering pets
                    echo '<h3><u>Question 4:</u><br><h4>How long do you want to foster this pet?</h4>
                    <select name = "Fduration" class="inputbox required" >
                        <option value = "1 month">1 Month</option>
                        <option value = "2 months">2 Months</option>
                        <option value = "3 months">3 Months</option>
                    </select>';
                }
            ?>

            <br><br><br><br>

            <input type="submit" value="Submit form" id="vsubmitbtn"  name="adoptionsubmitbutton">
        </form>
    </main>
</body>
</html>

