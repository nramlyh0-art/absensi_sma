<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 card shadow p-4">
            <h3 class="text-center">Daftar Akun Siswa</h3>
            <form method="POST">
                <input type="text" name="nisn" class="form-control mb-2" placeholder="NISN (untuk Username)" required>
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap" required>
                <input type="text" name="kelas" class="form-control mb-2" placeholder="Kelas (Contoh: XII-IPA-1)" required>
                <input type="password" name="pass" class="form-control mb-3" placeholder="Password" required>
                <button name="reg" class="btn btn-success w-100">Daftar Sekarang</button>
            </form>
            <p class="mt-3 text-center">Sudah punya akun? <a href="index.php">Login</a></p>
            <?php
            if(isset($_POST['reg'])){
                $u = $_POST['nisn']; $n = $_POST['nama']; $k = $_POST['kelas']; $p = $_POST['pass'];
                // Simpan ke tabel users
                $q1 = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$u', '$p', 'siswa')");
                $id_baru = mysqli_insert_id($conn);
                // Simpan ke tabel profiles
                $q2 = mysqli_query($conn, "INSERT INTO profiles (user_id, nama_lengkap, nisn, kelas) VALUES ('$id_baru', '$n', '$u', '$k')");
                if($q1 && $q2){
                    echo "<script>alert('Pendaftaran Berhasil!'); window.location='index.php';</script>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html> 