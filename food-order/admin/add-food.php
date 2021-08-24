<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class ="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
              if(isset($_SESSION['upload']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
              }
        ?>

        <form action ="" method="POST" enctype="multipart/form-data">

         <table class = "tbl-30">

             <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the Food">
                </td>
             </tr>

             <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                </td>
            </tr> 

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" placeholder="Title of the Food">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                    <?php 
                         //Create PHP Code to display Categories from Database
                         //1. Create SQL to get all active Categories from database
                         $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                         //Executing Query
                         $res = mysqli_query($conn, $sql);

                         //Count Rows to check whether we have categories or not
                         $count = mysqli_num_rows($res);

                         //If count is greater than zero, we have categories else we donot have categories
                         if($count>0)
                         {
                             //We have Categories
                             while($row=mysqli_fetch_assoc($res))
                             {
                                 $id = $row['id'];
                                 $title = $row['title'];
                                 ?>

                                 <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                 
                                 <?php
                             }
                         }
                         else
                         {
                             //We donot have categories
                             ?>
                             <option value="0">No Category Found</option>
                             <?php
                         }

                         //2. Display on Dropdown
                    ?>

                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes" >Yes
                    <input type="radio" name="featured" value="No" >No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes" >Yes
                    <input type="radio" name="active" value="No" >No
                </td>
              </tr>

              <tr>
                  <td colspan ='2'>
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary" >
                  </td>
              </tr>

          </table>
        
        </form>

        <?php 

             //Check whether tyhe button is clicked or not 
             if(isset($_POST['submit']))
             {
               //Add the food in Database
              // echo "Clicked";
               //1.Get the Data from form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not 
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];

                }
                else
                {
                    $featured = "No";//Setting the Default Value
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                   $active = "No";//Setting Default Value
                }
                
                //2.Upload the Image if Selected
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    //Check whether the Image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //image is Selected
                        //A. Rename the Image
                        //Get the extension of selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        //Create New Name for Image 
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image Name May be "<Food-Name...

                        //B. Upload the Image
                        //Get the Src Path and Destination path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finalyy Upload the Image
                        $upload = move_uploaded_file($src, $dst);

                        //Cheeck wther the Image is uplode or not
                        //ANd if the iamge is not uploaded then we will stop the peocess and redirec with error message
                        if($upload==false)
                        {
                            //Failed to upload image
                            //Redirect to add food page with error msg
                            //Set Message
                        $_SESSION['upload']= "<div class='error'>Failed to Upload Image.</div>";
                        //Redirect to Add Category Page
                         header('location:'.SITEURL.'admin/add-food.php');
                        //Stop the process
                         die();
                        }
                    }
                }
                else
                {
                  $image_name = ""; //Setting Default Value as blank
                }

                //3.Insert Into Database

                //Create a SQL Query to Save or AAdd food
                //For Numerical we dont need to pass value inside quotes '' But for string value it is compulsory to add quotes
                $sql2 = "INSERT INTO tbl_food SET
                  title ='$title',
                  description = '$description',
                  price = $price,
                  image_name = '$image_name',
                  category_id = $category,
                  featured='$featured',
                  active='$active'
                  ";

                  $res2 = mysqli_query($conn, $sql2);
                  //Check whether data inserted or not 
                  
                  if($res2 == true)
                  {
                      //data inserted Successfully
                      $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                      header('location:'.SITEURL.'admin/manage-food.php');
                  }
                  else
                  {
                      //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed To Add Food..</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                  }

             }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>