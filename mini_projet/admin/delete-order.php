<?php
    include('../config/constants.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql_order_food = "DELETE FROM tbl_order_food WHERE order_id=$id";
        $res_order_food = mysqli_query($conn, $sql_order_food);

        if ($res_order_food) {
            $sql_order = "DELETE FROM tbl_order WHERE id=$id";
            $res_order = mysqli_query($conn, $sql_order);

            if ($res_order) {
                $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
            } else {
                $_SESSION['delete'] = "<div class='error'>Failed to Delete Order. Try Again Later.</div>";
            }
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Associated Order Food. Try Again Later.</div>";
        }
    } else {
        $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
    }

    header('location:' . SITEURL . 'admin/manage-order.php');
?>  