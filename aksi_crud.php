<?php

//Panggil Koneksi Database
include "koneksi.php";

//Uji Jika Tombol Tambah di Klik
if (isset($_POST['btambah'])) {

    //Persiapan Simpan Data Baru
    $tambah = mysqli_query($koneksi, "INSERT INTO user(nama, nik, nomor_hp, instansi, domisili)
                                                    VALUES ('$_POST[tnama]',
                                                            '$_POST[tnik]',
                                                            '$_POST[tnomorhp]',
                                                            '$_POST[tinstansi]',
                                                            '$_POST[tdomisili]')");

    //Jika Simpan Sukses
    if($tambah){
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location='index.php';
        </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location='index.php';
        </script>";
    }
}

//Uji Jika Tombol Edit di Klik
if (isset($_POST['bedit'])) {

    //Persiapan Edit Data
    $edit = mysqli_query($koneksi, "UPDATE user SET
            nama = '$_POST[tnama]',
            nik = '$_POST[tnik]',
            nomor_hp= '$_POST[tnomorhp]',
            instansi= '$_POST[tinstansi]',
            domisili= '$_POST[tdomisili]'
        WHERE id_usr = '$_POST[id_usr]'");

    //Jika Edit Sukses
    if($edit){
        echo "<script>
                alert('Data Berhasil di Edit!');
                document.location='index.php';
        </script>";
    } else {
        echo "<script>
                alert('Edit Data Gagal!');
                document.location='index.php';
        </script>";
    }
}


//Uji Jika Tombol Hapus di Klik
if (isset($_POST['bhapus'])) {

    //Persiapan Hapus Data
    $hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_usr = '$_POST[id_usr]'");

    //Jika Hapus Sukses
    if($hapus){
        echo "<script>
                alert('Data Berhasil di Hapus');
                document.location='index.php';
        </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='index.php';
        </script>";
    }
}