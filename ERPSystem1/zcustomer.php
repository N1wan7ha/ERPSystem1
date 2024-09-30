<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ERPSystem1"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all data from the customers table
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);



?>