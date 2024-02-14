<?php
session_start();
include 'dbConn.php';

$error_message1 = '';
$error_message2 = '';

if (isset($_POST['btnLogin'])) {
    $email = $_POST['txtEmail'];
    $input_password = $_POST['txtPassword'];

    $query = "SELECT * FROM user WHERE `email_address`='$email'";
    $results = mysqli_query($connection, $query);
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        if (password_verify($input_password, $row['password'])) {

            // Set session variables
            $_SESSION['email'] = $row['email_address'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['userID'] = $row['userID'];

            include 'index.php';
            exit();
        } else {
            $error_message1 = "ⓘ Incorrect Password";
        }
    } else {
        $error_message2 = "ⓘ Email not found";
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws Print Hub | Malaysia</title>
    <link rel="stylesheet" href="loginPPH.css">
</head>

<body>
    <header id="header">
        <a href="mainPage.php">
            <img src="images//logo.png" alt="Paws Print Hub Logo" id="logo">
        </a>

        <div id="info"> <!--Name and Motto-->
            <h2>Paws Print Hub</h2>
            <p>Connecting Paws, Creating Stories</p>
        </div>
    </header>

    <main class="container">
        <div class="leftside">
            <img src="images/animalshelter.jpg" alt="" id="loginimg">
        </div>

        <div class="rightside">
            <form action="" method="post">
                <h1 style="margin-top: 80px;">Welcome Back!</h1>

                <div id="content" style="margin-top: 35px;">
                    <p><label for="txtEmail">Email Address: </label><br></p>
                    <input type="email" name="txtEmail" placeholder="example@gmail.com" required><br>

                    <?php if ($error_message2 != '') { ?>
                        <br>
                        <p style="color: red; margin-top: -20px;"><?php echo $error_message2; ?></p>
                    <?php } ?>

                    <p><label for="txtPassword">Password: </label><br></p>
                    <input type="password" name="txtPassword" placeholder="Must have at least 8 characters" required><br>

                    <?php if ($error_message1 != '') { ?>
                        <br>
                        <p style="color: red; margin-top: -20px;"><?php echo $error_message1; ?></p>
                    <?php } ?>

                    <div style="margin-top: 25px;">
                        <input type="submit" value="Login" name="btnLogin">
                    </div>

                    <div>
                        Don't have an account? <a href="signUp.php">Sign up</a>
                    </div>
                    <div><br>
                    ━━━━━━━ or ━━━━━━━
                    <br><br>
                    <a href="mainPage.php" id="view">View As Guest</a>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>
