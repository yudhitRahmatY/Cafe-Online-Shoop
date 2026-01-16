<?php
include 'includes/header.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM orders WHERE id_order='$id'");

echo "<script>alert('Order berhasil dihapus!'); location.href='orders.php';</script>";
