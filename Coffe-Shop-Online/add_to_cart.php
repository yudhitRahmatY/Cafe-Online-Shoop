<?php
session_start();
include 'config.php';

// ambil id menu dari POST/GET
$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    echo "<script>alert('Menu tidak valid!'); location.href='menu.php';</script>";
    exit;
}

// validasi menu
$cek = mysqli_query($conn, "SELECT * FROM menu WHERE id='$id'");
if (mysqli_num_rows($cek) === 0) {
    echo "<script>alert('Menu tidak ditemukan!'); location.href='menu.php';</script>";
    exit;
}

$menu = mysqli_fetch_assoc($cek);

// pastikan keranjang sudah ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// jika sudah ada, tambah jumlah
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    $_SESSION['cart'][$id] = [
        'id' => $menu['id'],
        'nama' => $menu['nama'],
        'harga' => $menu['harga'],
        'qty' => 1
    ];
}

echo "<script>alert('Berhasil ditambahkan ke keranjang!'); location.href='cart.php';</script>";
exit;
?>