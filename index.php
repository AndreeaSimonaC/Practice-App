<?php
    include_once 'dbconnection.php';
    session_start();
    ?>

    <!-- Register/Login button -->

    <?php
    if (!isset($_SESSION['loggedIn'])) : ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php endif; ?>


    <!-- Login/Logout button -->
    <?php
    if (isset($_SESSION['loggedIn'])) : ?>
        <form method="post" action="logout.php">
            <input type="submit" name="logout" value="Logout">
        </form>


    <?php endif; ?>

    <!-- Admin button -->
    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['role'] === 'admin') : ?>
        <a href="admin.php">Admin</a>
    <?php endif; ?>

    <!-- Shop button -->

    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['role'] === 'user') : ?>
        <a href="shop.php">Shop</a>
    <?php endif; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice-MySQL</title>
</head>

<body>



</body>

</html>