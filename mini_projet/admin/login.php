<?php include('../config/constants.php'); ?>
<html>
<head>
    <title>Login - Food Order System</title>
    <!-- Importation du CSS -->
    <link rel="stylesheet" href="../css/login.css">
    <!-- Ajout des polices pour améliorer le style -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login">
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="submit">Login</button>
        </form>
        <p class="text-center">Created By - H&C FOODIES</p>
    </div>
</body>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']); 
        $raw_password = $_POST['password'];
        $password = mysqli_real_escape_string($conn, $raw_password);
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>