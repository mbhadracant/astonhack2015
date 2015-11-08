<?php 
session_start();
   


$servername = "localhost";
$username = "root";
$password = "";

$customerID = $_GET['customerID'];

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Customer WHERE CustomerID = (?)";


    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$customerID);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row['Name'];
        $points = $row['Points'];
        
    }
} 


$stmt->close();




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rewards</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body style="background:black;">
    
    <div style="position:relative;left:100px;top:20px;height:500px;width:80%;background:#F2F2F2;border-radius:10px;text-align:center;">
        <br>
        <h3>Welcome to the rewards section <?php echo $name; ?>! Thank you for contributing to the reporting forum and saving a have <?php echo $points; ?> points to spend on!</h3>
        
        <div style="width:100%;height:200px;position:relative;left:30px;top:30px;">
            <div style="margin:5px;width:30%;height:100%;float:left;">
            <img src="fountain.jpg" style="max-width:100%;max-height:100%;"></div>
            <div style="margin:5px;width:30%;height:100%;float:left;">
            <img src="timer.jpg" style="max-width:100%;max-height:100%;"></div>
            <div style="margin:5px;width:30%;height:100%;float:left;">
                <img src="showerhead.jpg" style="max-width:100%;max-height:100%;"></div>
            
        
        </div>
        
        <button style ="position:relative;top:50px;left:-200px;" type="button" class="btn btn-default btn-md">3000 Points</button>
        <button style ="position:relative;top:50px;" type="button" class="btn btn-default btn-md">200 Points</button>
        <button style ="position:relative;top:50px;left:200px;" type="button" class="btn btn-default btn-md">1000 Points</button>
        
        
    </div>
    
    
  
    
    
</body>

</html>