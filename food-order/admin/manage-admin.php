
<?php include('partials/menu.php'); ?>

    <!--Main-Content Section Start-->
    <div class="main-content">
        <div class ="wrapper">
        <h1>Manage Admin</h1>
        </br>
           <?php
              if(isset($_SESSION['add']))//Checch Whether the Session is Set or Not
              {
              echo $_SESSION['add'];//Display Session Message
              unset($_SESSION['add']);//Delete Session Message
              }

              if(isset($_SESSION['delete']))//Checch Whether the Session is Set or Not
              {
              echo $_SESSION['delete'];//Display Session Message
              unset($_SESSION['delete']);//Delete Session Message
              }

              if(isset($_SESSION['update']))//Checch Whether the Session is Set or Not
              {
              echo $_SESSION['update'];//Display Session Message
              unset($_SESSION['update']);//Delete Session Message
              }

              if(isset($_SESSION['user-not-found']))//Checch Whether the Session is Set or Not
              {
              echo $_SESSION['user-not-found'];//Display Session Message
              unset($_SESSION['user-not-found']);//Delete Session Message
              }

              if(isset($_SESSION['pwd-not-match']))//Checch Whether the Session is Set or Not
              {
              echo $_SESSION['pwd-not-match'];//Display Session Message
              unset($_SESSION['pwd-not-match']);//Delete Session Message
              }

              if(isset($_SESSION['change-pwd']))//Checch Whether the Session is Set or Not
              {
              echo $_SESSION['change-pwd'];//Display Session Message
              unset($_SESSION['change-pwd']);//Delete Session Message
              }


           ?>
        <br><br><br>
           
        <a href = "add-admin.php" class ="btn-primary">Add Admin</a>
        </br></br>
        <table class="tbl-full">
            <tr>
                <th>S.NO</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php 
              //Query To Get All Admin
              $sql = "SELECT * FROM tbl_admin";
              //Excute Query
              $res = mysqli_query($conn, $sql);

              //Check Whether the Query is Executed Or Not
              if($res==TRUE){

               //Count Rows to Check whether we have data in database or not 
                $count = mysqli_num_rows($res);//Function to get All rows in Database

                $sn=1;//Create a Variable and Assign the Variable

                //Check the Number of Rows
                if($count>0)
                {
                // We have data in Database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Using while Loop to get all data in Database
                        //And while loop will run as long as  we have data in Database
                        
                        //Get Individual Data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        //Display the Value In our Table
                        ?>
                        <tr>
                           <td><?php echo $sn++; ?>. </td>
                           <td><?php echo $full_name; ?></td>
                           <td><?php echo $username; ?></td>
                           <td>
                           <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                           <a href = "<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class ="btn-secondary">Update Admin</a>
                           <a href= "<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class ="btn-danger">Delete Admin</a>
                           </td>
                           </tr>
 

                        <?php
                    }
                }
                else{
                    //We do not have data in Database
                 }

              }
            
            ?>


            
        </table>
    </div>
    </div>  
    <!--Main-Content Section End-->

<?php include('partials/footer.php'); ?>
    