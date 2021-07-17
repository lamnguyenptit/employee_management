<?php
    session_start();
    require 'dbconfig.php';

    $check= $_SESSION['username'];
    $check1=$_SESSION['password'];
    if($check != true && $check1 != true)
    {
        // $messg = 'Invalid Username and Password';
        // echo "$messg";
        header("Location: login.php");
    }
    session_unset();
    header("Location:login.php");
?>