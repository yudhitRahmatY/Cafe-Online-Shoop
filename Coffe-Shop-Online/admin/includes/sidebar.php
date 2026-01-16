<aside class="sidebar">
    <div class="brand">
        <img src="../image/about-img.png" alt="logo">
        <div>
            <h1>Home Coffee</h1>
            <div style="font-size:.85rem;color:var(--muted)">Admin Panel</div>
        </div>
    </div>

    <nav class="nav">
        <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
            <i>🏠</i> Dashboard
        </a>

        <a href="menu.php" class="<?= basename($_SERVER['PHP_SELF']) == 'menu.php' ? 'active' : '' ?>">
            <i>☕</i> Menu
        </a>

        <a href="orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">
            <i>🧾</i> Orders
        </a>

        <a href="users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">
            <i>👥</i> Users
        </a>

        <a href="settings.php" class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
            <i>⚙️</i> Settings
        </a>
        <a href="../kasir/transaksi.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'active' : '' ?>">
            <i>🛒</i> Kasir
        </a>
    </nav>

    <div style="position:relative;margin-top:18px">
        <button class="btn" onclick="location.href='../index.php'">View Site</button>
    </div>
</aside>

<main class="main">