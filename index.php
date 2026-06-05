<?php
require_once "config/config.php";
if (isset($_SESSION['username']) && !isset($_SESSION['usernamepasien'])) {
    echo "<script>window.location='" . base_url('dashboard/index.php') . "';</script>";
    exit;
}
if (isset($_SESSION['usernamepasien'])) {
    echo "<script>window.location='" . base_url('dashboard/indexpasien.php') . "';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sistem Pakar Diagnosa Gizi Buruk</title>
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
            overflow: hidden;
        }
        @keyframes gradMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .splash {
            text-align: center;
            padding: 2rem;
            animation: fadeScale 0.8s ease;
        }
        @keyframes fadeScale {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .logo-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: linear-gradient(135deg, #fff, #e8eaff);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            position: relative;
        }
        .logo-circle .fa-child {
            font-size: 3.5rem;
            color: #6777ef;
            position: relative;
            z-index: 2;
        }
        .logo-circle .fa-plus-circle {
            font-size: 1.5rem;
            color: #fc544b;
            position: absolute;
            top: 28px;
            right: 24px;
            z-index: 3;
        }
        .logo-circle .fa-heartbeat {
            font-size: 1.3rem;
            color: #fc544b;
            position: absolute;
            bottom: 28px;
            left: 26px;
            z-index: 3;
            animation: pulse 1.2s ease infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.25); opacity: 0.7; }
        }
        .brand-name {
            font-size: 1rem;
            font-weight: 700;
            color: rgba(255,255,255,0.6);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }
        .brand-title {
            font-size: 2.6rem;
            font-weight: 900;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 0.3rem;
        }
        .brand-sub {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.5);
            margin-bottom: 2.5rem;
        }
        .brand-sub span {
            display: inline-block;
            background: rgba(255,255,255,0.12);
            padding: 0.2rem 1.2rem;
            border-radius: 20px;
            font-weight: 600;
            color: #fff;
        }
        .loader {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255,255,255,0.15);
            border-top: 4px solid #fff;
            border-radius: 50%;
            margin: 0 auto;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loader-text {
            margin-top: 1rem;
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="splash">
        <div class="logo-circle">
            <i class="fas fa-child"></i>
            <i class="fas fa-plus-circle"></i>
            <i class="fas fa-heartbeat"></i>
        </div>

        <div class="brand-name">Sistem Pakar</div>
        <div class="brand-title">Gizi Buruk<br>Pada Balita</div>
        <div class="brand-sub">Metode <span>Naive Bayes</span></div>

        <div class="loader"></div>
        <div class="loader-text">Memuat...</div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = '<?= base_url('auth/login.php') ?>';
        }, 3500);
    </script>
</body>
</html>
