<div class="charts-container-center">
    <div class="chart-card">
        <h1><center>Pengaturan Data Berita</center></h1>
        <p><center>Tempat untuk menambah data berita</center></p>
    </div>
</div>

<div style="charts-container-center margin-top: 20px;">
    <div style="display: grid; padding: 20px;">
        <div style="width: 100%;">
            <div style="border: 1px solid #ddd; border-radius: 10px;">
                <div style="background: white; padding: 15px; border-bottom: 1px solid #ddd;">
                    <h5 style="margin: 0; font-size: 1.25rem;">Tambah Berita</h5>
                </div>
                <div style="padding: 15px;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Judul</label>
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="judul" name="judul" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Kategori</label>
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="kategori" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Konten</label>
                            <textarea class="form-control ckeditor" name="konten" id="ckeditor" rows="3"></textarea>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label for="gambar" style="display: block; margin-bottom: 5px;">Gambar</label>
                            <input type="file" id="gambar" name="gambar" required>
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Tambah</button>
                    </form>
                    <?php 
                    if(isset($_POST['submit'])) {
                        $judul_bret = $_POST['judul'];
                        $kategori_bret = $_POST['kategori'];
                        $konten_bret = $_POST['konten'];
                        $foto_bret = $_FILES['gambar']['name'];

                        $file_extension = array('png', 'jpg', 'jpeg', 'gif');
                        $extension = pathinfo($foto_bret, PATHINFO_EXTENSION);
                        $size_foto = $_FILES['gambar']['size'];
                        $rand = rand();

                        $penulis = $_SESSION['id_admin'];
                        $tangal = date('Y-m-d');

                        if(!in_array($extension, $file_extension)) {
                            echo "<script>alert('Upload file image (jpg, jpeg, png)'); window.location = 'dashboard.php?page=tambah_berita'</script>";
                        } else {
                           if($size_foto < 409600) {
                               $nama_foto_bret = $rand.'_'.$foto_bret;
                               move_uploaded_file($_FILES['gambar']['tmp_name'], '././img_bert/'.$nama_foto_bret);
                               mysqli_query($koneksi, "INSERT INTO tbl_berita (judul_berita, kategori, deskripsi, foto_berita, id_admin_berita, tangal_berita) VALUES ('$judul_bret', '$kategori_bret', '$konten_bret', '$nama_foto_bret', '$penulis', '$tangal')");
                               echo "<script>alert('Data berhasil disimpan'); window.location = 'dashboard.php?page=berita';</script>";
                           } else {
                                echo "<script>alert('Ukuran gambar terlalu besar'); window.location = 'dashboard.php?page=tambah_berita'</script>";
                           }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>



