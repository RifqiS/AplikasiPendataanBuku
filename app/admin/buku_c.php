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
        require '../config/config.php';
        $cari = $_GET['cari'];
        $a = mysqli_query($db, "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR pengarang LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun LIKE '%$cari%' OR qty LIKE '%$cari%' ORDER BY judul");
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
                            <button class="badge badge-danger m-1" id="hapus" name="hapus" value="<?= $key['id_buku']; ?>">Hapus</button>
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