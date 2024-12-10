<div class="charts-container-center">
    <div class="chart-card">
        <h1><center>Pengaturan Data User</center></h1>
        <p><center>Tempat untuk menghapus data user</center></p>
    </div>
</div>


<div style="charts-container-center margin-top: 20px;">
    <div style="display: grid; padding: 20px;">
        <div style="width: 100%;">
            <div style="border: 1px solid #ddd; border-radius: 10px;">
                <div style="background: white; padding: 15px; border-bottom: 1px solid #ddd;">
                    <h5 style="margin: 0; font-size: 1.25rem;">Hapus User</h5>
                </div>
                <div style="padding: 15px;">
                    <form action="" method="post">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Pilih User</label>
                            <select style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="id_user" name="id_user" required>
                                <option value="0">-- Pilih User --</option>
                                <?php 
                                $sql_user = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                                while($r_user = mysqli_fetch_array($sql_user)) {
                                ?>
                                <option value="<?php echo $r_user['id_user']; ?>"><?php echo $r_user['username']; ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Hapus</button>
                    </form>
                    <?php 
                    if(isset($_POST['submit'])) {
                        $id_user = $_POST['id_user'];
                        if($id_user == 0) {
                            echo "<script>alert('Pilih user terlebih dahulu'); window.location = 'dashboard.php?page=hapus_user';</script>";
                        } else {
                            $query = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user = '$id_user'");
                            if($query) {
                                echo "<script>alert('Data berhasil dihapus'); window.location = 'dashboard.php?page=user';</script>";
                            } else {
                                echo "<script>alert('Data gagal dihapus'); window.location = 'dashboard.php?page=hapus_user';</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


