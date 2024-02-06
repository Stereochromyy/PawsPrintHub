<?php
    session_start();
    include 'dbConn.php';

    if (isset($_POST['btnLogin'])) {
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];
        $query = "SELECT * FROM user WHERE email_address='$email' AND password='$password'";
        $results = mysqli_query($connection, $query);
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_assoc($results);
            // echo 'record found'; 

            // Set session variables
            $_SESSION['email'] = $row['email_address'];
            $_SESSION['password'] = $row['password'];

            include "index.php";
            exit();
        } else {
            echo 'record not found';
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
        <a href="Main Page.php">
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
                    
                    <p><label for="txtPassword">Password: </label><br></p>
                    <input type="password" name="txtPassword" placeholder="Must have at least 8 characters"required><br>
                    
                    <div style="margin-top: 25px;">
                        <input type="submit" value="Login" name="btnLogin">
                    </div>

                    <div>
                        Don't have an account? <a href="Sign Up.php">Sign up</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
</body>
</html>
