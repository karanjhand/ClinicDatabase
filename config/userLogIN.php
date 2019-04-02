<?php
    session_start(); //Start the session
    $loggedIn = 0;

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $loggedIn = 1;
        $userName = $_SESSION['uName'];
        $userID = $_SESSION['uID'];
    }    
    else{
    }
?>