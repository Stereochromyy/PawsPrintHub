<?php
$account = null;
if((isset($_SESSION['email'])) && (isset($_SESSION['password']))){
    $account = "user";
}
else{
    $account = "guest";
}
?>
