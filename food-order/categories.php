<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
                
                //Query to Get all Categories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count  = mysqli_num_rows($res);

                

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
            ?>

              <a href="category-foods.html">
               <div class="box-3 float-container">
                <?php
                   //check whether Image is available or not
                   if($image_name=="")
                   {
                       //Display the Message
                       echo "<div class='error'>Image not Available</div>";
                   }
                   else
                   {
                       //Image Available
                       ?>
                       <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                       <?php
                   }
                ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                   </div>
                </a>
            <?php
            }
         }
         else
         {
           //Categories Not Available
           echo "<div class='error>Category not Added</div>";
         }
        ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>