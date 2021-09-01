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
            <div class="card col-5 m-2">
                <div class="card-header bg-white text-center">
                    <h2>Data Diri</h2>
                </div>
                <div class="card-body">
                    <a href="akun_e.php" class="btn btn-warning float-right m-1">Ubah data</a>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?= $log['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?= $log['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>:</td>
                                <td><?= $log['telp']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $log['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td><?= $log['username']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

</body>

</html>