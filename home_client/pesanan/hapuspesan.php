<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = mysqli_query($koneksi, "DELETE FROM tbl_pesanan WHERE id_pesanan='$id'");
        if($sql) {
            echo "<script>alert('Data Pesanan Berhasil Dihapus'); window.location='home.php?page=pesanan'</script>";
        } else {
            echo "<script>alert('Gagal Menghapus Data Pesanan'); window.location='home.php?page=pesanan'</script>";
        }
    }
?>
