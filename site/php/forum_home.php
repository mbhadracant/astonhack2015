<!DOCTYPE html>
<html lang="en">
<?php 
session_start();




$cities = array('Scunthorpe', 'Chesterfield', 'Mansfield', 'Matlock', 'Nottingham', 'Derby', 'Stoke-on-Trent', 'Stafford','Oswestry','Welshpool','Shrewsbury','Telford','Wolverhampton','Tamworth', 'Leicester', 'Newtown', 'Birmingham', 'Kidderminster', 'Coventry', 'Warwick', 'Stratford-upon-Avon', 'Worcester', 'Evesham', 'Cheltenham', 'Gloucester');

$count = array();

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$points = 0;

 if (isset($_SESSION['logged']) && isset($_SESSION['customerID'])) { 
     
     
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
 





?>

    <head>
        <title>Problem Reporting Forum</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

        <script>
            var cities = ['Scunthorpe', 'Chesterfield', 'Mansfield', 'Matlock', 'Nottingham', 'Derby', 'Stoke-on-Trent', 'Stafford','Oswestry','Welshpool','Shrewsbury','Telford','Wolverhampton','Tamworth', 'Leicester', 'Newtown', 'Birmingham', 'Kidderminster', 'Coventry', 'Warwick', 'Stratford-upon-Avon', 'Worcester', 'Evesham', 'Cheltenham', 'Gloucester'];

cities.sort();

var forum = $('#forum_main');

for(var i = 0; i < cities.length;i++) { 
    
    $(forum).append("<div class='cities'><a href='../php/city_posts.php?city=" + cities[i]+ "'><h3>" + cities[i] + "</h3></a></div>");
    $(forum).append("<hr>");
}




        </script>
    </body>

</html>