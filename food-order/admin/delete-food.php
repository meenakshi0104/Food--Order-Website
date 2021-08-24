<?php
    include('../config/constants.php');
//echo "Delete Food Page";
if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Procees to Delete
        //echo "Procees to Delete";

        //1. Get ID and Image Name 
        $id = $_GET['id'];
        $image_name =$_GET['image_name'];

        //2. Remove the physical image file is available 
        if($image_name!="")
        {
            //Image is Available. so remove it 
            $path = "../images/food/".$image_name;

            //Remove the Image
            $remove = unlink($path);

            //If failed to remove image then and an error messqage and stop the process
            if($remove==false)
            {
               //Set the Session Message 
               $_SESSION['upload']="<div class='error'>Failed to Remove Image File.</div>";
               //Redirect to Manage Category page
               header('location:'.SITEURL.'admin/manage-food.php');
               //Stop the Process
               die(); 
            }
        }

    

    //3. Delete Data from the Database
        //Redirect to Manage Category Page with Message 
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the Data is delete from database or not 
        if($res==true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Set Fail Message and Redirect 
            $_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
    
    }
    else
    {
      //redirect to Mnage Category Page
      $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
      header('location:'.SITEURL.'admin/manage-food.php');
    }
?>