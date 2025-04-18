<?php include('partials-front/menu.php'); ?>
<?php
if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);

    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";
    $total_price = 0; // Initialisation du total
    $total_qty = 0; // Initialisation de la quantité totale

    // Insérer les informations principales dans tbl_order
    $sql_order = "INSERT INTO tbl_order (order_date, status, customer_name, customer_contact, customer_email, customer_city, customer_street, qty, total)
                  VALUES ('$order_date', '$status', '$full_name', '$contact', '$email', '$city', '$street', 0, 0)";
    $res_order = mysqli_query($conn, $sql_order);

    if ($res_order) {
        $order_id = mysqli_insert_id($conn); // Récupérer l'ID de la commande insérée

        // Traitement des plats sélectionnés
        if (isset($_POST['food_ids'])) {
            foreach ($_POST['food_ids'] as $food_id) {
                if (isset($_POST['quantities'][$food_id]) && $_POST['quantities'][$food_id] > 0) {
                    $qty = intval($_POST['quantities'][$food_id]); // Quantité du plat
                    $total_qty += $qty; // Ajouter à la quantité totale

                    // Récupérer le prix du plat
                    $sql_food = "SELECT price FROM tbl_food WHERE id=$food_id";
                    $res_food = mysqli_query($conn, $sql_food);

                    if ($res_food && mysqli_num_rows($res_food) > 0) {
                        $food = mysqli_fetch_assoc($res_food);
                        $price = floatval($food['price']);
                        $total = $qty * $price; // Total pour ce plat
                        $total_price += $total; // Ajouter au total général

                        // Insérer dans tbl_order_food
                        $sql_order_food = "INSERT INTO tbl_order_food (order_id, food_id)
                                           VALUES ($order_id, $food_id)";
                        $res_order_food = mysqli_query($conn, $sql_order_food);

                        if (!$res_order_food) {
                            die("Erreur lors de l'insertion dans tbl_order_food : " . mysqli_error($conn));
                        }
                    }
                }
            }

            // Mettre à jour les totaux dans tbl_order
            $sql_update_order = "UPDATE tbl_order SET qty=$total_qty, total=$total WHERE id=$order_id";
            $res_update_order = mysqli_query($conn, $sql_update_order);

            if (!$res_update_order) {
                die("Erreur lors de la mise à jour de tbl_order : " . mysqli_error($conn));
            }

            // Redirection vers la page de résumé
            $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
            header("Location:".SITEURL."order-summary.php?order_id=".$order_id."&total_price=".$total_price);
            exit();
        }
    } else {
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food. " . mysqli_error($conn) . "</div>";
        header('Location:'.SITEURL);
        exit();
    }
}
?>


<?php
// Vérification des plats disponibles
$sql = "SELECT id, title, price FROM tbl_food WHERE active='Yes'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) == 0) {
    echo "<div class='error'>Aucun plat disponible.</div>";
} else {
    ?>
    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-black">Complete the form to confirm your food selection.</h2>
            <form action="" method="POST" class="order">
                <!-- Section: Sélection des plats -->
                <fieldset>
                    <legend>Select Your Food</legend>
                    <table class="food-table">
                        <thead>
                            <tr>
                                <th>Food</th>
                                <th>Price (DH)</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="food_ids[]" value="<?php echo $row['id']; ?>"> 
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </td>
                                    <td><?php echo number_format($row['price'], 2); ?> DH</td>
                                    <td>
                                        <input type="number" name="quantities[<?php echo $row['id']; ?>]" value="1" min="1" class="input-responsive">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </fieldset>

                <!-- Section: Détails de livraison -->
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. H&C FOODIES" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0XXXXXXXXX" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. HC@gmail.com" class="input-responsive" required>

                    <div class="order-label">City</div>
                    <input type="text" name="city" placeholder="E.g. Khouribga" class="input-responsive" required>

                    <div class="order-label">Street</div>
                    <input type="text" name="street" placeholder="E.g. Nahda" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>
    <?php
}
?>
