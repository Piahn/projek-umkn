<?php
include "koneksi.php";

// Session
session_start();
if(empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo '
    <center>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <b>Maaf, Silakan Melakukan Login!</b><br><br>
    <b>Anda Telah Keluar Dari Server</b><br>
    <b>Atau Anda belum melakukan Login</b><br>

    <a href="index.php" title="Klik Link Ini untuk kembali ke login">Klik Saya</a>
    </center>
    ';
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard -  <?php echo ucfirst(str_replace("_", " ", $_GET['page'])) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --bg-color: #f4f7fa;
            --card-bg: white;
            --text-color: #333;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
            color: var(--text-color);
        }

        a {
            text-decoration: none;
            color: white;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease, transform 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-menu span {
            display: none;
        }

        .sidebar.collapsed .sidebar-header span {
            display: none;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 20px;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .menu-item i {
            margin-right: 15px;
            font-size: 20px;
        }

        .toggle-btn {
            /* cursor: pointer; */
            transition: transform 0.3s ease;
        }

        /* .toggle-btn:hover {
            transform: rotate(-180deg);
        } */

         /* Dropdown Menu */
         .profile-dropdown {
            position: absolute;
            top: 70px;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: none;
            flex-direction: column;
            width: 150px;
            z-index: 1;
        }

        .profile-dropdown a {
            padding: 10px;
            color: var(--text-color);
            text-decoration: none;
            display: block;
            transition: background 0.3s ease;
        }

        .profile-dropdown a:hover {
            background: rgba(0,0,0,0.05);
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .main-content.sidebar-collapsed {
            margin-left: -170px;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f3f5;
            border-radius: 20px;
            padding: 8px 15px;
            width: 300px;
        }

        .search-input {
            flex-grow: 1;
            padding: 0.75rem;
            border: 2px solid transparent;
            background: transparent;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        /* .search-bar input {
            border: none;
            background: transparent;
            width: 100%;
            margin-left: 10px;
        } */

        .nav-icons {
            display: flex;
            align-items: center;
        }

        .nav-icons > * {
            margin-left: 15px;
            color: #666;
            cursor: pointer;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
        }

        .card-content {
            flex-grow: 1;
        }

        .card-icon {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Chart and Table Containers */
        .charts-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            padding: 20px;
        }

        .charts-container-center {
            display: grid;
            gap: 20px;
            padding: 20px;
        }

        .charts-container-grid {
            grid-template-columns: 2fr 1fr;
            padding: 20px;
        }

        .chart-card, .table-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-card th, .table-card td {
            border-bottom: 1px solid #f1f3f5;
            padding: 10px;
            text-align: left;
        }

        .chart-grap {
            margin-top: 10px;
        }

        /* button */
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .charts-container {
                grid-template-columns: 1fr;
            }

        @keyframes collapseSidebar {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(18px);
            }
        }
        }
    </style>
    <!-- Boxicons for icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="bx bx-code-alt"></i>
                <span>Admin Dashboard</span>
            </div>
            <i class="bx bx-menu toggle-btn" id="toggleSidebar"></i>
        </div>
        
        <nav class="sidebar-menu">
            <a href="dashboard.php?page=home" class="menu-item <?php echo ($_GET['page'] == 'home') ? "active" : "" ?>">
                <i class="bx bx-grid-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="dashboard.php?page=users" class="menu-item <?php echo((($_GET['page'] == 'users') or ($_GET['page'] == 'tambah_user')) or ($_GET['page'] == 'hapus_user')) ? "active" : "" ?>">
                <i class="bx bx-user"></i>
                <span>Users</span>
            </a>
            <a href="dashboard.php?page=hewan" class="menu-item <?php echo($_GET['page'] == 'hewan') ? "active" : "" ?>">
                <i class="bx bx-chart"></i>
                <span>Analytics</span>
            </a>
            <a href="dashboard.php?page=berita" class="menu-item <?php echo((($_GET['page'] == 'berita') or ($_GET['page'] == 'tambah_berita')) or ($_GET['page'] == 'hapus_berita')) ? "active" : "" ?>">
                <i class="bx bx-message-square-detail"></i>
                <span>berita</span>
            </a>
            <a href="dashboard.php?page=tiket" class="menu-item <?php echo((((($_GET['page'] == 'tiket') or ($_GET['page'] == 'tambah_produk')) or ($_GET['page'] == 'hapus_produk')) or ($_GET['page'] == 'detail_produk')) or ($_GET['page'] == 'edit_produk')) ? "active" : "" ?>">
                <i class='bx bx-store-alt'></i>
                <span>Produk</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <div class="search-bar">
                <i class="bx bx-search"></i>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="search-input" 
                    placeholder="Cari username atau email..."
                >
            </div>
            <div class="nav-icons">
                <i class="bx bx-bell"></i>
                <i class="bx bx-message-square-dots"></i>
                <img src="../././projek/img/github.png" alt="Profile" style="border-radius: 50%; width: 40px; height: 40px;" id="profileImage">
                    <div class="profile-dropdown" id="profileDropdown" style="right: 0;">
                        <a href="dashboard.php?page=profile" style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 15px;"><i class='bx bx-group' style="margin-right: 10px;"></i>Profile</a>
                        <a href="dashboard.php?page=settings" style="display: flex; align-items: center;"><i class='bx bx-cog' style="margin-right: 10px;"></i>Settings</a>
                        <a href="logout.php" style="display: flex; align-items: center;"><i class='bx bx-log-out' style="margin-right: 10px;"></i>Logout</a>
                    </div>
            </div>
        </div>

        <?php 
        if (isset($_GET['page'])) {
            switch($_GET['page']) {
                // menu home
                case 'home':
                    include "home/views/home.php";
                break;  

                // user
                case 'users':
                    include "home/user/users.php";
                break;
                case 'tambah_user':
                    include "home/user/tambahuser.php";
                break;
                case 'hapus_user':
                    include "home/user/hapususer.php";
                break;

                // statis data
                case 'hewan':
                    include "home/hewan/hewan.php";
                break;

                // produk
                case 'tiket':
                    include "home/tiket/tiket.php";
                break;
                case 'tambah_produk':
                    include "home/tiket/tambahproduk.php";
                break;
                case 'hapus_produk':
                    include "home/tiket/hapusproduk.php";
                break;
                case 'detail_produk':
                    include "home/tiket/semuaproduk.php";
                break;
                case 'edit_produk':
                    include "home/tiket/editproduk.php";
                break;

                // berita
                case 'berita':
                    include "home/berita/berita.php";
                break;
                case 'tambah_berita':
                    include "home/berita/tambahberita.php";
                break;
                case 'hapus_berita':
                    include "home/berita/hapusberita.php";
                break;
                case 'edit_berita':
                    include "home/berita/editberita.php";
                break;

                // data profile
                case 'profile':
                    include "profile/profile.php";
                break;
                case 'settings':
                    include "profile/settings.php";
                break;
                default:
                    echo "<h3><center>Halaman Tidak Ada</center></h3>";
                break;
            }
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn.addEventListener('click', () => {
            // Toggle sidebar class
            sidebar.classList.toggle('collapsed');
            
            // Toggle main content margin
            // mainContent.classList.toggle('sidebar-collapsed');
        });

        // Profile Dropdown Functionality
        const profileImage = document.getElementById('profileImage');
        const profileDropdown = document.getElementById('profileDropdown');

        profileImage.addEventListener('click', () => {
            profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
        });

        window.addEventListener('click', (event) => {
            if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>

<?php
    }
?>