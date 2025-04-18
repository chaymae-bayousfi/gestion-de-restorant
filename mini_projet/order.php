
<?php include('partials-front/menu.php'); ?>

<?php 
if(isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);

    if($res === false) {
        die("Erreur lors de la requête SQL : " . mysqli_error($conn));
    }

    $count = mysqli_num_rows($res);
    if($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:'.SITEURL);
    }
} else {
    header('location:'.SITEURL);
}
?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-black">Complete the form to confirm your food selection.</h2>
        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <div class="image-container">
                        <?php 
                        if($image_name == "") {
                            echo "<div class='error'>Aucune image disponible pour ce plat.</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">

                        <p class="food-price"><?php echo $price; ?> DH</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>  
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. H&C FOODIES" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0XXXXXXXXX" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. HC@gmail.com" class="input-responsive" required>

                    <div class="order-label">City</div>
                    <input type="text" name="city" placeholder="E.g. khouribga" class="input-responsive" required>

                    <div class="order-label">Street</div>
                    <input type="text" name="street" placeholder="E.g. nahda" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>

<?php 
if (isset($_POST['submit'])) {
    // Récupération des données
    $food_id = $_POST['food_id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered"; // Status par défaut

    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_city = $_POST['city'];
    $customer_street = $_POST['street'];

    // Vérification que food_id existe
    $sql_check_food = "SELECT id FROM tbl_food WHERE id = $food_id";
    $res_check_food = mysqli_query($conn, $sql_check_food);

    if ($res_check_food === false) {
        die("Erreur de requête SQL : " . mysqli_error($conn));
    }

    if (mysqli_num_rows($res_check_food) == 0) {
        die("Erreur : Food ID $food_id n'existe pas dans la table tbl_food.");
    }

    // Requête pour insérer dans tbl_order
    $sql_order = "INSERT INTO tbl_order SET 
        price = $price,
        qty = $qty,
        total = $total,
        order_date = '$order_date',
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_city = '$customer_city',
        customer_street = '$customer_street'";

    $res_order = mysqli_query($conn, $sql_order);

    if ($res_order) {
        // Récupération de l'order_id
        $order_id = mysqli_insert_id($conn);

        // Requête pour insérer dans tbl_order_food
        $sql_order_food = "INSERT INTO tbl_order_food SET 
            order_id = $order_id,
            food_id = $food_id";

        $res_order_food = mysqli_query($conn, $sql_order_food);

        if ($res_order_food) {
            $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
            header('location:' . SITEURL);
        } else {
            die("Erreur lors de l'insertion dans tbl_order_food : " . mysqli_error($conn));
        }
    } else {
        die("Erreur lors de l'insertion dans tbl_order : " . mysqli_error($conn));
    }
}
?>
