<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

// Generate kunci Diffie-Hellman
$keys = generate_diffie_hellman_keys();
$dh = $keys['dh']; // Resource Diffie-Hellman
$peer_public_key = $keys['public_key']; // Contoh: menggunakan kunci publik sendiri

// Hitung shared secret
$shared_secret = generate_shared_secret($dh, $peer_public_key);

// Simpan shared secret di session
$_SESSION['shared_secret'] = $shared_secret;

// Ambil data mahasiswa dari database
$mahasiswa = query("SELECT * FROM mahasiswa");

// Jika query gagal, tampilkan pesan error
if ($mahasiswa === false) {
    die("Error: Gagal mengambil data dari database.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penerima Beasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Data Penerima Beasiswa</h2>
        <a href="addData.php" class="btn btn-primary mb-3">Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Universitas</th>
                    <th>Program Studi</th>
                    <th>Nomor Rekening</th>
                    <th>Nomor HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswa)) : ?>
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($mahasiswa as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['tempat_lahir']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                            <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                            <td><?= htmlspecialchars($row['universitas']); ?></td>
                            <td><?= htmlspecialchars($row['program_studi']); ?></td>
                            <td><?= dekripsi_blowfish($row['nomor_rekening'], $shared_secret); ?></td>
                            <td><?= dekripsi_blowfish($row['nomor_hp'], $shared_secret); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td>
                                <a href="ubah.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>