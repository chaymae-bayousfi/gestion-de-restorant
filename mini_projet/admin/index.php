<?php include('partials/menu.php'); ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 text-center">
                    <?php 
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                    Categories
                    <h1><?php echo $count; ?></h1>
                    <br />
                </div>
                <div class="col-4 text-center">

                    <?php 
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    Foods
                    <h1><?php echo $count2; ?></h1>
                    <br />
                </div>
                <div class="col-4 text-center">
                    <?php 
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    Total Orders
                    <h1><?php echo $count3; ?></h1>
                    <br />
                </div>
                <div class="col-4 text-center">
                    <?php 
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        $total_revenue = $row4['Total'];
                    ?>
                    Revenue Generated
                    <h1><?php echo $total_revenue; ?> DH</h1>
                    <br />
                </div>

                        <!-- Section pour les plats les plus commandés -->
        <div class="col-12">
            <h2>Top Ordered Foods</h2>
            <table class="tbl-full">
                <thead>
                    <tr>
                        <th>Food</th>
                        <th>Total Quantity Ordered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql5 = "SELECT f.title, SUM(o.qty) AS total_qty 
                                 FROM tbl_food f 
                                 JOIN tbl_order_food of ON f.id = of.food_id 
                                 JOIN tbl_order o ON o.id = of.order_id
                                 WHERE o.status = 'Delivered' 
                                 GROUP BY of.food_id 
                                 ORDER BY total_qty DESC 
                                 LIMIT 5";
                        $res5 = mysqli_query($conn, $sql5);

                        if($res5 && mysqli_num_rows($res5) > 0)
                        {
                            while($row5 = mysqli_fetch_assoc($res5))
                            {
                                echo "<tr>
                                        <td>{$row5['title']}</td>
                                        <td>{$row5['total_qty']}</td>
                                    </tr>";
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='2' class='error'>No Top Foods Found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

                <div class="clearfix"></div>
            </div>
        </div>
<?php include('partials/footer.php') ?>