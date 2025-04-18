
    <?php include('partials-front/menu.php'); ?>

    <section class="food-search text-center">

        <div class="container">
            <!-- Bouton Go to Cart -->
            <a href="cart.php" class="btn btn-primary">Go to Cart</a>
            <br><br>
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <section class="food-menu">
                <!-- Filtrage par prix -->
        <form method="GET" action="">
            <label for="price-filter">Filtrer par prix :</label>
            <select id="price-filter" name="price" onchange="this.form.submit()">
                <option value="all" <?php if(isset($_GET['price']) && $_GET['price'] == 'all') echo 'selected'; ?>>Tous les prix</option>
                <option value="10-20" <?php if(isset($_GET['price']) && $_GET['price'] == '10-20') echo 'selected'; ?>>10 - 20 DH</option>
                <option value="20-30" <?php if(isset($_GET['price']) && $_GET['price'] == '20-30') echo 'selected'; ?>>20 - 30 DH</option>
                <option value="30-40" <?php if(isset($_GET['price']) && $_GET['price'] == '30-40') echo 'selected'; ?>>30 - 40 DH</option>
                <option value="40-50" <?php if(isset($_GET['price']) && $_GET['price'] == '40-50') echo 'selected'; ?>>40 - 50 DH</option>
            </select>
        </form>

        <!-- Bouton pour réinitialiser le filtre -->
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Réinitialiser le filtre</a>
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                // Vérification du filtre de prix
                $priceFilter = isset($_GET['price']) ? $_GET['price'] : 'all';
                // Construction de la requête SQL selon le filtre sélectionné
                switch ($priceFilter) {
                    case '10-20':
                        $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND price BETWEEN 10 AND 20";
                        break;
                    case '20-30':
                        $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND price BETWEEN 20 AND 30";
                        break;
                    case '30-40':
                        $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND price BETWEEN 30 AND 40";
                        break;
                    case '40-50':
                        $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND price BETWEEN 40 AND 50";
                        break;
                    default:
                        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                        break;
                }
                $res=mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $description; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?>DH</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>
    </section>
   