<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config.php'; // koneksi DB

$query = mysqli_query($conn, "
    SELECT o.id, o.menu_id, o.qty, o.total_price, o.order_date, o.status, o.customer_name,
           m.nama AS menu_nama
    FROM orders o
    LEFT JOIN menu m ON o.menu_id = m.id
    ORDER BY o.id DESC
");
?>

<style>
    :root {
        --dark-bg: #1e1e1e;
        --dark-card: #2a2a2a;
        --primary: #d9a066;
        /* caramel */
        --secondary: #7b4f2c;
        /* coffee */
        --text-light: #f5f5f5;
        --text-muted: #bfbfbf;
        --status-pending: #ffcc57;
        --status-complete: #46c36f;
        --status-cancel: #e05454;
    }

    body {
        background-color: var(--dark-bg);
        color: var(--text-light);
    }

    .coffee-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-light);
    }

    .btn-coffee {
        background: var(--primary);
        color: #1e1e1e;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-coffee:hover {
        background: var(--secondary);
        color: #fff;
    }

    .coffee-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 15px;
        border-left: 4px solid var(--primary);
        border-right: 4px solid var(--primary);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.4);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        color: var(--text-light);
    }

    table thead {
        background: var(--secondary);
        color: #fff;
    }

    table th,
    table td {
        padding: 12px;
        vertical-align: middle;
    }

    table tbody tr:hover {
        background: #3a3a3a;
    }

    .badge-pending {
        background: var(--status-pending);
        color: #1e1e1e;
        padding: 6px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .badge-complete {
        background: var(--status-complete);
        color: #fff;
        padding: 6px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .badge-cancel {
        background: var(--status-cancel);
        color: #fff;
        padding: 6px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .btn-edit {
        padding: 6px 12px;
        background: var(--primary);
        color: #1e1e1e;
        border-radius: 8px;
        border: none;
        font-weight: 600;
    }

    .btn-edit:hover {
        background: var(--secondary);
        color: #fff;
    }

    .btn-delete {
        padding: 6px 12px;
        background: var(--status-cancel);
        color: #fff;
        border-radius: 8px;
        border: none;
        font-weight: 600;
    }

    .btn-delete:hover {
        background: #b8433f;
    }
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2 class="coffee-title">📦 Orders</h2>
        <a href="orders_add.php" class="btn-coffee">+ Tambah Order</a>
    </div>

    <div class="coffee-card">
        <table class="table table-bordered mb-0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                    <th>Pemesan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['menu_nama']; ?></td>
                            <td><?= $row['qty']; ?></td>
                            <td>Rp <?= number_format($row['total_price']); ?></td>
                            <td><?= $row['customer_name'] ?: '-'; ?></td>
                            <td><?= $row['order_date']; ?></td>

                            <td>
                                <?php if ($row['status'] == 'pending'): ?>
                                    <span class="badge-pending">Pending</span>
                                <?php elseif ($row['status'] == 'completed'): ?>
                                    <span class="badge-complete">Completed</span>
                                <?php else: ?>
                                    <span class="badge-cancel">Cancelled</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="orders_edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                                <a href="orders_delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin hapus?')"
                                    class="btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data order.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<?php include 'includes/footer.php'; ?>