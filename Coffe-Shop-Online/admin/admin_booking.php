<?php
$conn = new mysqli("localhost", "root", "", "home_coffee");
$result = $conn->query("SELECT * FROM bookings ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin - Booking Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #333;
            color: #fff;
        }
    </style>
</head>

<body>

    <h2>Daftar Booking Masuk</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tamu</th>
            <th>Tanggal</th>
            <th>Telepon</th>
        </tr>

        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['guests']; ?></td>
                <td><?= $row['date']; ?></td>
                <td><?= $row['phone']; ?></td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>