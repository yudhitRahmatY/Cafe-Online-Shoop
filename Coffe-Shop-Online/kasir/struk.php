<?php
require_once '../config.php';

$set = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM settings LIMIT 1"));
$trx = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE id='{$_GET['id']}'"));
$item = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id='{$_GET['id']}'");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Struk</title>
    <link rel="stylesheet" href="struk.css">
</head>

<body onload="window.print()">

    <center>
        <b><?= $set['nama_instansi']; ?></b><br>
        <?= nl2br($set['alamat_struk']); ?><br>
        <hr>
    </center>

    <?php while ($i = mysqli_fetch_assoc($item)): ?>
        <?= $i['nama_produk']; ?><br>
        <?= $i['qty']; ?> x <?= number_format($i['harga']); ?>
        <?= number_format($i['subtotal']); ?><br>
    <?php endwhile; ?>

    <hr>
    Subtotal : <?= number_format($trx['subtotal']); ?><br>
    Diskon : <?= number_format($trx['diskon']); ?><br>
    Pajak : <?= number_format($trx['pajak']); ?><br>
    <b>Total : <?= number_format($trx['total']); ?></b>

    <hr>
    <center>Terima Kasih ☕</center>

</body>

</html>