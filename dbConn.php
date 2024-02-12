<!-- Database connection -->
<?php
    $server = 'localhost'; //Or apply IP address 127.0.0.1
    $user = 'root' ;// default user
    $password = ''; // password if have
    $database = 'wdt_assignment';

    $connection = mysqli_connect($server, $user, $password, $database);

    if ($connection === false){ //Check database conenction
        die ("Database connection failure".mysqli($connection)); //If fail stop the execution
    }
