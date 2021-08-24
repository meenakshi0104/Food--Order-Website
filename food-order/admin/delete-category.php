<?php
    //Include Constants File
    include('../config/constants.php');

    //check Whether the id and image name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and Delete 
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name =$_GET['image_name'];

        //Remove the physical image file is available 
        if($image_name!="")
        {
            //Image is Available. so remove it 
            $path = "../images/category/".$image_name;
            //Remove the Image
            $remove = unlink($path);

            //If failed to remove image then and an error messqage and stop the process
            if($remove==false)
            {
               //Set the Session Message 
               $_SESSION['remove']="<div class='error'>Failed to Remove Category Image.</div>";
               //Redirect to Manage Category page
               header('location:'.SITEURL.'admin/manage-category.php');
               //Stop the Process
               die(); 
            }
        }
        //Delete Data from Database
        //Redirect to Manage Category Page with Message 
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the Data is delete from database or not 
        if($res==true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set Fail Message and Redirect 
            $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');

        }


    }
    else
    {
      //redirect to Mnage Category Page
      header('location:'.SITEURL.'admin/manage-category.php');
    }
?>