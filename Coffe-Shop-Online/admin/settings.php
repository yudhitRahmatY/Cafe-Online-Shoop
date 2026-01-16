<?php
require_once '../config.php';

// Ambil setting
$setting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM settings LIMIT 1"));

// SIMPAN SETTING APLIKASI
if (isset($_POST['simpan_setting'])) {

    $logo = $setting['logo'];

    if (!empty($_FILES['logo']['name'])) {
        $logo = time() . '_' . $_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'], 'uploads/' . $logo);
    }

    mysqli_query($conn, "UPDATE settings SET
        nama_aplikasi = '{$_POST['nama_aplikasi']}',
        nama_instansi = '{$_POST['nama_instansi']}',
        email         = '{$_POST['email']}',
        no_telp       = '{$_POST['no_telp']}',
        alamat        = '{$_POST['alamat']}',
        tema          = '{$_POST['tema']}',
        logo          = '$logo',
        pajak         = '{$_POST['pajak']}',
        jam_buka      = '{$_POST['jam_buka']}',
        jam_tutup     = '{$_POST['jam_tutup']}',
        alamat_struk  = '{$_POST['alamat_struk']}'
    WHERE id = '{$setting['id']}'");

    echo "<script>
        Swal.fire('Berhasil','Setting aplikasi berhasil disimpan','success')
        .then(()=>location='settings.php');
    </script>";
}

// GANTI PASSWORD ADMIN
if (isset($_POST['ganti_password'])) {

    $admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin LIMIT 1"));

    if (!password_verify($_POST['password_lama'], $admin['password'])) {
        echo "<script>Swal.fire('Gagal','Password lama salah','error')</script>";
    } elseif ($_POST['password_baru'] != $_POST['konfirmasi']) {
        echo "<script>Swal.fire('Gagal','Konfirmasi password tidak sama','error')</script>";
    } else {
        $hash = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE admin SET password='$hash' WHERE id='{$admin['id']}'");

        echo "<script>
            Swal.fire('Berhasil','Password berhasil diubah','success')
            .then(()=>location='settings.php');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Setting Aplikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-dark text-light">

    <div class="container mt-4">

        <!-- SETTING APLIKASI -->
        <div class="card bg-secondary text-light shadow border-0 mb-4">
            <div class="card-header bg-black">
                ⚙️ Setting Aplikasi & Bisnis
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-8">

                            <div class="mb-2">
                                <label class="form-label">Nama Aplikasi</label>
                                <input type="text" name="nama_aplikasi" class="form-control"
                                    value="<?= $setting['nama_aplikasi']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Nama Cafe</label>
                                <input type="text" name="nama_instansi" class="form-control"
                                    value="<?= $setting['nama_instansi']; ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?= $setting['email']; ?>">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="no_telp" class="form-control"
                                        value="<?= $setting['no_telp']; ?>">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Alamat Cafe</label>
                                <textarea name="alamat" class="form-control"
                                    rows="2"><?= $setting['alamat']; ?></textarea>
                            </div>

                            <hr class="border-light">

                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Pajak (%)</label>
                                    <input type="number" name="pajak" class="form-control"
                                        value="<?= $setting['pajak']; ?>" min="0" max="100">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Jam Buka</label>
                                    <input type="time" name="jam_buka" class="form-control"
                                        value="<?= $setting['jam_buka']; ?>">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Jam Tutup</label>
                                    <input type="time" name="jam_tutup" class="form-control"
                                        value="<?= $setting['jam_tutup']; ?>">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Alamat Struk</label>
                                <textarea name="alamat_struk" class="form-control"
                                    rows="3"><?= $setting['alamat_struk']; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tema</label>
                                <select name="tema" class="form-select">
                                    <option value="dark" <?= $setting['tema'] == 'dark' ? 'selected' : '' ?>>Dark</option>
                                    <option value="light" <?= $setting['tema'] == 'light' ? 'selected' : '' ?>>Light</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-4 text-center">
                            <label class="form-label">Logo Cafe</label><br>
                            <?php if ($setting['logo']): ?>
                                <img src="uploads/<?= $setting['logo']; ?>" class="img-fluid rounded mb-2">
                            <?php endif; ?>
                            <input type="file" name="logo" class="form-control">
                        </div>
                    </div>

                    <button name="simpan_setting" class="btn btn-dark w-100 mt-3">
                        💾 Simpan Setting
                    </button>

                </form>
            </div>
        </div>

        <!-- GANTI PASSWORD -->
        <div class="card bg-secondary text-light shadow border-0">
            <div class="card-header bg-black">
                🔐 Ganti Password Admin
            </div>
            <div class="card-body">
                <form method="post">
                    <input type="password" name="password_lama" class="form-control mb-2" placeholder="Password Lama"
                        required>
                    <input type="password" name="password_baru" class="form-control mb-2" placeholder="Password Baru"
                        required>
                    <input type="password" name="konfirmasi" class="form-control mb-3" placeholder="Konfirmasi Password"
                        required>

                    <button name="ganti_password" class="btn btn-danger w-100">
                        🔄 Ganti Password
                    </button>
                </form>
            </div>
        </div>

    </div>

</body>

</html>