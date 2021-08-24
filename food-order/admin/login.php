<?php include('../config/constants.php'); ?>


<html>
    <head>
        <title>Login -Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

       <div class ="login">
          <h1 class="text-center">Login</h1>
          <br><br>

          <?php
              if(isset($_SESSION['login']))//Checch Whether the Session is Set or Not
              {
                  echo $_SESSION['login'];//Display Session Message
                  unset($_SESSION['login']);//Delete Session Message
              }

              if(isset($_SESSION['no-login-message']))//Check Whether the Session is Set or Not
              {
                  echo $_SESSION['no-login-message'];//Display Session Message
                  unset($_SESSION['no-login-message']);//Delete Session Message
              }

            ?>
            <br><br>

          <!--Login Form Starts Here-->
          <form action="" method="POST" class="text-center">
          Username:<br>
          <input type ="text" name="username" placeholder="Enter Username"><br><br>
          Password:<br>
          <input type ="password" name="password" placeholder="Enter  Password"><br><br>
          
          <input type ="submit" name="submit" value="Login" class="btn-primary">
          <br><br>
          </form>
          <!--Login Form Starts Here-->


          <p class =" text-center">Created By -<a href="www.meenakshisingh.com">Meenakshi Singh</a></p>
          </div>
    </body>
</html>
<?php 

   //Check whether the Submit Button is clicked or not 
   if(isset($_POST['submit']))
   {
       //Process for Login
       //1. Get the Data from Login Form 
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user withn username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Executeb the Query
        $res = mysqli_query($conn,$sql);

        //4. SQL to check whether the user exists or not 
        $count = mysqli_num_rows($res);
        if($count ==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class ='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;//TO check whether the user is logged in or not logout will unset it
            //Redirect To Home Page Dashboard
            header('location:'.SITEURL.'admin/');
           
        }
        else
        {
          //User not Available and Login Fail
          $_SESSION['login'] = "<div class = 'error text-center'> Username or Password did not match.</div>";
           //Redirect to Home Page Dashborad
           header('location:'.SITEURL.'admin/login.php');
         
        }

   }
?>