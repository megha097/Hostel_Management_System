<?php

if (session_status() == PHP_SESSION_NONE) 
{
    ini_set('session.gc_maxlifetime', 86400);   // 24 hours
    ini_set('session.cookie_lifetime', 86400);  // 24 hours
    session_start();
}

$host = "localhost";
$user = "root";
$password = "";
$database = "hostel_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

?>