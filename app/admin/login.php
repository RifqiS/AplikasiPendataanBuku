<?php
session_start();
require '../config/config.php';

// cek cookie
if (isset($_COOKIE['key_admin']) && isset($_COOKIE['key1_admin'])) {
    $id = $_COOKIE['key_admin'];
    $key = $_COOKIE['key1_admin'];

    // ambil username berdasarkan id
    $result = mysqli_query($db, "SELECT * FROM admin WHERE id_admin = '$id'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login_admin'] = true;
        $_SESSION['id_admin'] = $row['id_admin'];
    }
}

// cek session
if (isset($_SESSION["login_admin"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    if (login($_POST, "admin") > 0) {
        echo "<script>
                document.location.href='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Username atau Password Salah!');
            </script>";
        mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div class="fadeIn first">
                    <h3 class="m-3">Silahkan Untuk Login</h3>
                </div>

                <!-- Login Form -->
                <form method="post" class="needs-validation" novalidate>
                    <div class="form-group">
                        <input type="text" id="username" class="form-control fadeIn second" name="username" placeholder="username" required>
                        <div class="invalid-feedback">
                            Tidak boleh kosong!
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control fadeIn third" name="password" placeholder="password" required>
                        <div class="invalid-feedback">
                            Tidak boleh kosong!
                        </div>
                    </div>
                    <div class="form-group form-check fadeIn fourth">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me!</label>
                    </div>
                    <input type="submit" class="fadeIn fourth" name="login" value="Log In">
                    <p class="fadeIn fourth">Belum Punya akun? <a href="register.php">Daftar di sini!</a></p>
                </form>

                <div id="formFooter">
                    <small>
                        &copy; 2020 Ahmad Yuunus - 2113191031
                    </small>
                </div>

            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>