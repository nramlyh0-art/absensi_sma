<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #FFDAE9; font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card-reg { background: white; padding: 40px; border-radius: 35px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); width: 480px; }
        h3 { color: #0056b3; font-weight: 700; text-align: center; margin-bottom: 25px; }
        .form-control, .form-select { border-radius: 12px; padding: 12px; background: #f8f9fa; border: 2px solid #eee; margin-bottom: 15px; }
        .btn-daftar { background: #2D94FF; color: white; border: none; padding: 14px; border-radius: 15px; font-weight: 700; width: 100%; transition: 0.3s; }
    </style>
</head>
<body>
<div class="card-reg">
    <h3>Daftar Akun Siswa</h3>
    <form method="POST">
        <label class="small fw-bold text-muted">USERNAME / NISN</label>
        <input type="text" name="user" class="form-control" placeholder="Contoh: amel" required>
        
        <label class="small fw-bold text-muted">NAMA LENGKAP</label>
        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
        
        <label class="small fw-bold text-muted">PILIH JURUSAN & KELAS</label>
        <select name="kelas" class="form-select" required>
            <option value="">-- Pilih Jurusan --</option>
            <optgroup label="MIPA (IPA)">
                <option value="10 MIPA">10 MIPA</option>
                <option value="11 MIPA">11 MIPA</option>
                <option value="12 MIPA">12 MIPA</option>
            </optgroup>
            <optgroup label="IIS (IPS)">
                <option value="10 IIS">10 IIS</option>
                <option value="11 IIS">11 IIS</option>
                <option value="12 IIS">12 IIS</option>
            </optgroup>
        </select>
        
        <label class="small fw-bold text-muted">PASSWORD</label>
        <input type="password" name="pass" class="form-control" placeholder="••••••••" required>
        
        <button type="submit" name="btn_daftar" class="btn-daftar shadow-sm">DAFTAR SEKARANG</button>
    </form>
    <div class="text-center mt-3"><small>Sudah punya akun? <a href="index.php" class="text-decoration-none fw-bold" style="color: #2D94FF;">Login</a></small></div>

    <?php
    if(isset($_POST['btn_daftar'])){
        $u = mysqli_real_escape_string($conn, $_POST['user']);
        $n = mysqli_real_escape_string($conn, $_POST['nama']);
        $k = mysqli_real_escape_string($conn, $_POST['kelas']);
        $p = mysqli_real_escape_string($conn, $_POST['pass']);
        $sql = "INSERT INTO users (username, nama_lengkap, kelas, password, role) VALUES ('$u', '$n', '$k', '$p', 'siswa')";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Pendaftaran Berhasil!'); window.location='index.php';</script>";
        }
    }
    ?>
</div>
</body>
</html>