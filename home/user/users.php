<?php
include "koneksi.php"; // Pastikan file koneksi ke database benar

// Tangkap keyword dari query URL
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mencari data berdasarkan keyword
$sql_search = "SELECT * FROM tbl_user WHERE username LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $sql_search);

// Hitung jumlah hasil pencarian
$total_results = mysqli_num_rows($result);
?>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="card-content">
            <h4>Total Users</h4>
            <?php
                $sql_user = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                $i = 1;
            ?>
            <h2><?php echo mysqli_num_rows($sql_user); ?></h2>
        </div>
        <div class="card-icon">
            <i class="bx bx-user"></i>
        </div>
    </div>
</div>
<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="card-content">
            <h4>Total Admin</h4>
            <?php
                $sql_admin = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_admin = 2");
            ?>
            <h2><?php echo mysqli_num_rows($sql_admin); ?></h2>
        </div>
        <div class="card-icon">
            <i class="bx bx-user"></i>
        </div>
    </div>
</div>

<div class="charts-container-grid">
    <div class="table-card">
        <h3>Recent Orders</h3>
        <br>
        <div style="display: flex; justify-content: space-between;">
            <!-- Form pencarian dengan metode GET -->
            <form action="dashboard.php" method="get">
                <!-- Tetap kirimkan 'page=users' sebagai bagian dari URL -->
                <input type="hidden" name="page" value="users">
                <div class="search-bar">
                    <i class="bx bx-search"></i>
                    <input 
                        type="text" 
                        name="search" 
                        id="searchInput" 
                        class="search-input" 
                        placeholder="Cari username admin atau user..." 
                        value="<?php echo htmlspecialchars($keyword); ?>"
                    >
                </div>
            </form>
            <div style="display: flex; justify-content: space-between;">
                <a href="dashboard.php?page=tambah_user" style="background-color: green; color: white; padding: 20px 15px 20px; border-radius: 5px; text-decoration: none; margin-right: 10px; display: inline-block;">
                    <i class='bx bx-user-plus' style="font-size: 20px; margin-right: 3px;"></i>
                </a>
                <a href="dashboard.php?page=hapus_user" style="background-color: red; color: white; padding: 20px 15px 20px; border-radius: 5px; text-decoration: none; display: inline-block;">
                    <i class='bx bx-user-minus' style="font-size: 20px; margin-right: 3px;"></i>
                </a>
            </div>
        </div>
        <br>
        <table style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>ID Account</th>
                    <th>Account</th>
                    <th>Gmail</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($total_results > 0) {
                    // Jika hasil pencarian ada
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['user_status']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    // Jika hasil pencarian kosong
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: black;">No matching records found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>