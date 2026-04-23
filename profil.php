<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file     : profil.php 
  | @author   : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

// Pastikan pengguna telah login
if (empty($_SESSION['USER'])) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>';
    echo '
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        
        Toast.fire({
            icon: "warning",
            title: "Harap Login !",
        }).then(() => {
            window.location.href = "login.php";
        });
    </script>';
    exit();
}

if (!empty($_POST['nama_pengguna'])) {
    $nama_pengguna = htmlspecialchars($_POST["nama_pengguna"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = md5($_POST["password"]);
    $id_login = $_SESSION['USER']['id_login'];

    // Cek apakah username sudah ada atau belum
    $sql_check_username = "SELECT COUNT(*) FROM login WHERE username = ? AND id_login != ?";
    $row_check_username = $koneksi->prepare($sql_check_username);
    $row_check_username->execute([$username, $id_login]);
    $is_username_exists = $row_check_username->fetchColumn();

    if ($is_username_exists > 0) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Username sudah ada!",
                text: "Silakan pilih username lain.",
            });
        </script>';
    } else {
        // Cek apakah password kosong atau tidak, jika kosong, gunakan password yang sudah ada di database
        if (empty($_POST['password'])) {
            $sql_get_password = "SELECT password FROM login WHERE id_login = ?";
            $row_get_password = $koneksi->prepare($sql_get_password);
            $row_get_password->execute([$id_login]);
            $edit_profil = $row_get_password->fetch(PDO::FETCH_OBJ);
            $password = $edit_profil->password;
        }

        $sql = "UPDATE login SET nama_pengguna = ?, username = ?, password = ? WHERE id_login = ?";
        $row = $koneksi->prepare($sql);

        // Periksa apakah update berhasil atau tidak
        if ($row->execute([$nama_pengguna, $username, $password, $id_login])) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Update Data Profil Berhasil!",
                }).then(() => {
                    window.location.href = "profil.php";
                });
            </script>';
            exit;
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal melakukan update data profil.",
                });
            </script>';
        }
    }
}

$id =  $_SESSION["USER"]["id_login"];
$sql = "SELECT * FROM login WHERE id_login = ?";
$row = $koneksi->prepare($sql);
$row->execute([$id]);
$edit_profil = $row->fetch(PDO::FETCH_OBJ);
?>


<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama_pengguna">Nama Pengguna</label>
                            <input type="text" class="form-control" value="<?= $edit_profil->nama_pengguna; ?>" name="nama_pengguna" id="nama_pengguna" required placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" required class="form-control" value="<?= $edit_profil->username; ?>" name="username" id="username" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" required class="form-control" value="" name="password" id="password" placeholder="" />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

<?php include 'footer.php'; ?>