<?php
    include 'dbConn.php';
    if (isset($_POST['btnsignup'])){
        // Storing under variable
        $name = $_POST['txtname'];
        $dob = $_POST['datedob'];
        $email = $_POST['txtemail'];
        $contactnum = $_POST['txtphonenum'];
        $gender = $_POST['rdogender'];
        $address = $_POST['txtaddress'];
        $password = $_POST['txtpswd']; 

        // Insert into the database
        $query= "INSERT INTO `user`(`name`, `dob`, `gender`, `email_address`, `password`, `contactnum`, `address`, `userroleID`) VALUES ('$name','$dob','$gender','$email','$password','$contactnum','$address','U1')";
        
        // Show message whether the registration successful/failure
        if (mysqli_query($connection, $query)){
?>
        <script>
            window.alert("Registered succesfully"); //successful pop up
        </script>
<?php
            header("refresh: 1"); 
        }else{
?>
    <script>
        window.alert("Registration failed."); //failure pop up
    </script>
<?php
        }
        }
        mysqli_close($connection);
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

    <title>Sign Up</title>
    <link rel="stylesheet" href="Sign Up.css">
</head>
<body>
    <div class="header">
        <img id="logo" src="logo.jpg" alt="Logo" height="100px" width="100px">
        <div class="name_motto"> <!--Name and motto-->
            <h2>Paw Print Hub</h2>
            <h4>- Connecting Paws, Connecting Stories -</h4>
        </div>

        <h1>Sign Up</h1>
    </div>
    <form action="#" method="post">
        <div class="info">
            <div>
                <!-- Full name -->
                <div class="aside">
                    <label>Full Name <br><br><input type="text" name="txtname" placeholder="Full Name as per IC" required></label>
                </div>
                <!-- Date of birth -->
                <div class="aside">
                    <label>Date of Birth <br><br><input type="date" name="datedob" required></label><br><br>
                </div>
            </div>
            <div>
                <!-- email -->
                <div class="aside">
                    <label>Email Address <br><br><input type="email" name="txtemail" id="" placeholder="email@mail.com" required></label>
                </div>
                <!-- phone num. -->
                <div class="aside">
                    <label>Phone Number <br><br><input type="text" name="txtphonenum" id="" placeholder="+(99) 99-999 9999" required></label><br><br>
                </div>
            </div>
            <div>
                <!-- gender -->
                <label class="aside">Gender </label>
                    <div id="clear">
                        <label class="containerradio" required>Male
                            <input type="radio" checked="checked"
                            value="Male"
                            name="rdogender">
                            <span class="cusradio"></span>
                        </label>
                        <!-- Span to wrap section for styling purposes -->
                        <label class="containerradio">Female
                            <input type="radio" name="rdogender" value="Female">
                            <span class="cusradio"></span> 
                        </label>
                    </div><br>
            </div>
            <!-- address -->
            <div class="aside">
                <label>Address <br><br><input type="text" name="txtaddress" placeholder="Num., Street Name, Postcode City, State"  id="address" required></label><br><br>
            </div>
            <div>
                <!-- password -->
                <div class="aside">
                    <label>Password <br><br><input type="password" name="txtpswd" id="pswd" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase, one lowercase and at least 8 characters" required></label> <!--Password pattern for validation-->
                </div>
                <div class="aside">
                    <label>Retype Password <br><br><input type="password" name="txtvalidate" id="repswd" placeholder="Retype password" required></label>
                </div>
            </div>
                
            <div id="message">
                <h3>Password Validation:</h3>
                    <ul>
                        <li class="invalid" id="letter">A lowercase letter</li>
                        <li class="invalid" id="capital">A uppercase letter</li>
                        <li class="invalid" id="number" >A number</li>
                        <li class="invalid" id="length">At least 8 characters</li>
                    </ul>
            </div>

            <div>
                <label><input type="submit" value="Sign Up" name="btnsignup" id="signup"></label>
            </div>
        </div>
    </form>
    <script>
        // Store variable with id from password key in
        var input = document.getElementById("pswd");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        var validate = document.getElementById("repswd");

        //When user enter/key in over the password input area
        input.onfocus = function(){
            document.getElementById("message").style.display = "block";
        }

        //When user click outside the password input area, hide the validation
        input.onblur = function(){
            document.getElementById("message").style.display = "none";
        }

        //When user typing smtg, validation occurs
        input.onkeyup = function () {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g; 
            if (input.value.match(lowerCaseLetters)){
                letter.classList.remove("invalid"); //change its style
                letter.classList.add("valid");
            }
            else{
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }
            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (input.value.match(upperCaseLetters)){
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            }
            else{
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }
            // Validate numbers
            var numbers = /[0-9]/g;
            if (input.value.match(numbers)){
                number.classList.remove("invalid");
                number.classList.add("valid");
            }
            else{
                number.classList.remove("valid");
                number.classList.add("invalid");
            }
            // Validate length
            if (input.value.length >=8){
                length.classList.remove("invalid");
                length.classList.add("valid");
            }
            else{
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }

        function validatepassword(){
            if (input.value !== validate.value){
                validate.setCustomValidity("Passwords not match."); //will show the customize message
            }
            else{
                validate.setCustomValidity('');
            }
        }
        //Check whether the changes in the password is same as the one over the confirm password
        validate.onkeyup = validatepassword; //when entering password

    </script>

</body>
</html>
