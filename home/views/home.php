<!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-content">
                    <h4>Total Users</h4>
                    <?php 
                    $sql_user = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                    $jumlah_user = mysqli_num_rows($sql_user);
                    ?>
                    <h2><?php echo $jumlah_user; ?></h2>
                    <small>+12.5% from last month</small>
                </div>
                <div class="card-icon">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-content">
                    <h4>Saldo</h4>
                    <h2>$45,230</h2>
                    <small>+8.2% from last month</small>
                </div>
                <div class="card-icon">
                    <i class="bx bx-dollar"></i>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-content">
                    <h4>Produk</h4>
                    <?php 
                    $sql_produk = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
                    $jumlah_produk = mysqli_num_rows($sql_produk);
                    ?>
                    <h2><?php echo $jumlah_produk; ?></h2>
                    <small>+15.7% from last month</small>
                </div>
                <div class="card-icon">
                    <i class="bx bx-cart"></i>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-content">
                    <?php 
                     $sql_pesanan = mysqli_query($koneksi, "SELECT * FROM tbl_pesanan, tbl_user, tbl_produk WHERE tbl_pesanan.id_user_pesanan = tbl_user.id_user AND tbl_pesanan.id_produk_pesanan = tbl_produk.id_produk");
                     $jumlah_pesanan = mysqli_num_rows($sql_pesanan);
                    ?>
                    <h4>Pesanan</h4>
                    <h2><?php echo $jumlah_pesanan; ?></h2>
                    <small>+20.1% from last month</small>
                </div>
                <div class="card-icon">
                    <i class="bx bx-line-chart"></i>
                </div>
            </div>
        </div>

        <!-- Charts and Tables Container -->
        <div class="charts-container">
            <div class="chart-card">
                <h3>Revenue Overview</h3>
                <div style="height: 300px; background: #f1f3f5; display: flex; justify-content: center; align-items: center;">
                    Chart Placeholder
                </div>
            </div>
            <div class="table-card">
                <h3>Recent Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12345</td>
                            <td>John Doe</td>
                            <td><span style="color: green;">Completed</span></td>
                            <td>$250.00</td>
                        </tr>
                        <tr>
                            <td>#12346</td>
                            <td>Jane Smith</td>
                            <td><span style="color: orange;">Pending</span></td>
                            <td>$175.50</td>
                        </tr>
                        <tr>
                            <td>#12347</td>
                            <td>Mike Johnson</td>
                            <td><span style="color: red;">Cancelled</span></td>
                            <td>$99.99</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>