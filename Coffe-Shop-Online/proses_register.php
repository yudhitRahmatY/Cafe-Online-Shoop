<?php
session_start();
include 'config.php';

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = 'user';

// Insert data
$query = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $nama, $email, $password, $role);

if ($stmt->execute()) {

    // AUTO LOGIN SETELAH REGISTER
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
    $_SESSION['logged_in'] = true;

    header("Location: index.php");
    exit;
} else {
    echo "Gagal Register: " . $stmt->error;
}
