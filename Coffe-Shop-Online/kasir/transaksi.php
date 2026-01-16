<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kasir POS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .pos-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            padding: 14px;
            border-radius: 12px;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .4);
            color: #fff;
        }

        label {
            color: #ccc;
        }

        .btn-pos {
            border-radius: 14px;
            font-size: 1.1rem;
            padding: 14px;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">

                <div class="pos-card shadow-lg p-4">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-cash-coin"></i> kasir
                        </h4>
                        <span class="badge bg-success px-3 py-2 rounded-pill">
                            Online
                        </span>
                    </div>

                    <form action="proses_transaksi.php" method="post">

                        <!-- Bayar -->
                        <div class="form-floating mb-4">
                            <input type="number" name="bayar" class="form-control" id="bayar" placeholder="Bayar"
                                required>
                            <label for="bayar">💳 Jumlah Bayar</label>
                        </div>

                        <!-- Produk -->
                        <h6 class="text-white mb-3">🛍️ Produk</h6>

                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="nama[]" class="form-control" id="produk" placeholder="Produk"
                                    required>
                                <label for="produk">Nama Produk</label>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" name="qty[]" class="form-control" id="qty"
                                            placeholder="Qty" required>
                                        <label for="qty">Qty</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" name="harga[]" class="form-control" id="harga"
                                            placeholder="Harga" required>
                                        <label for="harga">Harga</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="d-grid">
                            <button class="btn btn-success btn-pos">
                                <i class="bi bi-printer-fill"></i> Proses & Cetak
                            </button>
                        </div>

                    </form>

                </div>

                <p class="text-center text-white-50 mt-4 small">
                    Pos kasir | By: Ryuzyr
                </p>

            </div>
        </div>
    </div>

</body>

</html>