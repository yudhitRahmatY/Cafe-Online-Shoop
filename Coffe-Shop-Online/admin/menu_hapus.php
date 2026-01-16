<?php
include '../config.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM menu WHERE id=$id");

echo "<script>alert('Menu dihapus');location.href='menu.php'</script>";
