<?php

//Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbcrud";

//Buat Koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die (mysqli_error($koneksi));