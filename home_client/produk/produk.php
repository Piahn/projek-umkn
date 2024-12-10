<?php
include "koneksi.php"; // Pastikan file koneksi ke database benar

// Tangkap keyword dari query URL
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mencari data berdasarkan keyword
$sql_search = "SELECT * FROM tbl_produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%' OR harga_produk LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $sql_search);

// Hitung jumlah hasil pencarian
$total_results = mysqli_num_rows($result);
?>
<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="card-content">
            <h4>Total Products</h4>
            <?php
                $sql_produk = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
                $i = 1;
            ?>
            <h2><?php echo mysqli_num_rows($sql_produk); ?></h2>
        </div>
        <div class="card-icon">
            <i class="bx bx-shopping-bag"></i>
        </div>
    </div>
</div>

<div class="charts-container-grid">
    <div class="table-card">
        <h3>Recent Products</h3>
        <br>
        <div style="display: flex; justify-content: space-between;">
            <!-- Form pencarian dengan metode GET -->
            <form action="home.php" method="get">
                <!-- Tetap kirimkan 'page=produk' sebagai bagian dari URL -->
                <input type="hidden" name="page" value="produk">
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
                    <th>Harga</th>
                    <th>Stok</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($total_results > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['nama_produk']; ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                            <td>Rp <?php echo $row['harga_produk']; ?></td>
                            <td><?php echo $row['stok_produk']; ?></td>
                            <td>
                            <form action="home.php?page=tambah_pesan&id=<?php echo $row['id_produk']; ?>" method="post">
                                <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
                                <button type="submit" class="btn btn-primary">Beli Produk</button>
                            </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: black;">No matching records found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
