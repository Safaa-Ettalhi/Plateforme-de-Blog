<?php
$host = 'localhost';    // The database server (usually 'localhost' for local development)
$dbname = 'PlateformeBlog';  // The name of your database
$username = 'root';      // Your database username (usually 'root' in local environments)
$password = 'safaa';     // The password for the database user (make sure it's correct)

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection failed
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);  // If there's an error, it will stop execution and print the error
}

// Set the character set for the connection to utf8 (this helps with encoding issues)
$conn->set_charset("utf8");
?>
