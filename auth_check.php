<?php

session_start();

// Check if the user is logged in (adjust the session key as needed)
if (!isset($_SESSION['id_user'])) {
    // If not logged in, redirect to the login page
    header("Location: login"); 
    exit(); 
}