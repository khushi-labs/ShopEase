<?php
$host = "localhost";
$user = "root"; 
$pass = "";    
$dbname = "khushi_ecommerce";
// $host = "sql100.infinityfree.com";
// $user = "if0_39035439"; 
// $pass = "TOIJbGieet";    
// $dbname = "if0_39035439_khushi_ecommerce";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
