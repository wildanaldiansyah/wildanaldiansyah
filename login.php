<?php
// Mulai session jika belum ada
session_start();
// Jika sudah login, bisa langsung diarahkan ke halaman dashboard/index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <!-- Sesuaikan link CSS Bootstrap dengan yang Anda gunakan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            
            <!-- Notifikasi jika login gagal -->
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Login gagal! Username atau password salah.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($_GET['pesan'] == 'belum_login'): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Anda harus login terlebih dahulu untuk mengakses halaman.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Awal Card Login -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Form Login</h3>
                </div>
                <div class="card-body">
                    <form action="aksi_login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Akhir Card Login -->

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>