<?php
require_once 'koneksi.php';

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'editadmin') {
    $id       = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $pass     = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'admin';

    if ($pass !== '') {
        $password_hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $password_hash, $role, $id);
    } else {
        $stmt = $koneksi->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Data Berhasil Diubah'); window.location.href='daftar_user2.php';</script>";
    } else {
        echo "<script>alert('Data Tidak Berhasil Diubah'); window.location.href='daftar_user2.php';</script>";
    }
    $stmt->close();

} elseif ($aksi === 'editguru') {
    $id       = $_POST['id'] ?? '';
    $user_id  = $_POST['user_id'] ?? '';
    $nip      = $_POST['nip'] ?? '';
    $nama     = $_POST['nama'] ?? '';          // ← sebelumnya nama_lengkap
    $jk       = $_POST['jenis_kelamin'] ?? '';
    $username = $_POST['username'] ?? '';
    $pass     = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'guru';

    // Update tabel users
    if ($pass !== '') {
        $password_hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt1 = $koneksi->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt1->bind_param("sssi", $username, $password_hash, $role, $user_id);
    } else {
        $stmt1 = $koneksi->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt1->bind_param("ssi", $username, $role, $user_id);
    }
    $result = $stmt1->execute();
    $stmt1->close();

    // Update tabel guru
    $stmt2 = $koneksi->prepare("UPDATE guru SET nip = ?, nama = ?, jenis_kelamin = ? WHERE id = ?");
    $stmt2->bind_param("sssi", $nip, $nama, $jk, $id);
    $hasil = $stmt2->execute();
    $stmt2->close();

    if ($result && $hasil) {
        echo "<script>alert('Data Berhasil Diubah'); window.location.href='daftar_user2.php';</script>";
    } else {
        echo "<script>alert('Data Tidak Berhasil Diubah'); window.location.href='daftar_user2.php';</script>";
    }

} elseif ($aksi === 'editsiswa') {
    $id      = $_POST['id'] ?? '';
    $user_id = $_POST['user_id'] ?? '';
    $nis     = $_POST['nis'] ?? '';
    $nama    = $_POST['nama'] ?? '';           // ← sebelumnya nama_lengkap
    $kelas   = $_POST['kelas'] ?? '';
    $jk      = $_POST['jenis_kelamin'] ?? '';
    $user    = $_POST['username'] ?? '';
    $pass    = $_POST['password'] ?? '';
    $role    = $_POST['role'] ?? 'siswa';

    // Update tabel users
    if ($pass !== '') {
        $password_hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt1 = $koneksi->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt1->bind_param("sssi", $user, $password_hash, $role, $user_id);
    } else {
        $stmt1 = $koneksi->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt1->bind_param("ssi", $user, $role, $user_id);
    }
    $result = $stmt1->execute();
    $stmt1->close();

    // Update tabel siswa
    $stmt2 = $koneksi->prepare("UPDATE siswa SET nis = ?, nama = ?, kelas = ?, jenis_kelamin = ? WHERE id = ?");
    $stmt2->bind_param("ssssi", $nis, $nama, $kelas, $jk, $id);
    $hasil = $stmt2->execute();
    $stmt2->close();

    if ($result && $hasil) {
        echo "<script>alert('Data Berhasil Diubah'); window.location.href='daftar_user2.php';</script>";
    } else {
        echo "<script>alert('Data Tidak Berhasil Diubah'); window.location.href='daftar_user2.php';</script>";
    }

} else {
    echo "<script>alert('Aksi tidak valid'); window.location.href='daftar_user2.php';</script>";
}
?>

aksi edit user php