<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class ="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                    <input type="password" name="current_password" placeholder="Current Password" >
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                    <input type="password" name="new_password" placeholder="New Password" >
                    </td>
                </tr>
                
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" >
                    </td>
                </tr>
                
                <tr>
                    <td colspan ='2'>
                    <input type="hidden" name="id" value ="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary" >
                     
                    </td>
                </tr>

            </table>
        </form>
        </div>
    </div>

<?php
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form 
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //Check Whether the user with Current ID and Current Password Exists or Not
        $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //Execute the Query
        $res = mysqli_query($conn,$sql);

        //Check whether the Query executed successfully or not
        if($res==true){
            //Check whether data Available or not
            $count=mysqli_num_rows($res);
            
            if($count==1)
            {
                //User EXists and password can be changed
                //echo "User Found";
                //3.Check Whether the NEW Password and Confirm Password Match or not
                 if($new_password==$confirm_password)
                 {
                     //Update the Password
                     $sql2 = "UPDATE tbl_admin SET
                     password='$new_password'
                     WHERE id=$id
                     ";

                     //Execute the Query
                     $res2 = mysqli_query($conn, $sql2);

                     //Check whether the query executed or not
                     if($res2==true)
                     {
                         //Display Success Message
                         $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully. </div>";
                         // Redirect Page to User
                         header('location:'.SITEURL.'admin/manage-admin.php');
                     }
                     else{
                        $_SESSION['change-pwd'] = "<div class='error'> Failed To Changed Password. </div>";
                        // Redirect Page to User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                     }
                 }
                 else
                 {
                     //Redirect to Manage Admin Page with Error
                     $_SESSION['pwd-not-match'] = "<div class='error'> Password Not Match. </div>";
                     // Redirect Page to User
                     header('location:'.SITEURL.'admin/manage-admin.php');
                 }
            }
            else{
                $_SESSION['user-not-found']="<div class='error'> User Not Found. </div>";
                // Redirect Page to User
                header('location:'.SITEURL.'admin/manage-admin.php');
          }
          //3.Check Whether the NEW Password and Confirm Password Match or not

          //4.Change Password if all above is true
    }
}
?>


<?php include('partials/footer.php'); ?>