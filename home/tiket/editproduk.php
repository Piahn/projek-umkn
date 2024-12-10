<?php
include "koneksi.php"; // Pastikan file koneksi ke database benar

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk='$id'");
$product = mysqli_fetch_array($sql);

if(isset($_POST['submit'])) {
    $nama_produk = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $deskripsi = $_POST['konten'];
    $foto_prod = $_FILES['gambar']['name'];

    if($foto_prod != "") {
        $file_extension = array('png', 'jpg', 'jpeg', 'gif');
        $extension = pathinfo($foto_prod, PATHINFO_EXTENSION);
        $size_foto = $_FILES['gambar']['size'];
        $rand = rand();

        if(in_array($extension, $file_extension) && $size_foto < 409800) {
            $nama_foto_prod = $rand.'_'.$foto_prod;
            move_uploaded_file($_FILES['gambar']['tmp_name'], '././img_prod'.$nama_foto_prod);
            unlink("././img_prod/".$product['gambar_produk']); // Hapus gambar lama
            $query = mysqli_query($koneksi, "UPDATE tbl_produk SET nama_produk='$nama_produk', gambar_produk='$nama_foto_prod', deskripsi='$deskripsi', harga_produk='$harga', stok_produk='$jumlah' WHERE id_produk='$id'");
        } else {
            echo "<script>alert('Upload file image (jpg, jpeg, png) dengan ukuran kurang dari 400KB'); window.location = 'dashboard.php?page=edit_produk&id=".$id."'</script>";
        }
    } else {
        $query = mysqli_query($koneksi, "UPDATE tbl_produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga_produk='$harga', stok_produk='$jumlah' WHERE id_produk='$id'");
    }

    if($query) {
        echo "<script>alert('Data berhasil diupdate'); window.location = 'dashboard.php?page=detail_produk';</script>";
    } else {
        echo "<script>alert('Data gagal diupdate'); window.location = 'dashboard.php?page=edit_produk&id=".$id."'</script>";
    }
}
?>

<div style="charts-container-center margin-top: 20px;">
    <div style="display: grid; padding: 20px;">
        <div style="width: 100%;">
            <div style="border: 1px solid #ddd; border-radius: 10px;">
                <div style="background: white; padding: 15px; border-bottom: 1px solid #ddd;">
                    <h5 style="margin: 0; font-size: 1.25rem;">Edit Produk</h5>
                </div>
                <div style="padding: 15px;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Nama Produk</label>
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="nama" name="nama" value="<?php echo $product['nama_produk']; ?>" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Harga</label>
                            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="harga" value="<?php echo $product['harga_produk']; ?>" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Jumlah</label>
                            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="jumlah" value="<?php echo $product['stok_produk']; ?>" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Konten</label>
                            <textarea style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="konten" rows="3"><?php echo $product['deskripsi']; ?></textarea>
                        </div>
                        <div style="margin-bottom: 15px; text-align: left;">
                            <label for="gambar" style="display: inline-block; margin-bottom: 5px;">Gambar</label><br><br>
                            <img src="././img_prod/<?php echo $product['gambar_produk'] ?>" style="width: 100px; height: 100px; display: inline-block;"><br><br>
                            <input type="file" id="gambar" name="gambar" style="display: inline-block;">
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
