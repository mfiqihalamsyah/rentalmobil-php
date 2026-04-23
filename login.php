<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file      : history.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
require 'koneksi/koneksi.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <!-- ... (other meta tags, stylesheets, etc.) ... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <body style="margin: 0;">
        <div style="min-height: calc(85vh - 1rem); display: flex; flex-direction: column;">
            <div style="flex: 1;">
                <!-- Login -->
                <section class="py-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card shadow-lg">
                                    <div class="card-body p-5">
                                        <h2 class="card-title text-center mb-4">Silahkan Login</h2>
                                        <form method="post" action="koneksi/proses.php?id=login">
                                            <div class="form-group">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" name="user" id="username" class="form-control form-control-lg" placeholder="Masukkan username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="pass" id="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary btn-lg" type="submit">Login</button>
                                            </div>
                                        </form>
                                        <hr class="my-4">
                                        <p class="text-center mb-0">Belum punya akun? <a href="#modalId" data-bs-toggle="modal" class="text-primary">Daftar sekarang</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>

    <!-- Register -->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="koneksi/proses.php?id=daftar">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Pengguna</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-lg" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="user" id="regUsername" class="form-control form-control-lg" required placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="pass" id="regPassword" class="form-control form-control-lg" required placeholder="Masukkan password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleRegPassword">
                                    <i class="bi bi-eye" id="toggleRegIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility (Login)
        var togglePassword = document.getElementById("togglePassword");
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("toggleIcon");

        togglePassword.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        });

        // Toggle Password Visibility (Register)
        var toggleRegPassword = document.getElementById("toggleRegPassword");
        var regPasswordInput = document.getElementById("regPassword");
        var toggleRegIcon = document.getElementById("toggleRegIcon");

        toggleRegPassword.addEventListener("click", function() {
            if (regPasswordInput.type === "password") {
                regPasswordInput.type = "text";
                toggleRegIcon.classList.remove("bi-eye");
                toggleRegIcon.classList.add("bi-eye-slash");
            } else {
                regPasswordInput.type = "password";
                toggleRegIcon.classList.remove("bi-eye-slash");
                toggleRegIcon.classList.add("bi-eye");
            }
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <!-- alert https://sweetalert2.github.io/ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
<?php
include 'footer.php';
?>