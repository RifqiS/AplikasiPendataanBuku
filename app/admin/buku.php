<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perpustakaan</title>
</head>

<style>
    .tableFixHead {
        overflow-y: auto;
        height: 300px;
    }

    .tableFixHead thead th {
        position: sticky;
        top: 0;
    }

    /* Just common table stuff. Really. */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px 16px;
    }

    th {
        background: #eee;
    }
</style>

<body>
    <?php
    include 'nav.php';
    ?>
    <div class="mt-5"><br></div>
    <div class="container-fluid fadeInDown">
        <div class="row justify-content-center">
            <div class="card col-12 m-3">
                <div class="card-header bg-white text-center">
                    <h2>Daftar Buku</h2>
                </div>
                <div class="card-body">
                <table class="table table-borderless">
                        <tr>
                            <td>
                                <form action="">
                                    Cari Data : <input type="text" class="col-2" id="cari" name="cari" placeholder="" autocomplete="off">
                                </form>
                            </td>
                            <td class="float-right">
                                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#modalForm" data-whatever="Tambah Data">Tambah Data</button>
                            </td>
                        </tr>
                    </table>

                    <div id="tblBuku" class="tableFixHead">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                    <th>Jumlah Buku</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lihat = query("SELECT * FROM buku ORDER BY judul");
                                $a = mysqli_query($db, "SELECT * FROM buku ORDER BY judul");
                                $no = 1;
                                if (mysqli_num_rows($a)) {
                                    foreach ($a as $key) :
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $key['judul']; ?></td>
                                            <td><?= $key['pengarang']; ?></td>
                                            <td><?= $key['penerbit']; ?></td>
                                            <td><?= $key['tahun']; ?></td>
                                            <td><?= $key['qty']; ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <button type="button" class="badge badge-warning m-1" id="button_ubah" data-toggle="modal" data-target="#modalForm" data-kode_buku="<?= $key['id_buku']; ?>" data-whatever="Ubah Data">Ubah</button>
                                                    <button class="badge badge-danger m-1" id="hapus" name="hapus" value="<?= $key['id_buku']; ?>" onclick="return confirm('Yakin ?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                } else {
                                    echo "<tr class='text-center'>
                                        <td colspan='6'>Data Kosong</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Judul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="post" action="" novalidate>
                        <input type="hidden" class="form-control" id="id_buku" name="id_buku" value="<?= kodeauto("id_buku", "buku", "B"); ?>">
                        <div class="form-group">
                            <label for="judul" class="col-form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pengarang" class="col-form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penerbit" class="col-form-label">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tahun" class="col-form-label">Tahun Keluar</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" onkeypress="return isNumberKey(event)" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-form-label">Jumbah Buku</label>
                            <input type="text" class="form-control" id="qty" name="qty" onkeypress="return isNumberKey(event)" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong!
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="Tombol" name="tombol">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

    <!-- CRUD -->
    <?php
    if (isset($_POST['tombol'])) {
        if ($_POST['tombol'] == "Simpan") {
            if (iBuku($_POST) > 0) {
                echo "<script>
                        document.location.href='buku.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Gagal Menambah Data!');
                    </script>";
                mysqli_error($db);
            }
        } elseif ($_POST['tombol'] == "Ubah") {
            if (eBuku($_POST) > 0) {
                echo "<script>
                        document.location.href='buku.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Gagal Merubah Data!');
                    </script>";
                mysqli_error($db);
            }
        } else {
            echo "<script>
                        alert('Error!');
                    </script>";
        }
    }

    if (isset($_POST['hapus'])) {
        if (hBuku($_POST) > 0) {
            echo "<script>
                document.location.href='buku.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal Menghapus!');
            </script>";
            mysqli_error($db);
        }
    }
    ?>


    <!-- COSTOM Script -->
    <script>
        $('#modalForm').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var kode = button.data('kode_buku')

            var modal = $(this)
            modal.find('.modal-title').text(recipient)
            if (recipient === "Tambah Data") {
                modal.find('#Tombol').val("Simpan")
                document.getElementById("Tombol").value = "Simpan"
            } else if (recipient === "Ubah Data") {
                // modal.find('#id_buku').val(kode)
                modal.find('#Tombol').val("Ubah")
                document.getElementById("Tombol").value = "Ubah"
            }
        })
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#button_ubah', function() {
                var kode = $(this).data('kode_buku');
                $.ajax({
                    url: "buku_e.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        kode: kode,
                        tabel: 'buku'
                    },
                    success: function(response) {
                        console.log(response);
                        $("#id_buku").val(response[0].id_buku);
                        $("#judul").val(response[0].judul);
                        $("#pengarang").val(response[0].pengarang);
                        $("#penerbit").val(response[0].penerbit);
                        $("#tahun").val(response[0].tahun);
                        $("#qty").val(response[0].qty);
                    }
                });
            })
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#cari').on('keyup', function(){
                $('#tblBuku').load('buku_c.php?cari=' + $('#cari').val())
            })
        })
    </script>
</body>

</html>