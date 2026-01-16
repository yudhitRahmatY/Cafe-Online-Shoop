<?php
$conn = new mysqli("localhost", "root", "", "home_caffe");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO bookings (name, guests, date, phone)
            VALUES ('$name', '$guests', '$date', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>