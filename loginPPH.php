<?php
    $server = '127.0.0.1';
    $user = 'root'; //default user
    $password = '';
    $database = 'pph';

    $connection = mysqli_connect($server, $user, $password, $database);

    if ($connection === false) {
        die("Database connection failed: ". mysqli_connect_error());
    }

    if (isset($_POST['btnLogin'])) {
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];
        $query = "SELECT * FROM user WHERE email_address='$email' AND password='$password'";
        $results = mysqli_query($connection, $query);
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_assoc($results);
            echo 'record found';
            header("Location: PawsPrintHub.html");
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
    <link rel="stylesheet" href="PPH.css">
        <style>
        .leftside, .rightside {
            height: 100vh;
            width: 50%;
            display: flex;
            float: left;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }

        .rightside {
            background-color: snow;
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                margin: 120px 0 -120px 0;
            }

            .leftside, .rightside {
                width: 100%; /* Full width when stacked */
                height: 70vh; /* Adjusted height for responsiveness */
            }
        }

        #loginimg{
            height: 100vh;
            width: auto;
        }

        #content p {
            text-align: left;
            margin-bottom: 10px;
        }

        input[type="email"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: lightskyblue;
            color: black;
            cursor: pointer;
            font-size: large;
        }

        input[type="submit"]:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>

</head>

<body>
    <header id="header">
        <a href="PawsPrintHub.html">
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
                    <input type="password" name="txtPassword" placeholder="Must have at least 6 characters"required><br>
                    
                    <div style="margin-top: 25px;">
                        <input type="submit" value="Login" name="btnLogin">
                    </div>

                    <div>
                        Don't have an account? <a href="signupPPH.php">Sign up</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
</body>
</html>