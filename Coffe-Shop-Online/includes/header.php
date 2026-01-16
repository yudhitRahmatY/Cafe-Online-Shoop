<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cart_count = isset($_SESSION['cart'])
    ? array_sum(array_column($_SESSION['cart'], 'qty'))
    : 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'Home Coffee' ?></title>

    <!-- SWIPER -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header class="header">
        <div id="menu-btn" class="fas fa-bars"></div>

        <!-- LOGO -->
        <a href="index.php" class="logo">
            Home Coffee <i class="fas fa-mug-hot"></i>
        </a>

        <!-- NAVBAR -->
        <nav class="navbar">
            <a href="index.php#home">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#menu">Menu</a>
            <a href="index.php#review">Review</a>
            <a href="index.php#book">Book</a>
        </nav>

        <div class="auth-area">

            <?php if (isset($_SESSION['user'])): ?>

                <!-- NAMA USER -->
                <span class="user-greet">Hi, <?= $_SESSION['user']['nama'] ?></span>

                <!-- CART ICON -->
                <a href="cart.php" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if ($cart_count > 0): ?>
                        <span class="cart-badge"><?= $cart_count ?></span>
                    <?php endif; ?>
                </a>

                <!-- BOOKING -->
                <a href="index.php#book" class="btn book-btn">Booking</a>

                <!-- LOGOUT -->
                <a href="logout.php" class="btn logout">Logout</a>

            <?php elseif (isset($_SESSION['admin'])): ?>

                <!-- ADMIN MODE -->
                <span class="user-greet">Admin</span>
                <a href="admin/dashboard.php" class="btn admin-btn">Admin Panel</a>
                <a href="logout.php" class="btn logout">Logout</a>

            <?php else: ?>

                <!-- BELUM LOGIN -->
                <a href="login.php" class="btn">Sign In</a>
                <a href="index.php#book" class="btn book-btn">Booking</a>

            <?php endif; ?>

        </div>
    </header>