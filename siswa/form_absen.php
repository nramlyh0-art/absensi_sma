<?php 
include '../includes/db.php'; 
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if(isset($_POST['submit'])){
    $uid = $_SESSION['user_id'];
    $ket = $_POST['keterangan'];
    
    // Folder tujuan sesuai cuplikan layar folder kamu: assets/img/bukti/
    $target_dir = "../assets/img/bukti/"; 
    $filename = "BUKTI_" . time() . ".jpg";
    $target_file = $target_dir . $filename;

    if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
        mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, keterangan, bukti_foto, status_validasi) 
                             VALUES ('$uid', CURDATE(), '$ket', '$filename', 'Pending')");
        echo "<script>alert('Absen Berhasil!'); window.location='dashboard.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #FFDAE9; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .card-form { background: white; border-radius: 35px; padding: 40px; width: 400px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .btn-check:checked + .btn-outline-primary { background-color: #2D94FF; color: white; border-color: #2D94FF; }
        .btn-opt { border-radius: 15px; padding: 12px; margin-bottom: 10px; width: 100%; font-weight: bold; }
    </style>
</head>
<body>
<div class="card-form text-center">
    <h3 class="fw-bold mb-4">Pilih Kehadiran</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <input type="radio" class="btn-check" name="keterangan" id="h" value="Hadir" required>
            <label class="btn btn-outline-primary btn-opt" for="h">HADIR</label>

            <input type="radio" class="btn-check" name="keterangan" id="s" value="Sakit">
            <label class="btn btn-outline-primary btn-opt" for="s">SAKIT</label>

            <input type="radio" class="btn-check" name="keterangan" id="i" value="Izin">
            <label class="btn btn-outline-primary btn-opt" for="i">IZIN</label>
        </div>

        <div class="mb-4 text-start">
            <label class="small fw-bold mb-2">UNGGAH FOTO BUKTI</label>
            <input type="file" name="foto" class="form-control rounded-pill" accept="image/*" capture="camera" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold">KIRIM SEKARANG</button>
        <a href="dashboard.php" class="btn btn-link mt-2 text-muted text-decoration-none small">Kembali</a>
    </form>
</div>
</body>
</html>