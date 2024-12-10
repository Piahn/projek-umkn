<?php
    $id = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_berita WHERE id_berita='$id'");
    $r = mysqli_fetch_array($sql);
?>

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
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="judul" name="judul" value="<?php echo $r['judul_berita'] ?>" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Kategori</label>
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="kategori" value="<?php echo $r['kategori'] ?>" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Konten</label>
                            <textarea class="form-control ckeditor" name="konten" id="ckeditor" rows="3"><?php echo $r['deskripsi'] ?></textarea>
                        </div>
                        <div style="margin-bottom: 15px; text-align: left;">
                            <label for="gambar" style="display: inline-block; margin-bottom: 5px;">Gambar</label><br><br>
                            <img src="././././img_bert/<?php echo $r['foto_berita'] ?>" style="width: 100px; height: 100px; display: inline-block;"><br><br>
                            <input type="file" id="gambar" name="gambar" style="display: inline-block;">
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                    </form>
                    <?php
                        if(isset($_POST['submit'])) {
                            $judul_bret = $_POST['judul'];
                            $kategori_bret = $_POST['kategori'];
                            $konten_bret = $_POST['konten'];
                            $foto_bret = $_FILES['gambar']['name'];

                            if(empty($foto_bret)) {
                                $sql = mysqli_query($koneksi, "UPDATE tbl_berita SET judul_berita='$judul_bret', kategori='$kategori_bret', deskripsi='$konten_bret' WHERE id_berita='$id'");
                            } else {
                                $file_extension = array('png', 'jpg', 'jpeg', 'gif');
                                $extension = pathinfo($foto_bret, PATHINFO_EXTENSION);
                                $size_foto = $_FILES['gambar']['size'];
                                $rand = rand();

                                if(!in_array($extension, $file_extension)) {
                                    echo "<script>alert('Upload file image (jpg, jpeg, png)'); window.location = 'dashboard.php?page=edit_berita&id=".$id."'</script>";
                                } else {
                                    if($size_foto < 409600) {
                                        $nama_foto_bret = $rand.'_'.$foto_bret;
                                        move_uploaded_file($_FILES['gambar']['tmp_name'], '././img_bert/'.$nama_foto_bret);
                                        unlink("././img_bert/".$r['foto_berita']);
                                        $sql = mysqli_query($koneksi, "UPDATE tbl_berita SET judul_berita='$judul_bret', kategori='$kategori_bret', deskripsi='$konten_bret', foto_berita='$nama_foto_bret' WHERE id_berita='$id'");
                                    } else {
                                        echo "<script>alert('Ukuran gambar terlalu besar'); window.location = 'dashboard.php?page=edit_berita&id=".$id."'</script>";
                                    }
                                }
                            }

                            if($sql) {
                                echo "<script>alert('Berita berhasil diupdate'); window.location = 'dashboard.php?page=berita';</script>";
                            } else {
                                echo "<script>alert('Gagal mengupdate berita'); window.location = 'dashboard.php?page=edit_berita&id=".$id."'</script>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


