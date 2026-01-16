<?php
session_start();
require "config.php";

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login untuk melanjutkan checkout!');location.href='login.php';</script>";
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<script>alert('Keranjang kamu masih kosong!');location.href='cart.php';</script>";
    exit;
}

$total = 0;
foreach ($cart as $c) {
    $total += $c['harga'] * $c['qty'];
}

include "includes/header.php";
?>

<style>
    body {
        background: #0f0f0f;
    }

    .checkout-container {
        max-width: 900px;
        margin: 130px auto;
        background: #1a1a1a;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .checkout-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 25px;
        font-weight: bold;
        color: #f5d393;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .checkout-card {
        background: #111;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #2a2a2a;
    }

    .checkout-card h3 {
        color: #f5d393;
        margin-bottom: 15px;
        font-size: 1.3rem;
    }

    label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #444;
        background: #222;
        color: #fff;
        margin-bottom: 15px;
    }

    .order-summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .checkout-total {
        text-align: right;
        margin-top: 15px;
        border-top: 1px solid #444;
        padding-top: 15px;
        font-size: 1.3rem;
        font-weight: bold;
        color: #f5d393;
    }

    .btn-checkout {
        width: 100%;
        padding: 12px;
        margin-top: 20px;
        background: #f5d393;
        color: #000;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    .btn-checkout:hover {
        background: #ffe2a3;
    }
</style>

<div class="checkout-container">

    <h2 class="checkout-title">Checkout Order</h2>

    <form action="checkout_process.php" method="post">

        <div class="checkout-grid">

            <!-- FORM DATA CUSTOMER -->
            <div class="checkout-card">
                <h3>Customer Details</h3>

                <label>Nama Lengkap</label>
                <input type="text" name="customer_name" required>

                <label>Nomor Meja</label>
                <input type="text" name="table_number" placeholder="Contoh: A1 / 05" required>

                <label>Catatan (opsional)</label>
                <textarea name="note" rows="4" placeholder="Contoh: Kurangi gula, es sedikit..."></textarea>
            </div>

            <!-- RINGKASAN PESANAN -->
            <div class="checkout-card">
                <h3>Order Summary</h3>

                <?php foreach ($cart as $id => $c): ?>
                    <div class="order-summary-item">
                        <span><?= $c['nama'] ?> x <?= $c['qty'] ?></span>
                        <span>Rp <?= number_format($c['harga'] * $c['qty'], 0, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>

                <div class="checkout-total">
                    Total: Rp <?= number_format($total, 0, ',', '.') ?>
                </div>
            </div>

        </div>

        <button type="submit" name="checkout" class="btn-checkout">Proses Pembayaran</button>

    </form>

</div>

<?php include "includes/footer.php"; ?>