<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "config.php";

echo "DEBUG 1: File terbuka<br>";

// Cek apakah POST masuk
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "DEBUG 2: FORM tidak mengirim POST<br>";
    exit;
}

echo "DEBUG 3: POST diterima<br>";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = $_POST['password'];

echo "DEBUG 4: Email: $email<br>";

// Cari user
$q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (!$q) {
    echo "Query Error: " . mysqli_error($conn);
    exit;
}

$user = mysqli_fetch_assoc($q);

if (!$user) {
    echo "<script>alert('Email tidak ditemukan!');location.href='login.php?pesan=gagal';</script>";
    exit;
}

echo "DEBUG 5: User ditemukan<br>";

// Cek password
if (!password_verify($pass, $user['password'])) {
    echo "<script>alert('Password salah!');location.href='login.php?pesan=gagal';</script>";
    exit;
}

echo "DEBUG 6: Password cocok<br>";

// Set session
$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

echo "DEBUG 7: Session dibuat<br>";

// Redirect
if ($user['role'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit;
} else {
    header("Location: menu.php");
    exit;
}
