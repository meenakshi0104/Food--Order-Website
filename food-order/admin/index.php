
<?php include('partials/menu.php'); ?>

    <!--Main-Content Section Start-->
    <div class="main-content">
        <div class ="wrapper">
        <h1>DASHBOARD</h1>
        <div class ="col-4 text-center">

        <?php 

               $sql = "SELECT * FROM tbl_category";
              //execute the Query
               $res = mysqli_query($conn, $sql);

             //Get the value based on query executed
               $count = mysqli_num_rows($res);     

        ?>
            <h1><?php echo $count; ?></h1>
            </br>
            Categories
        </div>

        <div class ="col-4 text-center">

        <?php 

$sql2 = "SELECT * FROM tbl_category";
//execute the Query
$res2 = mysqli_query($conn, $sql2);

//Get the value based on query executed
$count2 = mysqli_num_rows($res2);     

?>
<h1><?php echo $count2; ?></h1>

            </br>
            Foods
        </div>

        <div class ="col-4 text-center">

        <?php 

               $sql3 = "SELECT * FROM tbl_food";
              //execute the Query
               $res3 = mysqli_query($conn, $sql3);

             //Get the value based on query executed
               $count3 = mysqli_num_rows($res3);     

        ?>
            <h1><?php echo $count3; ?></h1>
            
            </br>
            Total Orders
        </div>

        <div class ="col-4 text-center">
            
        <?php 

$sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
//execute the Query
$res4 = mysqli_query($conn, $sql4);

//Get the value based on query executed
$row4 = mysqli_fetch_assoc($res4); 

$total_revenue = $row4['Total'];

?>
<h1>$<?php echo $total_revenue; ?></h1>

            </br>
            Revenue Generate
        </div>
        <div class ="clearfix"></div>
        </div>  
    </div>
    <!--Main-Content Section End-->

<?php include('partials/footer.php'); ?>