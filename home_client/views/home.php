<!-- Dashboard Cards -->
<div class="dashboard-grid">

            <div class="dashboard-card">
                <div class="card-content">
                    <?php 
                    $sql_uang = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                    $jumlah_uang = mysqli_fetch_array($sql_uang);
                    ?>
                    <h4>Saldo</h4>
                    <h2>Rp <?php echo $jumlah_uang['uang']; ?></h2>
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
                        <?php
                        $sql_pesanan = mysqli_query($koneksi, "SELECT * FROM tbl_pesanan, tbl_user, tbl_produk WHERE tbl_pesanan.id_user_pesanan = tbl_user.id_user AND tbl_pesanan.id_produk_pesanan = tbl_produk.id_produk ORDER BY tbl_pesanan.id_pesanan DESC LIMIT 10");
                        while ($r = mysqli_fetch_array($sql_pesanan)) {
                        ?>
                        <tr>
                            <td>#<?php echo $r['id_pesanan']; ?></td>
                            <td><?php echo $r['nama_produk']; ?></td>
                            <td>Rp <?php echo $r['total_price']; ?></td>
                            <td><?php echo $r['query'] ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="chart-card">
                <h1><center>Revenue Overview</center></h1><br>
                <p>1. Dilarang melakukan spam request yang mengakibatkan server down <br><br> 2. Membuat banyak akun pada IP yang sama maka IP otomatis akan diblokir. <br><br> 3. Pemilik sewaktu-waktu dapat mengubah ketentuan di website ini, demi menjaga kualitas website. <br><br> 4. Dilarang keras untuk menyebarkan apikey Anda, akan diblokir.</p><br><br>
                <a href="dashboard.php?page=settings" class="btn btn-primary" style="float: left;"><i class='bx bx-cog' style="margin-right: 5px; margin-top: 3px;"></i> Settings Akun</a>
            </div>
        </div>
        </div>