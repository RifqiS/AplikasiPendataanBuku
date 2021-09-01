<?php
session_start();
require '../config/config.php';
// cek session
if (!isset($_SESSION["login_admin"])) {
    header("Location: login.php");
    exit;
}
$id_log = $_SESSION['id_admin'];
$log = query("SELECT * FROM admin WHERE id_admin = '$id_log'")[0];
?>

<link href="../../assets/css/c1.css" rel="stylesheet">
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<script src="../../assets/js/jquery-3.5.1.js"></script>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <a class="navbar-brand" href="index.php">Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="buku.php">Pendataan Buku</a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="dropdown01" data-toggle="dropdown"><?= $log['nama']; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="akun.php">Data Diri</a>
                        <a class="dropdown-item" href="akun_p.php">Ubah Password</a>
                        <hr>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>