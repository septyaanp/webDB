<?php
session_start();

// Jika tidak bisa login, maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Cek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Panggil fungsi hapus
    if (hapus($id) > 0) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
              </script>";
    }
} else {
    // Jika tidak ada parameter 'id', redirect ke index.php
    header('location:index.php');
    exit;
}
?>