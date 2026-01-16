<?php
session_start();
require "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$customer_name = $_POST['customer_name'];
$table_number = $_POST['table_number'];
$note = $_POST['note'];

$user_id = $_SESSION['user']['id'];
$cart = $_SESSION['cart'];

$total = 0;
foreach ($cart as $c) {
    $total += $c['harga'] * $c['qty'];
}

// INSERT ke tabel orders
mysqli_query($conn, "
    INSERT INTO orders (user_id, customer_name, table_number, note, total_price, order_date, status)
    VALUES ('$user_id', '$customer_name', '$table_number', '$note', '$total', NOW(), 'pending')
");

$order_id = mysqli_insert_id($conn);

// INSERT ke order_items
foreach ($cart as $id => $c) {
    mysqli_query($conn, "
        INSERT INTO order_items (order_id, menu_id, qty, price)
        VALUES ('$order_id', '$id', '{$c['qty']}', '{$c['harga']}')
    ");
}

// Hapus keranjang
unset($_SESSION['cart']);

echo "<script>
alert('Order berhasil dibuat! Pesanan sedang diproses.');
location.href='order_success.php?id=$order_id';
</script>";
