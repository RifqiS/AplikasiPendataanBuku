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
            <div class="card col-4 m-2">
                <div class="card-header bg-white text-center">
                    <h2>Ubah Password</h2>
                </div>
                <div class="card-body">
                    <form class="col-12 needs-validation" method="POST" novalidate>
                        <input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?= $log['id_admin']; ?>" required>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="passlama" id="passlama" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" required>
                            <div class="invalid-feedback">
                                Isi dengan 5 ~ 16 karakter
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="passbaru" id="passbaru" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" required>
                            <div class="invalid-feedback">
                                Isi dengan 5 ~ 16 karakter
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="repassbaru" id="repassbaru" minlength="5" maxlength="16" placeholder="Isi dengan 5 ~ 16 karakter" required>
                            <div class="invalid-feedback">
                                Password tidak sama!
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
        if (epass($_POST, "admin") > 0) {
            echo "<script>
                    document.location.href='akun.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal Menyimpan Data!');
                    document.location.href='akun_p.php';
                </script>";
            mysqli_error($db);
        }
    }
    ?>
    
    <?php
    include 'footer.php';
    ?>

    <!-- Re-Type Password -->
    <script type="text/javascript">
        window.onload = function() {
            document.getElementById("passbaru").onchange = validatePassword;
            document.getElementById("repassbaru").onchange = validatePassword;
        }

        function validatePassword() {
            var repassbaru = document.getElementById("repassbaru").value;
            var passbaru = document.getElementById("passbaru").value;
            if (passbaru != repassbaru)
                document.getElementById("repassbaru").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
            else
                document.getElementById("repassbaru").setCustomValidity('');
        }
    </script>

</body>

</html>