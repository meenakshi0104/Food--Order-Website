<?php include('partials/menu.php'); ?>

    <!--Main-Content Section Start-->
    <div class="main-content">
        <div class ="wrapper">
        <h1>Manage Food</h1>
        
        <br /><br />

        <a href = "<?php echo SITEURL; ?>admin/add-food.php" class ="btn-primary">Add Food</a>
         
        <br /><br /><br />

        <?php 
              if(isset($_SESSION['add']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
              }

              if(isset($_SESSION['delete']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
              }

              if(isset($_SESSION['upload']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
              }

              if(isset($_SESSION['unauthorize']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['unauthorize'];
              unset($_SESSION['unauthorize']);
              }

              if(isset($_SESSION['update']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
              }
        ?>

 
        <table class="tbl-full">
            <tr>
                <th>S.NO</th>
                <th>Title</th>
                 <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            
            </tr>
            <?php 
                
                //Create a SQL Query to Get all the food
                $sql = "SELECT * FROM tbl_food";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count  = mysqli_num_rows($res);

                //Create Serial Number Variable and assign value as 1
               $sn=1;

                //Check whether we have data in database or not 
               if($count >0)
               {
                //We have Added Food
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title=$row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                  ?>
              <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $price; ?></td>
                    <td>
                    <?php 
                          //Chck whether image name is available or not 
                      if($image_name=="")
                      {
                        // we dont have image Display error Message 
                         echo"<div class='error'>Image not Added.</div>";

                    }
                    else
                    {
                      //Display the Image
                      ?>
                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" >
                      <?php
                    }
                  ?>
                  </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href = "<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class ="btn-secondary">Update Food</a>
                    <a href = "<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class ="btn-danger">Delete Food</a>
                 </td>
            </tr>

                <?php
                }
  
            }
            else
            {
                 //Food not added in database
                 echo "<tr> <td colspan = '7' class='error'>Food Not Added Yet.</td> </tr>";
            }
        ?>

    </table>
</div>
</div>  
<!--Main-Content Section End-->

<?php include('partials/footer.php'); ?>

            