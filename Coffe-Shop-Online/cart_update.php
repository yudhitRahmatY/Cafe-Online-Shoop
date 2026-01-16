<?php
session_start();

// CEK LOGIN
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!');location.href='login.php';</script>";
    exit;
}

// CEK POST
if (!isset($_POST['id']) || !isset($_POST['action'])) {
    header("Location: cart.php");
    exit;
}

$id = $_POST['id'];
$action = $_POST['action'];

// CEK ITEM ADA DI CART
if (!isset($_SESSION['cart'][$id])) {
    header("Location: cart.php");
    exit;
}

// UPDATE QTY
if ($action == "plus") {

    $_SESSION['cart'][$id]['qty'] += 1;

} elseif ($action == "minus") {

    $_SESSION['cart'][$id]['qty'] -= 1;

    if ($_SESSION['cart'][$id]['qty'] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}

// BALIK KE CART
header("Location: cart.php");
exit;
