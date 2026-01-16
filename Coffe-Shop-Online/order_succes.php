<?php
session_start();
require "config.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$order_id = $_GET['id'];

// Ambil data order
$order = mysqli_query($conn, "
    SELECT * FROM orders WHERE id = '$order_id'
");
$order = mysqli_fetch_assoc($order);

if (!$order) {
    echo "<script>alert('Order tidak ditemukan');location.href='index.php';</script>";
    exit;
}

// Ambil item order
$items = mysqli_query($conn, "
    SELECT oi.*, m.nama AS menu_nama, m.gambar 
    FROM order_items oi
    LEFT JOIN menu m ON oi.menu_id = m.id
    WHERE oi.order_id = '$order_id'
");

include "includes/header.php";
?>

<style>
    body {
        background: #0d0d0d;
        color: #fff;
    }

    .success-container {
        max-width: 750px;
        margin: 130px auto;
        background: #1a1a1a;
        padding: 35px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 0 20px rgba(255, 214, 120, 0.2);
        border: 1px solid #2a2a2a;
    }

    .success-icon {
        font-size: 70px;
        color: #f5d393;
        margin-bottom: 10px;
    }

    .success-title {
        font-size: 2rem;
        font-weight: bold;
        color: #f5d393;
        margin-bottom: 15px;
    }

    .success-desc {
        font-size: 1.1rem;
        color: #ddd;
        margin-bottom: 25px;
    }

    .order-box {
        background: #111;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #2a2a2a;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .order-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 15px;
        border: 2px solid #f5d393;
    }

    .order-item h4 {
        margin: 0;
        color: #f5d393;
        font-size: 1.1rem;
    }

    .item-price {
        color: #bbb;
        font-size: 0.9rem;
    }

    .order-total {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #333;
        font-size: 1.4rem;
        font-weight: bold;
        color: #f5d393;
        text-align: right;
    }

    .btn-home {
        margin-top: 25px;
        padding: 12px 25px;
        background: #f5d393;
        color: #000;
        font-weight: bold;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }

    .btn-home:hover {
        background: #ffe0a8;
    }

    .info-box {
        margin-top: 15px;
        color: #bbb;
    }

    .info-box b {
        color: #f5d393;
    }
</style>

<div class="success-container">

    <div class="success-icon">
        <i class="fas fa-check-circle"></i>
    </div>

    <div class="success-title">Order Berhasil!</div>
    <div class="success-desc">Pesanan kamu sedang diproses. Silakan tunggu dengan nyaman ☕</div>

    <div class="order-box">

        <h3 style="color:#f5d393; margin-bottom: 15px;">Detail Pesanan</h3>

        <?php while ($row = mysqli_fetch_assoc($items)): ?>
            <div class="order-item">
                <img src="image/<?= $row['gambar'] ?>" alt="">
                <div style="text-align: left;">
                    <h4><?= $row['menu_nama'] ?></h4>
                    <div class="item-price">
                        <?= $row['qty'] ?> x Rp <?= number_format($row['price']) ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <div class="order-total">
            Total: Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
        </div>

        <div class="info-box">
            Meja: <b><?= $order['table_number'] ?></b> <br>
            Nama: <b><?= $order['customer_name'] ?></b> <br>
            Status: <b style="color:#60ff92;">Pending</b>
        </div>

    </div>

    <a href="index.php" class="btn-home">Kembali ke Beranda</a>

</div>

<?php include "includes/footer.php"; ?>