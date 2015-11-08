<?php  

$servername = "localhost";
$username = "root";
$password = "";
$incidentID = 16;
$customerID = 2;
$engineerID = 1;
$pending = "Pending";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $_POST['inciCategory'];
//
//echo $_POST['inciLocation'];
//echo $_POST['inciTownCity'];
//echo $_POST['inciPostCode'];


if ($_POST['inciCategory'] == "Water leak"){
//echo $_POST['waterLocation'];
//echo $_POST['howBad'];
//echo $_POST['causingDamage'];
    
    // prepare and bind
$stmt = $conn->prepare("INSERT INTO waterincident (IncidentID, LeakLocation, HowBad, CausingDamage) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $incidentID, $_POST['waterLocation'], $_POST['howBad'], $_POST['causingDamage']);

// set parameters and execute
$stmt->execute();
//echo "waterincident records created successfully ";
    
}

if ($_POST['inciCategory'] == "General Water Supply Issue"){
//echo $_POST['coldTap'];
//echo $_POST['supplyIssue'];
//echo htmlspecialchars($_POST['waterOtherIssue']);
    
        // prepare and bind
$stmt = $conn->prepare("INSERT INTO generalincident (IncidentID, ColdTap, WaterIssue, Comments) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $incidentID, $_POST['coldTap'], $_POST['supplyIssue'], htmlspecialchars($_POST['waterOtherIssue']));

// set parameters and execute
$stmt->execute();
//echo "generalincident records created successfully";
    
}

if ($_POST['inciCategory'] == "Drain Issue"){
//echo $_POST['drainIssue'];
//echo htmlspecialchars($_POST['drainOtherIssue']);
    
            // prepare and bind
$stmt = $conn->prepare("INSERT INTO drainincident (IncidentID, IssueType, Comments) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $incidentID, $_POST['drainIssue'], htmlspecialchars($_POST['drainOtherIssue']));

// set parameters and execute
$stmt->execute();
//echo "generalincident records created successfully";
    
}

if ($_POST['inciCategory'] == "Other"){
//echo htmlspecialchars($_POST['other']);
    
// prepare and bind
$stmt = $conn->prepare("INSERT INTO otherincident (IncidentID, Comments) VALUES (?, ?)");
$stmt->bind_param("is", $incidentID, htmlspecialchars($_POST['other']));

// set parameters and execute
$stmt->execute();
//echo "otherincident records created successfully";
}
    
//echo $_POST['fullName'];
//echo $_POST['telephone'];
//echo $_POST['address'];
//echo $_POST['postcode'];
//echo $_POST['email'];
    
    // prepare and bind
$stmt = $conn->prepare("INSERT INTO incident (IncidentID, IncidentCategory, PostCode, Address, TownCity, Date, Time, CustomerID, EngineerID, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssiis", $incidentID, $_POST['inciCategory'], $_POST['inciPostCode'], $_POST['inciLocation'], $_POST['inciTownCity'], date("Y/m/d"), date("h:i"),$customerID, $engineerID, $pending);

// set parameters and execute
$stmt->execute();
$incidentID = $incidentID + 1;
echo "new records created successfully";

$conn->close();

header("Location:forum_home.php");

?>