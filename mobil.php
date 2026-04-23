<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file      : mobil.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */

session_start();
require 'koneksi/koneksi.php';
include 'header.php';

// Handle search query
if (isset($_GET['cari'])) {
    $cari = strip_tags($_GET['cari']);
    $query = $koneksi->query('SELECT * FROM mobil WHERE merk LIKE "%' . $cari . '%" ORDER BY id_mobil DESC')->fetchAll();
} else {
    $query = $koneksi->query('SELECT * FROM mobil ORDER BY id_mobil DESC')->fetchAll();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mobil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .card {
            height: 400px;
            position: relative;
        }

        .card img {
            object-fit: cover;
            height: 200px;
        }

        .btn-container {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Daftar Mobil</h1><br>
        <form action="" method="get">
            <div class="input-group">
                <input type="search" name="cari" class="form-control rounded" placeholder="Cari Mobil.." aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary">Cari</button>
                <a href="mobil.php" class="btn btn-outline-primary">Lihat Semua</a>
            </div>
        </form><br>

        <div class="row" id="produk">
            <?php foreach ($query as $isi) : ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100">
                        <a href="detail.php?id=<?php echo $isi['id_mobil']; ?>">
                            <img src="assets/image/<?php echo $isi['gambar']; ?>" class="card-img-top" alt="...">
                            <div class="btn-container">
                                <div class="btn <?= $isi['status'] == 'Tersedia' ? 'btn-primary' : 'btn-danger' ?> btn-primary btn-sm mt-2 ml-2"><strong><?= $isi['status'] == 'Tersedia' ? 'Available' : 'Not Available' ?></strong></div>
                            </div>
                        </a>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-outline-secondary"><strong><?php echo $isi['merk']; ?></strong></li>
                            <li class="list-group-item bg-warning"><i class="fa fa-check"></i> Free Snack & Drinks</li>
                            <li class="list-group-item bg-dark text-white">
                                <i class="fa fa-money"></i> Rp. <?php echo number_format($isi['harga']); ?>/ day
                            </li>
                        </ul>

                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic mixed styles example">
                            <a href="booking.php?id=<?php echo $isi['id_mobil']; ?>" class="btn btn-success">Booking now!</a>
                            <a href="detail.php?id=<?php echo $isi['id_mobil']; ?>" class="btn btn-info">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <br>
    <br>
    <br>

    <?php include 'footer.php'; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>