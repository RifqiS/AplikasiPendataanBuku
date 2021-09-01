<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perpustakaan</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>
    <div class="mt-5"><br></div>
    <div class="container-fluid fadeInDown">
        <div class="row justify-content-center">
            <div class="card col-12 m-2">
                <div class="card-header bg-white text-center">
                    <h2>Ubah Data</h2>
                </div>
                <div class="card-body">
                    <form class="col-12 needs-validation" method="POST" novalidate>
                        <input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?= $log['id_admin']; ?>" required>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="" value="<?= $log['nama']; ?>" required>
                                <div class="invalid-feedback">
                                    Tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="<?= $log['email']; ?>" required>
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
                                    <input type="text" class="form-control" name="telp" id="telp" placeholder="Lebih dari 9 angka" value="<?= $log['telp']; ?>" onkeypress="return isNumberKey(event)" minlength="10" required>
                                </div>
                                <div class="invalid-feedback">
                                    Lebih dari 9 angka
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="" value="<?= $log['alamat']; ?>" required>
                                <div class="invalid-feedback">
                                    Tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" value="<?= $log['username']; ?>" required>
                                <div class="invalid-feedback">
                                    Isi dengan 5 ~ 16 karakter
                                </div>
                            </div>
                        </div>
                        <div class="form-group row float-right">
                            <div class="col">
                                <button class="btn btn-primary" name="simpan" type="submit">Simpan Perubahan</button>
                                <a href="akun.php" class="btn btn-danger" onclick="return confirm('Yakin ?')">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])) {
        if (eAkun($_POST, "admin") > 0) {
            echo "<script>
                    document.location.href='akun.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal Menyimpan Data!');
                </script>";
            mysqli_error($db);
        }
    }
    ?>

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

    
<?php
    include 'footer.php';
    ?>

</body>

</html>