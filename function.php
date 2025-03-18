<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "beasiswa_pemda_gumas");

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi untuk menghasilkan kunci Diffie-Hellman
function generate_diffie_hellman_keys()
{
    $dh = openssl_pkey_new([
        'dh' => [
            'p' => hex2bin('FFFFFFFFFFFFFFFFC90FDAA22168C234C4C6628B80DC1CD129024E088A67CC74020BBEA63B139B22514A08798E3404DDEF9519B3CD3A431B302B0A6DF25F14374FE1356D6D51C245E485B576625E7EC6F44C42E9A637ED6B0BFF5CB6F406B7EDEE386BFB5A899FA5AE9F24117C4B1FE649286651ECE65381FFFFFFFFFFFFFFFF'),
            'g' => hex2bin('02'),
        ],
    ]);

    if (!$dh) {
        die("Gagal menghasilkan kunci Diffie-Hellman: " . openssl_error_string());
    }

    $details = openssl_pkey_get_details($dh);
    $public_key = $details['dh']['pub_key'];
    $private_key = $details['dh']['priv_key'];

    return [
        'dh' => $dh, // Resource Diffie-Hellman
        'public_key' => $public_key,
        'private_key' => $private_key,
    ];
}

// Fungsi untuk menghitung shared secret
function generate_shared_secret($dh, $peer_public_key)
{
    // Hitung shared secret
    $shared_secret = openssl_dh_compute_key($peer_public_key, $dh);
    if ($shared_secret === false) {
        die("Gagal menghitung shared secret: " . openssl_error_string());
    }
    return $shared_secret;
}

// Fungsi untuk enkripsi menggunakan Blowfish
function enkripsi_blowfish($data, $key)
{
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('bf-cbc')); // Generate IV
    $encrypted = openssl_encrypt($data, 'bf-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted); // Gabungkan IV dan ciphertext
}

// Fungsi untuk dekripsi menggunakan Blowfish
function dekripsi_blowfish($data)
{
    global $sharedSecret; // Shared secret dari Diffie-Hellman
    $data = base64_decode($data);
    $iv = substr($data, 0, openssl_cipher_iv_length('bf-cbc')); // Ambil IV
    $encrypted = substr($data, openssl_cipher_iv_length('bf-cbc')); // Ambil ciphertext
    return openssl_decrypt($encrypted, 'bf-cbc', $sharedSecret, OPENSSL_RAW_DATA, $iv);
}

// Fungsi untuk menjalankan query
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function hapus($id)
{
    global $koneksi;
    $sql = "DELETE FROM mahasiswa WHERE id = $id";
    mysqli_query($koneksi, $sql);
    return mysqli_affected_rows($koneksi);
}
?>