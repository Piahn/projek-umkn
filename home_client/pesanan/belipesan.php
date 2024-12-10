<?php
include "koneksi.php";
session_start();

if (isset($_GET['id']) && isset($_SESSION['id_user'])) {
    $id = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_pesanan WHERE id_pesanan='$id'");
    $r = mysqli_fetch_array($sql);
    $jumlah = $r['query'];
    $id_produk = $r['id_produk_pesanan'];
    $id_user = $_SESSION['id_user'];

    // Validasi input
    if (!is_numeric($jumlah) || $jumlah <= 0) {
        echo "<script>alert('Jumlah tidak valid'); window.location='home.php?page=pesanan'</script>";
        exit;
    }

    mysqli_begin_transaction($koneksi);

    try {
        // Ambil data produk
        $sql = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk='$id_produk'");
        $r = mysqli_fetch_array($sql);

        if (!$r) {
            throw new Exception('Produk tidak ditemukan.');
        }

        $total_price = $r['harga_produk'] * $jumlah;

        $sql1 = mysqli_query($koneksi, "SELECT uang FROM tbl_user WHERE id_user='$id_user'");
        $r1 = mysqli_fetch_array($sql1);

        if (!$r1) {
            throw new Exception('User tidak ditemukan.');
        }

        $uang = $r1['uang'];

        if ($uang >= $total_price) {
            $total_uang = round($uang, 2) - round($total_price, 2);

            $sql2 = mysqli_query($koneksi, "DELETE FROM tbl_pesanan WHERE id_pesanan='$id'");
            if (!$sql2) {
                throw new Exception('Gagal menghapus pesanan.');
            }

            $sql3 = mysqli_query($koneksi, "UPDATE tbl_user SET uang='$total_uang' WHERE id_user='$id_user'");
            if (!$sql3) {
                throw new Exception('Gagal mengupdate uang user.');
            }

            mysqli_commit($koneksi);
            echo "<script>alert('Pembelian berhasil. Uang yang tersisa: Rp $total_uang'); window.location='home.php?page=pesanan'</script>";
        } else {
            throw new Exception('Uang tidak mencukupi untuk melakukan pembelian.');
        }
    } catch (Exception $e) {
        // Rollback jika terjadi error
        mysqli_rollback($koneksi);
        echo "<script>alert('" . $e->getMessage() . "'); window.location='home.php?page=pesanan'</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid'); window.location='home.php?page=pesanan'</script>";
}
?>
