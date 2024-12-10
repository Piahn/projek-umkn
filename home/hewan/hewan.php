<?php
include "koneksi.php"; // Pastikan file koneksi ke database benar

// Tangkap keyword dari query URL
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mencari data berdasarkan keyword
$sql_search = "SELECT * FROM tbl_pesanan, tbl_user, tbl_produk WHERE tbl_pesanan.id_user_pesanan = tbl_user.id_user AND tbl_pesanan.id_produk_pesanan = tbl_produk.id_produk AND (tbl_user.username LIKE '%$keyword%' OR tbl_produk.nama_produk LIKE '%$keyword%' OR tbl_produk.deskripsi LIKE '%$keyword%' OR tbl_produk.harga_produk LIKE '%$keyword%')";
$result = mysqli_query($koneksi, $sql_search);

// Hitung jumlah hasil pencarian
$total_results = mysqli_num_rows($result);
?>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="card-content">
            <h4>Total Produk</h4>
            <?php
                $sql_produk = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
                $jumlah_produk = mysqli_num_rows($sql_produk);
            ?>
            <h2><?php echo $jumlah_produk; ?></h2>
        </div>
        <div class="card-icon">
            <i class='bx bx-package'></i>
        </div>
    </div>
</div>

<div class="charts-container-grid">
    <div class="table-card">
        <h3>Recent Products</h3>
        <br>
        <div style="display: flex; justify-content: space-between;">
            <!-- Form pencarian dengan metode GET -->
            <form action="dashboard.php" method="get">
                <!-- Tetap kirimkan 'page=produk' sebagai bagian dari URL -->
                <input type="hidden" name="page" value="hewan">
                <div class="search-bar">
                    <i class="bx bx-search"></i>
                    <input 
                        type="text" 
                        name="search" 
                        id="searchInput" 
                        class="search-input" 
                        placeholder="Cari nama produk, deskripsi, atau harga..." 
                        value="<?php echo htmlspecialchars($keyword); ?>"
                    >
                </div>
            </form>
        </div>
        <br>
        <table style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if ($total_results > 0) {
                        $sql = mysqli_query($koneksi, "SELECT * FROM tbl_pesanan, tbl_user, tbl_produk WHERE tbl_pesanan.id_user_pesanan = tbl_user.id_user AND tbl_pesanan.id_produk_pesanan = tbl_produk.id_produk");
                        while($r = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $r['id_pesanan'] ?></td>
                            <td><?php echo $r['username'] ?></td>
                            <td><span style="color: green;"><?php echo $r['nama_produk'] ?></span></td>
                            <td><?php echo $r['query'] ?></td>
                        </tr>
                        <?php }  
                        } else {
                         // Jika hasil pencarian kosong
                        ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: black;">No matching records found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

