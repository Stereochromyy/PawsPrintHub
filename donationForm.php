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
    include 'checkAccount.php';
    ?>

    <?php
    if (isset($_POST['donationsubmitbutton'])) {

        $date = date("Y/m/d"); //define date first, because other variable need to be defined based on the type of donation (money or supply)
        $Mdonationinsertquery = False;
        $Sdonationinsertquery = False;

        // Before defining donation information, we have to define the userID first
        if ($account === "guest") { // If this account is a guest account, first we must create a record for him in user table.
            $name = $_POST["name"];
            $contact_num = $_POST["number"];
            $email = $_POST["email"];

            $guestquery = "INSERT INTO `user`(`name`, `contactnum`,`email_address`,`userroleID`) VALUES ('$name','$contact_num','$email','G3')";
            $guest_result = mysqli_query($connection, $guestquery);

            // The reason we create a user record for guest here is so that he can have an userID, now we just need to retrieve his userID
    
            $retrieveid = "SELECT userID FROM `user` WHERE email_address = '$email' ORDER BY userID DESC limit 1";
            $retrieveidresult = mysqli_query($connection, $retrieveid);
            while ($idrow = mysqli_fetch_assoc($retrieveidresult)) {
                $userid = $idrow["userID"];
            }
        } else { // If it is a user account, just get his userID with the $SESSION function that are defined at the login page.
            $userid = $_SESSION['userID'];
        }

        // After obtaining the needed user info (userID), now we starts to define donation information to put it into donation table of database
    
        $donation_type = $_POST["donationtype"]; // Defining the donation type the user picked
    
        if ($donation_type == "Monetary") { // Checking the donation type
            $donation_amount = $_POST["Damount"];

            // just a quick explain on naming convention, the "Mdonation" means Money-typed donation
            $Mdonationinsertquery = "INSERT INTO `donation`(`donation_type`, `donation_amount`, `donation_date`,`donation_status`,`userID`) VALUES ('$donation_type','$donation_amount','$date','Received','$userid')";
            $Mdonationinsertresult = mysqli_query($connection, $Mdonationinsertquery);
        } else { //else it's a supply-typed donation
            $donation_item = $_POST["donationitem"];
            $donation_quantity = $_POST["Damount"];

            $Sdonationinsertquery = "INSERT INTO `donation`(`donation_type`, `donation_item`, `donation_quantity`, `donation_date`,`donation_status`,`userID`) VALUES ('$donation_type','$donation_item','$donation_quantity','$date','Not received','$userid')";
            $Sdonationinsertresult = mysqli_query($connection, $Sdonationinsertquery);
        }

        // Checking if query is successfully ran, guest have 2 queries, user only have 1, so lets use if else statement to do this
        // First we define a donation_result, which will be "True" if either Money or Supply donation result query are successful
        if ($Mdonationinsertresult || $Sdonationinsertresult) {
            $donation_result = True;
        }

        if ($account == "guest") {
            if ($guest_result && $donation_result) {
                ?>
                <script>
                    window.alert("Donation successful, Thank you for your donation! :)");
                    window.location.href = "donationPortal.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    window.alert("Error occured, try again later :/")
                </script>
                <?php
            }
        } else { //Else, means hes a user, that means runing 1 query is enough
            if ($donation_result) {
                ?>
                <script>
                    window.alert("Donation successful, Thank you for your donation! :) ");
                    window.location.href = "donationPortal.php";
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
        <h1><b>Donation Form</b></h1>
        <br>
        <p>Welcome to our donation page! Your support means the world to us and the animals we care for. With your
            generosity, we can continue our mission of rescuing, nurturing, and finding loving homes for pets in need.
            Together, let's make a paw-sitive impact on the lives of our furry friends. Thank you for your kindness and
            compassion.
        </p>

        <form action="" method="post" id="vform">
            <?php
            if ($account == "guest") {
                ?>
                <label class="vguestdetail">Full Name:</label><input type="text" class="inputbox" name="name" pattern= "/^[a-zA-Z-' ]*$/" required> <br><br>
                <label class="vguestdetail">Email Address:</label><input type="text" class="inputbox" name="email" placeholder="email@mail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required> <br><br>
                <label class="vguestdetail">Contact Number:</label><input type="tel" class="inputbox"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="012-345-6789" name="number" required> <br><br><br>
                <?php
            }
            ?>
            <?php
            $type = $_GET['type'];
            // Close connection
            mysqli_close($connection); ?>
            <h2><u>Donation Type:</u></h2>
            <h5>kindly select a donation type below</h5><br>
            <h3><input type="radio" id="money" name="donationtype" value="Monetary" <?php echo ($type == 'monetary') ? 'checked' : ''; ?>> Monetary</h3><br>
            <h3><input type="radio" id="supply" name="donationtype" value="Item" <?php echo ($type == 'supply') ? 'checked' : ''; ?>> Supplies</h3><br><br>

            <div id="supplychoice">
                <h3>Donation item:</h3>
                <select id="donationitems" name="donationitem" onchange="updatelabel()">
                    <option value="Animal food">Animal Food</option>
                    <option value="Canned food">Canned Food</option>
                    <option value="Medical supplies">Medical supplies</option>
                    <option value="Cleaning supplies">Cleaning supplies</option>
                    <option value="Vitamin">Vitamins</option>
                </select>
                <br><br>
            </div>

            <div id="donationamount">
                <span id="damountlabel">
                    <h3>Donation Amount:</h3>
                </span><br>
                <input type="number" id="Damountinput" name="Damount" min="1" max="999" value="1" required>
            </div>

            <br>

            <input type="submit" value="Donate" id="vsubmitbtn" name="donationsubmitbutton">
        </form>
    </main>

    <script>
        let monetaryRadio = document.getElementById("money");
        let supplyRadio = document.getElementById("supply");
        let type = "<?php echo $_GET['type']; ?>";
        var Dinput = document.getElementById("Damountinput");

        if (type == 'monetary') {
            document.getElementById("donationamount").style.display = "block";
            document.getElementById("supplychoice").style.display = "none";
            // Dinput.type = "number";
            Dinput.min = "";
            Dinput.max = "";
            Dinput.value = "";
            Dinput.pattern = "[0-9]{1,6}";
            Dinput.placeholder = "Enter an amount";

            document.getElementById("damountlabel").innerHTML = "Donation Amount (RM) *Max 999999";
        } else {
            document.getElementById("supplychoice").style.display = "block";
            document.getElementById("donationamount").style.display = "block";
            Dinput.pattern = "";
            // Dinput.type = "number";
            Dinput.min = "1";
            Dinput.max = "999";
            Dinput.value = "1";
            updatelabel();
        }

        monetaryRadio.onclick = function () {
            document.getElementById("donationamount").style.display = "block";
            document.getElementById("supplychoice").style.display = "none";
            // Dinput.type = "";
            Dinput.min = "";
            Dinput.max = "";
            Dinput.value = "";
            Dinput.pattern = "[0-9]{1,6}";
            Dinput.placeholder = "Enter an amount";

            document.getElementById("damountlabel").innerHTML = "Donation Amount (RM) *Max 999999";
        }

        supplyRadio.onclick = function () {
            document.getElementById("supplychoice").style.display = "block";
            document.getElementById("donationamount").style.display = "block";
            Dinput.pattern = "";
            // Dinput.type = "number";
            Dinput.min = "1";
            Dinput.max = "999";
            Dinput.value = "1";
            updatelabel();
        }

        function updatelabel() {
            var amountlabel = document.getElementById("damountlabel");
            var donationitem = document.getElementById("donationitems").value;

            if (donationitem == "medical" || donationitem == "clean") {
                amountlabel.innerHTML = "Donation Amount (Box)";
            }
            else {
                amountlabel.innerHTML = "Donation Amount (KG)";
            }
        }
    </script>

</body>

</html>
