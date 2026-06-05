<?php
require_once "../config/config.php";
if (isset($_SESSION['username'])) {
    echo "<script>window.location='" . base_url() . "';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login Admin &mdash; Sistem Pakar Gizi Buruk</title>
    <link rel="stylesheet" href="<?= base_url() ?>/libs/Bootstrap-4-4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(145deg, #4952b8, #6777ef, #8b93f5);
            background-size: 300% 300%;
            animation: gradMove 8s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @keyframes gradMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            max-width: 420px;
            width: 90%;
            animation: fadeIn 0.8s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #6777ef, #8b93f5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: #fff;
            font-size: 1.8rem;
            box-shadow: 0 8px 25px rgba(103, 119, 239, 0.3);
        }
        .login-header h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #34395e;
            margin-bottom: 0.25rem;
        }
        .login-header p {
            color: #98a6ad;
            font-size: 0.85rem;
            margin: 0;
        }
        .form-group label {
            font-weight: 700;
            color: #444;
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
        }
        .input-group-custom {
            position: relative;
        }
        .input-group-custom .input-group-prepend .input-group-text {
            background: #f4f6fc;
            border: 2px solid #e3e8f0;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #98a6ad;
            transition: all 0.3s;
        }
        .input-group-custom .form-control {
            border: 2px solid #e3e8f0;
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 12px 16px;
            font-size: 0.95rem;
            height: 50px;
            transition: all 0.3s;
        }
        .input-group-custom .form-control:focus {
            border-color: #6777ef;
            box-shadow: none;
        }
        .input-group-custom:focus-within .input-group-prepend .input-group-text {
            border-color: #6777ef;
        }
        .btn-login {
            background: linear-gradient(135deg, #6777ef, #8b93f5);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 800;
            font-size: 1rem;
            color: #fff;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #4952b8, #6777ef);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(103, 119, 239, 0.4);
        }
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
        }
        .login-footer a {
            color: #6777ef;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        .login-footer a:hover { color: #4952b8; text-decoration: underline; }
        .login-footer .copyright {
            margin-top: 1rem;
            font-size: 0.8rem;
            color: #c5cbd3;
        }
        .alert-custom {
            border-radius: 12px;
            font-size: 0.9rem;
            text-align: center;
            padding: 12px;
            margin-bottom: 1rem;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 1.2rem;
            color: #98a6ad;
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        .back-link:hover { color: #6777ef; text-decoration: none; }
    </style>
</head>
<body>
    <div class="login-card">
        <a href="<?= base_url() ?>" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>

        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1>Login Admin</h1>
            <p>Sistem Pakar Diagnosa Gizi Buruk</p>
        </div>

        <form method="POST" action="">
            <?php
            if (isset($_POST['login'])) {
                $user = trim(mysqli_real_escape_string($con, $_POST['username']));
                $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
                $sql_login = mysqli_query($con, "SELECT * FROM admin WHERE username ='$user' AND password = '$pass'") or die(mysqli_error($con));
                if ($row = mysqli_fetch_array($sql_login)) {
                    $_SESSION['id_admin'] = $row['id_admin'];
                    $_SESSION['username'] = $user;
                    echo "<script>window.location='" . base_url('dashboard/index.php') . "';</script>";
                } else { ?>
                    <div class="alert alert-danger alert-custom">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Login Gagal</strong><br>Username atau Password salah
                    </div>
            <?php
                }
            }
            ?>

            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group input-group-custom">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="username" type="text" class="form-control" name="username" placeholder="Masukkan username" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group input-group-custom">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" name="login" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="login-footer">
            <a href="loginpasien.php"><i class="fas fa-user"></i> Login Sebagai Pasien</a>
            <div class="copyright">
                &copy; <?= date('Y') ?> Sistem Pakar Gizi Buruk
            </div>
        </div>
    </div>

    <script src="<?= base_url('/asset/node_modules/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/asset/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
</body>
</html>
