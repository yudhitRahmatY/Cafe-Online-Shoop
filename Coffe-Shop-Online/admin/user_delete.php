<?php
require '../config.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id = $id");

echo "<script>alert('User dihapus!');location.href='users.php';</script>";
?>