<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Management</title>
    <link rel="stylesheet" href="formManagement.css">
</head>
<body>
    <?php include 'adminNavBar.php'; ?>
    <main>
        <div id="filler"></div> 
        <div id="formbtngroup">
            <a href="adminAdoptionApplication.php">
                <div class="fmbox" id="adoptformbtn">
                    <div class="decoration1"></div>
                    <div class="decoration2"></div>
                    <div class="decoration3"></div>
                    <h2>View Adoption Application</h2>  
                </div>
            </a>

            <a href="adminFosterApplication.php">
                <div class="fmbox" id="fosterformbtn">
                    <div class="decoration1"></div>
                    <div class="decoration2"></div>
                    <div class="decoration3"></div>
                    <h2>View Fostering Application</h2>
                </div>
            </a>

            <a href="adminVolunteeringApplication.php">
                <div class="fmbox" id="volunteerformbtn">
                    <div class="decoration1"></div>
                    <div class="decoration2"></div>
                    <div class="decoration3"></div>
                    <h2>View Volunteer Application</h2>    
                </div>
            </a>
        </div>
    </main>
</body>

</html>
