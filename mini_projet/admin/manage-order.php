<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
                <br /><br /><br />
                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                ?>
                <br><br>
                <div class="table-container">
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food Title</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order_Date</th>
                        <th>Status</th>
                        <th>Customer_Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                         $sql = "SELECT o.*, f.title AS food_title 
                         FROM tbl_order o
                         JOIN tbl_order_food of ON o.id = of.order_id
                         JOIN tbl_food f ON of.food_id = f.id
                         ORDER BY o.id DESC";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $food_title = $row['food_title'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_city = $row['customer_city'];
                                $customer_street = $row['customer_street'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $food_title; ?>. </td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td>
                                            <?php 
                                                switch ($status) {
                                                    case "Ordered":
                                                        echo "<label>$status</label>";
                                                        break;
                                                    case "On Delivery":
                                                        echo "<label style='color: orange;'>$status</label>";
                                                        break;
                
                                                    case "Delivered":
                                                        echo "<label style='color: green;'>$status</label>";
                                                        break;
                                                    case "Cancelled":
                                                        echo "<label style='color: red;'>$status</label>";
                                                        break;
                                                    default:
                                                        echo "<label>$status</label>";
                                                        break;
                                                }
                                            ?>
                                    </td>


                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_city . ', ' . $customer_street; ?></td>

                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete Order</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                        }
                    ?>
                    
                </table>
                </div>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>