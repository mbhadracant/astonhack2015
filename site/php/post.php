<?php 
         // $file is set to "index.php"
session_start();
$id = $_GET['id'];
$category = "Other";
$city = "";
$servername = "localhost";
$username = "root";
$password = "";
$name = "";
$date = "";
$customerID = "";
$address = "";
$postcode = "";
$status = "";
$email = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"SevernTrentWater");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Incident WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}




if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $category = $row['IncidentCategory'];
        $city = $row['TownCity'];
        $date = $row['Date'];
        $customerID = $row['CustomerID'];
        $address = $row['Address'];
        $postcode = $row['PostCode'];
        $status = $row['Status'];
    }
} 


$stmt->close();

$sql = "SELECT * FROM Customer WHERE CustomerID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$customerID);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}

$points = 0;


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row['Name'];
        $email = $row['Email'];
        
    }
} 


$stmt->close();


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


$option1 = "";
$option2 = "";
$option3 = "";

if($category == "Water Leak") { 
    


$sql = "SELECT * FROM WaterIncident WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}




if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $option1 = $row['LeakLocation'];
        $option2 = $row['HowBad'];
        $option3 = $row['CausingDamage'];
        
    }
} 


$stmt->close();


} else if($category == "General water supply issue") { 
    
    $sql = "SELECT * FROM GeneralIncident WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}




if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $option1 = $row['ColdTap'];
        $option2 = $row['WaterIssue'];
        $option3 = $row['Comments'];
        
    }
} 


$stmt->close();
    
} else if ($category == "Drain Issue") { 
    
        $sql = "SELECT * FROM DrainIncident WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}




if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $option1 = $row['IssueType'];
        $option2 = $row['Comments'];
    }
} 


$stmt->close();
    
    
    
    
    
} else { 
 
        $sql = "SELECT * FROM OtherIncident WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}




if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $option1 = $row['Comments'];
        
    }
} 


$stmt->close();
    
}

$sql = "SELECT * FROM Messages WHERE IncidentID = (?)";

$result = 0;

    if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
   
} else {
    die("Errormessage: ". $conn->error);
}

$messages = array();
$nameMessage = array();
$emailMessage = array();





if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($messages,$row['Message']);
        array_push($nameMessage,$row['Name']);
        array_push($emailMessage,$row['Email']);
        
    }
} 


$stmt->close();


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
           <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
$_SESSION['name']
    <!-- Modal content-->
    <div class="modal-content">
        <form action="add_comment.php?id=<?php echo $id; ?>&name=<?php

if(isset($_SESSION["employee"])) {echo $_SESSION['name'];} else { echo $name;    }
                      ?>
                      &email=<?php echo $email; ?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Comment</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
  <label for="comment">Comment:</label>
  <textarea name="comment" class="form-control" rows="5" id="comment"></textarea>
</div>
      </div>
      <div class="modal-footer">
        <button type='submit' class='btn btn-default'>Submit</button>
      </div>
            </form>
    </div>

  </div>
</div> 
          <h1 class="text-middle title"> <a href="forum_home.php">Forum Reporting Problem</a></h1>
        
        <div id="split" class="container">
            <div id="forum_main">
            
            <div id='main_post'>
                <h3 id='category'><?php echo $category ?><span id="status"><?php echo " [" . $status . "]"; ?></span></h3>
                <h6 id='user' class='submitted text-middle'>Submitted By  <?php echo $name; ?></h6>
                <h6 id='date' class='submitted text-middle'><?php echo $date; ?></h6>
                <br>
                
                <?php  
                    if($category == 'Water Leak') { 
                        echo "
                        <div id='main_post_text'>
                            <h5>Where is the incident happening?</h5>
                            <p>" . $option1 . "</p>
                            <br>
                            <h5>How bad is the leak?</h5>
                            <p>" . $option2 . "</p>
                            <br>
                            <h5>Is it causing damage?</h5>
                            <p>" . $option3 . "</p>
                            <br>
                        </div>
                        ";   
                    } else if($category == 'General water supply issue') { 
                        echo "
                        <div id='main_post_text'>
                            <h5>Is the problem at cold tap nearest your stop tap?</h5>
                            <p>" . $option1 . "</p>
                            <br>
                            <h5>What type of water supply issue do you have?</h5>
                            <p>" . $option2 . "</p>
                            <br>
                            ";
                        
                        if($option3 != "") { 
                            echo "
                            <h5>Other - Description</h5>
                            <p>" . $option3 . "</p>
                            ";
                        }
                        echo "</div>
                        ";   
        
                    } else if($category == 'Drain Issue') { 
                        echo "
                        <div id='main_post_text'>
                            <h5>What type of drain issue do you have?</h5>
                            <p>" . $option1 . "</p>
                            <br>
                        </div>
                        ";   
        
                    } else { 
                        echo "
                        <div id='main_post_text'>
                            <h5>Description of the issue:</h5>
                            <p>" . $option1 . "</p>
                            <br>
                        </div>
                        ";
                    }

                    if( isset($_SESSION["logged"]) && isset($_SESSION["employee"]) && $status != "Resolved"){
                        if($_SESSION["logged"] == true && $_SESSION["employee"] == true) { 
                                
                            echo "
                            <br>
                            <form action='update.php?customerID=" . $customerID . "&id=" . $id . "' method='post'>
                            <div class='form-group'>
  <label for='sel1'>Select Status</label>
  <select name='status' class='form-control' id='sel1'>
    <option>Please Select</option>
    <option>Engineer Sent</option>
    <option>Resolved</option>
  </select>
  <br>
  <button style='float:right' type='submit' class='btn btn-default'>Update</button>
</div>
</form>

                            ";
                            
                        }
                    }


for($i = 0; $i < count($messages); $i++) { 
    
    echo "<hr>";
    
    echo "<h6 style='color:grey'>" . $nameMessage[$i] . "</h6>";
    echo "<p>" . $messages[$i] . "</p>";
    
    
}



        if(isset($_SESSION["logged"]) && isset($_SESSION["customerID"])) { 
            if($_SESSION["customerID"] == $customerID) {
                echo "<br>
<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal'>Add Comment</button>
                ";
            }
        }

        if(isset($_SESSION["logged"]) && isset($_SESSION["employee"])) {
                 echo "<br>
<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal'>Add Comment</button>
                ";
        }
                ?>
                
                
             
            </div>
            
            </div>
            
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
            $('#main_post_text').append("<h5>Location of problem:</h5><p><?php echo $address; ?></p> <?php echo $city ?><p><p><?php echo $postcode; ?></p>");
           
            if($('#status').html() == " [Pending]") { 
                   $('#status').css("color","red");
            } else if($('#status').html() == " [Engineer sent]") { 
                   $('#status').css("color","dodgerblue");
            } else { 
                    $('#status').css("color","green");
                }
            
        </script>
        
    </body>

    </html>