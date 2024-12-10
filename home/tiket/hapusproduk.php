<?php 
    $id = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk='$id'");
    $r = mysqli_fetch_array($sql);
    unlink("././img_prod/".$r['gambar_produk']);
    
    mysqli_query($koneksi, "DELETE FROM tbl_produk WHERE id_produk='$id'");
    
    echo "<script>alert('produk Berhasil Dihapus!'); window.location = 'dashboard.php?page=tiket';</script>";
?>