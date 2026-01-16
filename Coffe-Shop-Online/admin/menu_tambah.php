<?php
$pageTitle = "Tambah Menu";
include 'includes/header.php';
include 'includes/sidebar.php';

if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../image/" . $gambar);

    mysqli_query($conn, "INSERT INTO menu (nama, harga, kategori, gambar)
                         VALUES('$nama', '$harga', '$kategori', '$gambar')");

    echo "<script>alert('Menu berhasil ditambah');location.href='menu.php'</script>";
}
?>

<style>
    /* ========  COLOR PALETTE (Coffee Theme)  ======== */
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

    .coffee-card {
        border-radius: 14px;
        background: var(--cream);
        padding: 35px;
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.10);
        border-left: 6px solid var(--caramel);
        border-right: 6px solid var(--caramel);
    }

    h2.section-title {
        font-weight: 700;
        font-size: 26px;
        color: var(--espresso);
    }

    label.form-label {
        font-weight: 600;
        color: var(--coffee);
    }

    .form-control {
        height: 45px;
        border-radius: 12px;
        border: 2px solid #e0d6c8;
        background: #fffdf9;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: var(--caramel);
        box-shadow: 0 0 5px rgba(217, 160, 102, 0.4);
    }

    .btn-primary {
        padding: 12px 26px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        background: var(--coffee);
    }

    .btn-primary:hover {
        background: var(--espresso);
    }

    .btn-secondary {
        padding: 12px 26px;
        border-radius: 12px;
        font-weight: 600;
        background: #dad0c2;
        border: none;
        color: #333;
    }

    #img-preview {
        width: 190px;
        height: 190px;
        object-fit: cover;
        border-radius: 12px;
        display: none;
        border: 4px solid var(--caramel);
        padding: 3px;
        background: var(--cream);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .divider {
        height: 2px;
        background: var(--caramel);
        opacity: 0.3;
        margin: 25px 0;
        border-radius: 2px;
    }
</style>

<div class="container mt-4">
    <h2 class="section-title mb-4">☕ Tambah Menu Baru</h2>

    <div class="coffee-card">

        <form method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Caramel Latte"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" placeholder="Masukkan harga menu"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" placeholder="Coffee, Non Coffee, Snack"
                            required>
                    </div>

                </div>

                <div class="col-md-6 text-center">
                    <label class="form-label">Upload Gambar</label>
                    <input type="file" name="gambar" class="form-control mb-3" accept="image/*" required
                        onchange="previewImage(event)">

                    <img id="img-preview" alt="Preview Gambar">
                </div>
            </div>

            <div class="divider"></div>

            <div class="text-end">
                <button type="submit" name="save" class="btn btn-primary">Simpan Menu</button>
                <a href="menu.php" class="btn btn-secondary">Kembali</a>
            </div>

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