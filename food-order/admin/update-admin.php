<?php include('partials/menu.php'); ?>
   
<div class="main-content">
        <div class ="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            //1.Get the ID of Selected Admin
            $id=$_GET['id'];
            //2.Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the Query is Executed or not 
            if($res==true){
                //Check whether the data is available or not 
                $count =mysqli_num_rows($res);

                if($count==1){
                    //Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name =$row['full_name'];
                    $username =$row['username'];
                }
                else{
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                    <input type="text" name="full_name" value="<?php echo $full_name; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                    <input type="text" name="Username" value ="<?php echo $username; ?>" >
                    </td>
                </tr>
                <tr>
                    <td colspan ='2'>
                    <input type="hidden" name="id" value ="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary" >
                     
                    </td>
                </tr>
                
            </table>
        </form>
        </div>
    </div>

<?php

    //Check Whether the Submit Button is CLicked or Not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['Username'];

        //Create a SQL Query to Update Admin
        $sql ="UPDATE tbl_admin SET
        full_name ='$full_name',
        username='$username'
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn,$sql);

        //Check whether the Query executed successfully or not
        if($res==TRUE){
            //Data Inserted
            //echo "Data Inserted";
            //Create Session variable to Display the message 
            $_SESSION['update'] = "<div class='success'> Admin Updated Successfully.</div>";
            //Redirect Page to Manage Admin
            header('location:'.SITEURL>'admin/manage-admin.php');
          }
          else{
              // Failed to Insert Data
              //echo "Failed to Insert Data";
              $_SESSION['update'] = "<div class='error'>Failed To Delete Admin.</div> ";
              //Redirect Page to Add Admin
              header('location:'.SITEURL.'admin/manage-admin.php');
          } 
  
    }
?>


<?php include('partials/footer.php'); ?>