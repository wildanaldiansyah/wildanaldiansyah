<?php
session_start();
require_once 'navbar.php';
require_once 'koneksi.php';

echo "<h1>selamat datang {$_SESSION['nama']}, ia sebagai {$_SESSION['role']}</ H1>";
?>
<br>
<a href="logout.php">logout</a>

<?php require_once 'footer.php' ?>