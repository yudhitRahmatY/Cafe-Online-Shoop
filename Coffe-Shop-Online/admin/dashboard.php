<?php
$pageTitle = "Dashboard";
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Halaman Isi -->

<main class="main">
    <div class="topbar">
        <div class="search">
            <i style="opacity:.8">🔎</i>
            <input placeholder="Cari menu, order atau user..." />
        </div>
        <div class="actions">
            <div style="text-align:right;margin-right:8px">
                <div style="font-size:.9rem;color:var(--muted)">Admin</div>
                <div style="font-weight:700"><?= $_SESSION['user']['nama'] ?? 'Admin' ?></div>
            </div>
            <button class="btn" onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

    <div class="card-grid">
        <div class="card">
            <div class="k">Total Orders</div>
            <div class="v">1,264</div>
            <div style="margin-top:8px;color:var(--muted);font-size:.95rem">Orders this month</div>
        </div>

        <div class="card">
            <div class="k">Pendapatan</div>
            <div class="v">Rp 24.800.000</div>
            <div style="margin-top:8px;color:var(--muted);font-size:.95rem">Bulan ini</div>
        </div>

        <div class="card">
            <div class="k">Menu</div>
            <div class="v"><?= /* php count menu */ 12 ?></div>
            <div style="margin-top:8px;color:var(--muted);font-size:.95rem">Items aktif</div>
        </div>

        <div class="card">
            <div class="k">Users</div>
            <div class="v">342</div>
            <div style="margin-top:8px;color:var(--muted);font-size:.95rem">Terdaftar</div>
        </div>

        <div class="card chart-card card">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
                <div style="font-weight:700">Penjualan (7 hari)</div>
                <div style="color:var(--muted);font-size:.95rem">Overview</div>
            </div>
            <div
                style="flex:1;background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--muted);">
                <!-- placeholder chart -->
                <div id="chart-placeholder">[Chart area — Integrasi Chart.js bisa ditambahkan]</div>
            </div>
        </div>

        <div class="card table-card">
            <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 16px">
                <div style="font-weight:700">Pesanan Terbaru</div>
                <div style="color:var(--muted)">Lihat semua</div>
            </div>
            <div style="padding:0 12px 12px 12px">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>#A1203</td>
                            <td>Ariel Tatum</td>
                            <td>Rp 46.000</td>
                            <td style="color:#c49b63">Paid</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>#A1202</td>
                            <td>Davina Karamoy</td>
                            <td>Rp 28.000</td>
                            <td style="color:#f59e0b">Preparing</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>#A1199</td>
                            <td>Ryuzz</td>
                            <td>Rp 12.000</td>
                            <td style="color:#ef4444">Canceled</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <div>
                    <div class="k">Promosi aktif</div>
                    <div class="v">3</div>
                </div>
                <div style="font-size:.9rem;color:var(--muted)">Lihat</div>
            </div>
            <div style="margin-top:12px">
                <div style="font-size:.9rem;color:var(--muted)">Flash sale setiap Jumat</div>
            </div>
        </div>

        <div class="card">
            <div class="k">Stok hampir habis</div>
            <div style="margin-top:8px">
                <div style="display:flex;flex-direction:column;gap:6px">
                    <div style="display:flex;justify-content:space-between"><span>Mocca
                            Latte</span><strong>3</strong></div>
                    <div style="display:flex;justify-content:space-between">
                        <span>Espresso</span><strong>2</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="k">Menu Populer</div>
            <div class="menu-list">
                <div class="menu-item"><img src="../image/caffe_latte.jpg" alt="item">
                    <div>
                        <h4>Kopi Latte</h4>
                        <p>Rp 28.000</p>
                    </div>
                </div>
                <div class="menu-item"><img src="../image/matcha_latte.jpg" alt="item">
                    <div>
                        <h4>matcha</h4>
                        <p>Rp 20.000</p>
                    </div>
                    <div class="menu-item"><img src="../image/cold_brew.jpg" alt="item">
                        <div>
                            <h4>Cold Brew</h4>
                            <p>Rp 25.000</p>
                        </div>
                        <div class="menu-item"><img src="../image/americano.jpg" alt="item">
                            <div>
                                <h4>Americano</h4>
                                <p>Rp 15.000</p>
                            </div>
                        </div>`
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">© <?= date('Y') ?> Home Coffee | MR Ryuzz</div>
</main>
</div>

<?php include 'includes/footer.php'; ?>