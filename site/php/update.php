<?php

$id = $_GET['id'];
$status = $_POST['status'];
$customerID = $_GET['customerID'];
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE Incident SET Status = (?) WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("si",$status,$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}


$stmt->close();

$sql = "SELECT * FROM Customer WHERE CustomerID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$_GET['customerID']);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}

$email = "";
$points = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $points = $row['Points'];
    $email = $row['Email'];         
        
    }
}

$sql = "SELECT IncidentCategory FROM Incident WHERE IncidentID = (?)";



    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}



$category = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
    $category = $row['IncidentCategory'];         
        
    }
}

$stmt->close();

if($status == "Resolved") { 

$sql = "UPDATE Customer SET Points = (?) WHERE CustomerID = (?)";

    $points += rand(1,50);

$stmt = $conn->prepare($sql);



$stmt->bind_param('ii', $points, $customerID);
$stmt->execute();
if ($stmt->errno) {
  echo "FAILURE!!! " . $stmt->error;
}
else echo "Updated {$stmt->affected_rows} rows";
    
}   

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mbhadracant@gmail.com';                 // SMTP username
$mail->Password = 'Mayur30isthebest';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('mbhadracant@gmail.com', 'Severn Water Trent');  // Add a recipient
$mail->addAddress($email);               // Name is optional


   // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->Subject = $category;

$body = '';

if($status == "Engineer Sent") { 
    $body = 'Regarding your recent reporting, an engineer is on his way!';
} else { 
    $body = 'Your issue has been resolved';
}

$mail->Body    = $body;
$mail->AltBody = $body;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


echo $points;


header("Location:post.php?id=" . $id);

?>