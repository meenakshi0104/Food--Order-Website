<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class ="wrapper">
        <h1>Add Admin</h1>
        <br><br>
            <?php 
              if(isset($_SESSION['add']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['add'];//Display Session Message
              unset($_SESSION['add']);//Delete Session Message
              }
            ?>
         
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name" ></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="Username" placeholder="Your Username" ></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="Password" placeholder="Your Password" ></td>
                </tr>
                <tr>
                    <td colspan ='2'>
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
                     
                    </td>
                </tr>
            </table>
        </form>
        </div>
</div>

<?php include('partials/footer.php'); ?>
<?php 
    // Process the value from form and save it to the Database
    //Check whether the submit button is Clicked or Not
      if(isset($_POST['submit']))
      {
          //Button is Clicked 
          //echo "Button Clicked"

          //1. Get the data from Form 
        $full_name = $_POST['full_name'];
         $Username =  $_POST['Username'];
         $Password = md5($_POST['Password']);//Password Encryption with md5

         //2.SQL Query to Save the Data in the Database
        $sql = "INSERT INTO tbl_admin SET
               full_name='$full_name',
               username='$Username',
               password='$Password'
        ";

        //3. Executing Query and Saving data in Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4.Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
          //Data Inserted
          //echo "Data Inserted";
          //Create Session variable to Display the message 
          $_SESSION['add'] = "<div class='success'>Add Admin Successfully.</div>";
          //Redirect Page to Manage Admin
          header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            // Failed to Insert Data
            //echo "Failed to Insert Data";
            $_SESSION['add'] = "<div class='error'>Failed To Add Admin.</div> ";
            //Redirect Page to Add Admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        } 

      }
?>
                                                                                                                                                                                                                                                                                                                                            