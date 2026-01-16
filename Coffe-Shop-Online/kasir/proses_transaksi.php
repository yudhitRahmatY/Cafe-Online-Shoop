<?php
require_once '../config.php';

// 1️⃣ HITUNG SUBTOTAL
$subtotal = 0;
foreach ($_POST['qty'] as $i => $qty) {
    $harga = $_POST['harga'][$i];
    $subtotal += $qty * $harga;
}

// 2️⃣ PROMO OTOMATIS
$diskon = 0;

$promo = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM promo
    WHERE aktif = 1
    AND min_transaksi <= $subtotal
    ORDER BY min_transaksi DESC
    LIMIT 1
"));

if ($promo) {
    if ($promo['tipe'] == 'persen') {
        $diskon = ($promo['nilai'] / 100) * $subtotal;
    } else {
        $diskon = $promo['nilai'];
    }
}

// 3️⃣ PAJAK
$set = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pajak FROM settings LIMIT 1"));
$pajak = ($set['pajak'] / 100) * $subtotal;

// 4️⃣ TOTAL
$total = $subtotal - $diskon + $pajak;

// 5️⃣ BAYAR & KEMBALIAN
$bayar = $_POST['bayar'];
$kembalian = $bayar - $total;

// VALIDASI UANG KURANG
if ($kembalian < 0) {
    echo "<script>
        alert('Uang bayar kurang!');
        history.back();
    </script>";
    exit;
}

// 6️⃣ SIMPAN TRANSAKSI
mysqli_query($conn, "
    INSERT INTO transaksi
    (tanggal, subtotal, diskon, pajak, total, bayar, kembalian)
    VALUES
    (NOW(), '$subtotal', '$diskon', '$pajak', '$total', '$bayar', '$kembalian')
");

$id_transaksi = mysqli_insert_id($conn);

// 7️⃣ SIMPAN DETAIL TRANSAKSI
foreach ($_POST['qty'] as $i => $qty) {
    $harga = $_POST['harga'][$i];
    $sub = $qty * $harga;

    mysqli_query($conn, "
        INSERT INTO transaksi_detail
        (transaksi_id, nama_produk, qty, harga, subtotal)
        VALUES
        ('$id_transaksi','{$_POST['nama'][$i]}','$qty','$harga','$sub')
    ");
}

// 8️⃣ CETAK STRUK
header("Location: struk.php?id=$id_transaksi");
exit;