<?php
$id_pesanan = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_pesanan, tbl_user, tbl_produk WHERE tbl_pesanan.id_user_pesanan = tbl_user.id_user AND tbl_pesanan.id_produk_pesanan = tbl_produk.id_produk AND tbl_pesanan.id_pesanan='$id_pesanan'");
$r = mysqli_fetch_array($sql);
?>
<div class="charts-container-center">
    <div class="chart-card">
        <h1><center>Pengaturan Data Produk</center></h1>
        <p><center>Tempat untuk menambah data produk</center></p>
    </div>
</div>

<div style="charts-container-center margin-top: 20px;">
    <div style="display: grid; padding: 20px;">
        <div style="width: 100%;">
            <div style="border: 1px solid #ddd; border-radius: 10px;">
                <div style="background: white; padding: 15px; border-bottom: 1px solid #ddd;">
                    <h5 style="margin: 0; font-size: 1.25rem;">Edit Pesanan</h5>
                </div>
                <div style="padding: 15px;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Pilih Produk</label>
                            <select style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="id_produk">
                                <option value="0" selected>---Pilih Produk---</option>
                                <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM tbl_produk ORDER BY id_produk ASC");
                                while($r2 = mysqli_fetch_array($sql)) { ?>
                                <option value="<?php echo $r2['id_produk'] ?>" <?php if($r2['id_produk']==$r['id_produk_pesanan']) echo "selected"; ?>><?php echo $r2['nama_produk'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Jumlah</label>
                            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="jumlah" required value="<?php echo $r['query'] ?>">
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
                    </form>
                    <?php 
                    if(isset($_POST['submit'])) {
                        $id_produk = $_POST['id_produk'];
                        $jumlah = $_POST['jumlah'];
                        $id_user = $_SESSION['id_user'];
                        
                        $sql_produk = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk='$id_produk'");
                        $r = mysqli_fetch_array($sql_produk);
                        $harga_produk = $r['harga_produk'] * $jumlah;
                        $stok_baru = $r['stok_produk'] - $jumlah;
                        
                        if ($stok_baru >= 0) {
                            $sql_pesanan = "UPDATE tbl_pesanan SET id_produk_pesanan='$id_produk', query='$jumlah', total_price='$harga_produk' WHERE id_pesanan='$id_pesanan'";
                            $sql_update_stok = "UPDATE tbl_produk SET stok_produk='$stok_baru' WHERE id_produk='$id_produk'";

                            if (mysqli_query($koneksi, $sql_pesanan) && mysqli_query($koneksi, $sql_update_stok)) {
                                echo "<script>alert('Produk Telah Diupdate'); window.location = 'home.php?page=pesanan'</script>";
                            } else {
                                echo "Error: " . mysqli_error($koneksi);
                            }
                        } else {
                            echo "<script>alert('Jumlah stok tidak mencukupi'); window.location = 'home.php?page=produk'</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


