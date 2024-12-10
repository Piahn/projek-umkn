<?php 
    $id = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_berita WHERE id_berita='$id'");
    $r = mysqli_fetch_array($sql);
    unlink("././img_bert/".$r['foto_berita']);
    
    mysqli_query($koneksi, "DELETE FROM tbl_berita WHERE id_berita='$id'");
    
    echo "<script>alert('Berita Berhasil Dihapus!'); window.location = 'dashboard.php?page=berita';</script>";
?>