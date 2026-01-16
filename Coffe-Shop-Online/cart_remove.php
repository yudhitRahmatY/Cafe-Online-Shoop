<?php
session_start();

// CEK LOGIN
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!');location.href='login.php';</script>";
    exit;
}

// CEK ID DI URL
if (!isset($_GET['id'])) {
    header("Location: cart.php");
    exit;
}

$id = $_GET['id'];

// HAPUS ITEM DARI CART
if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}

// KEMBALI KE CART
header("Location: cart.php");
exit;
