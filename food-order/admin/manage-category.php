<?php include('partials/menu.php') ?>

<!--Main-Content Section Start-->
<div class="main-content">
        <div class ="wrapper">
        <h1>Manage Category</h1>
        </br></br>

        <?php 
              if(isset($_SESSION['add']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
              }

              if(isset($_SESSION['remove']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['remove'];
              unset($_SESSION['remove']);
              }

              if(isset($_SESSION['delete']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
              }

              if(isset($_SESSION['no-category-found']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['no-category-found'];
              unset($_SESSION['no-category-found']);
              }

              if(isset($_SESSION['update']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
              }

              if(isset($_SESSION['upload']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
              }

              if(isset($_SESSION['failed-remove']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['failed-remove'];
              unset($_SESSION['failed-remove']);
              }

             
        ?>
        <br><br>
         
           
        <a href = "<?php echo SITEURL; ?>admin/add-category.php" class ="btn-primary">Add Category</a>
        </br></br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                
                //Query to Get all Categories from Database
                $sql = "SELECT *FROM tbl_category";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count  = mysqli_num_rows($res);

                //Create Serial Number Variable and assign value as 1
                $sn=1;

                //Check whether we have data in database or not 
                if($count >0)
                {
                    //We have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title=$row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                <tr>
                     <td><?php echo $sn++; ?>.</td>
                     <td><?php echo $title; ?></td>

                     <td>
                         <?php
                          //Chck whether image name is available or not 
                          if($image_name!="")
                          {
                              //Display the Image
                              ?>

                              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                              <?php
                          }
                          else
                          {
                              //Display the Message 
                              echo "<div class='error'>Image not Added.</div>";
                          }
                         ?>
                    </td>

                     <td><?php echo $featured; ?></td>
                     <td><?php echo $active; ?></td>
                     <td>
                     <a href = "<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class ="btn-secondary">Update Category</a>
                     <a href = "<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class ="btn-danger">Delete Category</a>
                     </td>
                </tr>

                        <?php
                    }

                }
                else
                {
                  
                    //We do not have data
                    ?>
                    <tr>
                      <td colspan="6"><div class="error">No Category Added.</div>
                    </tr>

                    <?php
                }

                ?>

        </table>
    </div>
</div>  
    <!--Main-Content Section End-->

<?php include('partials/footer.php'); ?>
    