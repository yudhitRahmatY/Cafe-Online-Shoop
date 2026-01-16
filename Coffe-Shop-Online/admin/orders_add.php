<?php
include 'includes/header.php';
include 'includes/sidebar.php';

// Ambil list menu
$menu = mysqli_query($conn, "SELECT * FROM menu");

if (isset($_POST['submit'])) {

    $menu_id = $_POST['id_menu'];
    $jumlah = $_POST['jumlah'];
    $customer_name = $_POST['customer_name']; // kolom wajib berdasarkan tabel

    // Ambil harga menu
    $q = mysqli_query($conn, "SELECT harga FROM menu WHERE id = '$menu_id'");
    $data = mysqli_fetch_assoc($q);
    $harga = $data['harga'];

    $total = $harga * $jumlah;

    // INSERT sesuai struktur tabel orders
    mysqli_query(
        $conn,
        "INSERT INTO orders (menu_id, qty, total_price, customer_name, order_date, status)
         VALUES ('$menu_id', '$jumlah', '$total', '$customer_name', NOW(), 'pending')"
    );

    echo "<script>alert('Order berhasil ditambahkan!'); location.href='orders.php';</script>";
}
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-light" style="letter-spacing: 0.5px;">Tambah Order</h2>
        <a href="orders.php" class="btn btn-secondary px-4" style="border-radius: 10px;">
            ⬅ Kembali
        </a>
    </div>

    <div class="card bg-dark text-light shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body p-4">

            <form method="post">

                <!-- Menu -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px; color:#ccc;">
                        Pilih Menu
                    </label>
                    <select name="id_menu" class="form-control form-select bg-secondary text-light border-0"
                        style="height: 48px; border-radius: 12px;" required>
                        <option value="">— Pilih Menu —</option>
                        <?php while ($m = mysqli_fetch_assoc($menu)): ?>
                            <option value="<?= $m['id'] ?>">
                                <?= $m['nama'] ?> — Rp <?= number_format($m['harga'], 0, ',', '.') ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px; color:#ccc;">
                        Jumlah
                    </label>
                    <input type="number" name="jumlah" class="form-control bg-secondary text-light border-0"
                        placeholder="Masukkan jumlah pesanan" style="height: 48px; border-radius: 12px;" required>
                </div>

                <!-- Nama Customer -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px; color:#ccc;">
                        Nama Customer
                    </label>
                    <input type="text" name="customer_name" class="form-control bg-secondary text-light border-0"
                        placeholder="Masukkan nama pemesan" style="height: 48px; border-radius: 12px;" required>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" name="submit" class="btn btn-primary px-5 py-2 fw-semibold"
                        style="border-radius: 12px;">
                        Simpan Order
                    </button>

                    <a href="orders.php" class="btn btn-outline-light px-4 py-2 fw-semibold"
                        style="border-radius: 12px;">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>