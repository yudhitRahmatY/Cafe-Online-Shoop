<?php
$pageTitle = "Edit Menu";
include 'includes/header.php';
include 'includes/sidebar.php';

$id = $_GET['id'];
$m = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu WHERE id=$id"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    // cek gambar baru
    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../image/" . $gambar);

        mysqli_query($conn, "UPDATE menu SET 
            nama='$nama', harga='$harga', kategori='$kategori', gambar='$gambar'
            WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE menu SET 
            nama='$nama', harga='$harga', kategori='$kategori'
            WHERE id=$id");
    }

    echo "<script>alert('Menu berhasil diperbarui');location.href='menu.php'</script>";
}
?>

<style>
    :root {
        --latte: #f8f3e9;
        --coffee: #7b4f2c;
        --espresso: #3b2517;
        --cream: #fff8f0;
        --caramel: #d9a066;
    }

    .coffee-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--espresso);
    }

    .coffee-card {
        background: var(--cream);
        padding: 25px;
        border-radius: 14px;
        border-left: 6px solid var(--caramel);
        border-right: 6px solid var(--caramel);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        margin-top: 20px;
    }

    .form-label {
        font-weight: 600;
        color: var(--espresso);
    }

    .form-control {
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #d7ccc0;
    }

    .form-control:focus {
        border-color: var(--caramel);
        box-shadow: 0 0 6px rgba(217, 160, 102, 0.4);
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

    .btn-secondary {
        background: #bbb;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
    }

    #img-preview {
        max-width: 170px;
        margin-top: 10px;
        border-radius: 10px;
        border: 3px solid var(--caramel);
        display: block;
    }
</style>

<div class="container mt-4">
    <h2 class="coffee-title">✏️ Edit Menu</h2>

    <div class="coffee-card">

        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama" value="<?= $m['nama'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" value="<?= $m['harga'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" value="<?= $m['kategori'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Menu (opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                <img id="img-preview" src="../image/<?= $m['gambar'] ?>">
            </div>

            <button type="submit" name="update" class="btn-coffee">Update</button>
            <a href="menu.php" class="btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<script>
    function previewImage(event) {
        const image = document.getElementById('img-preview');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = 'block';
    }
</script>

<?php include 'includes/footer.php'; ?>