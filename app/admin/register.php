<?php
require '../config/config.php';

// Daftar
if (isset($_POST['daftar'])) {
    if (iRegistrasi($_POST) > 0) {
        echo "<script>
                alert('Selamat, anda telah berhasil mendaftarkan akun!');
                document.location.href='login.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal Menambah Data!');
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
    <title>Registrasi</title>
    <link href="../../assets/css/c1.css" rel="stylesheet">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div class="wrapper fadeInDown">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-12 m-2">
                        <div class="card-header bg-white text-center">
                            <h2>Form Registrasi</h2>
                        </div>
                        <div class="card-body">
                            <form class="col-12 needs-validation" method="POST" novalidate>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="" value="<?php if (isset($_POST['nama'])) {
                                                                                                                                echo $_POST['nama'];
                                                                                                                            } ?>" required>
                                        <div class="invalid-feedback">
                                            Tidak boleh kosong!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="<?php if (isset($_POST['email'])) {
                                                                                                                                                    echo $_POST['email'];
                                                                                                                                                } ?>" required>
                                        <div class="invalid-feedback">
                                            Tidak boleh kosong!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input type="text" class="form-control" name="telp" id="telp" placeholder="Lebih dari 9 angka" value="<?php if (isset($_POST['telp'])) {
                                                                                                                                                        echo $_POST['telp'];
                                                                                                                                                    } ?>" onkeypress="return isNumberKey(event)" minlength="10" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Lebih dari 9 angka
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="" value="<?php if (isset($_POST['alamat'])) {
                                                                                                                                    echo $_POST['alamat'];
                                                                                                                                } ?>" required>
                                        <div class="invalid-feedback">
                                            Tidak boleh kosong!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" id="username" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" value="<?php if (isset($_POST['username'])) {
                                                                                                                                                                                                echo $_POST['username'];
                                                                                                                                                                                            } ?>" required>
                                        <div class="invalid-feedback">
                                            Isi dengan 5 ~ 16 karakter
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pass1" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="pass1" id="pass1" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" required>
                                        <div class="invalid-feedback">
                                            Isi dengan 5 ~ 16 karakter
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pass2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="pass2" id="pass2" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" required>
                                        <div class="invalid-feedback">
                                            Password tidak sama!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row float-right">
                                    <div class="col">
                                        <button class="btn btn-primary" name="daftar" type="submit">Daftar</button>
                                        <button class="btn btn-warning" type="reset">Batal</button>
                                        <a href="login.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Number only -->
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <!-- Costom Validate -->
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

    <!-- Re-Type Password -->
    <script type="text/javascript">
        window.onload = function() {
            document.getElementById("pass1").onchange = validatePassword;
            document.getElementById("pass2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("pass2").value;
            var pass1 = document.getElementById("pass1").value;
            if (pass1 != pass2)
                document.getElementById("pass2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
            else
                document.getElementById("pass2").setCustomValidity('');
        }
    </script>
</body>

</html>