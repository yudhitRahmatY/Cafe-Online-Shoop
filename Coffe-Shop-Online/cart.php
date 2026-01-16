<?php
session_start();
require "config.php";

// CEK LOGIN — gunakan session yang diset di proses_login.php
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu untuk melihat keranjang!'); location.href='login.php';</script>";
    exit;
}

// Ambil cart dari session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang — Home Coffee</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: #1e1e1e;
        }

        .cart-container {
            max-width: 900px;
            margin: 120px auto;
            padding: 20px;
            background: #292929;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, .4);
            color: #fff;
        }

        .cart-title {
            text-align: center;
            font-size: 2.4rem;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding: 15px;
            background: #333;
            margin-bottom: 15px;
            border-radius: 12px;
            align-items: center;
            transition: .3s;
        }

        .cart-item:hover {
            transform: translateY(-3px);
            background: #3b3b3b;
        }

        .cart-item img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-info {
            flex: 1;
        }

        .cart-info h3 {
            font-size: 1.6rem;
            margin-bottom: 8px;
        }

        .cart-info p {
            font-size: 1.2rem;
            opacity: .7;
        }

        .qty-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            background: #555;
            color: #fff;
            cursor: pointer;
            font-size: 1.3rem;
        }

        .qty-number {
            font-size: 1.2rem;
            width: 28px;
            text-align: center;
        }

        .remove-btn {
            padding: 8px 13px;
            background: #e74c3c;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            transition: .3s;
        }

        .remove-btn:hover {
            background: #c0392b;
        }

        .total-box {
            padding: 20px;
            background: #333;
            border-radius: 12px;
            margin-top: 20px;
        }

        .total-box h2 {
            font-size: 1.8rem;
            display: flex;
            justify-content: space-between;
        }

        .checkout-btn {
            display: block;
            margin-top: 20px;
            width: 100%;
            padding: 15px;
            background: #ff8c42;
            text-align: center;
            color: white;
            border-radius: 10px;
            font-size: 1.3rem;
            text-decoration: none;
            transition: .3s;
        }

        .checkout-btn:hover {
            background: #ff7b22;
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            font-size: 1.4rem;
            opacity: .8;
        }

        .go-menu {
            display: inline-block;
            margin-top: 10px;
            padding: 12px 20px;
            background: #ff8c42;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <?php include "includes/header.php"; ?>

    <div class="cart-container">

        <div class="cart-title">Your Cart</div>

        <?php if (empty($cart)): ?>

            <div class="empty-cart">
                Keranjang masih kosong ☕
                <br>
                <a href="index.php#menu" class="go-menu">Lihat Menu</a>
            </div>

        <?php else: ?>

            <?php
            $grand_total = 0;

            foreach ($cart as $id => $item):

                $img = $item['gambar'] ?? 'no-image.png';
                $total = $item['harga'] * $item['qty'];
                $grand_total += $total;
                ?>

                <div class="cart-item">

                    <img src="image/<?= $img ?>" onerror="this.src='image/no-image.png';" alt="<?= $item['nama'] ?>">

                    <div class="cart-info">
                        <h3><?= $item['nama'] ?></h3>
                        <p>Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                    </div>

                    <div class="qty-box">
                        <form action="cart_update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button class="qty-btn" name="action" value="minus">-</button>
                            <span class="qty-number"><?= $item['qty'] ?></span>
                            <button class="qty-btn" name="action" value="plus">+</button>
                        </form>
                    </div>

                    <a class="remove-btn" href="cart_remove.php?id=<?= $id ?>">Remove</a>

                </div>

            <?php endforeach; ?>

            <div class="total-box">
                <h2>
                    Total
                    <span>Rp <?= number_format($grand_total, 0, ',', '.') ?></span>
                </h2>
            </div>

            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>

        <?php endif; ?>

    </div>

</body>

</html>