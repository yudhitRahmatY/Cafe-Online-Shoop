<?php
if (!isset($_SESSION))
    session_start();
include __DIR__ . '/../../config.php';

?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?= $pageTitle ?? 'Admin Panel' ?></title>

    <style>
        :root {
            --bg: #0f1724;
            --card: #0b1220;
            --muted: #94a3b8;
            --accent: #c49b63;
            --glass: rgba(255, 255, 255, 0.03);
            --radius: 12px;
            --gap: 16px;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: linear-gradient(180deg, var(--bg) 0%, #071022 100%);
            color: #e6eef8
        }

        .app {
            display: flex;
            min-height: 100vh
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            padding: 28px;
            background: linear-gradient(180deg, var(--card), rgba(8, 12, 18, 0.6));
            backdrop-filter: blur(6px);
            border-right: 1px solid rgba(255, 255, 255, 0.03)
        }

        .brand {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 18px
        }

        .brand img {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.04)
        }

        .brand h1 {
            font-size: 1.25rem;
            margin: 0;
            color: var(--accent)
        }

        .nav {
            margin-top: 12px
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: 8px
        }

        .nav a.active,
        .nav a:hover {
            background: var(--glass);
            color: #fff
        }

        .nav a i {
            width: 20px;
            text-align: center
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 28px
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px
        }

        .search {
            flex: 1;
            max-width: 520px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.03);
            padding: 10px 12px;
            border-radius: 999px
        }

        .search input {
            flex: 1;
            background: transparent;
            border: 0;
            color: var(--muted);
            outline: none
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center
        }

        .btn {
            padding: 8px 12px;
            border-radius: 10px;
            background: linear-gradient(180deg, var(--accent), #9a7a50);
            color: #071022;
            font-weight: 600;
            cursor: pointer
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--gap);
            margin-bottom: 20px
        }

        .card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            padding: 18px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(2, 6, 23, 0.6)
        }

        .k {
            font-size: 1.05rem;
            color: var(--muted)
        }

        .v {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            margin-top: 6px
        }

        /* CARD LAYOUTS */
        .chart-card {
            grid-column: span 2;
            height: 280px;
            display: flex;
            flex-direction: column
        }

        .table-card {
            grid-column: span 2;
            padding: 0
        }

        .menu-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 11px;
            padding: 12px
        }

        .menu-item {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 10px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.03)
        }

        .menu-item img {
            width: 72px;
            height: 56px;
            object-fit: cover;
            border-radius: 8px
        }

        .menu-item h4 {
            margin: 0;
            font-size: 1rem
        }

        .menu-item p {
            margin: 0;
            color: var(--muted);
            font-size: 0.9rem
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            font-size: 0.95rem;
            color: var(--muted)
        }

        th {
            color: #fff
        }

        /* FOOTER */
        .footer {
            margin-top: 24px;
            color: var(--muted);
            font-size: 0.9rem
        }

        /* RESPONSIVE */
        @media (max-width:1100px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .chart-card {
                grid-column: span 2
            }

            .table-card {
                grid-column: span 2
            }
        }

        @media (max-width:700px) {
            .sidebar {
                display: none
            }

            .app {
                flex-direction: column
            }

            .main {
                padding: 18px
            }

            .card-grid {
                grid-template-columns: 1fr
            }

            /* ======== MOBILE IMPROVEMENTS ======== */

            /* TOMBOL MENU (Sidebar Toggle) */
            .mobile-toggle {
                display: none;
                font-size: 22px;
                background: var(--glass);
                padding: 8px 12px;
                border-radius: 8px;
                cursor: pointer;
            }

            @media (max-width: 700px) {

                /* Sidebar auto-hidden */
                .sidebar {
                    display: none;
                    position: fixed;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    width: 240px;
                    z-index: 999;
                    background: linear-gradient(180deg, var(--card), #060b14);
                    padding: 28px;
                    animation: slideIn .25s ease-out;
                }

                /* Sidebar muncul ketika aktif */
                .sidebar.active {
                    display: block;
                }

                @keyframes slideIn {
                    from {
                        transform: translateX(-100%);
                    }

                    to {
                        transform: translateX(0);
                    }
                }

                /* App layout menjadi kolom */
                .app {
                    flex-direction: column;
                }

                .main {
                    padding: 18px;
                }

                /* Tombol menu tampil */
                .mobile-toggle {
                    display: inline-block;
                }

                /* Topbar stacked */
                .topbar {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }

                .search {
                    width: 100%;
                }

                .actions {
                    width: 100%;
                    justify-content: space-between;
                }

                /* Grid menjadi 1 kolom */
                .card-grid {
                    grid-template-columns: 1fr !important;
                }

                /* Menu populer 1 kolom */
                .menu-list {
                    grid-template-columns: 1fr !important;
                }

                /* Tabel lebih mudah dibaca */
                table {
                    font-size: .9rem;
                }

                th,
                td {
                    padding: 10px;
                }
            }
        }
    </style>
</head>

<body>
    <div class="app">