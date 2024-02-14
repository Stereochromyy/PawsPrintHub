<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt/Foster</title>
    <link rel="stylesheet" href="adopt@Foster.css">
</head>

<body>

    <?php
    include("userNavigationBar.php");
    ?>

    <main>
        <div id="petbar"></div>
        <div id="petbuttongroup">
            <button class="petbutton" id="allfilter">All</button>
            
            <button class="petbutton" id="dogfilter">Dog</button>

            <button class="petbutton" id="catfilter">Cat</button>

            <button class="petbutton" id="otherfilter">Other</button>
        </div>

        <div id="main2">
            <?php
                include 'dbConn.php'; 

                    // Step 2: create SQL command - select, insert, update, delete
                    $query = "SELECT * FROM animal";

                    // Step 3: execute query
                    $results = mysqli_query($connection, $query);

                    // Step 4: read results
                    while ($row = mysqli_fetch_assoc($results)) {
                        $animalid = $row["animalID"];
                        $animalimgquery = "SELECT * FROM animal_image where animalID = '$animalid' ORDER BY animalimageID DESC limit 1";
                        $imgresult = mysqli_query($connection, $animalimgquery);
                        while ($imgrow = mysqli_fetch_assoc($imgresult)) {
                            $animalimg = $imgrow["animal_image_link"];
                        }

                        $animalspecies = $row["species"];

                        if($animalspecies == "dog"){
                            $species = "dog";
                        } else if($animalspecies == "cat"){
                            $species = "cat";
                        } else{
                            $species = "other";
                        }
                        
                        echo '<div class="petframe '.$species.'">';
                        echo '<img src="'. $animalimg .'" class="petbox" id="'.$animalid.'">';
                        echo '<div class="petinfo">';
                    
                        $birthdate = new DateTime($row['birthday']);
                        $currentDate = new DateTime();
                        $age = $currentDate->diff($birthdate);
                    
                        if ($age->y > 0) {
                            echo '<p>Name: ' . $row['name'] . '<br> Age: ' . $age->y . ' years </p>';
                        } else {
                            echo '<p>Name: ' . $row['name'] . '<br> Age: ' . $age->m . ' months </p>';
                        }
                        ?>
                        </br>
                        <a href = "petdetailpage.php?adopt_animalID=<?php echo $animalid; ?>">
                            <button class="view" id="viewpet"> View More ￫ </button>
                        </a>
                        <?php
                        echo '</div>';
                        echo '</div>'; 
                    }
                    

                // Step 5: close connection
                mysqli_close($connection);
                        ?>
        </div>
    </main>

    <script>
    var viewbtn = document.getElementById("viewpet");
    viewbtn.onclick = function(){
        window.location.href = "petdetailpage.php?";
    }

    // Setting up variable for buttons
    var allbtn = document.getElementById("allfilter");
    var dogbtn = document.getElementById("dogfilter");
    var catbtn = document.getElementById("catfilter");
    var otherbtn = document.getElementById("otherfilter");

    // Setting up variable for pet frame with species as their id
    var dog = document.getElementsByClassName("dog");
    var cat = document.getElementsByClassName("cat");
    var other = document.getElementsByClassName("other");

    allbtn.onclick = function(){
        allbtn.style.backgroundColor = "rgb(214, 237, 255)";
        dogbtn.style.backgroundColor = "white";
        catbtn.style.backgroundColor = "white";
        otherbtn.style.backgroundColor = "white";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "block";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "block";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "block";
        }
    }
    
    dogbtn.onclick = function(){
        allbtn.style.backgroundColor = "white";
        dogbtn.style.backgroundColor = "rgb(214, 237, 255)";
        catbtn.style.backgroundColor = "white";
        otherbtn.style.backgroundColor = "white";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "block";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "none";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "none";
        }
    }

    catbtn.onclick = function(){
        allbtn.style.backgroundColor = "white";
        dogbtn.style.backgroundColor = "white";
        catbtn.style.backgroundColor = "rgb(214, 237, 255)";
        otherbtn.style.backgroundColor = "white";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "none";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "block";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "none";
        }
    }

    otherbtn.onclick = function(){
        allbtn.style.backgroundColor = "white";
        dogbtn.style.backgroundColor = "white";
        catbtn.style.backgroundColor = "white";
        otherbtn.style.backgroundColor = "rgb(214, 237, 255)";

        for(var i=0; i<dog.length; i++){
            dog[i].style.display = "none";
        }
        for(var i=0; i<cat.length; i++){
            cat[i].style.display = "none";
        }
        for(var i=0; i<other.length; i++){
            other[i].style.display = "block";
        }
    }
</script>

</body>
</html>
