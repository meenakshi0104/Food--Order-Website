<?php 

      include('../config/constants.php'); 
      //Destroy Session
      session_destroy();//Unsets $_SESSION['user]
      //Redirect to HomePage
      header('location:'.SITEURL.'admin/login.php');

?>