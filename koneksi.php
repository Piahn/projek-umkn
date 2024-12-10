<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "dbs_wisata";

$koneksi = mysqli_connect($server, $username, $password, $db_name);

if (!$koneksi) {
    echo "Gagal Terhubung dengan database";
} else {
    // echo "Berhasil Terhubung dengan database";
}

?>
