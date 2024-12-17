<?php
$host = 'localhost';    
$dbname = 'PlateformeBlog'; 
$username = 'root';      
$password = 'safaa';     


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);  // If there's an error, it will stop execution and print the error
}
$conn->set_charset("utf8");
?>
