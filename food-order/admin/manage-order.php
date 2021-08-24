<?php include('partials/menu.php'); ?>

    <!--Main-Content Section Start-->
    <div class="main-content">
        <div class ="wrapper">
        <h1>Manage Order</h1>
        
</br></br><br>
   
    <?php 
              if(isset($_SESSION['update']))//Check Whether the Page is Set or Not
              {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
              }
    ?>
<br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
           
            <?php 
                
                //Create a SQL Query to Get all the food
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

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
                    $food=$row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total=$row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address=$row['customer_address'];
                   ?>
                   

              <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $food; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $total; ?></td>
                    <td><?php echo $order_date; ?></td>

                    <td>
                       <?php
                         if($status=="Ordered")
                         {
                             echo "<label>$status</label>";
                         }
                         if($status=="On Delivery")
                         {
                             echo "<label style='color: orange;'>$status</label>";
                         }
                         if($status=="Delivered")
                         {
                             echo "<label style='color: green;'>$status</label>";
                         }
                         if($status=="Cancelled")
                         {
                             echo "<label style='color: red;'>$status</label>";
                         }
                         
                        ?>
                     </td>

                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $customer_contact; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_address; ?></td>
                    
                     <td>
                        <a href ="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class ="btn-secondary">Update Order</a>
                     </td>
                </tr>
                <?php
                }
            }
            else
            {
                //Order not Available 
                echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";

            }
            ?>
 
        </table>
    </div>
    </div>  
    <!--Main-Content Section End-->

<?php include('partials/footer.php'); ?>