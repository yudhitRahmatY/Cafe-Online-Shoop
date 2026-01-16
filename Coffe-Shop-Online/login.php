<?php
session_start();

// Jika sudah login, langsung arahkan
if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

$title = "Login | Home Coffee";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #3a2f2f;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 35px 28px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: fadeIn 0.7s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-wrapper h2 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .login-wrapper p {
            color: #ddd;
            margin-bottom: 25px;
        }

        .error-msg {
            background: #e74c3c;
            padding: 10px;
            border-radius: 8px;
            color: #fff;
            margin-bottom: 18px;
            font-size: 1.2rem;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            height: 50px;
            padding-left: 42px;
            border: none;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.88);
            font-size: 1.15rem;
            outline: none;
            transition: 0.3s;
            box-sizing: border-box;
        }

        .input-box input:focus {
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.30);
        }

        .input-box i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            font-size: 1.3rem;
            color: #6b4f4f;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(45deg, #6b3e2e, #a87149);
            color: #fff;
            font-size: 1.3rem;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
            margin-top: 5px;
        }

        .btn-login:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        }

        .extra {
            margin-top: 18px;
            color: #fff;
            font-size: 1rem;
        }

        .extra a {
            color: #ffd9b3;
            font-weight: 600;
            text-decoration: none;
        }

        .extra a:hover {
            color: #fff;
            text-decoration: underline;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <div class="login-wrapper">

        <h2>Welcome Back</h2>
        <p>Silakan masuk untuk melanjutkan</p>

        <!-- Pesan gagal -->
        <?php if (isset($_GET['pesan']) && $_GET['pesan'] === "gagal"): ?>
            <div class="error-msg">Email atau password salah!</div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST">

            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address" required autocomplete="email">
                <i class="fas fa-envelope"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                <i class="fas fa-lock"></i>
            </div>

            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>

        <div class="extra">
            Belum punya akun? <a href="register.php">Daftar</a>
        </div>

    </div>

</body>

</html>