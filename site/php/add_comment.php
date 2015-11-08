<?php


$message =  $_POST['comment'];
$id = $_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];




$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO Messages(IncidentID, Message,Name,Email) VALUES (?,?,?,?)");
$stmt->bind_param("isss", $id, $message, $name, $email);

// set parameters and execute
$stmt->execute();

echo "New records created successfully";

header("Location:post.php?id=" . $id);

?>