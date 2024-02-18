<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws Print Hub | Malaysia</title>
    <link rel="stylesheet" href="donationPortal.css">
</head>

<body>
    <?php
    include 'userNavigationBar.php';
    ?>

    <!-- Rectangle for design purpose -->
    <div class="rectangle"> </div>

    <!-- Donation info -->
    <div class="donation">
        <div class="donationinfo" id="text">
            <h1 class="infotext"><b>DONATE ONLINE</b></h1>
            <h2>Your support matters!!!</h2>
            <p style="font-size: large; line-height: 30px; color: rgb(136, 115, 115);"><b>Make a One-Time Payment</b> <br> via Online Banking/ QR Payment
            <p><br>
            <p>Welcome to Paws Print Hub's Donation Portal! Your support transforms lives by providing shelter, medical care, and basic necessities for pets in need. Choose your donation options, and rest assured, our platform secure the confidentiality of your contribution. Every penny makes changes, let's join us in connecting paws and creating lasting stories. Click the donation options to make a difference today!</p>
        </div>
        <!-- Donation option linked to form -->
        <div class="container">
            <button id="monetarybtn" class="donationoption1" style="background-color: #dafade;">
                <img src="https://static-00.iconduck.com/assets.00/money-send-icon-2048x2046-yh64gys6.png" alt="Monetary" height="50px" width="50px" id="icon">
                <h1 style="display: flex; margin-top: 20px;">Monetary</h1>
            </button>

            <button id="supplybtn" class="donationoption2" style="background-color: #c4e0ed;">
                <img src="https://static-00.iconduck.com/assets.00/box-icon-512x511-cu40u9gv.png" alt="Item" id="icon" height="50px" width="50px">
                <h2 style="display: flex; margin-top: 25px;">Item supplies</h2>
            </button>
        </div>

    </div>

    <!-- Footer for additional info -->
    <div id="footer">
        <p style="margin-left: 30px; padding-top:10px;">If you have any enquiries, feel free to drop us a message at 01-2345 6789 or email us at pawsprinthub@gmail.com. <br><br> *All donations are tax-exempted. You will be mailed a tax-exempt receipt within 2-3 weeks.</p>

        <footer>Copyright &copy; 2024 Paws Print Hub, Malaysia. All Rights Reserved.</footer>

    </div>

    <script>
        var moneybtn = document.getElementById("monetarybtn");
        var supplybtn = document.getElementById("supplybtn");

        moneybtn.onclick = function() {
            window.location.href = "donationForm.php?type=monetary";
        }
        supplybtn.onclick = function() {
            window.location.href = "donationForm.php?type=supply";
        }
    </script>
    </bod>

</html>
