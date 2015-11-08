<?php 

$form_email = $_POST["email"];
$form_password = $_POST["password"];

$id = $_GET['id'];

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Customer WHERE Email = (?) AND Password = (?)";



    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("ss",$form_email,$form_password);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}



if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
            session_start();
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $row['Name'];
            $_SESSION['customerID'] = $row['CustomerID'];
            header("Location:" . $_GET['redirect'] . "?id=" . $id);
            
        
    }
} 

$stmt->close();

$sql = "SELECT * FROM Engineer WHERE Email = (?) AND Password = (?)";



    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("ss",$form_email,$form_password);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}



if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
            session_start();
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $row['Name'];
            $_SESSION['employee'] = true;
            header("Location:" . $_GET['redirect'] . "?id=" . $id);  
        
    }
}

echo "Wrong username or password";

header("Location:" . $_GET['redirect'] . "?id=" . $id);  

$stmt->close();

?>