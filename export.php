<?php
require 'function.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

$filename = "mahasiswa data-" . date('Ymd') . ".xls";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Mahasiswa Data.xls");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
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
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['nim']; ?></td>
                <td><?= $row['tempat_lahir']; ?></td>
                <td><?= $row['tanggal_lahir']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td><?= $row['universitas']; ?></td>
                <td><?= $row['program_studi']; ?></td>
                <td><?= dekripsi_blowfish($row['nomor_rekening']); ?></td>
                <td><?= dekripsi_blowfish($row['nomor_hp']); ?></td>
                <td><?= $row['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>