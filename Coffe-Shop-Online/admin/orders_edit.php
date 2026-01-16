<?php
include 'includes/header.php';
include 'includes/sidebar.php';

$id = $_GET['id'];

// Ambil order berdasarkan ID
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id='$id'"));

// Ambil list menu
$menu = mysqli_query($conn, "SELECT * FROM menu");

// Proses update
if (isset($_POST['submit'])) {
    $menu_id = $_POST['menu_id'];
    $qty = $_POST['qty'];
    $customer_name = $_POST['customer_name'];
    $status = $_POST['status'];

    // Ambil harga menu
    $m = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM menu WHERE id='$menu_id'"));
    $harga = $m['harga'];
    $total = $harga * $qty;

    mysqli_query($conn, "
        UPDATE orders SET 
            menu_id='$menu_id', 
            qty='$qty',
            total_price='$total',
            customer_name='$customer_name',
            status='$status'
        WHERE id='$id'
    ");

    echo "<script>alert('Order berhasil diperbarui!'); location.href='orders.php';</script>";
}
?>

<div class="container mt-4">
    <h2 class="text-light fw-bold mb-4">Edit Order</h2>

    <div class="card bg-dark text-light shadow-sm border-0 p-4" style="border-radius:15px;">

        <form method="post">

            <!-- Menu -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Menu</label>
                <select name="menu_id" class="form-control bg-secondary text-light border-0" required>
                    <?php while ($m = mysqli_fetch_assoc($menu)): ?>
                        <option value="<?= $m['id'] ?>" <?= $m['id'] == $order['menu_id'] ? 'selected' : '' ?>>
                            <?= $m['nama'] ?> - Rp <?= number_format($m['harga']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Qty -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jumlah</label>
                <input type="number" name="qty" class="form-control bg-secondary text-light border-0"
                    value="<?= $order['qty'] ?>" required>
            </div>

            <!-- Customer Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Customer</label>
                <input type="text" name="customer_name" class="form-control bg-secondary text-light border-0"
                    value="<?= $order['customer_name'] ?>" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-control bg-secondary text-light border-0" required>
                    <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex gap-2 mt-4">
                <button type="submit" name="submit" class="btn btn-primary px-5 py-2 fw-semibold"
                    style="border-radius:12px;">
                    Update Order
                </button>
                <a href="orders.php" class="btn btn-outline-light px-4 py-2 fw-semibold" style="border-radius:12px;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

<?php include 'includes/footer.php'; ?>