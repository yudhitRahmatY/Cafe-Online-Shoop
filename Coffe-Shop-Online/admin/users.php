<?php
$pageTitle = "Users";
include 'includes/header.php';
include 'includes/sidebar.php';
require '../config.php';

// Ambil semua user
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<div class="content">
    <div class="page-header">
        <h2 class="fw-bold">Manajemen Users</h2>
        <a href="user_add.php" class="btn btn-primary">+ Tambah User</a>
    </div>

    <div class="card bg-dark text-light mt-3" style="padding:20px;border-radius:12px">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($u = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['role'] ?></td>
                        <td><?= $u['created_at'] ?></td>
                        <td>
                            <a href="user_edit.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="user_delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>