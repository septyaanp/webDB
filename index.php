<?php 

//Panggil Koneksi Database
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD DATA USER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="mt-3">
            <h3 class="text-center">DATA PENERIMA BANTUAN</h3>
            <h3 class="text-center">Dinas Sosial</h3>
        </div>
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Data User
            </div>
            <div class="card-body">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah Data User
                </button>


                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Nomor HP</th>
                        <th>Instansi</th>
                        <th>Domisili</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    //Persiapa Menampilkan Data
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_usr DESC");
                    while($data = mysqli_fetch_array($tampil)):
                    ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?=$data['nama']?></td>
                        <td><?=$data['nik']?></td>
                        <td><?=$data['nomor_hp']?></td>
                        <td><?=$data['instansi']?></td>
                        <td><?=$data['domisili']?></td>
                        <td>
                            <a href="#"class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?=$no?>">Edit</a>
                            <a href="#"class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?=$no?>">Hapus</a>
                        </td>
                    </tr>

                <!-- Awal Modal Edit -->
                <div class="modal fade" id="modalEdit<?=$no?>" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Data User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="aksi_crud.php">
                                <input type="hidden" name="id_usr"value="<?= $data['id_usr']?> ">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="tnama" value="<?=$data['nama']?>"
                                            placeholder="Masukkan Nama Anda!">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="tnik"value="<?=$data['nik']?>"
                                            placeholder="Masukkan NIK Anda!">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control" name="tnomorhp"value="<?=$data['nomor_hp']?>" placeholder="Nomor HP">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Instansi</label>
                                        <select class="form-select" name="tinstansi">
                                            <option value="<?=$data['instansi']?>"><?=$data['instansi']?></option>
                                            <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                                            <option value="Perusahaan Swasta">Perusahaan Swasta</option>
                                            <option value="Pemerintahan">Pemerintahan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Domisili</label>
                                        <textarea class="form-control" name="tdomisili" rows="3"><?=$data['domisili']?></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success" name="bedit">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Edit-->
                  

                <!-- Awal Modal Hapus -->
                <div class="modal fade" id="modalHapus<?=$no?>" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="aksi_crud.php">
                                <input type="hidden" name="id_usr"value="<?= $data['id_usr']?> ">
                                <div class="modal-body">
                                    <h5 class="text-center"> Apakah Anda Yakin Untuk Menghapus Data berikut?<br>
                                    <span class="text-danger"><?= $data['nama']?> - <?= $data['nik']?>
                                </span>
                                </h5>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success" name="bhapus">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Hapus-->
                    <?php endwhile;?>
                </table>


                <!-- Awal Modal Tambah -->
                <div class="modal fade" id="modaltambah" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Data User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="aksi_crud.php">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="tnama"
                                            placeholder="Masukkan Nama Anda!">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="tnik"
                                            placeholder="Masukkan NIK Anda!">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control" name="tnomorhp" placeholder="Nomor HP">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Instansi</label>
                                        <select class="form-select" name="tinstansi">
                                            <option></option>
                                            <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                                            <option value="Perusahaan Swasta">Perusahaan Swasta</option>
                                            <option value="Pemerintahan">Pemerintahan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Domisili</label>
                                        <textarea class="form-control" name="tdomisili" rows="3">

                                        </textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success" name="btambah">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Tambah-->
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>