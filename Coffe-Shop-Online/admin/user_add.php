<?php
include 'includes/header.php';
include 'includes/sidebar.php';
require '../config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (nama, email, password, role, created_at)
                         VALUES ('$nama', '$email', '$pass', '$role', NOW())");

    echo "<script>alert('User berhasil ditambahkan!');location.href='users.php';</script>";
}
?>

<div class="content">
    <h2 class="fw-bold">Tambah User</h2>

    <div class="card bg-dark text-light mt-3" style="padding:20px;border-radius:12px">
        <form method="post">

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>