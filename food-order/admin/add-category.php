<?php include('partials/menu.php') ?>

<!--Main-Content Section Start-->
<div class="main-content">
        <div class ="wrapper">
        <h1>Add Category</h1>

        </br></br>

        <?php 
              if(isset($_SESSION['add']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
              }

              if(isset($_SESSION['upload']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
              }
               

            ?>
            <br><br>
         
        <!-- Add Category form Starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title" >
                </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
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
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary" >
                     
                    </td>
                </tr>
               
            </table>
        </form>
        

        <?php

        //Check whether the Submit button is Clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked";
            //1. Get the Value from Category form
            $title = $_POST['title'];

            //For Raadio input, we need to check whether the button is selected or not 
            if(isset($_POST['featured']))
            {
              //Get the Value From form
              $featured =$_POST['featured'];

            }
            else
            {
              $featured ="No";
            }
            if(isset($_POST['active']))
            {
                $active =$_POST['active'];
            }
            else{
                $active ="No";
            }

            //Check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);
            //die();

            if(isset($_FILES['image']['name']))
            {
                //Upload the Image
                //To Upload image we need image name,source path and destination path
                $image_name = $_FILES['image']['name'];

                //Upload the Image only if image is selected
            if($image_name != "")
            {

                //Auto Rename our Image
                //Get the Extension of our image name,source path and destination path
               $ext = end(explode('.',$image_name));

               //Rename the Image
               $image_name = "Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                //Finalyy Upload the Image
                $upload = move_uploaded_file($source_path, $destination_path);

                //CHeeck wther the Image is uplode or not
                //ANd if the iamge is not uploaded then we will stop the peocess and redirec with error message
                 if($upload==false)
                 {
                     //Set Message
                     $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                     //Redirect to Add Category Page
                     header('location:'.SITEURL.'admin/add-category.php');
                     //Stop the process
                     die();
                 }
            }
                
            }
            else
            {
              //Don't Upload Image and set the image_name value as blank
              $image_name="";
            }

            //2. Create SQL Query to Insert Category Into Database
            $sql = "INSERT INTO tbl_category SET
            title ='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            
            //3.Execute the Query and Save in Database
            $res = mysqli_query($conn, $sql);

            //4.Check whether the (Query is Executed) data is inserted or not
        if($res==true){
            
            //Create Session variable to Display the message 
            $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header('location:'.SITEURL.'admin/manage-category.php');
          }
          else{
              // Failed to Insert Data
              //echo "Failed to Insert Data";
              $_SESSION['add'] = "<div class='error'>Failed To Add Category.</div> ";
              //Redirect Page to Add Admin
              header('location:'.SITEURL.'admin/add-category.php');
          } 
  
        }
        ?>
    </div>
</div>

        <!-- Add Category form Starts-->

<?php include('partials/footer.php') ?>
           