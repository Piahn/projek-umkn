<style>
        .dashboard {
            max-width: 1400px;
            /* margin: 2rem auto; */
            /* display: grid; */
            grid-template-columns: 1fr 3fr;
            gap: 2rem;
            padding: 20px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--background-light);
            padding-bottom: 0.5rem;
        }

        .product-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: var(--card-background);
            border-radius: 12px;
            overflow: hidden;
        }

        /* .product-table thead {
            background-color: var(--primary-color);
            color: white;
        } */

        .product-table th, .product-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-table tr:hover {
            background-color: #f9fafb;
        }

        .btn-primary:hover {
            background-color: #4c59b0;
        }

        .btn-danger {
            background-color: red;
            color: white;
        }

        .btn-danger:hover {
            background-color: #e53e3e;
        }

        @media screen and (max-width: 1024px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
        }
</style>

<!-- Charts and Tables Container -->
<div class="charts-container-center">
    <div class="chart-card">
        <h1><center>Revenue News</center></h1>
        <p><center>Berikut merupakan daftar berita</center></p>
        <a href="dashboard.php?page=tambah_berita" class="btn btn-primary" style="float: left;">Tambah Berita</a>
    </div>
</div>

<div class="dashboard">
        <div class="card">
            <h2>Daftar Produk</h2><br>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>ID Berita</th>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_berita, tbl_admin WHERE tbl_berita.id_admin_berita=tbl_admin.id_admin");
                    while($r = mysqli_fetch_array($sql)) {

                    ?>
                    <tr>
                        <td><?php echo $r['id_berita']; ?></td>
                        <td><?php echo $r['judul_berita']; ?></td>
                        <td><?php echo $r['kategori']; ?></td>
                        <td><?php echo $r['tangal_berita']; ?></td>
                        <td><?php echo $r['username']; ?></td>
                        <td>
                            <a href="dashboard.php?page=edit_berita&id=<?php echo $r['id_berita']; ?>" class="btn btn-primary">Edit</a>
                            <a href="dashboard.php?page=hapus_berita&id=<?php echo $r['id_berita']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>