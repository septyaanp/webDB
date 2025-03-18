<?php
require 'function.php';

if (isset($_POST['dataMahasiswa'])) {
    $output = '';
    $sql = "SELECT * FROM mahasiswa WHERE id = '" . $_POST['dataMahasiswa'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                    <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '
                    <tr>
                        <th width="40%">Nama</th>
                        <td width="60%">' . $row['nama'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">NIM</th>
                        <td width="60%">' . $row['nim'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Tempat Lahir</th>
                        <td width="60%">' . $row['tempat_lahir'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Tanggal Lahir</th>
                        <td width="60%">' . $row['tanggal_lahir'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Jenis Kelamin</th>
                        <td width="60%">' . $row['jenis_kelamin'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Universitas</th>
                        <td width="60%">' . $row['universitas'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Program Studi</th>
                        <td width="60%">' . $row['program_studi'] . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Nomor Rekening</th>
                        <td width="60%">' . dekripsi_blowfish($row['nomor_rekening']) . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Nomor HP</th>
                        <td width="60%">' . dekripsi_blowfish($row['nomor_hp']) . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Status</th>
                        <td width="60%">' . $row['status'] . '</td>
                    </tr>';
    }
    $output .= '</table></div>';
    echo $output;
}