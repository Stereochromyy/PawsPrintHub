<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Management</title>
</head>
<style>
    .fmbox {
        margin: auto;
        height: auto;
        width: 70%;
        margin-top: 125px;
        margin-bottom: -90px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: relative;
        padding: 50px;
        border-radius: 25px;
        border: 2px solid;
        transition: 0.5s;
    }

    .fmbox:hover{
        box-shadow: lightslategray 4px 4px 2px;
        transform: translateY(8px);
        transition: ease-in 0.3s;
    }

    .fmbox a {
        text-decoration: none;
        text-align: center;
        font-size: large;
        cursor: pointer;
    }
</style>

<body>
    <?php include 'adminNavBar.php'; ?>

    <main>
        <div class="fmbox">
            <a href="adminAdoptionApplication.php">
                <h2>View Adoption Application</h2>
            </a>
        </div>
        <div class="fmbox">
            <a href="adminFosterApplication.php">
                <h2>View Fostering Application</h2>
            </a>
        </div>
        <div class="fmbox">
            <a href="adminVolunteeringApplication.php">
                <h2>View Volunteer Application</h2>
            </a>
        </div>
    </main>
</body>

</html>
