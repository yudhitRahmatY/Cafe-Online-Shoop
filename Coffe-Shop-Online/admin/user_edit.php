<?php
include 'includes/header.php';
include 'includes/sidebar.php';
require '../config.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$user = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Jika password diganti
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET nama='$nama', email='$email', role='$role', password='$password' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET nama='$nama', email='$email', role='$role' WHERE id=$id");
    }

    echo "<script>alert('User diperbarui!');location.href='users.php';</script>";
}
?>

<div class="content">
    <h2 class="fw-bold">Edit User</h2>

    <div class="card bg-dark text-light mt-3" style="padding:20px;border-radius:12px">
        <form method="post">

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Password Baru (kosongkan jika tidak ganti)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>