<?php
require '../config/config.php';
            $kode = $_POST['kode'];
            $table = $_POST['tabel'];
            $cari = mysqli_query($db, "SELECT * FROM $table WHERE id_buku = '$kode'");
            while($row = mysqli_fetch_array($cari)){
                $id_buku = $row['id_buku'];
                $judul = $row['judul'];
                $pengarang = $row['pengarang'];
                $penerbit = $row['penerbit'];
                $tahun = $row['tahun'];
                $qty = $row['qty'];
            
                $return_arr[] = array("id_buku" => $id_buku,
                                "judul" => $judul,
                                "pengarang" => $pengarang,
                                "penerbit" => $penerbit,
                                "tahun" => $tahun,
                                "qty" => $qty    
                            );
            }
            
            echo json_encode($return_arr);
?>