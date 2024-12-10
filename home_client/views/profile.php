<!-- Dashboard Cards -->
<div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-content">
                    <h2>Username</h2>
                    <h4><?php echo $_SESSION['username'] ?></h4>
                </div>
                <div class="card-icon">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-content">
                    <h4>email</h4>
                    <h3><?php echo $_SESSION['email'] ?></h3>
                </div>
                <div class="card-icon">
                    <i class='bx bxl-gmail'></i>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-content">
                    <h4>Role</h4>
                    <?php if (isset($_SESSION['id_admin'])) { ?>
                        <h2>Admin</h2>
                    <?php } elseif (isset($_SESSION['id_user'])) { ?>
                        <h2>User</h2>
                    <?php } ?>
                </div>
                <div class="card-icon">
                    <i class='bx bx-medal'></i>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="card-content">
                    <h4>Address</h4>
                    <h2><?php echo $_SERVER['REMOTE_ADDR']; ?></h2>
                </div>
                <div class="card-icon">
                    <i class='bx bx-rss'></i>
                </div>
            </div>
        </div>

        <!-- Charts and Tables Container -->
        <div class="charts-container">
            <div class="chart-card">
                <h1><center>Revenue Overview</center></h1><br>
                <p>1. Dilarang melakukan spam request yang mengakibatkan server down <br><br> 2. Membuat banyak akun pada IP yang sama maka IP otomatis akan diblokir. <br><br> 3. Pemilik sewaktu-waktu dapat mengubah ketentuan di website ini, demi menjaga kualitas website. <br><br> 4. Dilarang keras untuk menyebarkan apikey Anda, akan diblokir.</p><br><br>
                <a href="dashboard.php?page=settings" class="btn btn-primary" style="float: left;"><i class='bx bx-cog' style="margin-right: 5px; margin-top: 3px;"></i> Settings Akun</a>
            </div>
        </div>