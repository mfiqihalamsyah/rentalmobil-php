<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : proses.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>

<body>
</body>

</html>

<?php
require 'koneksi.php';

if ($_GET['id'] == 'login') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $row = $koneksi->prepare("SELECT * FROM login WHERE username = ? AND password = md5(?)");

    $row->execute(array($user, $pass));

    $hitung = $row->rowCount();

    if ($hitung > 0) {
        session_start();
        $hasil = $row->fetch();
        $_SESSION['USER'] = $hasil;

        if ($_SESSION['USER']['level'] == 'admin') {
            echo '
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });
                
                Toast.fire({
                    icon: "success",
                    title: "Login Sukses",
                }).then(() => {
                    window.location.href = "../admin/index.php";
                });
            </script>';
        } else {
            echo '
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });
                
                Toast.fire({
                    icon: "success",
                    title: "Login Sukses",
                }).then(() => {
                    window.location.href = "../index.php";
                });
            </script>';
        }
    } else {
        echo '
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });
            
            Toast.fire({
                icon: "error",
                title: "Username atau password salah",
            }).then(() => {
                window.location.href = "../login.php";
            });
        </script>';
    }
}


if ($_GET['id'] == 'daftar') {
    $data[] = $_POST['nama'];
    $data[] = $_POST['user'];
    $data[] = md5($_POST['pass']);
    $data[] = 'pengguna';

    $row = $koneksi->prepare("SELECT * FROM login WHERE username = ?");

    $row->execute(array($_POST['user']));

    $hitung = $row->rowCount();

    if ($hitung > 0) {
        echo '
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });
            
            Toast.fire({
                icon: "error",
                title: "Daftar Gagal, Data Sudah ada",
            }).then(() => {
                history.go(-1);
            });
        </script>';
    } else {

        $sql = "INSERT INTO `login`(`nama_pengguna`, `username`, `password`, `level`)
                VALUES (?,?,?,?)";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo '
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });
            
            Toast.fire({
                icon: "success",
                title: "Daftar Sukses Silahkan Login",
            }).then(() => {
                history.go(-1);
            });
        </script>';
    }
}

if ($_GET['id'] == 'booking') {
    $dir = '../assets/ktp/';
    $tmp_name = $_FILES['img_ktp']['tmp_name'];
    $temp = explode(".", $_FILES["img_ktp"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png");

    if ($_FILES['img_ktp']["error"] > 0) {
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
                icon: "error",
                title: "Harap Upload KTP !",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } elseif (!in_array($_FILES['img_ktp']["type"], $allowedImageType)) {
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
                title: "Hanya dapat mengunggah JPG, PNG & GIF",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } elseif (round($_FILES['img_ktp']["size"] / 1024) > 4096) {
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
                title: "Besar gambar KTP tidak boleh lebih dari 4MB !",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } else {
        if (move_uploaded_file($tmp_name, $target_path)) {
            $total = $_POST['total_harga'] * $_POST['lama_sewa'];
            $unik  = random_int(100, 999);
            $total_harga = $total + $unik;

            $data[] = time();
            $data[] = $_POST['id_login'];
            $data[] = $_POST['id_mobil'];
            $data[] = $_POST['ktp'];
            $data[] = $newfilename;
            $data[] = $_POST['nama'];
            $data[] = $_POST['alamat'];
            $data[] = $_POST['no_tlp'];
            $data[] = $_POST['tanggal'];
            $data[] = $_POST['lama_sewa'];
            $data[] = $total_harga;
            $data[] = "Belum Bayar";
            $data[] = date('Y-m-d');

            $sql = "INSERT INTO booking (kode_booking, 
            id_login, 
            id_mobil, 
            ktp, 
            img_ktp, 
            nama, 
            alamat, 
            no_tlp, 
            tanggal, lama_sewa, total_harga, konfirmasi_pembayaran, tgl_input) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Anda Sukses Booking",
                    text: "Silahkan Melakukan Pembayaran !",
                }).then(() => {
                    window.location.href = "../bayar.php?id=' . time() . '";
                });
            </script>';
        } else {
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
                    icon: "error",
                    title: "Harap Upload KTP !",
                }).then(() => {
                    history.go(-1);
                });
            </script>';
            exit();
        }
    }
}

if ($_GET['id'] == 'konfirmasi') {
    $dir = '../assets/bukti/';
    $tmp_name = $_FILES['bukti']['tmp_name'];
    $temp = explode(".", $_FILES["bukti"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png");

    if ($_FILES['bukti']["error"] > 0) {
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
                icon: "error",
                title: "Harap Upload Bukti Transfer !",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } elseif (!in_array($_FILES['bukti']["type"], $allowedImageType)) {
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
                title: "Hanya dapat mengunggah JPG & PNG",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } elseif (round($_FILES['bukti']["size"] / 1024) > 4096) {
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
                title: "Besar gambar KTP tidak boleh lebih dari 4MB !",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } else {
        if (move_uploaded_file($tmp_name, $target_path)) {
            $data[] = $_POST['id_booking'];
            $data[] = $_POST['no_rekening'];
            $data[] = $_POST['nama'];
            $data[] = $_POST['nominal'];
            $data[] = $_POST['tgl'];
            $data[] = $newfilename;

            $sql = "INSERT INTO `pembayaran`(`id_booking`, `no_rekening`, `nama_rekening`, `nominal`, `tanggal`, `bukti`) 
    VALUES (?,?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);

            $data2[] = 'Sedang di proses';
            $data2[] = $_POST['id_booking'];
            $sql2 = "UPDATE `booking` SET `konfirmasi_pembayaran`=? WHERE id_booking=?";
            $row2 = $koneksi->prepare($sql2);
            $row2->execute($data2);

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Kirim Sukses",
					text: "Pembayaran anda sedang diproses",
                }).then(() => {
                    history.go(-2);
                });
            </script>';
        } else {
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
                    icon: "error",
                    title: "Harap Upload Gambar !",
                }).then(() => {
                    history.go(-1);
                });
            </script>';
            exit();
        }
    }
}
