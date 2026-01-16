<?php
$pageTitle = "Kelola Menu";
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<style>
    :root {
        --latte: #f8f3e9;
        --coffee: #7b4f2c;
        --espresso: #3b2517;
        --cream: #fff8f0;
        --caramel: #d9a066;
    }

    body {
        background: var(--latte);
    }

    .coffee-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--espresso);
    }

    .btn-coffee {
        background: var(--coffee);
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-coffee:hover {
        background: var(--espresso);
        color: #fff;
    }

    .coffee-card {
        background: var(--cream);
        border-radius: 14px;
        margin-top: 20px;
        padding: 20px;
        border-left: 6px solid var(--caramel);
        border-right: 6px solid var(--caramel);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.12);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th {
        background: var(--coffee);
        color: #fff;
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }

    table td {
        padding: 12px;
        border-bottom: 1px solid #e8dccb;
        color: #3a2b1d;
        vertical-align: middle;
    }

    table tr:hover {
        background: #f2e7d8;
    }

    .img-thumb {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--caramel);
        padding: 2px;
        background: var(--cream);
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        margin-right: 5px;
        text-decoration: none;
    }

    .btn-edit {
        background: var(--caramel);
        color: #fff;
    }

    .btn-edit:hover {
        background: #c18a4d;
        color: #fff;
    }

    .btn-delete {
        background: #d9534f;
        color: #fff;
    }

    .btn-delete:hover {
        background: #b8403c;
        color: #fff;
    }
</style>

<div class="container mt-4">

    <h2 class="coffee-title">☕ Kelola Menu</h2>

    <button class="btn-coffee" onclick="location.href='menu_tambah.php'">+ Tambah Menu</button>

    <div class="coffee-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
                $no = 1;
                while ($m = mysqli_fetch_assoc($q)) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td><img src='../image/$m[gambar]' class='img-thumb'></td>
                        <td>$m[nama]</td>
                        <td>Rp " . number_format($m['harga'], 0, ',', '.') . "</td>
                        <td>$m[kategori]</td>
                        <td>
                            <a class='btn-action btn-edit' href='menu_edit.php?id=$m[id]'>Edit</a>
                            <a class='btn-action btn-delete' href='menu_hapus.php?id=$m[id]' onclick=\"return confirm('Hapus menu ini?')\">Hapus</a>
                        </td>
                    </tr>
                    ";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'includes/footer.php'; ?>