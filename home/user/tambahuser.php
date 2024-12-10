<div class="charts-container-center">
    <div class="chart-card">
        <h1><center>Pengaturan Data User</center></h1>
        <p><center>Tempat untuk menambah data user</center></p>
    </div>
</div>


<div style="charts-container-center margin-top: 20px;">
    <div style="display: grid; padding: 20px;">
        <div style="width: 100%;">
            <div style="border: 1px solid #ddd; border-radius: 10px;">
                <div style="background: white; padding: 15px; border-bottom: 1px solid #ddd;">
                    <h5 style="margin: 0; font-size: 1.25rem;">Tambah User</h5>
                </div>
                <div style="padding: 15px;">
                    <form action="" method="post">
                        <div style="margin-bottom: 15px;">
                            <label for="nama" style="display: block; margin-bottom: 5px;">Nama</label>
                            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="nama" name="nama" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
                            <input type="email" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="email" name="email" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label for="password" style="display: block; margin-bottom: 5px;">Password</label>
                            <input type="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="password" name="password" required>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px;">Role</label>
                            <select style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" id="role" name="role" required>
                                <option value="0">-- Pilih Role --</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Tambah</button>
                    </form>
                    <?php 
                    if(isset($_POST['submit'])) {
                        $name = $_POST['nama'];
                        $email = $_POST['email'];
                        $password = md5($_POST['password']);
                        $role = $_POST['role'];
                        if($role == 1) {
                            $query = mysqli_query($koneksi, "INSERT INTO tbl_admin (username, email, password, admin_status) VALUES ('$name', '$email', '$password', 'Admin')");
                        } else {
                            $query = mysqli_query($koneksi, "INSERT INTO tbl_user (username, email, password, user_status) VALUES ('$name', '$email', '$password', 'User')");
                        }
                        if($query) {
                            echo "<script>alert('Data berhasil disimpan'); window.location = 'dashboard.php?page=user';</script>";
                        } else {
                            echo "<script>alert('Data gagal disimpan'); window.location = 'dashboard.php?page=tambah_user';</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


