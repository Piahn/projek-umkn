<style>
        .dashboard {
            max-width: 1400px;
            margin: 2rem auto;
            display: grid;
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
    <div class="dashboard">
        <div class="card">
            <?php 
            $sql = mysqli_query($koneksi, "SELECT COUNT(id_produk) as total FROM tbl_produk");
            $r = mysqli_fetch_array($sql);
            ?>
            <h2>Ringkasan Produk</h2><br>
            <p>Jumlah produk: <?php echo $r['total'] ?></p><br>
            <a href="dashboard.php?page=detail_produk" class="btn btn-primary">Lihat Semua Produk</a>
            <a href="dashboard.php?page=tambah_produk" class="btn btn-primary">Tambah Produk</a>
        </div>

        <div class="card">
            <h2>Daftar Produk</h2><br>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
                    while($r = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td><?php echo $r['id_produk']; ?></td>
                        <td><?php echo $r['nama_produk']; ?></td>
                        <td>Rp <?php echo $r['harga_produk']; ?></td>
                        <td><?php echo $r['stok_produk']; ?></td><br>
                        <td><?php echo $r['deskripsi'];?></td>
                        <td>
                            <a href="dashboard.php?page=edit_produk&id=<?php echo $r['id_produk']; ?>" class="btn btn-primary"><i class='bx bx-edit'></i></a>
                            <a href="dashboard.php?page=hapus_produk&id=<?php echo $r['id_produk']; ?>" class="btn btn-danger"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>