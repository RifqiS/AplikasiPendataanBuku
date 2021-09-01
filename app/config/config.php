<?php
require 'koneksi.php';

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function kodeauto($id, $table, $key)
{
    global $db;
    $kode    = mysqli_query($db, "select max($id) as KODE from $table");
    $ar      = mysqli_fetch_array($kode);
    $id_kode = $ar['KODE'];
    $urut    = substr($id_kode, 7, 3);
    $urut++;
    $id_baru = $key . date('dmy') . sprintf("%03s", $urut);
    return $id_baru;
}

function login($data, $table)
{
    global $db;
    $username = $data["username"];
    $password = $data["password"];

    $result_u = mysqli_query($db, "SELECT * FROM $table WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result_u) === 1) {

        // cel password
        $row = mysqli_fetch_assoc($result_u);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION['login_' . $table] = true;
            $_SESSION['id_' . $table] = $row["id_" . $table];

            // cek remember me
            if (isset($data['remember'])) {
                // buat cookie 1d
                setcookie('key_' . $table, $row['id_' . $table], time() + (86400 * 30));
                setcookie('key1_' . $table, hash('sha256', $row['username']), time() + (86400 * 30));
            }

            return true;
        }
    } else {
        return false;
    }
}

function eAkun($data, $table)
{
    global $db;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $telp = htmlspecialchars($data['telp']);
    $alamat = htmlspecialchars($data['alamat']);
    $username = htmlspecialchars(strtolower(stripcslashes($data["username"])));

    $cek_email = mysqli_query($db, "SELECT email FROM $table WHERE id_admin!='$id' and email = '$email'");

    // $cek_email_1 = mysqli_fetch_assoc($cek_email);
    $cek_username = mysqli_query($db, "SELECT username FROM $table WHERE username = '$username' and id_admin!='$id'");
    // $cek_username_1 = mysqli_fetch_assoc($cek_username);

    if (mysqli_num_rows($cek_email) > 0) {
        echo "<script>
                alert('Email telah digunakan! Silahkan gunakan Email yang lain');
            </script>";
    } else {
        if (mysqli_num_rows($cek_username) > 0) {
            echo "<script>
                    alert('Username telah digunakan! Silahkan gunakan Username yang lain');
                </script>";
        } else {
            mysqli_query($db, "UPDATE $table SET nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat', username = '$username' WHERE id_$table = '$id'");
            return mysqli_affected_rows($db);
        }
    }
}

function ePass($data, $table)
{
    global $db;
    $id_admin = $data['id'];
    $passlama = htmlspecialchars(mysqli_real_escape_string($db, $data['passlama']));
    $passbaru = htmlspecialchars(mysqli_real_escape_string($db, $data['passbaru']));
    $passbaru_en = password_hash($passbaru, PASSWORD_DEFAULT);

    $cek_pass = mysqli_query($db, "SELECT * FROM admin WHERE id_admin = '$id_admin'");

    if (mysqli_num_rows($cek_pass) === 1) {
        // cel password
        $row = mysqli_fetch_assoc($cek_pass);
        if (password_verify($passlama, $row["password"])) {
            mysqli_query($db, "UPDATE $table SET password = '$passbaru_en' WHERE id_$table = '$id_admin'");
            return mysqli_affected_rows($db);
        }
    } else {
        echo "<script>
                alert('Password lama salah!');
            </script>";
        return false;
    }
}

function iRegistrasi($data)
{
    global $db;
    $id_admin = kodeauto("id_admin", "admin", "U");
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $telp = htmlspecialchars($data['telp']);
    $alamat = htmlspecialchars($data['alamat']);
    $username = htmlspecialchars(strtolower(stripcslashes($data["username"])));
    $pass_in = htmlspecialchars(mysqli_real_escape_string($db, $data['pass2']));
    $pass_out = password_hash($pass_in, PASSWORD_DEFAULT);

    $cek_email = mysqli_query($db, "SELECT * FROM admin WHERE email = '$email'");
    $cek_username = mysqli_query($db, "SELECT * FROM admin WHERE username = '$username'");

    if (mysqli_num_rows($cek_email) === 1) {
        echo "<script>
                alert('Email telah digunakan! Silahkan gunakan Email yang lain');
            </script>";
        unset($_POST['email_user']);
    } elseif (mysqli_num_rows($cek_username) === 1) {
        echo "<script>
                alert('Username telah digunakan! Silahkan gunakan Username yang lain');
            </script>";
        unset($_POST['username']);
    } else {
        mysqli_query($db, "INSERT INTO admin VALUES ('$id_admin','$nama','$email','$telp','$alamat','$username','$pass_out','1')");
        return mysqli_affected_rows($db);
    }
}

function iBuku($data)
{
    global $db;
    $id_buku = htmlspecialchars($data['id_buku']);
    $judul = htmlspecialchars($data['judul']);
    $pengarang = htmlspecialchars($data['pengarang']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $tahun = htmlspecialchars($data['tahun']);
    $qty = htmlspecialchars($data['qty']);

    mysqli_query($db, "INSERT INTO buku VALUES ('$id_buku','$judul','$pengarang','$penerbit','$tahun','$qty')");
    return mysqli_affected_rows($db);
}

function eBuku($data)
{
    global $db;
    $id_buku = htmlspecialchars($data['id_buku']);
    $judul = htmlspecialchars($data['judul']);
    $pengarang = htmlspecialchars($data['pengarang']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $tahun = htmlspecialchars($data['tahun']);
    $qty = htmlspecialchars($data['qty']);

    mysqli_query($db, "UPDATE buku SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', tahun = '$tahun', qty = '$qty' WHERE id_buku = '$id_buku'");
    return mysqli_affected_rows($db);
}

function hBuku($data)
{
    global $db;
    $hapus = htmlspecialchars($data['hapus']);

    mysqli_query($db, "DELETE FROM buku WHERE id_buku = '$hapus'");
    return mysqli_affected_rows($db);
}
