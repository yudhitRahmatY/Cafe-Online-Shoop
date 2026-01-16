<?php
$title = "Admin Login";
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='admin'");

    if (mysqli_num_rows($cek) == 1) {
        $_SESSION['admin'] = mysqli_fetch_assoc($cek);
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $error = "Email / Password salah!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="login-box">
    <h1>Admin Login</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email Admin" required />
        <input type="password" name="password" placeholder="Password Admin" required />
        <button type="submit" class="btn">Login</button>
    </form>

</section>

<?php include 'includes/footer.php'; ?>