<?php 
session_start();
session_unset(); 
session_destroy();


  if(isset($_GET['city'])) {
        header("Location:" . $_GET['redirect'] . "?city= " . $_GET['city']);
} else if(isset($_GET['id'])) {
        header("Location:" . $_GET['redirect'] . "?id= " . $_GET['id']);
  } else { 
       header("Location:forum_home.php");
  }


?>

 