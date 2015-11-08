<?php 
session_start();
    if(!isset($_GET['city'])) {
        header("Location: forum_home.php");  
    }
$city = $_GET['city'];

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Incident WHERE TownCity = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("s",$city);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}

$category = array();
$problemID = array();
$status = array();

$customerID = array();

$sizeOfProblems = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sizeOfProblems++;
        array_push($category,$row['IncidentCategory']);
        array_push($problemID,$row['IncidentID']); 
        array_push($status,$row['Status']);
        array_push($customerID, $row['CustomerID']);
        
    }
} 


$stmt->close();
                   
$names = array();

$sql = "SELECT Name FROM Customer WHERE CustomerID = (?)";

for($i = 0; $i < count($customerID);$i++) {
    
   



    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("s",$customerID[$i]);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($names,$row['Name']);
        
    }
} 


$stmt->close();
}


$points = 0;

 if (isset($_SESSION['logged'])) { 
      if (isset($_SESSION['customerID'])) { 
$sql = "SELECT Points FROM Customer WHERE CustomerID = (?)";
     
$customerID = $_SESSION['customerID'];
    
$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$customerID);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        $points = $row['Points'];
    }
} 


$stmt->close();
      }
 }

              
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Problem Reporting Forum</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/site.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>
    
      <h1 class="text-middle title"> <a href="forum_home.php">Forum Reporting Problem</a></h1>
    
     <div id="split" class="container">
        <div id="forum_main"></div>
         
       <div id="reporting_account" class="jumbotron">
                <?php
                

            if (isset($_SESSION['logged'])) { 
                echo "
                
                <div>
                    <h5>Logged in as: " . $_SESSION['name'] .  "</h5>
                    ";
                if(isset($_SESSION['customerID'])) {
                    echo "<h5>Points:" . $points . "</h5>";
                }
                   
               echo "</div>";
                
                   if(isset($_SESSION['customerID'])) {
               echo "<form action='rewards.php?customerID=" . $customerID . "' method='post'>
                <button type='submit' class='btn btn-default btn-xs'>Redeem Points</button>
                </form>";
                   }
                echo "<br>
                    <form action='logout.php?redirect=" . basename(__FILE__) . "' method='post'>
                <button type='submit' class='btn btn-default btn-xs'>Logout</button>
                </form>
                
                ";
                
            } else { 
              
                echo "
                
                <form role='form'  action='login.php?redirect=" . basename(__FILE__) . "' method='post'>
                <h3>Login</h3>
  <div class='form-group'>
    <label for='email'>Email address:</label>
    <input name='email' type='email' class='form-control' id='email'>
  </div>
  <div class='form-group'>
    <label for='pwd'>Password:</label>
    <input name= 'password' type='password' class='form-control' id='pwd'>
  </div>
  
  <button type='submit' class='btn btn-default'>Submit</button>
</form>";   
            }
                ?>
            </div>
        </div>

    </div>

 <script>
     
     <?php
echo "var problemID = ". json_encode($problemID) . ";\n";
echo "var category = ". json_encode($category) . ";\n";
echo "var problemSize = ". json_encode($sizeOfProblems) . ";\n";
echo "var status = ". json_encode($status) . ";\n";
echo "var names = ". json_encode($names) . ";\n";
?>
     
    
    
     if(problemSize == 0) { 
         $('#forum_main').append("<h3 class='text-center'>There are currently no problems in this city</h3>");
         $('#forum_main').height(329);
     }
     
     
    
    for(var i = 0; i < problemSize; i++) {
        
        var stat = "";
        var color = "";
        if(status[i] == "P") { 
            stat = "Pending";
            color = "red";
        } else if(status[i] == "R") { 
            stat = "Resolved";
            color = "green";
        } else { 
            stat = "Engineer Sent";
            color = "dodgerblue";
        }
        $('#forum_main').append("<div class='posts'><div class='left-side'><a href='post.php?id=" + problemID[i] + "'><h3>" + category[i] +  "</h3></a><h6 class='submitted'>Submitted By " + names[i] + "</h6></div><div class='right-side'><h4 style='position:relative;top:15px;left:130px;'>Status:<span style='color:" + color + "'> " + stat + "</span></h4></div></div>");
        $('#forum_main').append("<hr>");
    }
     
    
</script>
</body>

</html>