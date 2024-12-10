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
                    <h5 style="margin: 0; font-size: 1.25rem;">Tambah Produk</h5>
                </div>
                <div style="padding: 15px;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Nama Produk</label>
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="nama" name="nama" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Harga</label>
                            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="harga" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Jumlah</label>
                            <input type="number" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="jumlah" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Konten</label>
                            <textarea style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="konten" rows="3"></textarea>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label for="gambar" style="display: block; margin-bottom: 5px;">Gambar</label>
                            <input type="file" id="gambar" name="gambar" required>
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Tambah</button>
                    </form>
                    <?php 
                    if(isset($_POST['submit'])) {
                        $nama_produk = $_POST['nama'];
                        $harga = $_POST['harga'];
                        $jumlah = $_POST['jumlah'];
                        $deskripsi = $_POST['konten'];
                        $foto_prod = $_FILES['gambar']['name'];

                        $file_extension = array('png', 'jpg', 'jpeg', 'gif');
                        $extension = pathinfo($foto_prod, PATHINFO_EXTENSION);
                        $size_foto = $_FILES['gambar']['size'];
                        $rand = rand();

                        if(!in_array($extension, $file_extension)) {
                            echo "<script>alert('Upload file image (jpg, jpeg, png)'); window.location = 'dashboard.php?page=tambah_produk'</script>";
                        } else {
                            if($size_foto < 409800) {
                                $nama_foto_prod = $rand.'_'.$foto_prod;
                                move_uploaded_file($_FILES['gambar']['tmp_name'], '././img_prod/'.$nama_foto_prod);
                                mysqli_query($koneksi, "INSERT INTO tbl_produk (nama_produk, gambar_produk, deskripsi, harga_produk, stok_produk) VALUES ('$nama_produk', '$nama_foto_prod', '$deskripsi', '$harga', '$jumlah')");
                                echo "<script>alert('Data berhasil disimpan'); window.location = 'dashboard.php?page=tiket';</script>";
                            } else {
                                echo "<script>alert('Ukuran gambar terlalu besar'); window.location = 'dashboard.php?page=tambah_produk'</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


