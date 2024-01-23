<?php
session_start();
$account = null;
if(isset($email) && isset($password)){
    $account = True;
}
else{
    $account = False;
}
?>
