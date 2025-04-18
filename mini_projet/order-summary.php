<?php include('partials-front/menu.php'); ?>

<?php
// Vérifier l'ID de la commande
if (isset($_GET['order_id'])) {
    isset($_GET['total_price']);
    $order_id = intval($_GET['order_id']); // Sécuriser l'entrée
    $total_price = floatval($_GET['total_price']);
    // Requête SQL pour récupérer les détails de la commande
    $sql = "SELECT 
                o.id AS order_id, 
                o.order_date, 
                o.status,
                o.customer_name, 
                o.customer_contact, 
                o.customer_email, 
                o.customer_city, 
                o.customer_street,
                f.title, 
                o.qty,
                o.price,
                (o.qty * o.price) AS total_price
            FROM tbl_order o
            INNER JOIN tbl_order_food of ON o.id = of.order_id
            INNER JOIN tbl_food f ON of.food_id = f.id
            WHERE o.id = $order_id";

    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $first_order = mysqli_fetch_assoc($res);
?>
        <section class="order-summary">
            <div class="container">
                <h2 class="text-center">Order Summary</h2>
                <table class="order-details">
                    <tr>
                        <th>Customer Name</th>
                        <td><?php echo htmlspecialchars($first_order['customer_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo htmlspecialchars($first_order['customer_contact']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($first_order['customer_email']); ?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><?php echo htmlspecialchars($first_order['customer_city']); ?></td>
                    </tr>
                    <tr>
                        <th>Street</th>
                        <td><?php echo htmlspecialchars($first_order['customer_street']); ?></td>
                    </tr>
                </table>

                <h3>Ordered Food</h3>
                <table class="food-items" border="1">
                    <thead>
                        <tr>
                            <th>Food</th>
                            <th>Quantity</th>
                            <th>Price (DH)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        mysqli_data_seek($res, 0); // Réinitialise le pointeur du résultat
                        $order_total = 0; // Initialiser le total de la commande
                        while ($order = mysqli_fetch_assoc($res)) {
                            $order_total += $order['total_price']; // Ajouter au total de la commande
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['title']); ?></td>
                                <td><?php echo intval($order['qty']); ?></td>
                                <td><?php echo number_format($order['total_price'], 2); ?> DH</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <h3>Total Order Price: <?php echo number_format($order_total, 2); ?> DH</h3>
            </div>
        </section>
<?php
    } else {
        echo "<div class='error'>Order not found.</div>";
    }
} else {
    echo "<div class='error'>Invalid Order ID.</div>";
}
?>
